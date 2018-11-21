<?php
namespace app\index\controller;
use app\common\controller\IndexBase;
use think\Loader;
class Order extends IndexBase {
    public $data = null;
    public function createOrder() {
        $data          = input('post.');
        $order         = [];
        $id = session('userInfo.id');
        $user = model('user')->where('id',$id)->find();
        session('userInfo',$user);
        $order['addr'] = model('address')->getAddr(session('userInfo.id'), 1);
        if (empty($order['addr'])) {
            $order['addr'] = model('address')->getAddr(session('userInfo.id'), 0);
        }
        $order['product'] = model('product')->getProductByID(implode(',', $data['id']), 'in');
        $order['totalprice'] = $data['totalprice'];
        $order['num']        = $data['num'];

        $this->assign('order', $order);
        return $this->fetch();
    }

    public function order() {
        $user = session('userInfo');
        $tmp                   = input('post.data');
        $data                  = json_decode($tmp, true);
        $order                 = [];
        $order['uid']          = session('userInfo.id');
        $order['addr_id']      = $data['addrid'];
        $order['out_trade_no'] = date('YmdHis') . rand(1000, 9999);
        $voucher = $data['voucher'];
        if ($voucher==1 && $user->voucher==500){
            $order['endprice']     = $data['endprice'] - $user->voucher;
            model('user')->where('id',$user->id)->update(['voucher'=>0]);
            $user->voucher = 0;
            session('userInfo',$user);
        } else {
            $order['endprice']     = $data['endprice'];
        }
        $order['created'] = time();
        $id                    = model('order')->insertGetId($order);
        if ($id) {
            $orderPro = [];
            $proid    = $data['proid'];
            $pronum   = $data['pronum'];
            $suit    = $data['suit'];
            $price    = $data['proprice'];
            $num = count($proid);
            for ($i = 0; $i < $num; $i++) {
                $orderPro[$i]['oid']    = $id;
                $orderPro[$i]['proid']  = $proid[$i];
                $orderPro[$i]['pronum'] = $pronum[$i];
                $proprice               = 0;
                if ($pronum[$i] >= 10) {
                    $proprice = floor($pronum[$i] / 10) * $suit[$i];
                    $proprice += $pronum[$i] % 10 * $price[$i];
                } else {
                    $proprice = $pronum[$i] % 10 * $price[$i];
                }
                $orderPro[$i]['proprice'] = $proprice;
            }
            $res = model('orderproducts')->insertAll($orderPro);
            if ($res) {
                model('cart')->where('userid',$user->id)->delete();
                return $id;
            }
            return 0;
        } else {
            return 0;
        }
    }

    public function pay() {
        Loader::import('wxpay.lib.WxPayJsPay');
        Loader::import('wxpay.lib.WxPayConfig');
        Loader::import('wxpay.lib.WxPayException');
        $code = input('get.code');

        if (empty($code)){
            $this->GetOpenid();
        } else {
            $id = input('get.id');
            $order = model('order')->where('id',$id)->find();
            $params =[];
            $params['body'] = '人参萃取精华丸';
            $params['total_fee']=1;
            $params['out_trade_no'] = $order['out_trade_no'];
            $openId = $this->GetOpenidFromMp($code);
            $jsApiParameters = \wxpay\JsapiPay::getParams($params,$openId);
            $this->assign('jsApiParameters',$jsApiParameters);
            return $this->fetch();
        }
    }

    public function GetOpenid($code='')
    {
        //通过code获得openid
        if (empty($code)){
            //触发微信返回code码
            $str = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $baseUrl = urlencode($str);//.$_SERVER['QUERY_STRING']
            $url = $this->__CreateOauthUrlForCode($baseUrl);
            Header("Location: $url");
            exit();
        } else {
            //获取code码，以获取openid
            $openid = $this->GetOpenidFromMp($code);
            return $openid;
        }
    }

    private function __CreateOauthUrlForCode($redirectUrl)
    {
        $urlObj["appid"] = \WxPayConfig::APPID;
        $urlObj["redirect_uri"] = "$redirectUrl";
        $urlObj["response_type"] = "code";
        $urlObj["scope"] = "snsapi_base";
        $urlObj["state"] = "STATE"."#wechat_redirect";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
    }

    public function GetOpenidFromMp($code)
    {
        $url = $this->__CreateOauthUrlForOpenid($code);
        //初始化curl
        $ch = curl_init();
        //设置超时
        // curl_setopt($ch, CURLOPT_TIMEOUT, $this->curl_timeout);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if(\WxPayConfig::CURL_PROXY_HOST != "0.0.0.0"
            && \WxPayConfig::CURL_PROXY_PORT != 0){
            curl_setopt($ch,CURLOPT_PROXY , \WxPayConfig::CURL_PROXY_HOST);
            curl_setopt($ch,CURLOPT_PROXYPORT, \WxPayConfig::CURL_PROXY_PORT);
        }
        //运行curl，结果以jason形式返回
        $res = curl_exec($ch);
        curl_close($ch);
        //取出openid
        $data = json_decode($res,true);

        // 结果检测
        if(empty($data['openid'])) {
            throw new \WxPayException($data['errmsg']);
        }

        $this->data = $data;
        $openid = $data['openid'];
        return $openid;
    }
    private function __CreateOauthUrlForOpenid($code)
    {
        $urlObj["appid"] = \WxPayConfig::APPID;
        $urlObj["secret"] = \WxPayConfig::APPSECRET;
        $urlObj["code"] = $code;
        $urlObj["grant_type"] = "authorization_code";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
    }

    private function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v)
        {
            if($k != "sign"){
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        return $buff;
    }
}
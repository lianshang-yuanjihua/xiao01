<?php

namespace app\common\common;

class Function {
    /**
     * 微信支付方法
     * @param  string $openid    用户的openid
     * @param  string $goods     商品名称
     * @param  string $order     订单号
     * @param  string $total_fee 总金额
     * @param  string $attach    附加参数,可填订单id
     */
    public function wxpay($openId, $goods, $order_sn, $total_fee, $attach) {
        require_once APP_PATH . 'wxpayapi/lib/WxPay.Api.php';
        require_once APP_PATH . 'wxpayapi/example/WxPayJsApiPay.php';
        require_once APP_PATH . 'wxpayapi/example/log.php';
        require_once APP_PATH . 'wxpayapi/example/WxPay.Config.php';

        //初始化日志
        $logHandler = new CLogFileHandler(APP_PATH . "/wxpayapi/logs/" . date('Y-m-d') . '.log');
        $log        = Log::Init($logHandler, 15);

        try {
            //①、获取用户openid
            $tools = new JsApiPay();
            if (empty($openId)) {
                $openId = $tools->GetOpenid();
            }

            //②、统一下单
            $input = new WxPayUnifiedOrder();
            $input->SetBody($goods);
            $input->SetAttach($attach);
            $input->SetOut_trade_no($order_sn);
            $input->SetTotal_fee($total_fee);
            $input->SetTime_start(date("YmdHis"));
            $input->SetTime_expire(date("YmdHis", time() + 600));
            $input->SetGoods_tag("test");
            $input->SetNotify_url("http://" . $_SERVER['HTTP_HOST'] . "/payment");
            $input->SetTrade_type("JSAPI");
            $input->SetOpenid($openId);
            $config = new WxPayConfig();
            $order  = WxPayApi::unifiedOrder($config, $input);
            // echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
            // printf_info($order);
            $jsApiParameters = $tools->GetJsApiParameters($order);
            return $jsApiParameters;
            //获取共享收货地址js函数参数
            // $editAddress = $tools->GetEditAddressParameters();
        } catch (Exception $e) {
            Log::ERROR(json_encode($e));
        }
    }
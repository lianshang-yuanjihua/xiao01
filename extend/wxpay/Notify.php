<?php

namespace wxpay;

use think\Loader;

require_once 'lib/WxPayException.php';
Loader::import('wxpay.lib.WxPayApi');
Loader::import('wxpay.lib.WxPayNotify');

/**
 * 异步通知处理类
 *
 *
 */
class Notify extends \WxPayNotify {
    /**
     * 此为主函数, 即处理自己业务的函数, 重写后, 框架会自动调用
     *
     * @param array $data 微信传递过来的参数数组
     * @param string $msg 错误信息, 用于记录日志
     */
    public function NotifyProcess($data, &$msg) {
        // 一下均为实例代码
        // 1.校检参数
        if (!array_key_exists("transaction_id", $data)) {
            $msg = "输入参数不正确";
            return false;
        }

        // 2.微信服务器查询订单，判断订单真实性(可不需要)
        if (!$this->Queryorder($data["transaction_id"])) {
            $msg = "订单查询失败";
            return false;
        }

        // 3.去本地服务器检查订单状态(强烈建议需要)
        $order = $this->getOrder($data);
        if (empty($order)) {
            $msg = '本地订单不存在';
            return false;
        }

        // 4.检查订单状态
        if ($this->checkOrderStatus($order)) {
            // 如果订单处理过, 则直接返回true
            return true;
        }

        // 订单状态未修改情况下, 进行处理业务
        $result = $this->processOrder($order, $data);
        if (!$result) {
            $msg = '订单处理失败';
            return false;
        }

        return true;
    }

    /**
     * 处理核心业务
     * @param  array $order 订单信息
     * @param  array $data  通知数组
     * @return Boolean
     */
    public function processOrder($order, $data) {
            //检查支付是否成功
//        if ($data['get_brand_wcpay_request'] == 'ok'){
//            db('order')
//                ->where('id', $order['id'])
//                ->update(['status' => 1, 'transaction_id' => $data['transaction_id']]);
//
//            $user =session('userInfo');
//            //查看该用户是否有上级
//            if ($user->pid !=0){
//                //有
//                $pid1 = $user->pid;
//                $puser = db('user')->where('id',$pid1)->find();
//                $num = 0;//参与提成的商品数
//                //查看该用户上级是否为代理商
//                if ($puser->cloudwh != 0){
//                    //是代理商则查看商品数量,检查是否使用代金券,扣除代理商云仓相应的存货并结算推荐奖励
//                    $orderproducts = model('orderproducts')->where('oid',$order->id)->select();
//                    foreach ($orderproducts as $detail){
//                        $num += $detail->pronum;
//                    }
//                    $num -= $order->type;//减去使用的代金券
//                    if ($num >0)
//                    db('user')->where('id',$pid1)
//                        ->dec('cloudwh',$num)
//                        ->inc('balance',$num * 70)
//                        ->update();
//                } else{
//                    if ($num >0)
//                        db('user')->where('id',$pid1)->setInc('balance',$num * 70);
//                }
//                $tmp = trim($user->path,'--');
//                $path = explode('--',$tmp);
//
//                //第二级
//                if (count($path)>=2 && $num>0){
//                    $pid2 = $path[array_search($pid1,$path)-1];
//                    db('user')->where('id',$pid2)->setInc('balance',$num * 70);
//                }
//
//            } else {
//                //没有
//
//            }
//
//        } else {
//            return false;
//        }
        return true;

    }

    // 去微信服务器查询是否有此订单
    public function Queryorder($transaction_id) {
        $input = new \WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = \WxPayApi::orderQuery($input);
        if (array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS") {
            return true;
        }
        return false;
    }

    // 去本地服务器查询订单信息
    public function getOrder($data) {

        $order = db('order')->where('out_trade_no', $data['out_trade_no'])->find();
        return $order;
    }

    /**
     * 检查order状态, 是否已经做过修改, 避免重复修改
     * 原因: 可能由于业务处理较慢, 还未等回复微信服务器, 同一订单的另一个通知已到达,
     *      为了避免重复修改订单, 需要对状态进行检查
     *
     * @return Boolean
     */
    public function checkOrderStatus($order) {
        // 检查还未修改, 则返回true, 检查已经修改过了, 则返回false
        // 例如:
        return $order['status'] == 1 ? true : false;
    }

}

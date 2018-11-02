<?php

namespace app\wxpayAPI\controller;
require_once APP_PATH . 'wxpayapi/lib/WxPay.Notify.php';
use \WxPayNotify;

class WeixinPay extends WxPayNotify {

//微信支付回调验证
    public function notify() {
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];

        // 这句file_put_contents是用来查看服务器返回的XML数据 测试完可以删除了
        file_put_contents('./logs/log.txt', $xml, FILE_APPEND);

        //将服务器返回的XML数据转化为数组
        //$data = json_decode(json_encode(simplexml_load_string($xml,'SimpleXMLElement',LIBXML_NOCDATA)),true);
        $data = xmlToArray($xml);
        // 保存微信服务器返回的签名sign
        $data_sign = $data['sign'];
        // sign不参与签名算法
        unset($data['sign']);
        $sign = $this->makeSign($data);

        // 判断签名是否正确  判断支付状态
        if (($sign === $data_sign) && ($data['return_code'] == 'SUCCESS') && ($data['result_code'] == 'SUCCESS')) {
            $result = $data;
            // 这句file_put_contents是用来查看服务器返回的XML数据 测试完可以删除了
            file_put_contents('./logs/log1.txt', $xml, FILE_APPEND);

            //获取服务器返回的数据
            $order_sn  = $data['out_trade_no']; //订单单号
            $order_id  = $data['attach']; //附加参数,选择传递订单ID
            $openid    = $data['openid']; //付款人openID
            $total_fee = $data['total_fee']; //付款金额

            //更新数据库
            // $this->updateDB($order_id, $order_sn, $openid, $total_fee);
        } else {
            $result = false;
        }
        // 返回状态给微信服务器
        if ($result) {
            $str = '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
        } else {
            $str = '<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[签名失败]]></return_msg></xml>';
        }
        echo $str;
        return $result;
    }

}
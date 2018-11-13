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
class Notify extends \WxPayNotify
{
    /**
     * 此为主函数, 即处理自己业务的函数, 重写后, 框架会自动调用
     *
     * @param array $data 微信传递过来的参数数组
     * @param string $msg 错误信息, 用于记录日志
     */
    public function NotifyProcess($data, &$msg)
    {
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
     * @param $order 订单对象
     * @param $data 通知对象
     * @return boolean
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function processOrder($order, $data)
    {
        //检查支付是否成功
        if ($data['get_brand_wcpay_request'] == 'ok') {
            db('order')
                ->where('id', $order['id'])
                ->update(['status' => 1, 'transaction_id' => $data['transaction_id']]);

            $user = session('userInfo');
            //查看该用户是否有上级
            if ($user->pid != 0) {
                //有
                $pid1 = $user->pid;
                $puser = db('user')->where('id', $pid1)->find();
                //查看该用户上级依据账户类型做处理
                $num = 0;//商品提成数量;
                $pros = db('orderproducts')->where('oid', $order['id'])->select();
                foreach ($pros as $value) {
                    $num += $value->pronum;
                }
                $num = $num - $order->voucher;
                $re = $this->usertype($puser, $num);
                if ($re) {
                    if ($puser->pid != 0) {
                        $puser2 = db('user')->where('id', $puser->pid)->find();
                        return $this->usertype($puser2, $num);
                    } else return true;
                } else
                    //用户类型不正确
                    return false;
            }
        } else {
            return false;
        }

    }

    /**
     * @param $user
     * @param $num
     * @return bool
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function usertype($user, $num)
    {
        $balance = $user->balance;
        $total_income = $user->total_income;
        switch ($user->usertype) {
            //普通用户
            case 0:
                $balance += $num * 70;
                $total_income += $num * 70;
                db('user')->where('id', $user->id)->update(['balance' => $balance, 'total_income' => $total_income]);
                return true;
                break;
            //一级代理
            case 1:
                $balance += $num * 100;
                $total_income += $num * 100;
                db('user')->where('id', $user->id)->update(['balance' => $balance, 'total_income' => $total_income]);
                return true;
                break;
            //二级代理
            case 2:
                $balance += $num * 100;
                $total_income += $num * 100;
                db('user')->where('id', $user->id)->update(['balance' => $balance, 'total_income' => $total_income]);
                return true;
                break;
            default:
                return false;
        }
    }

    // 去微信服务器查询是否有此订单
    public function Queryorder($transaction_id)
    {
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
    public function getOrder($data)
    {

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
    public function checkOrderStatus($order)
    {
        // 检查还未修改, 则返回true, 检查已经修改过了, 则返回false
        // 例如:
        return $order['status'] == 1 ? true : false;
    }

}

<?php

namespace wxpay;

use app\index\model\Orderproducts;
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

         //2.微信服务器查询订单，判断订单真实性(可不需要)
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

            db('order')
                ->where('id', $order['id'])
                ->update(['status' => 1, 'transaction_id' => $data['transaction_id']]);
            $this->sellLog($order);
            $user = session('userInfo');
            //查看该用户是否有上级
            $path = explode('--', trim($user->path, '--'));
            //有上级
            if (!empty($path)) {
                $team = db('user')->where('id', 'in', $path)->select();
                $orderproducts = db('orderproducts')->where('oid', $order->id)->select();
                $num = 0;
                foreach ($orderproducts as $va) {
                    $num += $va->pronum;
                }
                $num -= $order->voucher;
                rsort($team);
                $share = 2;//分享推荐奖励次数
                $reward = 0; //代理推荐代理奖励/如果直推上级与购买者不是代理,则没有奖励
                foreach ($team as $value) {
                    if ($share <= 0 && $reward <= 0) {
                        break;
                    }
                    //直推上级
                    if ($value->id == $user->pid) {

                        switch ($value->usertype) {
                            case 0://普通会员
                                $befbalance = $value->balance;
                                $value->balance += $value->agent_price * $num;
                                $aftbalance = $value->balance;
                                $value->total_income += $value->agent_price * $num;
                                db('user')->where('id', $value->id)->update($value);
                                $this->appLog($value->id,$aftbalance,$befbalance);
                                break;
                            case 1://1级代理
                                $sell = 0;
                                //购买商品的用户是一级或二级代理
                                if ($user->usertype > 0 && $user->usertype <= 2) {
                                    $sell = ($value->agent_price + $value->reward) * $num;
                                    $reward = 1;
                                } else {
                                    //不是代理
                                    $sell = $value->agent_price * $num;
                                }
                                $befbalance = $value->balance;
                                $befcloud = $value->cloud;
                                $value->balance += $sell;
                                $value->total_income += $sell;

                                for ($i = $order->voucher; $i < count($orderproducts); $i++) {
                                    $product = db('product')->where('id', $orderproducts[$i]->proid)->find();
                                    if ($value->cloud - $product->agent_1_price >= 0) {
                                        $value->cloud -= $product->agent_1_price;
                                        $value->balance += $product->price;
                                    }
                                }
                                db('user')->where('id', $value->id)->update($value);
                                $aftbalance = $value->balance;
                                $aftcloud = $value->cloud;
                                $this->appLog($value->id, $aftbalance, $befbalance,$aftcloud,$befcloud);
                                break;
                            case 2://二级代理
                                $sell = 0;
                                //购买商品的用户是一级或二级代理
                                if ($user->usertype > 0 && $user->usertype <= 2) {
                                    $sell = ($value->agent_price + $value->reward) * $num;
                                    $reward = 1;
                                } else {
                                    //不是代理
                                    $sell = $value->agent_price * $num;
                                }
                                $befbalance = $value->balance;
                                $befcloud = $value->cloud;
                                $value->balance += $sell;
                                $value->total_income += $sell;
                                for ($i = $order->voucher; $i < count($orderproducts); $i++) {
                                    $product = db('product')->where('id', $orderproducts[$i]->proid)->find();
                                    if ($value->cloud - $product->agent_2_price >= 0) {
                                        $value->cloud -= $product->agent_2_price;
                                        $value->balance += $product->price;
                                    }
                                }
                                db('user')->where('id', $value->id)->update($value);
                                $aftbalance = $value->balance;
                                $aftcloud = $value->cloud;
                                $this->appLog($value->id, $aftbalance, $befbalance,$aftcloud,$befcloud);
                                break;
                        }
                        $share--;
                    } else {
                        if ($value->usertype >= 1 && $value->usertype <= 2) {
                            $sell = 0;
                            if ($reward > 0) {
                                $reward--;
                                $sell += $value->reward * $num;
                                if ($share > 0) {
                                    $sell += $value->agent_price * $num;
                                    $share--;
                                }
                                $befbalance = $value->balance;
                                $befcloud = $value->cloud;
                                $value->balance += $sell;
                                $value->total_income += $sell;
                                db('user')->where('id', $value->id)->update($value);
                                $aftbalance = $value->balance;
                                $aftcloud = $value->cloud;
                                $this->appLog($value->id, $aftbalance, $befbalance,$aftcloud,$befcloud);
                            }
                        } else {
                            $sell = 0;
                            if ($share > 0) {
                                $share--;
                                $sell += $value->agent_price * $num;
                                $befbalance = $value->balance;
                                $befcloud = $value->cloud;
                                $value->balance += $sell;
                                $value->total_income += $sell;
                                db('user')->where('id', $value->id)->update($value);
                                $aftbalance = $value->balance;
                                $aftcloud = $value->cloud;
                                $this->appLog($value->id, $aftbalance, $befbalance,$aftcloud,$befcloud);
                            }
                        }
                    }
                }
            } else{
                $this->sellLog($order);
            }

            return true;
    }

    /**
     * @param $id 用户id
     * @param $aftbalance 交易后余额
     * @param $befbalance 交易前余额
     * @param $aftcloud 交易后云仓
     * @param $befcloud 交易前云仓
     */
    public function appLog($id, $aftbalance, $befbalance, $aftcloud='', $befcloud='')
    {
        $balog = [];
        $balog['uid'] = $id;
        $balog['time'] = time();
        $balog['amount'] = $aftbalance - $befbalance;
        $balog['balance'] = $aftbalance;
        $balog['remarks'] = 'app交易';
        db('balancelog')->insert($balog);
        if (!empty($aftcloud) && !empty($befcloud)){
        $yclog = [];
        $yclog['uid'] = $id;
        $yclog['time'] = time();
        $yclog['amount'] = $aftcloud - $befcloud;
        $yclog['cloud'] = $aftcloud;
        $yclog['remarks'] = 'app交易';
        db('yclog')->insert($yclog);
        }
    }

    /** 产品销售日志
     * @param $order 订单
     */
    public function sellLog($order){
        $orderpro = db('orderproducts')->where('oid',$order['id'])->select();
        $tmp = [];
        foreach ($orderpro as $value){
            $tmp['id'] = $value['proid'];
            $tmp['num'] = $value['pronum'];
        }
        $products = db('product')->where('id','in',$tmp['id'])->select();
        foreach ($products as $v){
            $sellog = [];
            for ($i=0;$i<count($tmp['id']);$i++){
                if ($v['id'] == $tmp['id'][$i]){
                    $sellog['proid'] = $v['id'];
                    $sellog['uid'] = $v['id'];
                    $sellog['time'] = time();
                    $sellog['amount'] = $tmp['num'][$i];
                    $sellog['product'] = $v['inventory'] - $tmp['num'][$i];
                    $sellog['remarks'] = 'app平台销售';
                    db('selllog')->insert($sellog);
                    db('product')->where('id', $v['id'])->setDec('inventory',$tmp['num'][$i]);
                }
            }
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

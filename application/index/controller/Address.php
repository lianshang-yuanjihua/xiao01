<?php

namespace app\index\controller;
use app\common\controller\IndexBase;
use think\Validate;

class Address extends IndexBase {
     public function saveaddr(){
        $data = input('post.');
        $rules =[
          'consignee|收货人'=>'require',
            'mobile|手机号'=>['regex' => '/^1(3\d|4[57]|5[0-37-9]|66|7[367]|8[0235-9]|99)\d{8}$/','require'],
            'zipcode|邮政编码'=>['regex' => '/^\d{6}$/','require'],
            'remark'=>'require',
            'address'=>'require'
        ];
        $validate = new Validate($rules);
        if ($validate->check($data)){
            $data['userid'] = session('userInfo.id');
            $res = model('address')->save($data);
            if ($res){
                session('successMsg','添加成功');
                $this->redirect('user/addrlist');
            } else {
                session('errorMsg','添加失败');
                $this->redirect('user/newaddr');
            }
        } else {
            session('errorMsg',$validate->getError());
            $this->redirect('user/newaddr');
        }

     }
    public function selectaddr(){
         $id = session('userInfo.id');
         return model('address')->getAddrByID($id) ?: false;
    }

    public  function getaddr(){
         $id = input('post.id');
         $addr = model('address')->where('id',$id)->find();
         return $addr;
    }
}
<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;

class Product extends AdminBase {

    public function del() {
        $proid = input('post.id');
        return model('product')->delProByID($proid);
    }

    public function productlist() {
        $productlist = model('product')->getProList();
        $this->assign('productlist', $productlist);
        return $this->fetch();
    }

    public function edit() {
        $id  = input('param.id');
        $pro = model('product')->where('id', $id)->find();
        $this->assign('product', $pro);
        return $this->fetch();
    }

    public function show() {
        $id      = input('param.id');
        $product = model('product')->getProduct($id);
        if ($product) {
            $this->assign('product', $product);
            return $this->fetch();
        } else {
            session('errorMsg', '获取产品信息失败');
            $this->redirect('product/productlist');
        }

    }

    public function add() {
        return $this->fetch();
    }

    public function doAdd() {
        $data       = input('post.');
        $id         = model('product')->insertGetId($data);
        $data['id'] = $id;
        session('successMsg', '添加成功!请添加产品图片!');
        $this->assign([
            'data' => $data,
        ]);
        return $this->fetch('productimg/proimg');
    }

}
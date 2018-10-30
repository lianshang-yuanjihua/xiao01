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
        $id    = input('param.id');
        $pro   = model('product')->where('id', $id)->find();
        $imgs  = [];
        $image = model('Productimg')->getImg($id);
        foreach ($image as $value) {
            switch ($value->type) {
            case '0':
                $imgs['cartimg'] = $value;
                break;
            case '1':
                $imgs['slideimg'][] = $value;
                break;
            case '2':
                $imgs['showimg'] = $value;
                break;
            case '3':
                $imgs['detailimg'][] = $value;
                break;
            default:
                break;
            }
        }
        $this->assign([
            'product' => $pro,
            'imgs'    => $imgs,
        ]);
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

    public function doEdit() {
        $data      = input('post.');
        $file      = request()->file();
        $productid = input('param.id');
        $res       = model('product')->where('id', $productid)->update($data);
        // echo "<pre>";
        // print_r($this->checkEmpty($file));
        // exit;
        if ($this->checkEmpty($file)) {
            $path    = ROOT_PATH . "public" . DS . "static" . DS . "upload";
            $success = 0;
            foreach ($file as $key => $value) {
                $image              = [];
                $tmp                = explode('-', $key);
                $image['type']      = $tmp[1];
                $image['productid'] = $productid;

                switch ($image['type']) {
                case '0':
                    model('productimg')->where('type', 0)->delete();
                    $info = $value->validate([
                        'size' => 2048000,
                        'ext'  => 'jpg,gif,png'])
                        ->move($path);
                    if (is_object($info) && $info->getSaveName()) {
                        $image['path'] = $info->getSaveName();
                        model('Productimg')->insert($image);
                        $success++;
                    } else {
                        $this->error($file->getError());
                    }
                    break;

                case '1':
                    foreach ($value as $v) {
                        $info = $v->validate([
                            'size' => 2048000,
                            'ext'  => 'jpg,gif,png'])
                            ->move($path);
                        if (is_object($info) && $info->getSaveName()) {
                            $image['path'] = $info->getSaveName();
                            model('Productimg')->insert($image);
                            $success++;
                        } else {
                            $this->error($file->getError());
                        }
                    }
                    break;
                case '2':
                    model('productimg')->where('type', 2)->delete();
                    $info = $value->validate([
                        'size' => 2048000,
                        'ext'  => 'jpg,gif,png'])
                        ->move($path);
                    if (is_object($info) && $info->getSaveName()) {
                        $image['path'] = $info->getSaveName();
                        model('Productimg')->insert($image);
                        $success++;
                    } else {
                        $this->error($file->getError());
                    }
                    break;
                case '3':
                    foreach ($value as $v) {
                        $info = $v->validate([
                            'size' => 2048000,
                            'ext'  => 'jpg,gif,png'])
                            ->move($path);
                        if (is_object($info) && $info->getSaveName()) {
                            $image['path'] = $info->getSaveName();
                            model('Productimg')->insert($image);
                            $success++;
                        } else {
                            $this->error($file->getError());
                        }
                    }
                    break;
                default:
                    $this->error('请上传图片');
                    break;
                }
            }
        }
        if ($res) {
            session('successMsg', '产品信息修改成功!上传了' . $success . '张图片!');
            $this->redirect('product/show', ['id' => $productid]);
        } else {
            session('errorMsg', '产品信息修改失败!上传了' . $success . '张图片!');
            $this->redirect('product/productlist');
        }
    }

    public function checkEmpty($arr) {
        if (is_array($arr)) {
            foreach ($arr as $value) {
                if (is_array($value)) {
                    $this->checkEmpty($value);
                }
                return !empty($value);
            }
        } else {
            return $arr ? true : false;
        }
    }
}
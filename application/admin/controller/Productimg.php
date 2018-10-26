<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;

class Productimg extends AdminBase {
    public function upload() {
        $id      = input('param.id');
        $product = model('product')->getProduct($id);
        $this->assign('product', $product);
        return $this->fetch();
    }

    public function doUpload() {
        $data      = input('param.');
        $productid = $data['productid'];
        $file      = request()->file();
        $path      = ROOT_PATH . "public" . DS . "static" . DS . "upload";
        $success   = 0;
        foreach ($file as $key => $value) {
            $image              = [];
            $tmp                = explode('-', $key);
            $image['type']      = $tmp[1];
            $image['productid'] = $productid;

            switch ($image['type']) {
            case '0':
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
        if ($success) {
            session('successMsg', '成功上传' . $success . '张图片!');
            $this->redirect('product/show', ['id' => $productid]);
        } else {
            session('errorMsg', '上传失败');
            $this->redirect('productimg/proimg');
        }
    }

    public function proimg() {
        $productid = input('param.id');
        $res       = model('product')->where('id', $productid)->find();
        if (res) {
            $this->assign('data', $res);
            return $this->fetch();
        }
    }

    public function del() {
        $id  = input('param.id');
        $res = model('Productimg')->delImgByID($id);
        return $res ? 1 : 0;
    }
}
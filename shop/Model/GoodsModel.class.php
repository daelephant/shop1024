<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17.10.25
 * Time: 22:39
 * 商品goodsmodel模型
 */
namespace Model;
use Think\Model;
class GoodsModel extends Model{
    //为数据表字段添加默认值，不能为空
    //自动完成设置add_time/upd_time
    protected $_auto = array(
        array('add_time','time',1,'function'),
        array('upd_time','time',3,'function')
    );
    // 插入数据前的回调方法
    //参数：
    //$data是收集的表单信息$options是设置的各种条件
    protected function _before_insert(&$data,$options) {
        //上传图片处理：
        if($_FILES['goods_logo']['error']===0) {
            //通过Think/Upload.class.php实现附件上传
            $cfg = array(
                'rootPath' => './Common/Uploads/', //保存根路径
            );
            $up = new \Think\Upload($cfg);
            $z = $up->uploadOne($_FILES['goods_logo']);
            //$z会返回成功上传附件的相关信息
            //拼装图片的路径名信息，存储到数据库里面
            $big_path_name = $up->rootPath . $z['savepath'] . $z['savename'];
            $data['goods_big_logo'] = $big_path_name;
        }


    }
    // 插入成功后的回调方法
    protected function _after_insert($data,$options) {}

}
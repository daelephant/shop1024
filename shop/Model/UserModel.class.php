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
class UserModel extends Model{

    /*字段映射定义，把form表单中自定义字段，变为数据表合法字段*/
    protected $_map = array(
        'name' => 'user_name',
        'password' => 'user_pwd',
        'email' => 'user_email',
    );
    /*自动完成充填字段信息*/
    protected $_auto = array(
        array('add_time','time',1,'function'),//添加记录完成add_time的填充
        array('user_pwd','md5',1,'function'),//添加记录完成user_pwd的加密填充

        //1:代表添加时，用time函数function
    );

    // 更新数据前的回调方法
    protected function _before_update(&$data,$options) {}
    // 更新成功后的回调方法
    protected function _after_update($data,$options) {}
}
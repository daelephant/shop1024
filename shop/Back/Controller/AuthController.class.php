<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2017-10-25
 * Time: 15:17
 */
namespace Back\Controller;
use Think\Controller;
use Think\Model;

class AuthController extends Controller{
//    列表展示
    public function showlist(){
        //获取权限列表信息
        $info = D('Auth')->order('auth_path')->select();//根据auth_path排序，使得权限按照上下级关系显示

        //设置面包屑导航
        $bread = array(
            'first' => '权限管理',
            'second' => '权限列表',
            'linkTo' => array(
                '【添加权限】',U('Auth/tianjia')
            ),
        );

        $this->assign('bread',$bread);

        $this->assign('info',$info);
        $this->display();
    }


}
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

class RoleController extends Controller{
//    列表展示
    public function showlist(){
        $info = D('Role')->select();
        //设置面包屑导航
        $bread = array(
            'first' => '角色管理',
            'second' => '角色列表',
            'linkTo' => array(
                '【添加角色】',U('Role/tianjia')
            ),
        );

        $this->assign('bread',$bread);
        $this->assign('info',$info);
        $this->display();
    }


}
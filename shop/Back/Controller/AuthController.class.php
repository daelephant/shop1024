<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2017-10-25
 * Time: 15:17
 */
namespace Back\Controller;
use Common\Tools\BackController;
use Think\Model;

class AuthController extends BackController{
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

    //添加权限
    function tianjia(){
        //展示、收集两个逻辑
        if(IS_POST){
            //var_dump($_POST);exit(); ok
            $auth = new \Model\AuthModel();
            $data = $auth->create();
            //通过_after_insert()方法实现path和level两个字段的维护
            if($auth->add($data)){
                $this->success('添加权限成功',U('showlist'),2);
            }else{
                $this->error('添加权限失败',U('tianjia'),2);
            }
        }else{
            //获取可供选择的上级权限（level=0/1）
            $pinfo = D('Auth')->where(array('auth_level'=>array('in','0,1')))->order('auth_path')->select();
            //SELECT * FROM `php_auth` WHERE `auth_level` IN ('0','1') ORDER BY auth_path [ RunTime:0.0010s ]
            $this->assign('pinfo',$pinfo);

            //设置面包屑导航
            $bread = array(
                'first' => '权限管理',
                'second' => '权限添加',
                'linkTo' => array(
                    '【返回】',U('Auth/showlist')
                ),
            );

            $this->assign('bread',$bread);
            $this->display();
        }
    }
}
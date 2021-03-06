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

class TypeController extends BackController{
//    列表展示
    public function showlist(){
        $info = D('Type')->select();
        //设置面包屑导航
        $bread = array(
            'first' => '类型管理',
            'second' => '类型列表',
            'linkTo' => array(
                '【添加类型】',U('tianjia')
            ),
        );

        $this->assign('bread',$bread);
        $this->assign('info',$info);
        $this->display();
    }
    //添加类型
    function tianjia(){
        //展示、收集两个逻辑
        if(IS_POST){
            //var_dump($_POST);exit(); ok
            $auth = new \Model\TypeModel();
            $data = $auth->create();
            //通过_after_insert()方法实现path和level两个字段的维护
            if($auth->add($data)){
                $this->success('添加类型成功',U('showlist'),2);
            }else{
                $this->error('添加类型失败',U('tianjia'),2);
            }
        }else{

            //设置面包屑导航
            $bread = array(
                'first' => '类型管理',
                'second' => '类型添加',
                'linkTo' => array(
                    '【返回】',U('showlist')
                ),
            );

            $this->assign('bread',$bread);
            $this->display();
        }
    }
    public function distribute(){
        //两个逻辑：展示、收集
        $role = new \Model\RoleModel();
        if(IS_POST){
            //dump($_POST);

            //处理数据到model中处理.起名字为saveAuth,通过saveAuth方法实现数据制作（权限分配）
            //$z = $role -> saveAuth($_POST['auth_id'],$_POST['role_id']);

            //通过瞻前顾后机制实现数据制作role_auth_ids/role_auth_ac(权限分配)
            //控制器里面只负责调用save方法，其余的工作交给model的瞻前顾后实现

            $data = $role -> create();//收集表单数据,要和数据表中数据名一致，去查看html中name
            if($role -> save($data)){
                $this->success('分配权限成功',U('showlist'),2);
            }else{
                $this->error('分配权限失败',U('distribute',array('role_id',I('get.role_id'))),2);
            }


        }else {
            $role_id = I('get.role_id');
            //获取 被分配权限 的角色信息
            $roleinfo = D('Role')->find($role_id);
            //  获得被分配的权限
            $auth_infoA = D('Auth')->where("auth_level=0")->select();//顶级权限
            $auth_infoB = D('Auth')->where("auth_level=1")->select();//次顶级权限
            $this->assign('auth_infoA', $auth_infoA);
            $this->assign('auth_infoB', $auth_infoB);

            //设置面包屑导航
            $bread = array(
                'first' => '角色管理',
                'second' => '分配权限',
                'linkTo' => array(
                    '【返回】', U('Role/showlist')
                ),
            );

            $this->assign('bread', $bread);
            $this->assign('roleinfo', $roleinfo);
            $this->display();
        }
    }

}
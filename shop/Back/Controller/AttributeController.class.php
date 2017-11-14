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

class AttributeController extends BackController{
//    列表展示
    public function showlist(){
        //获得属性列表信息
        $type_id = I('get.type_id');//类型id
        $info = D('Attribute')->where(array('type_id'=>$type_id))->select();
        /* 可供选择的类型，给下拉框补充值*/
        $typeinfo = D('Type')->select();
        $this->assign('typeinfo',$typeinfo);
        /* 可供选择的类型，给下拉框补充值*/
        //设置面包屑导航
        $bread = array(
            'first' => '属性管理',
            'second' => '属性列表',
            'linkTo' => array(
                '【添加属性】',U('tianjia')
            ),
        );

        $this->assign('bread',$bread);
        $this->assign('info',$info);
        $this->display();
    }
    //添加属性
    function tianjia(){
        //展示、收集两个逻辑
        if(IS_POST){
            //var_dump($_POST);exit(); ok
            $auth = new \Model\AttributeModel();
            $data = $auth->create();
            if($data){
                if($auth->add($data)){
                    $this->success('添加属性成功',U('Type/showlist'),2);
                }else{
                    $this->error('添加属性失败',U('tianjia'),2);
                }
            }else{
                //验证失败$data = false
                $errorinfo = $auth->getError();//获得验证错误信息
                $this->error($errorinfo,U('tianjia'),1);
            }
        }else{
           /* 可供选择的类型，给下拉框补充值*/
            $typeinfo = D('Type')->select();
            $this->assign('typeinfo',$typeinfo);
           /* 可供选择的类型，给下拉框补充值*/

            //设置面包屑导航
            $bread = array(
                'first' => '属性管理',
                'second' => '属性添加',
                'linkTo' => array(
                    '【类型列表】',U('Type/showlist')
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

    function getInfoByType(){
        $type_id = I('get.type_id');
        $info = D('Attribute')->where(array('type_id'=>$type_id))->select();
        echo json_encode($info);
        //file_put_contents('./log.php',var_export($info,true),FILE_APPEND);//追加
        file_put_contents('./log.php',var_export($info,true));//默认不追加写入
    }
}
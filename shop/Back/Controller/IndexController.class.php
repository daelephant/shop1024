<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2017-10-25
 * Time: 14:30
 */
namespace Back\Controller;
use Think\Controller;
class IndexController extends Controller{
    function __construct()
    {
        parent::__construct();//先执行父类的构造方法，没有这一步代表重新
        layout(false);//临时关闭当前模板布局，写在构造函数里，对整个类文件起作用
    }

    public function head(){
        $this->display();
    }
    public function left(){
        //通过管理员获得对应的角色，通过角色获得对应的权限并显示
        $admin_id = session('admin_id');
        $admin_name = session('admin_name');
        if($admin_name != 'admin'){//普通用户获取权限
            $auth_ids = D('Manager')->alias('m')->join('__ROLE__ r on m.mg_role_id=r.role_id')->field('r.role_auth_ids')
            ->where(array('m.mg_id'=>$admin_id))->find();
            //SELECT r.role_auth_ids FROM php_manager m INNER JOIN php_role r on m.mg_role_id=r.role_id WHERE m.mg_id = '2' LIMIT 1
            //dump($auth_ids);
            $auth_ids = $auth_ids['role_auth_ids'];//字符串
            //根据auth_ids获取对应的权限信息
            $auth_infoA = D('Auth')->where("auth_id in ($auth_ids) and auth_level=0")->select();//顶级权限
            $auth_infoB = D('Auth')->where("auth_id in ($auth_ids) and auth_level=1")->select();//次顶级权限
            //dump($auth_infoB);
        }else{//admin用户获取
            $auth_infoA = D('Auth')->where("auth_level=0")->select();//顶级权限
            $auth_infoB = D('Auth')->where("auth_level=1")->select();//次顶级权限

        }
        $this -> assign('auth_infoA',$auth_infoA);
        $this -> assign('auth_infoB',$auth_infoB);
        $this->display();
    }
    public function right(){
        $this->display();
    }
    public function index(){
        $this->display();
    }
}
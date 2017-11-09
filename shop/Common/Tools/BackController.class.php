<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2017-11-09
 * Time: 16:34
 */
//后台父类控制器
namespace Common\Tools;
use Think\Controller;
class BackController extends Controller{
    //构造方法
    function __construct()
    {
        parent::__construct();//先执行父类的，否则父类构造方法被覆盖

        $admin_id =session('admin_id');
        $admin_name =session('admin_name');

        //权限控制过滤功能实现
        $nowAC = CONTROLLER_NAME.'-'.ACTION_NAME;//当前所在的控制器-方法
        if(!empty($admin_name)){//登录状态，有用户登录才进去判断权限
            //系统有一些权限是无需分配，直接可以访问
            $allowAC = "Admin-logout,Admin-login,Admin-verifyImg,Admin-checkCode,Index-index,
            Index-head,Index-left,Index-right";

            //获得当前管理员对应角色的“role_auth_ac”
            $roleinfo = D('Manager')->alias('m')->join('__ROLE__ r on m.mg_role_id=r.role_id')->
                field('r.role_auth_ac')->where(array('mg_id'=>$admin_id))->find();
            $role_ac = $roleinfo['role_auth_ac'];

            //判断当前访问的权限是否是角色允许的权限
            //1、访问的权限在角色权限列表中没有出现
            //2、访问的权限在默认允许的列表中也没用出现
            //3、当前用户还不是admin超级管理员
            //4、以上123同时满足，就是“没有权限访问”
            // strpos(s1,s2):判断s2在s1中首次出现的位置（0,1,2,3...），没有出现，返回false

            if(strpos($role_ac,$nowAC)===false && strpos($allowAC,$nowAC)===false && $admin_name!='admin'){
                exit('没有权限访问！');
            }
        }else{//退出系统状态
            //跳转到登录界面去
            //退出状态也让访问的权限定义
            //$this->redirect('Admin/login');//重定向次数过多not ok
            $allowAC = "Admin-login,Admin-verifyImg,Admin-checkCode";
            if(strpos($allowAC,$nowAC)===false){
                //$this->redirect('Admin/login');
                //通过js，可以使得全部的frameset都跳转
                $js = <<<eof
                        <script>
                            window.top.location.href = "/index.php/Back/Admin/login";
                        </script>
eof;
                echo $js;

            }
        }
    }
}
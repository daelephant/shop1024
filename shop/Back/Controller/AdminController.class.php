<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2017-10-25
 * Time: 14:15
 */
namespace Back\Controller;
use Common\Tools\BackController;
class AdminController extends BackController{
    function __construct()
    {
        parent::__construct();//先执行父类的构造方法，没有这一步代表重新
        //layout(false);//临时关闭当前模板布局，写在构造函数里，对整个类文件起作用
    }
    public function login(){
        layout(false);//临时关闭当前模板布局，写在构造函数里，对整个类文件起作用
        if(IS_POST){
            //dump($_POST);
            $name = $_POST['admin_user'];
            $pwd = $_POST['admin_psd'];
            //用户名和密码的校验
            $manager = D('Manager');
            $info = $manager->where(array('mg_name'=>$name,'mg_pwd'=>$pwd))->find();
            //dump($info);
            if($info != null){
                //session持久化操作(id/name)
                session('admin_id',$info['mg_id']);
                session('admin_name',$info['mg_name']);
                //页面跳转
                $this->redirect('Index/index');
            }else{
                $this->error('用户名或者密码错误',U('login'),2);
            }
        }else {
            $this->display();
        }
    }

    //管理员退出系统
    public function logout(){
        layout(false);//临时关闭当前模板布局，写在构造函数里，对整个类文件起作用
        session(null);
        //$this->redirect('分组/控制器/操作方法');
        $this->redirect('login');
    }

    public function verifyImg(){
        //显示验证码
        $cfg = array(
            'fontSize'  =>  20,              // 验证码字体大小(px)

            'imageH'    =>  40,               // 验证码图片高度
            'imageW'    =>  100,               // 验证码图片宽度
            'length'    =>  2,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取

        );
        $very = new \Think\Verify($cfg);
        $very->entry();
    }

    //ajax过来校验验证码
    function checkCode(){
        $code = I('get.code');//获得用户输入的验证码
        $vry = new \Think\Verify();
        if($vry->check($code)){
            echo json_encode(array('status'=>1));
        }else{
            echo json_encode(array('status'=>2));
        }
    }

    //管理员列表展示
    function showlist(){
        //设置面包屑导航
        $bread = array(
            'first' => '管理员管理',
            'second' => '管理员列表',
            'linkTo' => array(
                '【添加管理员】',U('tianjia')
            ),
        );

        $this->assign('bread',$bread);

        $info = D('Manager')->alias('m')->join('LEFT JOIN __ROLE__ r on m.mg_role_id=r.role_id')->field('m.*,r.role_name')->select();
        //SELECT m.*,r.role_name FROM php_manager m LEFT JOIN php_role r on m.mg_role_id=r.role_id [ RunTime:0.0000s ]
        //dump($info);
        $this->assign('info',$info);
        $this->display();
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2017-10-25
 * Time: 14:15
 */
namespace Back\Controller;
use Think\Controller;
class AdminController extends Controller{
    function __construct()
    {
        parent::__construct();//先执行父类的构造方法，没有这一步代表重新
        layout(false);//临时关闭当前模板布局，写在构造函数里，对整个类文件起作用
    }
    public function login(){
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

}

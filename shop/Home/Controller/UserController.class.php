<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function login(){
        //两个逻辑：展示，收集
        if(IS_POST){
            //用户名、密码校验，session持久化信息、页面跳转
        }else{

            $this->display();
        }
    }
    public function regist(){
        //两个逻辑：展示、收集
        $user = new \Model\UserModel();//usermodel写映射机制
        if(IS_POST){
            $data = $user -> create();//过滤非法字段
            if($user->add($data)){
                $this->success('注册成功',U('showRegister'),1);
            }else{
                $this->error('注册失败',U('regist'),1);
            }
        }else {
            $this->display();
        }
    }
    function showRegister(){
        $this->display();
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
    //会员邮箱激活
    function jihuo(){
        $user_id = I('get.user_id');
        $checkcode = I('get.checkcode');

        //更改user_check=1,user_check_code=null
        //需要先验证，再激活
        $user = D('User');
        $userinfo = $user -> where(array('user_check'=>0))->find($user_id);
        if($userinfo['user_check_code'] === $checkcode) {
            $z = $user->setField(array('user_id' => $user_id, 'user_check' => 1, 'user_check_code' => ''));
            if ($z) {
                $this->success('会员激活成功', U('login'), 1);
            }
        }else{
            $this->error('操作错误或账号已经激活',U('login'),1);
        }

    }
}
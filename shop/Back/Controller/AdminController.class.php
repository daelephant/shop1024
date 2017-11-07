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
    public function login(){
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

}

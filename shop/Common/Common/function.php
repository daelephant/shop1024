<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17.10.26
 * Time: 7:56
 * 给项目创建一个函数库文件，名字固定为function.php
 */
//防止xss攻击的特殊方法
function fanXSS($string) {
    require_once './Plugin/htmlpurifier/HTMLPurifier.auto.php';
    // 生成配置对象
    $cfg = HTMLPurifier_Config::createDefault();
    // 以下就是配置：
    $cfg->set('Core.Encoding', 'UTF-8');
    // 设置允许使用的HTML标签
    $cfg->set('HTML.Allowed', 'div,b,strong,i,em,a[href|title],ul,ol,li,br,span[style],img[width|height|alt|src]');
    // 设置允许出现的CSS样式属性
    $cfg->set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align');
    // 设置a标签上是否允许使用target="_blank"
    $cfg->set('HTML.TargetBlank', TRUE);
    // 使用配置生成过滤用的对象
    $obj = new HTMLPurifier($cfg);
    // 过滤字符串
    return $obj->purify($string);
}
function sendMail($to, $title, $content){
    require_once('./Plugin/phpmailer/class.phpmailer.php');
    $mail = new PHPMailer();
    // 设置为要发邮件
    $mail->IsSMTP();
    // 是否允许发送HTML代码做为邮件的内容
    $mail->IsHTML(TRUE);
    $mail->CharSet='UTF-8';
    // 是否需要身份验证
    $mail->SMTPAuth=TRUE;
    /*  邮件服务器上的账号是什么 -> 到163注册一个账号即可 */
    $mail->From="chengyinxiang93@163.com";
    $mail->FromName="chengyinxiang93";
    $mail->Host="smtp.163.com";
    $mail->Username="chengyinxiang93";
    $mail->Password="hello2017";

    // 发邮件端口号默认25
    $mail->Port = 25;
    // 收件人
    $mail->AddAddress($to);
    // 邮件标题
    $mail->Subject=$title;
    // 邮件内容
    $mail->Body=$content;
    return($mail->Send());
}

//根据一个二维数组，返回指定字段的逗号分隔的字符串信息
function arrayToString($arr,$field){
    $s = "";
    foreach($arr as $k=>$v){
        $s .= $v["$field"].",";
    }
    $s = rtrim($s,',');
    return $s;
}

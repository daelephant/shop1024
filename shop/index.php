<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17.10.24
 * Time: 22:28
 */
//调试、生产模式
define('App_DEBUG',true);//调试模式
//define('App_DEBUG',false);//生产模式
//给系统静态资源文件请求路径设置常量
define('SITE_URL','/');
//前台
define('CSS_URL','/Home/Public/style/');
define('IMG_URL','/Home/Public/images/');
define('JS_URL','/Home/Public/js/');
//后台Admin
define('ADMIN_CSS_URL','/Admin/Public/css/');
define('ADMIN_IMG_URL','/Admin/Public/images/');
define('ADMIN_JS_URL','/Admin/Public/js/');
//引入tp框架的接口文件
include("../ThinkPHP/ThinkPHP.php");
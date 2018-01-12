<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17.11.8
 * Time: 6:12
 */
return array(
    //开启布局
    'LAYOUT_ON' => true,
    'LAYOUT_NAME' => 'layout',
    'IMAGE_CONFIG' => array(
        'maxSize' => 1024 * 1024,//以下开始设置：1M
        'exts' => array('jpg','gif','png','jpeg'),//设置文件上传类型
        'rootPath' => './Common/Uploads/',//设置上传图片的保存路径 -》PHP要使用的路径，指的是电脑硬盘路径，所以只能用相对路径（本次相对入口文件位置），不能使用 /，linux代表磁盘跟
        'viewPath' => '/Common/Uploads/',//显示图片时的路径  -》浏览器用的路径，相对网站根目录
    )
);
<?php
return array(
//'配置项'=>'配置值'
//    给项目做静态文件访问路由路径的配置
//  前台
    'CSS_URL' => '/Home/Public/style/',
    'JS_URL' => '/Home/Public/js/',
    'IMG_URL' => '/Home/Public/images/',
//    后台
    'BACK__URL'    => '/Back/Public/css/',
    'BACK_JS_URL'  => '/Back/Public/js/',
    'BACK_IMG_URL' => '/Back/Public/img/',
    'PLUGIN_URL' => '/plugin/',
//    给shop/common定义访问路径
    'COMMON_URL' => '/Common/',

    //定义网站的域名地址（方便图片显示）
    'SITE_URL' => 'http://www.shop1222.com/',//每次换环境需要修改此域名

    'URL_HTML_SUFFIX'       =>  'html',  // URL伪静态后缀设置

    //打开页面的跟踪信息
    'SHOW_PAGE_TRACE' => true,

    /* 数据库设置 来源：ThinkPHP/Conf/convention.php */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'shop1024',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'php_',    // 数据库表前缀
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8

//    设置布局
    'LAYOUT_ON'             =>  false,  //是否启动布局
    'LAYOUT_NAME'           =>  'layout',  //当前布局文件的名称，默认为layout



);
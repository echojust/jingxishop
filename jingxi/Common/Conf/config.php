<?php
return array(
	//'配置项'=>'配置值'
    //home公共资源路径配置
    'CSS_URL' => '/Public/Home/style/',
    'JS_URL' => '/Public/Home/js/',
    'IMG_URL' => '/Public/Home/images/',
    //admin公共资源路径配置
    'AD_CSS_URL' => '/Public/Admin/css/',
    'AD_JS_URL' => '/Public/Admin/js/',
    'AD_IMG_URL' => '/Public/Admin/images/',
    //Plugin路径配置
    'PLUGIN_URL' => '/Common/Plugin/',
    //给网站域名设置一个配置变量(方便图片等信息访问)
     'SITE_URL' => 'http://www.jingxi.com/',
    //数据库配置
    'DB_TYPE'               =>  'Mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'jingxi',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'sp_',    // 数据库表前缀
    'DB_PARAMS'          	=>  array(), // 数据库连接参数
    'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
    //设置显示页面跟踪信息
    'SHOW_PAGE_TRACE' => true,
    //设置session开启
);
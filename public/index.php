<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
//通过头信息解决跨域问题   //可设置分支
header("Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS");
header("Access-Control-Allow-Origin:*");
//设置头部可以带的参数
header('Access-Control-Allow-Headers:Content-type,Content-length,X-Requested-with,Accept,Authorization,yourHeaderFeild,token');//允许接收token
if($_SERVER['REQUEST_METHOD']=="OPTIONS"){
    exit();
}
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';

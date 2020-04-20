<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
//后台接口
Route::resource('api/login','admin/Login');
Route::resource('api/category','admin/Category');
Route::resource('api/infos','admin/Infos');
Route::resource('api/user','admin/User');
// 微信接口
Route::resource('wx/login','wx/Login');
Route::resource('wx/uploads','wx/Uploader');
Route::resource('wx/catelist','wx/Catelist');
Route::resource('wx/info','wx/Info');
Route::resource('wx/mysend','wx/Mysend');
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];

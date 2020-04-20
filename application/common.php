<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\JWT;
function checkToken(){
    //前台把数据传到后台    查询字符串  post  header
    $getToken = request()->get('token');
    $postToken = request()->post('token');
    $headeToken = request()->header('token');
    if($getToken){
        $token = $getToken;
    }else if($postToken){
        $token = $postToken;
    }else if($headeToken){
        $token = $headeToken;
    }else{
        json([
            'code'=>config('code.auth'),
            'msg'=>"授权失败，请登陆"
        ],401)->send();
        exit();
    }
    $tokenResult = JWT::verify($token,config('signature'));
    if(!$tokenResult){
        json([
            'code'=>config('code.auth'),
            'msg'=>"验证失败"
        ])->send();
        exit();
    }
    $id= $tokenResult['id'];
    $username = $tokenResult['username'];
    request()->id=$id;
    request()->username=$username;
}
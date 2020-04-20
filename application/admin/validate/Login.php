<?php


namespace app\admin\validate;


use think\Validate;

class Login extends Validate
{
    protected  $rule=[
        'username'=>'require|min:3|max:12',
        'password'=>'require|min:6|max:12',
    ];
    protected $message=[
        'username.require'=>'用户名必填',
        'username.min'=>'最少3个字符',
        'username.max'=>'最多12个字符',
        'password.require'=>'密码必填',
        'password.min'=>'最少6个字符',
        'password.max'=>'最多12个字符'
    ];protected $scene=[];//场景
}
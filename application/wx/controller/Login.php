<?php

namespace app\wx\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\JWT;
class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $code = $this->request->get('code');
        $appid="wx57de94c659d170ad";
        $appsecret="dd179c5e78fdcccab5c7d381c1fb40a4";
        $url="https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$appsecret&js_code=$code&grant_type=authorization_code";
        $result=json_decode(file_get_contents($url));
        return json([
            'code'=>200,
            'msg'=>"登陆成功",
            'openid'=>$result->openid,
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
        $data = $this->request->post();
        $result=model('user')->insert_user($data);
        $id=Db::table('user')->getLastInsID();
        if($result){
            $payload=['id'=>$id,'nickname'=>$data['nickname']];
            $token=JWT::getToken($payload,config('signature'));
            return json([
                'code'=>200,
                'msg'=>'注册成功',
                'token'=>$token
            ]);
        }else{
            return json([
                'code'=>404,
                'msg'=>"注册失败"
            ]);
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}

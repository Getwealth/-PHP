<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\JWT;
use think\Request;

class Login extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->code=config('code');
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
       
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

        //权限  验证数据   处理相应逻辑
        $data = $this->request->post();
        $validate = validate('login');
        if(!$validate->check($data)){
            return json([
                'code'=>config('code.fail'),
                'msg'=>$validate->getError()
            ]);
        }
        //登陆验证
        $res= Db::table('manager')->where('musername',$data['username'])->find();
        if($res){
            $password=md5(crypt($data['password'],'wuif1908'));
            if($res['mpassword']==$password){
                $payload=['id'=>$res['mid'],'username'=>$res['musername']];
                $token=JWT::getToken($payload,config('signature'));
                return json([
                    'code'=>$this->code['success'],
                    'msg'=>"登陆成功",
                    'token'=>$token
                ]);
            }else{
                return json([
                    'code'=>$this->code['fail'],
                    'msg'=>"用户名和密码不匹配"
                ]);
            }
        }else{
            return json([
                'code'=>$this->code['fail'],
                'msg'=>"用户名不存在"
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

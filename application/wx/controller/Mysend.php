<?php

namespace app\wx\controller;

use think\Controller;
use think\Request;

class Mysend extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $data = $this->request->get();
        if(isset($data['limit'])&&!empty($data['limit'])){
            $limit = $data['limit'];
        }else{
            $limit=3;
        }
        if(isset($data['page'])&&!empty($data['page'])){
            $page=$data['page'];
        }else{
            $page=1;
        }
        $where=[];
        if(isset($data['where'])&&!empty($data['where'])){
            $where=['userid'=>$data['where']];
        }
        $result=model('informations')->i_select($where,'id,istate,idesc,ithumbs,tell,userid,create_time,isfinished',$limit,$page);
        $total=$result->total();
        $item = $result->items();
        foreach ($item as $key=> $value){
            $userinfo= model('User')->find_user(['openid'=>$value->userid],"avatarurl,nickname,id");
            if($userinfo){
                $item[$key]['userinfo']=$userinfo;
            }
        }
        if($item){
            return json([
                'code'=>200,
                'msg'=>'获取成功',
                'data'=>$item,
                'total'=>$total
            ]);
        }else{
            return json([
                'code'=>201,
                'msg'=>"暂无数据"
            ]);
        }
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
        $id=$data['id'];
        $isfinished=$data['isfinished'];
        $result = model('informations')->c_finished($id,$isfinished);
        if($result){
            return json([
               'code'=>200,
               'msg'=>'完成状态修改成功'
            ]);
        }else{
            return  json([
                'code'=>201,
                'msg'=>"完成状态修改失败"
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

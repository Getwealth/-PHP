<?php

namespace app\wx\controller;

use think\Controller;
use think\Db;
use think\Request;

class Info extends Controller
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
            if($data['where']==1 || $data['where']==2){
                $where=['istate'=>$data['where'],'isfinished'=>2];
                $result=model('informations')->i_select($where,'id,istate,idesc,ithumbs,tell,userid,create_time',$limit,$page);
            }else{
                $where=$data['where'];
                $result=model('informations')->i_search($where,'id,istate,idesc,ithumbs,tell,userid,create_time',$limit,$page);
            }
        }else{
             $result=model('informations')->i_select($where,'id,istate,idesc,ithumbs,tell,userid,create_time',$limit,$page);
        }
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
        $data = $this->request->post();
        if((isset($data['istate'])&&!empty($data['istate']))|| (isset($data['idesc'])&&!empty($data['idesc'])) || (isset($data['cid'])&&!empty($data['cid'])) || (isset($data['tell'])&&!empty($data['tell'])) ){
            $res = model('informations')->insert_info($data);
            if($res){
                return json([
                    'code'=>200,
                    'msg'=>"发布成功"
                ]);
            }else{
                return json([
                    'code'=>1001,
                    'msg'=>"发布失败"
                ]);
            }
        }else{
            return json([
                'code'=>201,
                'msg'=>"上传信息不完整"
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
        $id = $this->request->get('id');
        $userid = $this->request->get('userid');
        $data = Db::table('informations')->where('id',$id)->field('id,istate,ithumbs,create_time,tell,idesc,userid')->find();
        $userinfo=model('user')->find_user(['openid'=>$userid],'nickname');
        $data['userinfo']=$userinfo;
        if($data){
            return  json([
                'code'=>200,
                'msg'=>"查询成功",
                'data'=>$data
            ]);
        }else{
            return json([
                'code'=>201,
                'msg'=>"信息不存在"
            ]);
        }

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

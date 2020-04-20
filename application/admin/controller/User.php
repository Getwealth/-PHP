<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class User extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        checkToken();
        $getData = $this->request->get();
        if(isset($getData['limit'])&&!empty($getData['limit'])){
            $limit = $getData['limit'];
        }else{
            $limit=1;
        }
        if(isset($getData['limit'])&&!empty($getData['limit'])){
            $page=$getData['page'];
        }else{
            $page=1;
        }
        if(isset($getData['search'])&&!empty($getData['search'])){
            $search=['id|nickname|city|province'=>$getData['search']];
        }else{
            $search=[];
        }
        $result = Db::table('user')->where($search)->field('id,nickname,avatarurl,gender,city,province')->order('id asc')->paginate($limit,false,['page'=>$page]);
        $total=$result->total();
        $data=$result->items();
        if($result){
            if(count($data)){
                return json([
                    'code'=>200,
                    'msg'=>'查询成功',
                    'data'=>$data,
                    'count'=>$total
                ]);
            }else{
                return json([
                    'code'=>201,
                    'msg'=>"暂无数据",
                ]);
            }
        }else{
            return json([
                'code'=>201,
                'msg'=>"暂无数据",
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

<?php

namespace app\admin\controller;

use think\Controller;
use think\Exception;
use think\Request;

class Category extends Controller
{
    protected $model;
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->code=config('code');
        $this->model=model('Category');
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        checkToken();
        try{
            $res = $this->model->c_query();
            $firsrCate=$this->model->c_filiter();
            function datadel($arr,$pid){
                $newarr=[];
                for($i=0;$i<count($arr);$i++){
                    $cate=$arr[$i];
                    if($cate['pid']==$pid){
                        $array = datadel($arr,$cate['cid']);
                        if(!empty($array)){
                            $cate['children']=$array;
                        }
                        array_push($newarr,$cate);
                    }
                }
                return $newarr;
            }
            if($res){
                $data=datadel($res,0);
                return json([
                    'code'=>$this->code['success'],
                    'msg'=>'查询成功',
                    'data'=>$data,
                    'count'=>count($data),
                    'firstCate'=>$firsrCate
                ]);
            }else{
                return json([
                    'code'=>$this->code('success'),
                    'msg'=>"暂无数据"
                ]);
            }
        }catch (Exception $exception){
            return json([
                'code'=>$this->code['server'],
                'msg'=>"服务器错误"
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
        if((isset($data['name'])&&!empty($data['name']))&&(isset($data['pid']))){
            $isrepeat=$this->model->c_find($data);
            if($isrepeat){
                return json([
                    'code'=>$this->code['fail'],
                    'msg'=>"分类已存在，请勿重复添加"
                ]);
            }else{
                $data['value']=$data['name'];
                $res = $this->model->c_insert($data);
                if($res){
                    $cid = $this->model->cid;
                    return json([
                        'code'=>$this->code['success'],
                        'cid'=>$cid,
                        'msg'=>"数据添加成功"
                    ]);
                }else{
                    return json([
                        'code'=>$this->code['fail'],
                        'msg'=>"数据添加失败"
                    ]);
                }
            }
        }else{
            return json([
                'code'=>202,
                'msg'=>"数据输入错误"
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
        $data=$this->request->delete();
        $cid=$data['cid'];
        $isChild=$this->model->findsome(['pid'=>$cid]);
        if($isChild){
            $resChild=$this->model->c_del(['pid'=>$cid]);
            $res = $this->model->c_del(['cid'=>$cid]);
            if($res && $resChild){
                $this->model->c_del('pid',$id);
                return json([
                    'code'=>$this->code['success'],
                    'msg'=>"删除成功"
                ]);
            }else{
                return json([
                    'code'=>$this->code['fail'],
                    'msg'=>"删除失败"
                ]);
            }
        }else{
            $res = $this->model->c_del(['cid'=>$cid]);
            if($res){
                $this->model->c_del('pid',$id);
                return json([
                    'code'=>$this->code['success'],
                    'msg'=>"删除成功"
                ]);
            }else{
                return json([
                    'code'=>$this->code['fail'],
                    'msg'=>"删除失败"
                ]);
            }
        }
    }
}

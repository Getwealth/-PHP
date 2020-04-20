<?php


namespace app\common\model;


use think\Model;

class Informations extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    public function insert_info($data){
        return $this->allowField(true)->save($data);
    }
    public function i_select($where=[],$field='*',$limit=3,$page=1,$orderField='id',$orderType='desc'){
        return $this->where($where)->field($field)->order($orderField,$orderType)->paginate($limit,false,[
            'page'=>$page
        ]);
    }
    public function i_search($where,$field='*',$limit=3,$page=1,$orderField='id',$orderType='desc'){
        return $this->where('idesc','like','%'.$where.'%')->field($field)->order($orderField,$orderType)->paginate($limit,false,[
            'page'=>$page
        ]);
    }
    public function c_finished($id,$isfinished){
        return $this->isUpdate(true)->save(['isfinished'=>$isfinished],['id'=>$id]);
    }
    public function delinfos($id){
        return $this->where('id',$id)->delete();
    }
}
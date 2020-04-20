<?php


namespace app\common\model;


use think\Model;

class Category extends Model
{
    public function c_insert($data){
        return $this->allowField(true)->isUpdate(false)->save($data);
    }
    public function c_query(){
        return $this->all();
    }
    public function c_find($data){
        return $this->where('name',$data['name'])->find();
    }
    public function c_del($where){
        return $this->where($where)->delete();
    }
    public function c_filiter(){
        return $this->where('pid',0)->field('cid,name')->select();
    }
    public function c_someLimit($where=[],$field='*',$limit=3,$offset=0){
        return $this->where($where)->order('cid','asc')->limit($offset,$limit)->field($field)->select();
    }
    public function findsome($where){
        return $this->where($where)->count();
    }
}
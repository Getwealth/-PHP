<?php


namespace app\common\model;


use think\Model;

class User extends Model
{
    public function find_user($where=[],$field='*'){
        return $this->where($where)->field($field)->find();
    }
    public function insert_user($data){
        return $this->allowField(true)->save($data);
    }
}
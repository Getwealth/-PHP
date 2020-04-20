<?php

namespace app\wx\controller;
use think\Controller;
use think\Request;
class Uploads extends Controller{
    public function upload(){
        $file= $_FILES['file'];
        
       //创建一个文件保存的目录 uploads
    $filepath="../public/uploads";
    //判断是否存在这个路径
    //is_dir($filepath);
    $res = is_dir($filepath);
    if(!is_dir($filepath)){
        //如果文件目录不存在就创建一个新的目录 mkdir();
        mkdir($filepath);
    }
    //上传文件需要知道上传时间，所以一般会在uploads中创建20191107格式的文件夹来保存上传的文件
    $date = date('Ymd');
    $filepath.="/".$date;
    if(!is_dir($filepath)){
        mkdir($filepath);
    }
    $imgname=time() . mt_rand(1,99999);
    $type = $file['name'];
    $type = explode(".",$type);
    $type=array_pop($type);
    $imgpath =$filepath."/".$imgname.".".$type;
    $res=move_uploaded_file($file['tmp_name'],$imgpath);
    if($res){
        $webpath =$imgpath;
        return json([
            "code"=>200,
            "mes"=>"上传成功",
            "data"=>$webpath,
        ]);
    }else{
        return json([
            "code"=>1001,
            "mes"=>"上传失败"
        ]);
    }
 }
}
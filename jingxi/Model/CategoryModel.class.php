<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/5/31
 * Time: 20:27
 */

namespace Model;
use Think\Model;

class CategoryModel extends Model
{
    protected function _after_insert($data,$options)
    {
        if($data['cat_pid']==0){
            $path = $data['cat_id'];
        }else{
            $pinfo = $this->find($data['cat_pid']);
            $path = $pinfo['cat_path']."-".$data['cat_id'];

        };
        //等级:就是path全路径里边'-'的个数
        $level = substr_count($path,'-');

        //把path和level更新给记录
        $arr = array(
            'cat_id'=>$data['cat_id'],
            'cat_path'=>$path,
            'cat_level'=>$level,
        );
        $this -> save($arr);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/5/28
 * Time: 10:07
 */

namespace Model;
use Think\Model;


class AuthModel extends Model
{
    //瞻前顾后原则
    protected function _after_insert($data,$option)
    {
        //dump($data);die;
        if($data['auth_pid']==0){
            //顶级权限
            $path = $data['auth_id'];
        }else{
            //非顶级权限
            //寻找其上级权限
            $parpath = $this->find($data['auth-pid']);
            $path = $parpath['auth_path']."-".$data['auth_id'];
        };
            //获得auth_level值,其值为auth_path中"-"的个数
            $level = substr_count($path,'-');
            $arr = array(
                'auth_id'=>$data['auth_id'],
                'auth_path'=>$path,
                'auth_level'=>$level,
            );
        $this->save($arr);

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/5/31
 * Time: 0:09
 */

namespace Admin\Controller;
use Tools\AdminController;

class TypeController extends AdminController
{
    public function showlist()
    {
        $daohang = array(
            'title1'=>'类型管理',
            'title2'=>'类型列表',
            'act'=>'添加',
            'act_link'=>U('tianjia'),
        );
        $this->assign('daohang',$daohang);
        $typeInfo = D('Type')->select();
        $this->assign('typeInfo',$typeInfo);
        $this->display();
    }
    //添加类型
    public function tianjia()
    {
        $type = D('Type');
        if(IS_POST){
            //收集表单数据
            $data = $type->create();
            if($type->add($data)){
                $this->success('添加类型成功',U('showlist'),1);
            }else{
                $this->error('添加类型失败',U('tianjia'),1);
            };
        }else{
            $daohang = array(
            'title1'=>'类型管理',
            'title2'=>'类型添加',
            'act'=>'返回',
            'act_link'=>U('showlist'),
        );
            $this->assign('daohang',$daohang);
            $this->display();
        };

    }
}
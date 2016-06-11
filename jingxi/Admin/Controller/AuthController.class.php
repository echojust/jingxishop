<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/5/26
 * Time: 22:50
 */

namespace Admin\Controller;
use Tools\AdminController;

class AuthController extends AdminController
{
    public function showlist()
    {
        $daohang = array(
            'title1' => '权限管理',
            'title2' => '权限列表',
            'act' => '添加',
            'act_link' => U('tianjia'),
        );
        $this->assign('daohang',$daohang);
        $AuthInfo = D('Auth')->order('auth_path')->select();
        $this->assign('AuthInfo',$AuthInfo);
        $this->display();
    }
    public function tianjia()
    {
        $auth = new \Model\AuthModel();
        if(IS_POST){
                $data = $auth -> create();//收集数据
                //dump($data);die;
                if($auth->add($data)){
                    $this->success('添加权限成功',U('showlist'),1);
                }else{
                    $this->error('添加权限失败',U('tianjia'),1);
                };

        }else{
            //定义导航
            $daohang = array(
                'title1' => '权限管理',
                'title2' => '权限添加',
                'act' => '返回',
                'act_link' => U('showlist'),
            );
            //传递导航信息
            $this->assign('daohang',$daohang);
            //获得已有的权限信息 展示于下拉框
            $pauthinfo = D('Auth')->order('auth_path')->
                where(array('auth_level'=>array('in','0,1')))->select();
            $this->assign('pauthinfo',$pauthinfo);
            $this->display();
        };

    }
    public function delete()
    {

    }
    public function update()
    {

    }
}
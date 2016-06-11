<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/5/25
 * Time: 20:37
 */

namespace Admin\Controller;
use Tools\AdminController;

class RoleController extends AdminController
{
    public function showlist()
    {
        $daohang = array(
            'title1' => '角色管理',
            'title2' => '角色列表',
            'act'    => '添加',
            'act_link' => U('tianjia'),
        );
        $this->assign('daohang',$daohang);
        $info = D("Role")->select();
        $this->assign("info", $info);
        $this->display();
    }
    private function saveAuthAC($auth_ids)
    {
        $auth_info = D('Auth')->select($auth_ids);

        $s = "";
        foreach($auth_info as $k => $v) {
            if (!empty($v['auth_c']) && !empty($v['auth_a'])) {
                $s .= $v['auth_c'] . '-' . $v['auth_a'] . ",";
            }
        }
            $s = rtrim($s,',');

            return $s;

    }

    public function distribute()
    {
        $daohang = array(
            'title1' => '角色管理',
            'title2' => '分配权限',
            'act' => '返回',
            'act_link' => U('showlist'),
        );
        $this->assign('daohang',$daohang);
        $role = D('Role');
        if (IS_POST) {
            $role_id = I('post.role_id');
            $auth_ids = implode(',',I('post.auth_id'));
            $auth_ac = $this->saveAuthAC($auth_ids);
            //dump($auth_ac);die;
            $arr = array(
                'role_id' => $role_id,
                'role_auth_ids' => $auth_ids,
                'role_auth_ac' => $auth_ac,
            );
            if($role->save($arr)){
                $this->success('分配权限成功',U('showlist'),1);
            }else{
                $this->error('分配权限失败',U('distribute',array('role_id'=>$role_id),1));
            };


        } else {
            $role_id = I("get.role_id");
            //获得其角色信息
            $roleinfo = D("Role")->find($role_id);
            $this->assign("roleinfo", $roleinfo);
            //获得全部的权限信息
            $authInfoA = D('Auth')->where(array('auth_level' => 0))->select();
            $authInfoB = D('Auth')->where(array('auth_level' => 1))->select();
            $this->assign("authinfoA", $authInfoA);
            $this->assign("authinfoB", $authInfoB);
            $this->display();
        };


    }
}
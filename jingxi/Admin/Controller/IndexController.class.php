<?php
namespace Admin\Controller;

use Tools\AdminController;
class IndexController extends AdminController {
        function __construct()
        {
                parent::__construct();
                layout(false);
        }

        public function index(){
                C('SHOW_PAGE_TRACE' , false);
                $this -> display(); }

        public function center(){
                C('SHOW_PAGE_TRACE' , false);
                $this -> display(); }

        public function top(){
                C('SHOW_PAGE_TRACE' , false);
                $this -> display(); }

        public function down(){
                C('SHOW_PAGE_TRACE' , false);
                $this -> display(); }

        public function left(){
                $role_id = session('role_id');
                $mg_id = session('admin_id');
                $mg_name = session('admin_name');
                //dump($mg_name);die;
                if($mg_name === 'admin'){
                        $authInfoA = D('Auth')->where(array('auth_level'=>0))->select();
                        $authInfoB = D('Auth')->where(array('auth_level'=>1))->select();
                }else{

                $roleInfo = D('Role')->find($role_id);
                //获得权限ID
                $auth_ids = $roleInfo['role_auth_ids'];
                //父级子级权限获取
                $authInfoA = D('Auth')->where(array('auth_level'=>0,'auth_id'=>array('in',$auth_ids)))->select();
                $authInfoB = D('Auth')->where(array('auth_level'=>1,'auth_id'=>array('in',$auth_ids)))->select();
                };
                //展示模板
                $this->assign("authInfoA",$authInfoA);
                $this->assign("authInfoB",$authInfoB);
                $this->display();

        }

        public function right(){$this -> display(); }

}
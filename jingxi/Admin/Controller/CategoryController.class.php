<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/5/31
 * Time: 19:40
 */

namespace Admin\Controller;
use Tools\AdminController;

class CategoryController extends AdminController
{
    public function showlist()
    {
        $daohang = array(
            'title1'=>'分类管理',
            'title2'=>'分类列表',
            'act'=>'添加',
            'act_link'=>U('tianjia'),
        );
        $this->assign('daohang',$daohang);
        $info = D('Category')->order('cat_path')->select();
        $this->assign('info',$info);
        $this->display();
    }
    //添加分类
    public function tianjia()
    {
        $Category = new \Model\CategoryModel();
        if(IS_POST){
            $data = $Category->create();
            if($Category->add($data)){
                $this->success('分类添加成功',U('showlist'),1);
            }else{
                $this->error('分类添加失败',U('tianjia'),1);
            };
        }else{
            $daohang = array(
                'title1'=>'分类管理',
                'title2'=>'分类添加',
                'act'=>'返回',
                'act_link'=>U('showlist'),
            );
            $this->assign('daohang',$daohang);
            $pcatinfo = D('Category')->order('cat_path')->
                where(array('cat_level'=>array('in','0,1')))->select();
            $this->assign('pcatinfo',$pcatinfo);
            $this->display();
        };
    }
    //根据父级id获得子级分类信息
    public function getCatByPid()
    {
        $cat_id = I('get.cat_id');
        $catinfo = D('Category')->where(array('cat_pid'=>$cat_id))->select();
        echo json_encode($catinfo);
    }
}
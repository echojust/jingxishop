<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/6/4
 * Time: 17:37
 */

namespace Tools;
use Think\Controller;

class HomeController extends Controller
{
        function __construct()
        {
            parent::__construct();
            $category = D('category');
            //第一级分类
            $catinfoA = $category->where(array('cat_level'=>'0'))
                ->select();
            $catinfoB = $category->where(array('cat_level'=>'1'))
                ->select();
            $catinfoC = $category->where(array('cat_level'=>'2'))
                ->select();
            //assign渲染模板
            $this->assign('catinfoA',$catinfoA);
            $this->assign('catinfoB',$catinfoB);
            $this->assign('catinfoC',$catinfoC);


        }
}
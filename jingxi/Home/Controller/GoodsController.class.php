<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/6/4
 * Time: 14:57
 */

namespace Home\Controller;
use Tools\HomeController;

class GoodsController extends HomeController
{
    public function showlist()
    {
        $cat_id = I('get.cat_id');
        $now_catinfo = D('Category')->find($cat_id);

        $this->display();
    }
    public function detail()
    {
        $this->display();

    }
}
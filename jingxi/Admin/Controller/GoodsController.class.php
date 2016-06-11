<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/5/24
 * Time: 22:20
 */

namespace Admin\Controller;
use Tools\AdminController;
use Think\Upload;
use Think\Image;

class GoodsController extends AdminController
{
    public  function showlist()
    {
        $daohang = array(
            'title1'=>'商品管理',
            'title2'=>'商品列表',
            'act'=>'添加',
            'act_link'=>U('tianjia'),
        );
        $this->assign('daohang',$daohang);
        $info = D("goods")->field('goods_id,goods_name,goods_price,goods_weight,goods_number,goods_small_logo')
        ->select();

        $this->assign("info",$info);
        $this->display();
    }
    public  function tianjia()
    {
        $Goods = new \Model\GoodsModel();
        $daohang = array(
            'title1' => '商品管理',
            'title2' => '添加商品',
            'act' => '返回',
            'act_link' => U('showlist'),
        );
        $this->assign('daohang',$daohang);

        if(IS_POST){
            //dump($_POST);die;
            $GoodsInfo = $Goods->create();
            //富文本编辑器的信息不能过滤
            $GoodsInfo['goods_introduce'] = \fangXSS($_POST['goods_introduce']);
            $GoodsInfo['add_time'] = $GoodsInfo['upd_time'] = time();
            //实现商品logo上传的处理
            $this->deal_logo($GoodsInfo);
            //add方法插入成功后,返回最新插入的id(主键)
            if($newId = $Goods->add($GoodsInfo)){
                //插入成功后 维护相册信息
                $this->deal_pics($newId);

                $this->success('添加商品成功',U('showlist'),1);



            }else{
                $this->error('添加商品失败',U('tianjia'),1);
            }

        }else {
            $typeinfo = D('Type')->select();
            $this->assign('typeinfo',$typeinfo);
            //获得主分类信息
            $cateinfoA = D('Category')->where(array('cat_level'=>'0'))->order('cat_path')
                                ->select();

            $this->assign('cateinfoA',$cateinfoA);
            $this->display();
        }
    }
    /*
     * 实现商品修改功能
     * */
    public function update()
    {
        $daohang = array(
            'title1'=>'商品管理',
            'title2'=>'商品修改',
            'act'=>'返回',
            'act_link'=>U('showlist'),
        );
        $this->assign('daohang',$daohang);
        $goods_id = I('get.goods_id');
        $goods = new \Model\GoodsModel();
        if (IS_POST) {
            $data = $goods -> create();//表单域信息
            //对详情页进行过滤
            $data['goods_introduce'] = \fangXSS($_POST['goods_introduce']);
            $data['upd_time'] = time();
            $cheshi = $goods->where(array('goods_id'=>$_POST['goods_id']))->find();
            //dump($cheshi['add_time']);die;
            //实现图片上传处理
            $this->deal_logo($data);
            $this->deal_pics($data['goods_id']);
            if($goods->save($data)){
                $this->success('修改数据成功',U('showlist'),1);
            }else{
                $this->error('修改数据失败',U('update',array('goods_id'=>$goods_id)),1);
            };

        } else {
            //获得商品goods表内信息

            $info = $goods->find($goods_id);
            $this->assign('info', $info);
            //获得相册goods_pics信息
            $picsinfo = D('goods_pics')->where(array('goods_id' => $goods_id))->select();
            $this->assign('picsinfo', $picsinfo);
            //获得供选取的“类型”信息
            $typeinfo = D('Type')->select();
            $this -> assign('typeinfo',$typeinfo);
            //获得"主分类"信息
            $catinfoA = D('Category')->where(array('cat_level'=>'0'))->order('cat_path')
                    ->select();
            $this->assign('catinfoA',$catinfoA);
            //获得扩展分类信息
            $catinfo = D('Goods_cat')->where(array('goods_id'=>$goods_id))
                ->field('group_concat(cat_id) catid')->find();
            //dump($catinfo);die;
            $extcatinfo = $catinfo['catid'];
            $this->assign('extcatinfo',$extcatinfo);
            $this->display();
        };

    }



/*
 * 实现商品相册图片的批量上传处理
 * */
    private function deal_logo(&$data)
    {

        //附件没有问题 才会继续处理
        if($_FILES['goods_logo']['error']===0){
            //通过是否有goods_id来判断是新添商品还是修改商品
            //unlink删除文件
            if(!empty($data['goods_id'])){
                //修改商品
                $old_logo = D('Goods')
                    ->field('goods_big_logo,goods_small_logo')
                    ->find($data['goods_id']);
                unlink($old_logo['goods_big_logo']);
                unlink($old_logo['goods_small_logo']);
            }
                $cfg = array(
                    'rootPath'      =>  './Public/IMG/',
                );
            $up = new Upload($cfg);
            $imgInfo = $up -> uploadOne($_FILES['goods_logo']);
            //把上传的图片信息保存在数据库中(savepath,savename)
            $big_path_name = $up->rootPath.$imgInfo['savepath'].$imgInfo['savename'];
            $data['goods_big_logo'] = $big_path_name;
            //缩略图的维护
            $im = new Image();
            $im -> open($big_path_name);
            $im -> thumb(200,200,6);
            //设定缩略图入库信息
            $small_path_name = $up->rootPath.$imgInfo['savepath'].'s_'.$imgInfo['savename'];
            $im -> save($small_path_name);//输出缩略图
            $data['goods_small_logo'] = $small_path_name;
        }else{
        };
    }
    /*
     * 实现相册功能图片批量上传
     * */
    private function deal_pics($goods_id)
    { //判断是否有成功上传的图片
        $flag = false;

        //遍历相册上传信息,只要有一个成功 即可开始上传
        foreach($_FILES['goods_pics']['error'] as $k => $v){
            if($v===0){
                $flag = true;
            }
        }

        if($flag === true){
            $cfg = array(
                'rootPath' =>  './Public/Pics/',
            );
            $up = new Upload($cfg);
            //FILES数组信息 使用upload
            $imgInfo = $up -> upload(array($_FILES['goods_pics']));
            //遍历$imgInfo 对每个图片进行处理
            $im = new Image();
            foreach($imgInfo as $k => $v){
                //原图路径名
                $yuan_path_name = $up->rootPath.$v['savepath'].$v['savename'];
                //制作缩略图
                $im->open($yuan_path_name);
                $im->thumb(800,800,6);
                $b_name = $up->rootPath.$v['savepath'].'b_'.$v['savename'];
                $im->save($b_name);
                //缩略图

                $im->thumb(350,350,6);
                $m_name = $up->rootPath.$v['savepath'].'m_'.$v['savename'];
                $im->save($m_name);
                //缩略图

                $im->thumb(50,50,6);
                $s_name = $up->rootPath.$v['savepath'].'s_'.$v['savename'];
                $im->save($s_name);
                //将三种缩略图信息存入数据库
                $arr = array(
                    'goods_id'=>$goods_id,
                    'goods_pics_b'=>$b_name,
                    'goods_pics_m'=>$m_name,
                    'goods_pics_s'=>$s_name,
                );
                D('goods_pics')->add($arr);


            }
        }
    }
    //实现单个相册的图片删除操作
    function removePics(){
        $pics_id = I('get.pics_id');
        //查询并删除物理图片
        $picsinfo = D('GoodsPics')->find($pics_id);
        unlink($picsinfo['goods_pics_b']);
        unlink($picsinfo['goods_pics_m']);
        unlink($picsinfo['goods_pics_s']);
        //删除记录
        D('GoodsPics')->delete($pics_id);

        echo "删除商品相册成功";
    }
}
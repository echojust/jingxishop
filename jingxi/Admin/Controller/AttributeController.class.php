<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/5/31
 * Time: 13:35
 */

namespace Admin\Controller;
use Tools\AdminController;

class AttributeController extends AdminController
{
    public function showlist()
    {
        $daohang = array(
            'title1' => '属性管理',
            'title2' => '属性列表',
            'act' => '添加',
            'act_link' => U('tianjia'),
        );
        $this -> assign('daohang',$daohang);
        //获得属性和类型相关值
        /*$AttrInfo = D('Attribute')->alias('a')->join('__TYPE__ t on a.type_id = t.type_id')
                        ->field('a.*,t.type_name')->select();
        $this->assign('AttrInfo',$AttrInfo);*/
        $typeinfo = D('Type')->select();
        $this->assign('typeinfo',$typeinfo);
        $this->display();
    }
    //添加属性
    public function tianjia()
    {
        $Attribute = D('Attribute');
        if(IS_POST){
            $data = $Attribute -> create();
            if($Attribute->add($data)){
                $this->success('添加属性成功',U('showlist'),1);
            }else{
                $this->error('添加属性失败',U('tianjia'),1);
            };
        }else{
            $daohang = array(
                'title1' => '属性管理',
                'title2' => '属性添加',
                'act' => '返回',
                'act_link' => U('showlist'),
            );
            $this->assign('daohang',$daohang);
            $typeinfo = D('Type')->select();
            $this->assign('typeinfo',$typeinfo);
            $this->display();
        };
    }
    //通过类型id获得属性信息的方法
    public function getAttrByType()
    {
        $type_id = I('get.type_id');
        $cdt = array();
        //如果typeid=0就获得所有属性信息,如果不等于0 则根据其type_id获得相关信息
        if($type_id != 0 ){
            $cdt['a.type_id'] = $type_id;
        }
        $info = D('Attribute')->alias('a')->join('__TYPE__ t on t.type_id = a.type_id')
            ->field('a.*,t.type_name')->where($cdt)->select();
        echo json_encode($info);
    }
    //商品添加页面
    public function getAttrByType2()
    {
        $type_id = I('get.type_id');
        $info = D('Attribute')->field('attr_id,attr_name,attr_sel,attr_vals')
            ->where(array('type_id'=>$type_id))->select();
        echo json_encode($info);
    }
    //商品修改页面
    public function getAttrByType3(){
        $type_id = I('get.type_id');//获得类型id
        $goods_id = I('get.goods_id'); //当前被修改商品的goods_id

        //获得的属性信息两种情况：空壳、实体
        //sp_goods_attr  商品---属性关联
        //sp_attribute   属性信息
        $flag = 1; //1：实体属性信息，2：空壳属性信息

        //1) 获得"实体"属性信息
        $info = D('GoodsAttr')
            ->alias('ga')
            ->join('__ATTRIBUTE__ a on ga.attr_id=a.attr_id')
            ->where(array('ga.goods_id'=>$goods_id,'a.type_id'=>$type_id))
            ->field('a.attr_id,a.attr_name,a.attr_sel,a.attr_vals,group_concat(ga.attr_value) as attrvalues')
            ->group('a.attr_id')
            ->select();

        //判断是否存在实体属性信息
        if(empty($info)){
            //2) 获得“空壳”属性信息
            //获得对应的属性信息
            $flag = 2;
            $info = D('Attribute')
                ->field('attr_id,attr_name,attr_sel,attr_vals')
                ->where(array('type_id'=>$type_id))
                ->select();
        }
        //整合数据 与 $flag标志
        $shuju['flag'] = $flag;
        $shuju['data'] = $info;
        echo json_encode($shuju); //{{flag:1/2},{data:[{},{},{},...]}}
    }
}
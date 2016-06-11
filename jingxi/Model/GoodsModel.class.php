<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/5/24
 * Time: 22:35
 */

namespace Model;
use Think\Model;

class GoodsModel extends Model
{
    //添加商品后维护数据
        protected function _after_insert($data,$options)
        {
            //dump($_POST['attrids']);die;
            if(!empty($_POST['attrids'])){
                foreach($_POST['attrids'] as $k =>$v){
                    foreach($v as $kk => $vv){
                        $arr = array(
                            'goods_id'=>$data['goods_id'],
                            'attr_id'=>$k,
                            'attr_value'=>$vv,
                        );
                        D('GoodsAttr')->add($arr);
                    }
                }
            }
            //对扩展分类进行维护
            if(!empty($_POST['ext_cat'])){
                foreach($_POST['ext_cat'] as $k => $v){
                    $arr = array(
                        'goods_id'=>$data['goods_id'],
                        'cat_id'=>$v,
                    );
                    //dump($arr);die;
                    D('GoodsCat')->add($arr);
                }

            }
        }
    //修改商品信息入库前修改数据
    protected function _before_update($data,$options){
        //dump($data);
        /*dump($options);
        array(3) {
          ["table"] => string(8) "sp_goods"
          ["model"] => string(5) "Goods"
          ["where"] => array(1) {
            ["goods_id"] => int(27)
          }
        }*/
        $goods_id = $options['where']['goods_id'];
        if(!empty($_POST['attrids'])){
            //给商品修改"属性"信息
            //删除旧的属性，写入新的属性
            //1) 删除旧属性
            D('GoodsAttr')
                ->where(array('goods_id'=>$goods_id))
                ->delete();
            //2) 写入新的属性
            foreach($_POST['attrids'] as $k => $v){
                foreach($v as $kk => $vv){
                    //给sp_goods_attr写入数据
                    $arr = array(
                        'goods_id'=>$goods_id,
                        'attr_id'=>$k,
                        'attr_value'=>$vv,
                    );
                    D('GoodsAttr')->add($arr);
                }
            }
        }
        //收集扩展分类信息
        //先删除旧的扩展分类信息
        D('Goods_cat')->where(array('goods_id'=>$goods_id))->delete();
        if(!empty($_POST['ext_cat'])){
            //添加新的
            foreach($_POST['ext_cat'] as $k => $v){
                if($v !='0'){
                    $arr = array(
                        'goods_id'=>$goods_id,
                        'cat_id'=>$v,
                    );
                    D('Goods_cat')->add($arr);
                }
            }

        }
    }
}
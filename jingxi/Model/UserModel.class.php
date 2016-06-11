<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/6/2
 * Time: 20:00
 */

namespace Model;
use Think\Model;

class UserModel extends Model
{
        protected function _after_insert($data,$options)
        {
            $code = md5(time().$data['user_id']);
            $url = C("SITE_URL")."index.php/Home/User/activeUser/user_id/".$data['user_id'].'/code/'.$code;
            $content = "请点击<a href='$url' target='_blank'>激活</a>按钮激活您的账号";
            if(sendMail($data['user_email'],'新会员激活账号',$content)){
                $arr = array(
                    'user_id'=>$data['user_id'],
                    'user_check_code'=>$code,
                );
                $this->save($arr);
            }
        }
}
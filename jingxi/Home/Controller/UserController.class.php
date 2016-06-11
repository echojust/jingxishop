<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/5/24
 * Time: 21:12
 */

namespace Home\Controller;
use Tools\HomeController;
use Think\Verify;

class UserController extends HomeController
{
        public  function login()
        {
            if(IS_POST){
                $user = D('User');
                $data = I('post.');
                $verify = new Verify();
                if($verify->check($data['chknumber'])){
                    $userinfo = $user->where(array('user_name'=>$data['user_name'],'user_pwd'=>$data['user_pwd']))
                                        ->find();
                    if($userinfo){
                        if($userinfo['user_check']!='0'){
                            session('user_id',$userinfo['user_id']);
                            session('user_name',$userinfo['user_name']);
                            $this->redirect('Index/index');
                        }else{
                            $this->error('账号没有激活',U('login'),1);
                        };
                    }else{
                        $this->error('用户账号或密码错误',U('login',1));
                    };

                }else{
                    $this->error('验证码错误',U('login'),1);
                };

            }else{
                $this -> display();
            };

        }
    //注册模块
        public  function register()
        {
            $user = new \Model\UserModel();
            if(IS_POST){
                $verify = new Verify();


                if($verify->check(I("post.chknumber"))){
                        $data = $user -> create();
                        $data['add_time'] = time();
                        if($user->add($data)){
                            $this->success('注册成功',U('login'),1);
                        }else{
                            $this->success('注册失败',U('register'),1);
                        };
                }else{
                    $this->error('验证码输入错误',U("register"),1);
                };
            }else{
                $this -> display();
            };

        }
        //验证码
        public function VerifyImg()
        {
            $config = array(
                'fontSize'  =>  14,              // 验证码字体大小(px)
                'useCurve'  =>  true,            // 是否画混淆曲线
                'useNoise'  =>  false,            // 是否添加杂点
                'imageH'    =>  36,               // 验证码图片高度
                'imageW'    =>  150,               // 验证码图片宽度
                'length'    =>  4,               // 验证码位数
                'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
            );
            $verify = new Verify($config);
            $img = $verify -> entry();
        }
        //会员激活
        public function activeUser()
        {
            $user_id = I('get.user_id');
            $code = I('get.code');
            //激活有时间限制 15天过期 过期会删除未激活的账号
            //linux:crontab 每天过滤并删除过期的未激活账号
            $cdt['user_check'] = '0';
            $cdt['user_id'] = $user_id;
            $cdt['user_check_code'] = $code;
            $userinfo = D('user')->where($cdt)->find();
            if($userinfo){
                $arr = array(
                    'user_id'=>$user_id,
                    'user_check'=>'1',
                    'user_check_code'=>'',

                );
                if(D('User')->save($arr)){
                    $this -> success('会员激活成功',U('login'),1);
                }else{
                    $this -> error('会员激活失败,请联系系统管理',U('login'),1);
                }
            }else{
                exit('非法账号激活');
            };
        }
    //退出
    function logout()
    {
        session(null);
        $this->redirect('Index/index');
    }
}
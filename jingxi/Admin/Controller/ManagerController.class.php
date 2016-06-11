<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/5/23
 * Time: 14:26
 */

namespace Admin\Controller;
use Think\Controller;
use Think\Verify;

//后台管理员控制器
class ManagerController extends Controller
{
    //登录系统
    public function login()
    {
        layout(false);//取消布局
        if(IS_POST){
            //校验验证码
            $verify = new Verify();
            $data = I("post.");
            if($verify->check($data['chknumber'])){
                    $name = I("post.user");
                    $pwd = I("post.pwd");
                    $info = D("Manager")->where("mg_name = '$name' AND mg_pwd = '$pwd'")
                        ->find();

                if($info !== null){
                    //持久化用户信息
                    session('admin_id',$info['mg_id']);
                    session('role_id',$info['role_id']);
                    session('admin_name',$info['mg_name']);
                    //跳转到后台
                    //dump(session('admin_name'));die;
                    $this->redirect('Index/index');
                }else{
                    $this->error("用户名或密码输入错误",U("login"),1);
                };
            }else{
                $this->error("验证码输入错误",U("login"),1);
            };
        }else{
            $this -> display();
        };

    }
    public function verifyImg()
    {
        $config = array(
            'fontSize'  =>  14,              // 验证码字体大小(px)
            'useCurve'  =>  true,            // 是否画混淆曲线
            'useNoise'  =>  false,            // 是否添加杂点
            'imageH'    =>  40,               // 验证码图片高度
            'imageW'    =>  88,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
        );
        $verify = new Verify($config);
        $img = $verify -> entry();

    }
    public function logout()
    {
        session(null);
        $this->redirect('login');
    }

}
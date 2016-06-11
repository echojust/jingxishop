<?php
/**
 * Created by PhpStorm.
 * User: huang
 * Date: 2016/5/27
 * Time: 8:27
 */

namespace Tools;
use Think\Controller;

class AdminController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $adminname = session('admin_name');
        $adminid = session('admin_id');
        $role_id = session('role_id');
        $nowAC = CONTROLLER_NAME.'-'.ACTION_NAME;
        //登录用户与非登录用户
        if(!empty($adminname)){
            //如果是admin则默认具备所有权限 非admin才要验证权限
            if($adminname !== 'admin'){
                $roleInfo = D('role')->find($role_id);
                $roleAC = $roleInfo['role_auth_ac'];
                //所有登录的账号都具备的基础权限
                $allowAC = "Manager-login,Manager-verifyImg,Manager-logout,Index-top,Index-index,Index-left,Index-right,Index-down,Index-center";
                //验证动作是否存在基础权限或自己具备的权限
                if(strpos($roleAC,$nowAC)===false && strpos($allowAC,$nowAC)===false){
                    exit('非法访问,请联系管理员获得相关权限');
                };
            };
        }else{
            //B. 处于退出系统状态
            //退出系统状态默认允许访问权限定义
            $quitAC = "Manager-login,Manager-verifyImg";

            if(strpos($quitAC,$nowAC)===false){
                //如果访问的权限不是默认允许的，就要跳转到登录页
                //$this -> redirect('Manager/login');//只能保证右侧(right)跑到登录页

                //整体(top/left/right/down)都跳转到登录页
                $js = <<<eof
                    <script type="text/javascript">
                        window.top.location.href="/index.php/Admin/Manager/login";
                    </script>
eof;
                echo $js;
            };
        };
    }
}
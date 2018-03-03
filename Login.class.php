<?php
class Login extends User{
    public $result;
    public function checkData(){
        
        //验证码是否正确
        $returnArr = Tool::validate();
        if(!$returnArr["code"]){
            return $returnArr;
        }

        $dbo =DBO::getInstance();//获得连接数据库实例的单例 实例化对象
        $sql = "SELECT pwd FROM user WHERE username=?";
        $arr = array($this->user);
        $this->result = $dbo->inquire($sql,$arr,"fetch");//数组

        if(!$this->result){//用户名不存在
            $returnArr = array(
                "msg"=>"用户名不存在",
                "code"=>false
            );
            return $returnArr;
        }

        if($this->result['pwd']==$this->pwd){//用户名/密码正确  登陆成功
            $returnArr = array(
                "msg"=>"登陆成功",
                "code"=>true
            );
            setcookie("username", $this->user);

            if(in_array("on",$_POST)){
                echo "<script> sessionStorage.setItem('username','$this->user');</script>";
            }
            return $returnArr;
        }

        $returnArr = array(//密码不正确
            "msg"=>"密码不正确",
            "code"=>false
        );
        return $returnArr;
    }

function getCookie(){
    if(isset($_COOKIE["validate"])){
        return $_COOKIE["validate"];
    }
    return false;
    }
}
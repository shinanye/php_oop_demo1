<?php
class Register extends User{
    private $email;
    public $return;
    public function __construct($arr){
        parent::__construct($arr);
        $this->email = $arr["email"];
    }

    public function checkData(){
        $dbo =DBO::getInstance();
        $sql = "SELECT * FROM user";
        $arr = array($this->user);
        $this->result = $dbo->inquire($sql,$arr,"fetchAll");//数组 返回密码

        foreach($this->result as $items){
            if($items["username"]==$this->user){
                $returnArr = array(
                    "msg"=>"用户名已被注册",
                    "code"=>false
                );
                return $returnArr;
            }

            if($items["pwd"]==$this->pwd){
                $returnArr = array(
                    "msg"=>"密码已被使用",
                    "code"=>false
                );
                return $returnArr;
            }

            if($items["email"]==$this->email){
                $returnArr = array(
                    "msg"=>"邮箱已被注册",
                    "code"=>false
                );
                return $returnArr;
            }
        }

        $returnArr = array(//密码、用户名都没有被使用
            "msg"=>"注册成功",
            "code"=>true
        );
        setcookie("username", $this->user);
        $sql = "INSERT INTO user(username,pwd,email) VALUES(?,?,?)";
        $arr = array($this->user,$this->pwd,$this->email);
        $dbo->insert($sql,$arr);
        return $returnArr;
    }
}
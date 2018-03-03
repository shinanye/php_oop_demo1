<?php
    $arr = array([
        "username"=>"张三",
        "id"=>"000",
        "pwd"=>"123456"
    ],
    [
        "username"=>"李四",
        "id"=>"0000",
        "pwd"=>"798" 
    ]
);
    function deep_in_array($val,$arr)
    {
        foreach($arr as $item){
            if(in_array($val,$item)){
                return true;
            }
        }
        return false;
    }

        var_dump(deep_in_array("0000001",$arr));
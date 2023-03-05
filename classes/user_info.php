<?php

$data = array();

if($error ==""){
    $data['user_id']=$_SESSION['user']->user_id;
    $query = "select * from user where user_id =:user_id";
    $result = $db->read($query,$data);

    if(is_array($result)){
              $result = $result[0];

                $image = ($result->gender =="male") ? "../images/user_male.jpg" :"../images/user_female.jpg";
                if(file_exists($result->image)){
                    
                $image = "images/".$result->image;
                }
                $info->massege ="Your are logged in";
                $info->data_type ="user_info";
                $info->image =$image;
                $info->result =$result;
                echo json_encode($info);

          
        }else{
            $info->massege ="Wrong Email";
            $info->data_type ="error";
            echo json_encode($info);
    }

}else{
    $info->massege =$error;
    $info->data_type ="error";
    echo json_encode($info);
}

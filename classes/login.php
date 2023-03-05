<?php

sleep(1);
$data = array();


if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-])/",$data_object->email)){
    $error .="The email is invalid <br>";
}
if(empty($data_object->password)){
    $error .="The password  is empty <br>";
}

if($error ==""){
    $data['email']=$data_object->email;
    $query = "select * from user where email =:email";
    $result = $db->read($query,$data);

    if(is_array($result)){
            $result = $result[0];
            if($result->password == $data_object->password){
                $_SESSION['user']=$result;
                $info->massege =$_SESSION['user'];
                $info->data_type ="info";
                echo json_encode($info);
            }else{
                $info->massege ="Wrong password";
                $info->data_type ="error";
                echo json_encode($info);

            }
          
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

<?php

sleep(1);
$data = array();
if(empty($data_object->username)){
    $error .="The username name is invalid <br>";
}
if(strlen($data_object->username) < 3){
    $error .=" username should be longer than three <br>";
}
if(!preg_match("/^[a-z A-Z]*$/",$data_object->username)){
    $error .="The username is invalid <br>";
}
if(empty($data_object->email)){
    $error .="please enter a valid email <br>";
}
if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-])/",$data_object->email)){
    $error .="The email is invalid <br>";
}
if(empty($data_object->password)){
    $error .="The password  is empty <br>";
}
if($data_object->password !=$data_object->password2){
    $error .="The password  did not matched <br>";
}
if(strlen($data_object->password) < 7){
    $error .=" password should 7 characters long <br>";
}
if(!isset($data_object->gender)){
    $error .="The gender should be selected <br>";
}
$data['user_id']=$db->generate_id(60);
$data['username']=$data_object->username;
if(isset($data_object->gender)){
$data['gender']=$data_object->gender;
}
$data['email']=$data_object->email;
$data['password']=$data_object->password;
$data['date'] =date('Y-m-d H:i:s');
$query = "insert into user(user_id,username,email,gender,password,date)
values(:user_id,:username,:email,:gender,:password,:date)";
if($error ==""){
    $result = $db->write($query,$data);
    if($result){
        $info->massege ="Your profile is created";
        $info->data_type ="info";
        echo json_encode($info);
    }



}else{
        $info->massege =$error;
        $info->data_type ="error";
        echo json_encode($info);
}
<?php
session_start();

require_once("autoloader.php");
$db =new Database();
$info = (object)[];

$data_type="";
if(isset($_POST['data_type'])){
    $data_type =$_POST['data_type'];
    
}

 
if(isset($_FILES['file']) && !$_FILES['file']['name'] ==""){
    if($_FILES['file']['error'] ==0){

        $folder = '../images/';

        
            $destination = $folder.$_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'],$destination );

        

    }
}

$destination = $folder.$_FILES['file']['name'];
  $id = $_SESSION['user']->user_id;
if($data_type =="send_image"){

  if($destination !==""){
    $data1['sender']=$_SESSION['user']->user_id;
     $data1['receiver']=$_POST['user_id'];
     $data1['date']= date("Y-m-d H:s:i");
     $data1['massege_id']= $db->generate_id(60);
     $data1['file']= $destination;

         // insert the massege into database //
    $query = "insert into massege(sender,receiver,massege_id,file,date)values(:sender,:receiver,:massege_id,:file,:date)";
    $result = $db->write($query,$data1);
    if($result){
        $info->massege ="Your profile is updated";
        $info->data_type ="image_send";
        echo json_encode($info);
    }
}
}

?>
<?php
$user ="";
   // getting the single user //
$id = $_SESSION['user']->user_id;
  $sqli = "select * from user where user_id !='$id'"; 
  $contact = $db->read($sqli,[]);


  // getting the single user massege //
  $array['receiver'] =$id;
  $array['sender'] = $_SESSION['user']->user_id;
  $sqli = "select * from massege  where (sender =:sender && receiver =:receiver) order by id asc limit 1";
    $result3 = $db->read($sqli,$array);
  
foreach($contact as $row){

  $image = ($row->gender =="male") ? "../images/user_male.jpg" :"../images/user_female.jpg";
  if(file_exists($row->image)){
    $image = "images/".$row->image;
  }
  $user .=contacts($row,$image);
 

}



$info->massege =$user;
$info->data_type ="contacts";
echo json_encode($info);
die;

$info->massege ="no contacts were found";
$info->data_type ="error";
echo json_encode($info);
 ?>
<?php
$massege ="";
$new_massege ="";

    // Id of the receiver //
$id = $data_object->find->user_id;
$id1 =$_SESSION['user']->user_id;
    // select to chat  //

  $sqli = "select * from user where user_id ='$id'";
  $result = $db->read($sqli,[]);
  if(is_array($result)){


    $result = $result[0];

    $image = ($result->gender =="male") ? "images/user_male.jpg" :"images/user_female.jpg";
    if(file_exists($result->image)){
        
    $image = "images/".$result->image;
    }
        
      // check the redeived massege//
      $array['receiver'] =$id;
     $array['sender'] = $_SESSION['user']->user_id;

      $sqli = "select * from massege  where (sender =:sender && receiver =:receiver) OR (sender =:receiver && receiver =:sender) order by id asc";
     $result3 = $db->read($sqli,$array);
     if(is_array($result3)){
   foreach($result3 as $row){

      if($row->receiver ==$_SESSION['user']->user_id && $row->sender ==$id){
         if($row->received == 0){
             $new_massege .= "there is new massege";

         }
      }
   }
}

     //  update seen feature //
     $db->write("update massege set seen = 1 where sender ='$id' && receiver ='$id1'");

     

    // Query to get the chats from the database when the chats is onload//
    $array['receiver'] =$id;
     $array['sender'] = $_SESSION['user']->user_id;

     $sqli = "select * from massege  where (sender =:sender && receiver =:receiver) OR (sender =:receiver && receiver =:sender) order by id asc";
     $result3 = $db->read($sqli,$array);
     if(is_array($result3)){
   foreach($result3 as $row){
      
      if($row->sender ==$_SESSION['user']->user_id){
         $db->write("update massege set received = 1 where id ='$row->id'");
      }
      if($row->sender ==$_SESSION['user']->user_id){
         $massege .=sender_massege($row);

      }else{
         $massege .="<div class='message friend_msg'>
         <p>$row->massege <br><span>".date("H:i",strtotime($row->date))."</span></p>
     </div>";
      }
        
   
   }

     }
   

  }

  
$info->user=$result->username;
$info->massege=$massege;
$info->new_massege=$new_massege;
$info->data_type ="chats";
echo json_encode($info);
die;



?>
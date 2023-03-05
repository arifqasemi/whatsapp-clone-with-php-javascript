<?php

require_once("autoloader.php");

$data = file_get_contents("php://input");
$data_object = json_decode($data);
session_start();
if(!isset($_SESSION['user'])){
   if(isset($data_object->type) && $data_object->data_type != 'login' && $data_object->data_type != 'signUp'){
       $info->loged_in=false;
       echo json_encode($info);
       die;

   }
   
}
$db =new Database();
$info = (object)[];
$error = "";


if(isset($data_object->data_type) && $data_object->data_type =='logout'){
   if(isset($_SESSION['user'])){
      unset($_SESSION['user']);
  }
  $info->loged_in = false;
  $info->data_type = "logout";
  echo json_encode($info);
   
}

if(isset($data_object->data_type) && $data_object->data_type =='signUp'){
    include("sign_up.php");
    
 }
 if(isset($data_object->data_type) && $data_object->data_type =='login'){
    require_once("login.php");
}



if(isset($data_object->data_type) && $data_object->data_type =='user_info'){
      require_once("user_info.php");

   
    // echo "the user info is getting";
 }

 if(isset($data_object->data_type) && $data_object->data_type =='contacts'){
    include("contacts.php");
    
    
 }

 if(isset($data_object->data_type) && $data_object->data_type =='start_chat'){
    include("start_chat.php");
    // echo "this going to be start chat";
    
    
 }

 if(isset($data_object->data_type) && $data_object->data_type =='send_massege'){
    include("send_massege.php");
    
     

    
 }






 
 function contacts($row,$image=[]){

   
    return "<div>
    <div class='block' >
    <div class='imgBox' user_id='$row->user_id' onClick='start_chat(event)' >
        <img src='$image' class='cover' alt=''>
    </div>
    <div class='details' user_id='$row->user_id' onClick='start_chat(event)'>
        <div class='listHead'>
            <h4>$row->username</h4>
            <p class='time'>12:34</p>
        </div>
        <div class='message_p' user_id='$row->user_id' onClick='start_chat(event)'>
        <p>$row->last_massege</p>
        </div>
    </div>
  </div>
  </div>
  ";
   
     
  }



  function sender_massege($row){

   $sender ="
   <div class='message my_msg'>";
  
   if($row->seen){
      $sender .="
   <p>$row->massege <br><span>".date("H:i",strtotime($row->date))."<i class='fas fa-check-double' id='check_icon' style='color:blue;'></i></span></p>
   ";
   }elseif($row->received){
      $sender .="
      <p>$row->massege <br><span>".date("H:i",strtotime($row->date))."<i class='fas fa-check-double' id='check_icon' ></i></span></p>
      ";
   }

   if($row->file !==null){
      
      $image = "images/".$row->file;
      $sender .="<img src='$image' style='width:120px; height:140px;'>
      ";
   }
   $sender .="
   </div>";
   return $sender;

  }



  function receiver_massege($row){
   return "<div class='message friend_msg'>
         <p>$row->massege<br><span>".date("H:i",strtotime($row->date))."</span></p>
       
        
     </div>";
     
  }
  ?>
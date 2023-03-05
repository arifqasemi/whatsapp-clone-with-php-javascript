<?php
$massege ="";
$id = $data_object->find->user_id;
   // get the user from the database and display the name //
  $sqli = "select * from user where user_id ='$id'";
  $result = $db->read($sqli,[]);
  if(is_array($result)){


     $data1['massege']=$data_object->find->massege;
     $data1['sender']=$_SESSION['user']->user_id;
     $data1['receiver']=$data_object->find->user_id;
     $data1['date']= date("Y-m-d H:s:i");
     $data1['massege_id']= $db->generate_id(60);

    // read from massege table //
     $arr1['sender']= $_SESSION['user']->user_id;
     $arr1['receiver']=$data_object->find->user_id;
     $sqli = "select * from massege where receiver =:receiver  && sender =:sender";
     $result2 = $db->read($sqli,$arr1);

     if(is_array($result2)){
        $result2 = $result2[0];
        $data1['massege_id']=$result2->massege_id;
     }   

     // insert the massege into database //
     $query = "insert into massege(sender,receiver,massege,massege_id,date)values(:sender,:receiver,:massege,:massege_id,:date)";
     $result = $db->write($query,$data1);
    
   
     // insert individual massege //
     $individual['last_massege']=$data_object->find->massege;
     $individual['user_id']=$_SESSION['user']->user_id;

     $query = "update  user set last_massege =:last_massege where user_id =:user_id";
     $result = $db->write($query,$individual);

    

     // read the sender massege from the database //
     $array['receiver'] =$id;
     $array['sender'] = $_SESSION['user']->user_id;

     $sqli = "select * from massege  where (sender =:sender && receiver =:receiver) OR (sender =:receiver && receiver =:sender)";
     $result3 = $db->read($sqli,$array);
     if(is_array($result3)){
   foreach($result3 as $row){
      if($row->sender ==$_SESSION['user']->user_id){
         $massege .=sender_massege($row);

      }else{
         $massege .= "<div class='message friend_msg'>
         <p>$row->massege<br><span>".date("H:i",strtotime($row->date))."</span></p>";
         if($row->file !==null){
      
            $image = "images/".$row->file;
            $massege .="<img src='$image' style='width:120px; height:140px;'>
            ";
         }
        $massege .="
     </div>";
      }
        
   
   }

     }



    

     $info->massege =$massege;
     $info->data_type ="sender_massege";
     echo json_encode($info);
     die;
   
               
   

  }






?>
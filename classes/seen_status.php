<?php
$seen ="";

    // Id of the receiver //
$id = $data_object->find->user_id;

    // select to chat  //

    
     
     //  update seen feature //
    //  $db->write("update massege set seen = 1 where sender ='$id'");



    // check the receiverd status//
   

      // check the seen status//
    $array['receiver'] =$id;
    $array['sender'] = $_SESSION['user']->user_id;

    $sqli = "select * from massege  where (sender =:sender && receiver =:receiver)  order by id asc";
    $result3 = $db->read($sqli,$array);
    if(is_array($result3)){
        foreach($result3 as $row){
            if($row->seen == 1){
              $seen .="the massege is seen";
            }
       
           }
       
    }
    

$info->seen=$seen;
$info->data_type ="seen_status";
echo json_encode($info);
die;



?>
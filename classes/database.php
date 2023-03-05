<?php




class Database{
    public $connection;


    function __construct(){
        $this->connection = $this->connect();
    }



   public function connect(){

           $string = 'mysql:host=localhost;dbname=chat_app';
        try{

          $db = new PDO($string, "root", "");
             return $db;

        }catch(PDOExeception $e){
          echo "failed";

        }
        return false;
    }



    public function write($query, $data_array =[]){
       $db = $this->connect();
        $stmt = $db->prepare($query);
       
        $check = $stmt->execute($data_array);
        if($check){
            return true;
        }
        return false;
    }
    public function read($query, $data_array=[]){

        $db = $this->connect();
         $stmt = $db->prepare($query);
         $check = $stmt->execute($data_array);

         if($check){
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            if(is_array($result)  && count($result)>0){
                
                return $result;
            }
             return false;
         }
        //  return false;
     }

   public function generate_id($round_count) {

        $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $text = "";
    
        $round_count = rand(4,$round_count);
    
        for($i=0;$i<$round_count;$i++) {
    
            $random = rand(0,61);
            
            $text .= $array[$random];
    
        }
    
        return $text;
    }
}
<style>
    .contacts img{
    width:15%;
    height:40px;
    border-radius:50%;
}
.contacts{
    display:flex;
    padding:8px 0;
    cursor:pointer;
    padding-left:5px;
    text-transform:capitalize;
}
.contacts h4{
    color:white;
    padding-left:5px;

}

.right_sight{
    display:none;
}
.box {
    position:absolute;
    top:50px;
   left:350px;
  width: 150px;
  height: 100px;
  background-color: white;
  transition: width 0.5s ease;
  z-index: 5;
  border-radius:6px;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:space-around;
  padding:2px 5px;
  opacity:0;
}

.box i{
    padding-right:4px;
    cursor:pointer;
}
.box h4{
    cursor:pointer;
}

.display{
    opacity:10;
}

#check_icon{
    font-size:15px;
}

</style>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arif Qasemi WhatsApp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <div class="leftSide">
            <!-- Header -->
            <div class="header">
                <div class="userimg">
                    <img src="" id="profile_image" alt="" class="cover">
                </div>
                <ul class="nav_icons">
                    <li><ion-icon name="ellipsis-vertical" class="icon"></ion-icon></li>
                </ul>
                <div class="box">
                <h4><i class="fa fa-user"></i>Profile</h4>
                <h4 class="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</h4>
                </div>
            </div>
           
            <!-- CHAT LIST -->
           <?php include("user.php")?>

           <!-- CHAT LIST END -->

        <div class="rightSide">
            <div class="right_sight">
            <?php include("right_side.php")?>

            </div>
           
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



<script type="text/javascript">
    var sound = new Audio("sound.mp3");
    var CURRENT_USER_CHAT ="";

    function _(element){
        return document.getElementById(element);
    }


    // getting the data from the api //

    function get_data(find,type){
        var ajax = new XMLHttpRequest();
        ajax.onload = function(){
            if(ajax.status == 200 || ajax.readyState == 4){
                handle_result(ajax.responseText,type);
            }
        }


         data = {};
         data.find = find;
         data.data_type = type;
         data = JSON.stringify(data);
        ajax.open("POST","../classes/api.php",true);
        ajax.send(data);
    }



    // handling the result from the api //

function handle_result(result,type){
    
    // alert(result);
    if(result.trim() !==""){
        var obj = JSON.parse(result);
        if(typeof(obj.loged_in) !== "undefined" && !obj.loged_in){
            window.location = "login.php";
        }else{
            switch(obj.data_type){
                case "user_info":
                    var username = _('username');
                    // username.innerHTML = obj.result.username;
                    // email.innerHTML = obj.result.email;
                    var profile_image = _('profile_image');
                    profile_image.src = obj.image;

                    break;
                    case "contacts":
                    var contacts_holder =document.querySelector('.chatlist');
                    contacts_holder.innerHTML = obj.massege;
                    break;
                    case "chats":
                    // var header =document.querySelector('.chatlist');
                    // header.innerHTML= obj.massege;
                    var name_holder =document.querySelector('.name');
                    name_holder.innerHTML = obj.user;
                    var msg_holder =document.querySelector('.chatbox');
                        msg_holder.innerHTML=obj.massege;
                       
                    
                 
                    break;
                    case "sender_massege":
                        var sender_msg =document.querySelector('.chatbox');
                        sender_msg.innerHTML=obj.massege;
                        var sender_msg =document.querySelector('.chatbox');
                        sender_msg.scrollTo(10,sender_msg.scrollHeight);
                        sound.play();
                    break;
                    case "send_image":
                        sound.play();

                    break;
                    case "logout":
                        
                        window.location = "login.php";
                    break;
                    
            }
        }
    }
}


//     var settings = _("settings");
//     settings.addEventListener('click',getsettings);



//     function getsettings(){
//         get_data({},"settings");

//     }


 // start chat //

function start_chat(e){

    var user_id = e.target.getAttribute('user_id');
    if(e.target.id ==""){     
          var user_id = e.target.parentNode.getAttribute('user_id');
          CURRENT_USER_CHAT = user_id;
          if(!CURRENT_USER_CHAT ==""){
            var rigth_side =document.querySelector('.right_sight');
            rigth_side.style.display = "block";
          }

    } 
    if(user_id ==null){
            alert('please click on the photo');
        }
          
               get_data({user_id: CURRENT_USER_CHAT},"start_chat");

    
    
    

    }
   
  // send message //

  function send_messege(){
    var chat_input = _('input');
    if(!chat_input.value ==""){
        
    get_data({user_id: CURRENT_USER_CHAT,
             massege:chat_input.value}
             ,"send_massege");
             chat_input.value="";
    get_data({user_id: CURRENT_USER_CHAT},"start_chat");
    var sender_msg =document.querySelector('.chatbox');
    sender_msg.scrollTo(10,sender_msg.scrollHeight);

   }else{
    alert("please type something");

   }

}



   

get_data({},"user_info");
get_data({},"contacts");


//   live chat //
// get_data({},"chat");
setInterval(() => {
    if(CURRENT_USER_CHAT !==""){
        get_data({user_id: CURRENT_USER_CHAT},"start_chat");

    }
    
}, 1000);
      
   // nav icon //
var nav_icon =document.querySelector('.icon');
    nav_icon.addEventListener('click',function(){
        var nav =document.querySelector('.box');
        nav.classList.toggle("display");

       
    });


    // logout icon //
    var logout =document.querySelector('.logout');
    logout.addEventListener('click',function(){
       
            var answer = confirm("are you sure?");
    if(answer){
        get_data({},"logout");

    }
       
    });


    //  input focus to show typing //
    const myElement = document.getElementById("input");

        myElement.addEventListener("focus", () => {
        console.log("Element focused");
        });



    // send image //

    function send_image(file){

const formData = new FormData();
var xml = new XMLHttpRequest();
    xml.onload = function(){
        if(xml.status == 200 || xml.readyState == 4){
            handle_result(xml.responseText);
            sound.play();


        }
    }
     formData.append("data_type","send_image" );
     formData.append("user_id",CURRENT_USER_CHAT);
    formData.append('file',file[0])
    xml.open("POST","../classes/send_image.php",true);
    xml.send(formData);
}
</script>
</body>
</html>
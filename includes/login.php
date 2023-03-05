
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="javascript">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <title>Document</title>
</head>

<style>

.wrapper{
    width: 700px;
    min-height:600px;
    margin:auto;
}
form{
    display:flex;
    flex-direction:column;
}
input[type="text"], input[type="password"],input[type="submit"],input[type="email"]{
    padding:10px;
    margin:10px;
    border-radius:5px;
    border:solid 1px grey;
}
input[type="submit"]{
    cursor:pointer;
    background-color:#2804a5;
    color:white;
}

#error{
    background-color:#ef6666;
    padding:10px;
    margin:10px;
    color:white;
    text-align:center;
    display:none;
}
</style>
<body>
    <div class="wrapper">
        <div  style="display:flex; justify-content:center;">
            <h5>My Chat App</h5>
        </div>
        <div id="error"></div>
<form id="form">
  <input type="email" id="email" name="email" placeholder="Email">
  <input type="password" id="password" name="password" placeholder="Password">
 
  <input type="submit" id="btn" value="Login">
  <a href="includes/sign_up.php" style="display:block; text-align:center">Don't have an account? SignUp here</a>
</form>
    


</div>
<script type="text/javascript">
    function _(element){
        return document.getElementById(element);
    }
    var btn = _("btn");
    btn.addEventListener("click",collect_data);
    var form = _("form");
    function collect_data(evt){
        btn.value= "loading...please waite";
        btn.disabled=true;

        evt.preventDefault();
        const formdata= form.getElementsByTagName('INPUT');
         var data= {};
        for (var i = 0; i < formdata.length; i++) {
           var key  = formdata[i].name;
           switch(key){
                case"password":
                data.password =formdata[i].value;
                break;
                case"email":
                data.email =formdata[i].value;
                break;
                
            }
          
        }  
                send_data(data,"login")
               
    }


    function send_data(data,type){
        var xml = new XMLHttpRequest();
        xml.onload = function(){
            if(xml.status == 200 || xml.readyState == 4){
            handle_result(xml.responseText);
                btn.disabled= false;
                btn.value="Login";

            }
        }
         data.data_type = "login";
        data_string= JSON.stringify(data);
        xml.open("POST","../classes/api.php",true);
        xml.send(data_string);

    }

    
    function handle_result(result){
        // alert(result);
        var data = JSON.parse(result);
        if(data.data_type == "info"){
            window.location = "index.php";
        }else{
            var error = _("error");
            error.innerHTML = data.massege;
            error.style.display = "block";
        }
    }

</script>
</body>
</html>




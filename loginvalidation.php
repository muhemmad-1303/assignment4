<?php
$host='localhost';
$user='root';
$password='';
$dbname='users';
$con=new mysqli($host,$user,$password,$dbname);
if($con->connect_error){
  die("connection error");
}

if($_SERVER["REQUEST_METHOD"]="POST"){
   foreach($_POST as $key=>$value){
      $form_data[$key]=val($value);
   }
}
function val($data){
   $data=trim($data);
   $data=stripslashes($data);
   $data=htmlspecialchars($data);
   return $data;
}

$error=array();
if(empty($form_data['username'])){
    $error["errorusername"]="field should contain a value";
 }
 else if(!preg_match("/^[a-zA-Z_]*$/",$form_data['username'])){
    $error["errorusername"]="letter and underscore are only allowed";
    $form_data['username']="";
 }
 else{
     $sql="select * from userinfo where username ='{$form_data['username']}'";
     $result=$con->query($sql);
     if($result->num_rows == 0){
      $error['errorusername']='incorrect username';
     }   
 }
 if(empty($form_data['password'])){
    $error["errorpassword"]="field should contain a value";
    
  }
  else if(!preg_match("/^[ A-Za-z0-9_@-]*$/",$form_data['password'])){
    
    $error["errorpassword"]="alphanumeric and special charcter only allowed";
    $form_data['password']="";
 
  }
  session_start();
 $_SESSION['form_data']=$form_data;
 $_SESSION['form_error']=$error;
 
  
  
  if(empty($error)){
  
  $sql="select password from userinfo where username ='{$form_data['username']}'";
  $result=$con->query($sql);
  $row=$result->fetch_assoc();

  if(password_verify($form_data['password'],$row['password'])){
    
    header("location:contacmeinfo.php");
  }
  else{
       $error['errorpassword']="incorrect password";
       $_SESSION['form_error']=$error;
       header("location:loginpage.php");
    
  }
  }
  else{
    header("location:loginpage.php");
  }


?>
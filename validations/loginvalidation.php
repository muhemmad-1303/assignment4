<?php
include "../database/database.php";

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
     $statement=$pdo->prepare("select * from userinfo where username ='{$form_data['username']}'");
     $statement->execute();
     $result=$statement->fetchAll(PDO::FETCH_ASSOC);
     
     if(count($result)== 0){
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

  $state=$pdo->prepare("select password from userinfo where username ='{$form_data['username']}'");
  $state->execute();
  $res=$state->fetchAll(PDO::FETCH_ASSOC);

  if(password_verify($form_data['password'],$res[0]['password'])){
    
    header("location:../page/contacmeinfo.php");
  }
  else{
       var_dump($res);
       $error['errorpassword']="incorrect password";
       $_SESSION['form_error']=$error;
       header("location:../page/loginpage.php");
    
  }
  }
  else{
    
    header("location:../page/loginpage.php");
  }


?>
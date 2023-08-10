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
     if($result->num_rows > 0){
      $error['errorusername']='username has taken';
     }
    
 }
 if(empty($form_data['email'])){
   $error["erroremail"]="field should contain a value";
    
 }
 else if (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)){
   $error["erroremail"]="invalid email entered";
    $form_data['email']="";
 }
 else{
   $sql="select * from userinfo where email ='{$form_data['email']}'";
   $result=$con->query($sql);
   if($result->num_rows > 0){
    $error["erroremail"]="email already exist";
   }
  
 }
 if(empty($form_data['number'])){
   $error["errornumber"]="field should contain a value";
   
 }
 else if(!preg_match("/[0-9]/",$form_data['number'])){
   $error["errornumber"]="number only allowed";
   $form_data['number']="";

 }
 else{
   $sql="select * from userinfo where number ='{$form_data['number']}'";
   $result=$con->query($sql);
   if($result->num_rows > 0){
    $error['errornumber']='number already exist';
   }
 }
 if(empty($form_data['password'])){
   $error["errorpassword"]="field should contain a value";
   
 }
 else if(!preg_match("/^[ A-Za-z0-9_@-]*$/",$form_data['password'])){
   
   $error["errorpassword"]="alphanumeric and special charcter only allowed";
   $form_data['password']="";

 }
 if(empty($form_data['gender'])){
   $error["errorgender"]="choose a option";
    
 }
 
 
 
 
 session_start();
 $_SESSION['form_data']=$form_data;
 $_SESSION['form_error']=$error;
 



  if(empty($error)){
     $hasshedpassword=password_hash($form_data['password'],PASSWORD_BCRYPT);
     $sql="INSERT INTO userinfo(username, email, number, gender, password) VALUES ('{$form_data['username']}','{$form_data['email']}','{$form_data['number']}','{$form_data['gender']}','$hasshedpassword')";
     $con->query($sql);
     $_SESSION['form_data']="";
     $_SESSION['form_error']="";
     header("location:../page/loginpage.php");
  }
  else{
  
   //   header("location:contact.php?errorfname=".$errorfname."&errorlname=".$errorlname."&erroremail=".$erroremail."&errornumber=".$errornumber."&fname=".$fname."&email=".$email."&number=".$number."&message=".$message);
   
     $_SESSION['conditon']=0;
     header("location:../page/register.php");
  }
?>
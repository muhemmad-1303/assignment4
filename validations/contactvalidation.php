<?php
 $host='localhost';
 $user='root';
 $password='';
 $dbname='users';
 $con=new mysqli($host,$user,$password,$dbname);
 if($con->connect_error){
   die("connection error");}
   
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
 if(empty($form_data['fname'])){
    $error["errorfname"]="field should contain a value";
    $form_data['fname']="";
 }
 else if(!preg_match("/^[a-zA-Z-' ]*$/",$form_data['fname'])){
    $error["errorfname"]="letter and space are only allowed";
    $form_data['fname']="";
 }
 if(empty($form_data['lname'])){
    $error["errorlname"]="field should contain a value";
    $form_data['lname']="";
 }
 else if(!preg_match("/^[a-zA-Z-' ]*$/",$form_data['lname'])){
   $error["errorlname"]="letter and space are only allowed";
    $form_data['lname']="";
 }
 if(empty($form_data['email'])){
   $error["erroremail"]="field should contain a value";
    $form_data['email']="";
 }
 else if (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)){
   $error["erroremail"]="invalid email entered";
    $form_data['email']="";
 }


 if(empty($form_data['number'])){
   $error["errornumber"]="field should contain a value";
    $form_data['number']="";
 }
 else if(!preg_match("/[0-9]/",$form_data['number'])){
   $error["errornumber"]="number only allowed";
    $form_data['number']="";

 }
 
 session_start();
 $_SESSION['form_data']=$form_data;
 $_SESSION['form_error']=$error;
 $_SESSION['start'] = true;
 



  if(empty($error)){
     $sql="INSERT INTO contactinfo(fname, lname, email, number,message) VALUES ('{$form_data['fname']}','{$form_data['lname']}','{$form_data['email']}','{$form_data['number']}','{$form_data['message']}')";
     $con->query($sql);
     header("location:../page/success.php");
  }
  else{
  
   //   header("location:contact.php?errorfname=".$errorfname."&errorlname=".$errorlname."&erroremail=".$erroremail."&errornumber=".$errornumber."&fname=".$fname."&email=".$email."&number=".$number."&message=".$message);
    header("Location:../page/contact.php");
    
   
  }
?>
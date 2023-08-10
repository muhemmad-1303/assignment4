<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/validation.css">
</head>
<body>
      <?php
        session_start();

        if(!isset($_SESSION['start'])){
             header("location:contact.php");
        }
        $form_data=$_SESSION['form_data'] ?? ' ';
        unset($_SESSION['form_data']); 
        unset($_SESSION['start']);
        unset($_SESSION['start']);
        $name=$form_data['fname']?? " ";
        $name.=" ";
        $name.=$form_data['lname']?? " ";
        
      ?>
      <div class="main">
        <?php include "nav.php"?>
        <div class="successcard">
            <h1>Hooray..</h1>
            <p>You are connected with me</p>
            <div class="detailcard">
                <p>your details</p>
                <p>Name: <?= $name ?></p>
                <p>Email: <?= $form_data['email']?? " " ?></p>
                <p>Number: <?= $form_data['number'] ?? " "?></p>
                <p>Message: <?= $form_data['message'] ?? " "?></p>
            </div>
        
        </div>
      </div>
</body>
</html>
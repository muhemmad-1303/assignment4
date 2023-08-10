<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
<?php
      session_start();
      $form_data=$_SESSION['form_data'] ?? [];
      $error=$_SESSION["form_error"] ?? [];
    
      unset($_SESSION['form_data']);
      unset($_SESSION['form_error']);
      
     
      ?>
       <div class="main">
       <?php include "nav.php"?>
        <div class="logincard">
            <form action="../validations/loginvalidation.php" method="post">
            <div class="inputbox">
            <label>User Name:</label>
            <input type="text" name="username" value="<?=$form_data['username'] ?? '' ?>">
            <span><?=$error['errorusername']??''  ?></span>
            </div>
            <div class="inputbox">
            <label>Password:</label>
            <input type="password" name="password"value="<?=$form_data['password'] ?? '' ?>">
            <span><?=$error['errorpassword']??''  ?></span>
            </div>
            <input type="submit" value="Log In">
            </form>
            <hr noshade>
            <div class="register">
                <a href="register.php">Create new account</a>
            </div>
        </div>
       </div>
</body>
</html>
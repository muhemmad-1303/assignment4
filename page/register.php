<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/register.css">
</head>
<body>
    <?php
      session_start();
      $form_data=$_SESSION['form_data'] ?? [];
      $error=$_SESSION["form_error"] ?? [];
      $condition=$_SESSION['conditon'] ?? "";
      unset($_SESSION['form_data']);
      unset($_SESSION['form_error']);
      if($condition !=0){
        $form_data=[];
        
      }
      ?>
    <div class="main">
        <?php include "nav.php"  ?>
        <div class="registercard">
            <h1>Create new account</h1>
            <form action="../validations/registervalidation.php" method="post">
            <div class="registerbody">
                <div class="inputbox">
                    <label>User name:</label>
                    <input type="text" name="username" value="<?= $form_data['username'] ?? '' ?>">
                    <span><?= $error['errorusername'] ?? ''?></span>
                </div>
                <div class="inputbox">
                    <label>Email:</label>
                    <input type="text" name="email"  value="<?= $form_data['email'] ?? '' ?>" >
                    <span><?= $error['erroremail'] ?? ''?></span>
                </div>
                <div class="inputbox">
                    <label>Number</label>
                    <input type="text" name="number" value="<?= $form_data['number'] ?? '' ?>">
                    <span><?= $error['errornumber'] ?? ''?></span>
                </div>
                <div class="inputbox">
                    <label>password</label>
                    <input type="password" name="password" value="<?= $form_data['password'] ?? '' ?>">
                    <span><?= $error['errorpassword'] ?? ''?></span>
                </div>
                <div class="radiobtn">
                    <div class="radiobox">
                    <label>Male</label>
                    <input type="radio" name="gender" value="male" <?php if(!empty($form_data['gender'])){if($form_data['gender']==='male') echo "checked";}?>>
                   </div>
                   <div class="radiobox">
                    <label>Female</label>
                    <input type="radio" name="gender" value="female">
                  </div>
                  <div class="radiobox">
                    <label>Other</label>
                    <input type="radio" name="gender" value="other">
                  </div> 
                </div>
                <span class="gendererror"><?= $error['errorgender'] ?? ''?></span>
                <input type="submit" value="Sign Up">
            </div>
            </form>
        </div>
    </div>
</body>
</html>
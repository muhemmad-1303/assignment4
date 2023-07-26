<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="validation.css">
</head>
<body>
      <?php
        session_start();
        $form_data=$_SESSION['form_data'];
        unset($_SESSION['form_data']);
      ?>
      <div class="main">
        <div class="successcard">
            <h1>Hooray..</h1>
            <p>You are connected with me</p>
            <div class="detailcard">
                <p>your details</p>
                <p>Name: <?=$form_data['fname']." ".$form_data['lname']?></p>
                <p>Email: <?= $form_data['email'] ?></p>
                <p>Number: <?= $form_data['number']?></p>
                <p>Message: <?= $form_data['message']?></p>
            </div>
        
        </div>
      </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/contactmeinfo.css">
</head>
<body>
<?php
 include "../database/database.php";
 $statement=$pdo->prepare("SELECT *FROM contactinfo;");
 $statement->execute();
 $result=$statement->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="main">
<div class="contactcard">
<h1>Contact Information</h1>
<table width="800" style="border:1px solid black;">
   <tr>
    <td>fname</td>
    <td>lname</td>
    <td>email</td>
    <td>number</td>
    <td>message</td>
   </tr>
   <?php
     foreach($result as $row){
   ?>
      <tr>
      <td><?=$row["fname"] ?></td>
      <td><?=$row["lname"] ?></td>
      <td><?=$row["email"] ?></td>
      <td><?=$row["number"] ?></td>
      <td><?=$row["message"] ?></td>
     </tr>

   <?php  }  ?>


</table>
     </div>
</div>
</body>
</html>




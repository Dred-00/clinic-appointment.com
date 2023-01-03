<?php

include 'config.php';

if(isset($_POST['submit'])){

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = mysqli_real_escape_string($conn, $_POST['password']);
  $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
  $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('queryss failed');
  
  if (mysqli_num_rows($select) > 0){
      $message[] = 'user already exist';
  }else{
      if($pass != $cpass){
          $message[] = 'confirm password not matched';
      }else{
          $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password ) VALUES('$name','$email','$pass')") or die('query failed');

          if($insert){
              $message[] = 'registered succesfully!';
              header('location:login.php');
          }else{
              $message[] = 'registration failed!';
          }  
      }
  }
}

?>


<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="body.css">
    </head>
    <body>

<div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
        <h3> Register now</h3>
        <?php
        if(isset($message)){
            foreach($message as $message){
                echo'<div class="message">'.$message.'</div>';
            }
        }


        ?>

            <input type="text" name="name" placeholder="enter fullname" class="box" required>
            <input type="email" name="email" placeholder="enter email" class="box" required>
            <input type="password" name="password" placeholder="enter password" class="box" required>
            <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
            <input type="submit" name="submit" value="register now" class="btn">
            <p>Already have an Account <a href="login.php">Login now </a> </p>
            <br>
            <a href=" home.php" class="home"> Home</a>
    </form>


</body>
</html>
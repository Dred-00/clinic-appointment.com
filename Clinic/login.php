<?php
include 'config.php';
session_start();

if(isset($_POST['submit'])){

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = mysqli_real_escape_string($conn, $_POST['password']);

  $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');
  
  if (mysqli_num_rows($select)> 0){
     $row = mysqli_fetch_assoc($select);
     $_SESSION['user_id'] = $row['id'];
     header('location:user.php');
  }else{
    $message[] = 'incorrect email or password';
  }
}

?>

<html>

<head>
        <title>Login</title>
        <link rel="stylesheet" href="body.css">
    </head>

<body>

<div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
        <h3> Login Now </h3>
        <?php
        if(isset($message)){
            foreach($message as $message){
                echo'<div class="message">' .$message. '</div>';
            }
        }


        ?>
            <input type="email" name="email" placeholder="enter email" class="box" required>
            <input type="password" name="password" placeholder="enter password" class="box" required>
            <input type="submit" name="submit" value="login now" class="btn">
            <p>Don't have an Account <a href="register.php">Register now </a> </p>
            <br>
            <a href="home.php">Home </a>
            <br>
            <a href="adminlog.php">Admin </a>
    </form>


</body>
</html>
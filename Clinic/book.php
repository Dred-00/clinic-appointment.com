<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['book'])){

  $fname = mysqli_real_escape_string($conn, $_POST['fname']);
  $appoint = mysqli_real_escape_string($conn, $_POST['appoint']);
  $sched = mysqli_real_escape_string($conn, $_POST['sched']);
  $porpose = mysqli_real_escape_string($conn, $_POST['porpose']);
  $select = mysqli_query($conn, "SELECT * FROM `app_form` WHERE appoint = '$appoint' AND sched = '$sched'") or die('query failed');
  
  if (mysqli_num_rows($select) > 0){
      $message[] = 'book already exist';
      }else{
        $insert = mysqli_query($conn, "INSERT INTO `app_form`(fname, appoint, sched, porpose ) VALUES('$fname','$appoint','$sched','$porpose')") or die('query failed');

          if($insert){
              $message[] = 'Book succesfully!';
              header('location:book.php');
          }else{
              $message[] = 'Book failed!';
          }  
      }
  }

  
  
?>


<html>
<html lang="en">
<head>
    <title> User </title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/244d468570.js" crossorigin="anonymous"></script>

</head>
<body>

<?php
$select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die ('query failed');
if(mysqli_num_rows($select)>0){
    $fetch = mysqli_fetch_assoc($select);
}
?>



    <div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="leftbox">
            <nav>
                <a class="tab active">
                <i class="fa-regular fa-calendar-check"></i>
                </a>
            </nav>
        </div>
        <div class="rightbox">
        <div class="book tabShow">
            <h1>Book Appointment</h1>
            <h2>Full Name</h2>
            <input type="text" name="fname" value="<?php echo $fetch['name'] ?>">
            <h2>Appointment</h2>
            <select name="appoint" class="app">
                <option value="Tooth Extraction">Tooth Extraction</option name="appoint">
                <option value="Cleaning">Cleaning</option name="appoint">
                <option value="Teeth Filling">Teeth Filling</option name="appoint">
                <option value="Medical Certificate">Medical Certificate</option name="appoint">
                <option value="Resting Bed">Resting Bed</option name="appoint">
              </select>
            <h2>Appointment Date</h2>
            <a class="rem">(Atleast 3 Days Before the Appointment Date)</a>
            <input type="date" class="input" name="sched">
            <h2>Purpose of the Appointment</h2>
            <input type="text" class="input" name="porpose">
            
            <input type="submit" name="book" value="Book Appointment" class="btn">
         <a href="user.php" class="btn">Done</a>
    </div>
<script>
    const tabBtn = document.querySelectorAll(".tab")
    const tab = document.querySelectorAll(".tabShow")


    function tabs(panelIndex){
        tab.forEach(function(node){
            node.style.display = "none";
        });
        tab[panelIndex].style.display = "block";
    }
    tabs(0);
</script>







</body>
</html>
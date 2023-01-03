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
                header('location:user.php');
            }else{
                $message[] = 'Book failed!';
            }  
        }
    }
  
    

  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> User </title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/244d468570.js" ></script>

</head>
<body>

<?php
$select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die ('query failed');
if(mysqli_num_rows($select)>0){
    $fetch = mysqli_fetch_assoc($select);
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="container">
        <div class="leftbox">
            <nav>
                <a onclick="tabs(0)" class="tab active">
                    <i class="fa fa-user"></i>
                </a>
                <a onclick="tabs(1)" class="tab">
                    <i class="fa-solid fa-file-medical"></i>
                </a>
                <a onclick="tabs(2)" class="tab">
                    <i class="fa-solid fa-sliders"></i>
                </a>
                <a onclick="tabs(3)" class="tab">
                    <i class="fa-regular fa-calendar-check"></i>
                </a>
            </nav>
        </div>
        <div class="rightbox">
            <div class="profile tabShow">
                <h1>Personal Info</h1>
                <h2> Full Name</h2>
                <input type="text" name="update_name" value="<?php echo $fetch['name'] ?>">
                <h2>Phone/Contact Number</h2>
                <input type="text" name="update_pnum" value="<?php echo $fetch['pnum'] ?>">
                <h2>Age</h2>
                <input type="text" name="update_age" value="<?php echo $fetch['age'] ?>">
                <h2>Gender (Male/Female)</h2>
                <input type="text" name="update_gender" value="<?php echo $fetch['gender'] ?>">
                <h2>Date of Birth</h2>
                <input type="date" name="update_birth" value="<?php echo $fetch['birth'] ?>">
                
                <a class="btn" href="personal.php"> Update Profile</a>
            </div>
            <div class="medical tabShow">
                <h1>School/Medical Records</h1>
                <h2>Id Number</h2>
                                <input type="text" name="update_idnum" value="<?php echo $fetch['idnum'] ?>">
                <h2>Course</h2>
                                <input type="text" name="update_course" value="<?php echo $fetch['course'] ?>">
                <h2>Year/Block</h2>
                                <input type="text" name="update_year" value="<?php echo $fetch['year'] ?>">
                <h2>Weight</h2>
                                <input type="text" name="update_weight" value="<?php echo $fetch['weight'] ?>">
                <h2>Height</h2>
                                <input type="text" name="update_height" value="<?php echo $fetch['height'] ?>">
                <a class="btn" href="School.php"> Update Profile</a>
        </div>
        <div class="account tabShow">
            <h1>Account Setting</h1>
            <h2>Email</h2>
            <input type="text" name="update_email" value="<?php echo $fetch['email'] ?>">
            <br>
            <input type="password" name="old_pass" value="<?php echo $fetch['password']?>" >
            <a class="btn" href="account.php"> Update Profile</a>
            <br>
            <button class="btn"><a href="login.php?logout=<?php echo $user_id; ?>" class="delete-btn"> Logout </a></button>
        </div>
        <div class="book tabShow">
        <h1>Book Appointment</h1>
            <h2>Full Name</h2>
            <input type="text" name="fname" value="<?php echo $fetch['name'] ?>">
            <h2>Appointment</h2>
            <select name="appoint" class="app">
                <option value="Pre-Medical">Pre-Medical</option name="appoint">
                <option value="Dental check-up">Dental check-up</option name="appoint">
                <option value="Tooth Extraction">Tooth Extraction</option name="appoint">
                <option value="Medical Certificate">Medical Certificate</option name="appoint">

              </select>
            <h2>Appointment Date</h2>
            <a class="rem">(Atleast 1 Day Before the Appointment Date)</a>
            <input type="date" class="input" name="sched" required>
            <h2>Purpose of the Appointment</h2>
            <input type="text" class="input" name="porpose" required>
            
            <input type="submit" name="book" value="Book Appointment" class="btn">

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
<script>
    $(".tab").click(function(){
        $(this).addClass("active").siblings().removeClass("active")
    })
</script>







</body>
</html>
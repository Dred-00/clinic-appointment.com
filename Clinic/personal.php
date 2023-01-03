<?php
 
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
    

if(isset($_POST['prof_update'])){

    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_pnum = mysqli_real_escape_string($conn, $_POST['update_pnum']);
    $update_age = mysqli_real_escape_string($conn, $_POST['update_age']);
    $update_gender = mysqli_real_escape_string($conn, $_POST['update_gender']);
    $update_birth = mysqli_real_escape_string($conn, $_POST['update_birth']);


    mysqli_query($conn, "UPDATE `user_form` SET name = '$update_name', pnum = '$update_pnum', age = '$update_age', gender = '$update_gender', birth = '$update_birth' WHERE id = '$user_id'") or die ('query failed');

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
                
                <input type="submit" name="prof_update" value="UPDATE" class="btn">
                <a class="btn" href="User.php"> Back</a>
    
        
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
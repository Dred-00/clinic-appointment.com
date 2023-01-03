<?php
 
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
    

if(isset($_POST['prof_update'])){

    $update_idnum = mysqli_real_escape_string($conn, $_POST['update_idnum']);
    $update_course = mysqli_real_escape_string($conn, $_POST['update_course']);
    $update_year = mysqli_real_escape_string($conn, $_POST['update_year']);
    $update_weight = mysqli_real_escape_string($conn, $_POST['update_weight']);
    $update_height = mysqli_real_escape_string($conn, $_POST['update_height']);


    mysqli_query($conn, "UPDATE `user_form` SET idnum = '$update_idnum', course = '$update_course', year = '$update_year', weight = '$update_weight', height = '$update_height' WHERE id = '$user_id'") or die ('query failed');

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

                <a onclick="tabs(1)" class="tab">
                    <i class="fa-solid fa-file-medical"></i>
                </a>
                
            </nav>
        </div>
        <div class="rightbox">
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
                
                                <input type="submit" name="prof_update" value="UPDATE" class="btn">
                <a class="btn" href="User.php"> Back</a>
    
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
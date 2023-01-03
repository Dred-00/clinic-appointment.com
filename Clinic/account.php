<?php
 
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
    

if(isset($_POST['prof_update'])){

    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
    $update_password = mysqli_real_escape_string($conn, $_POST['update_password']);


    mysqli_query($conn, "UPDATE `user_form` SET email = '$update_email', password = '$update_password'WHERE id = '$user_id'") or die ('query failed');

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
                <a onclick="tabs(2)" class="tab">
                    <i class="fa-solid fa-sliders"></i>
                </a>
            </nav>
        </div>
        <div class="account tabShow">
            <h1>Account Setting</h1>
            <h2>Email</h2>
            <input type="text" name="update_email" value="<?php echo $fetch['email'] ?>">
            <br>
            <input type="text" name="update_password" value="<?php echo $fetch['password']?>" >
            <input type="submit" name="prof_update" value="UPDATE" class="btn">
            <br>
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
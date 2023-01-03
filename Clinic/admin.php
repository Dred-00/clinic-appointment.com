<?php
 
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Admin </title>
    <link rel="stylesheet" href="stylees.css">
    <script src="https://kit.fontawesome.com/244d468570.js" crossorigin="anonymous"></script>
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
                    <i class="fa-regular fa-calendar-check"></i>
                </a>
                <a onclick="tabs(1)" class="tab">
                    <i class="fa-solid fa-sliders"></i>
                </a>
                
            </nav>
        </div>
        <div class="rightbox">
            <div class="appointment tabShow">
                <h1>Appointments</h1>
            <div class="outer-wrapper">
            <div class="table-wrapper">
            <table>
                <tr>
                    <th> Student Name </th>
                    <th> Appointment </th>
                    <th> Date of Appointment </th>
                    <th> Purpose of Appointment </th>
                </tr>
            <tbody>
            <?php 
            $sql = "SELECT fname, appoint, sched, porpose from app_form";
            $result = $conn-> query($sql);

            if($result-> num_rows > 0){
                while ($row = $result-> fetch_assoc()){
                    echo "<tr>";
                    echo "<td>". $row["fname"]."</td>";
                    echo "<td>".$row["appoint"]."</td>";
                    echo "<td>".$row["sched"]."</td>";
                    echo "<td>".$row["porpose"]."</td>";
                    echo "<tr>";
                }
                echo "</table>";
            }
            else{
                echo "0 result";
            }
            $conn-> close();
            ?>

            </table>    
            
            </div>
            </div>
            <a class="btn" href="studentslist.php"> Studemts List </a>
            </div>
        <div class="account tabShow">
            <h1>Account Setting</h1>
            <button class="btn"><a href="login.php?logout=<?php echo $user_id; ?>" class="delete-btn"> Logout </a></button>
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
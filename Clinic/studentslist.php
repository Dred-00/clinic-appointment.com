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
                    <i class="fa-solid fa-list"></i>
                </a>
                <a onclick="tabs(1)" class="tab">
                    <i class="fa-solid fa-sliders"></i>
                </a>
                
            </nav>
        </div>
        <div class="rightbox">

            <div class="students tabShow">
                <h1>Student List</h1>
             <div class="outer-wrapper">
            <div class="table-wrapper">
            <table>
                <tr>
                    <th> Student Name </th>
                    <th> Email Address </th>
                    <th> Age </th>
                    <th> Gender </th>
                    <th> Birthday </th>
                    <th> ID Number </th>
                    <th> Course </th>
                    <th> Year & Block </th>
                    <th> Phone/Contact Number </th>
                    <th> Weight </th>
                    <th> Height </th>

                </tr>
            <tbody>
            <?php 
            $sql = "SELECT name, email, age, gender, birth, idnum, course, year, pnum, weight, height from user_form";
            $result = $conn-> query($sql);

            if($result-> num_rows > 0){
                while ($row = $result-> fetch_assoc()){
                    echo "<tr>";
                    echo "<td>". $row["name"]."</td>";
                    echo "<td>".$row["email"]."</td>";
                    echo "<td>".$row["age"]."</td>";
                    echo "<td>".$row["gender"]."</td>";
                    echo "<td>".$row["birth"]."</td>";
                    echo "<td>".$row["idnum"]."</td>";
                    echo "<td>".$row["course"]."</td>";
                    echo "<td>".$row["year"]."</td>";
                    echo "<td>".$row["pnum"]."</td>";
                    echo "<td>".$row["weight"]."</td>";
                    echo "<td>".$row["height"]."</td>";
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
            <a class="btn" href="admin.php"> Appointments </a>
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
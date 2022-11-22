<?php
    include 'db.php';

    session_start();
    
    $id = $_SESSION['id'];
    $sql = "SELECT username FROM admins WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);
    $name = mysqli_fetch_column($result, 0);

    if(!isset($_SESSION['id'])){
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
	<meta content="" name="author" />
    <title>Dashboard</title>

    <!-- connection with css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="assets/css/main.css" rel="stylesheet"/>
    <!---->
</head>
<body >
    <a href="logout.php"><button class="border-0 rounded-pill py-2 px-3 fw-bold navbar-btn text-white me-2"><i class="bi bi-box-arrow-right"></i>&nbsp;Log out</button></a>
    <a href="accountSettings.php"><button>Account Settings</button></a>
    <?php 
        $sql = "SELECT * FROM `admins`";
        $result = mysqli_query($conn, $sql);
        $numofUsers = mysqli_num_rows($result);

        $sql1 = "SELECT * FROM `book`;";
        $result1 = mysqli_query($conn, $sql1);
        $numofBooks = mysqli_num_rows($result1);

        $sql2 = "SELECT * FROM `book` WHERE category_id = 1;";
        $result2 = mysqli_query($conn, $sql2);
        $numofLitertBooks = mysqli_num_rows($result2);

        
        $sql3 = "SELECT * FROM `book`WHERE category_id = 2;";
        $result3 = mysqli_query($conn, $sql3);
        $numofScincBooks = mysqli_num_rows($result3);

        
        $sql4 = "SELECT * FROM `book` WHERE category_id = 3;";
        $result4 = mysqli_query($conn, $sql4);
        $numofOtherBooks = mysqli_num_rows($result4);
    ?>
    <?php echo "Welcome ". $name;?>
    
    <div class="border border-darker bg-white">
        <p>Total Books <span><?=$numofBooks;?></span></p>
    </div>

    
    <div class="border border-darker bg-white">
        <p>Total Users <span><?=$numofUsers;?></span></p>
    </div>

    
    <div class="border border-darker bg-white">
        <p>Total Books in literature <span><?=$numofLitertBooks;?></span></p>
        <p>Total Books in science <span><?=$numofScincBooks;?></span></p>
        <p>Total Books in Others <span><?=$numofOtherBooks?></span></p>
    </div>
</body>
</html>
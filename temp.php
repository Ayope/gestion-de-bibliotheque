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
    <?php echo "Welcome ". $name;?>

    <nav class="navbar navbar-light navbar1">
        <span class="navbar-brand fs-2 ms-3 text-white ">Dashboard</span>
        <a href="logout.php"><button class="border-0 rounded-pill py-2 px-3 fw-bold navbar-btn text-white me-2"><i class="bi bi-box-arrow-right"></i>&nbsp;Log out</button></a>
    </nav>

        
    <div class="col-8 main-container d-grid ">
        <div class="sidebar" id="sideNav">
            <div class="header-box">
                <a href="#" class="d-flex justify-content-center mt-5">
                    <img src="./assets/img/batman.png" class="rounded-circle" style="width: 75%; height: auto; position: relative;">
                </a>
                <a href="#" class="text-decoration-none"><span class="d-flex justify-content-center text-white fw-bold"><?php echo $name;?></span></a>
                <hr class="text-white">
                <ul class="list-unstyled">
                    <li><a href="dashboard.html" class="dashboard text-decoration-none d-flex justify-content-center fw-bold mt-5 text-white" style="background-color:#3F2918;"><i class="bi bi-hdd-stack"></i>&nbsp;Dashboard</a></li>
                    
                    <div class="multi-level text-center fw-bold mt-4">
                        <div class="item">
                            <input type="checkbox" id="DropBooks">
                            <label for="DropBooks" class="bookdrop text-white w-100"><i class="bi bi-book bookicon"></i>&nbsp;Books&nbsp;<img src="./assets/img/down.png" class="arrow"></label>
                            
                            <ul class="list-unstyled ">
                                <a href="addBook.html" class="text-decoration-none fw-light text-white w-100 "><li class="pt-2 ps-5 bookop1">Add Book</li></a>
                                <a href="booksList.html" class="text-decoration-none fw-light text-white w-100 "><li class="pt-2 ps-5 bookop2">Books list</li></a>
                            </ul>

                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div> 
</body>
</html>
<?php
    include 'db.php';

    session_start();
    
    $id = $_SESSION['id'];
    $sql = "SELECT username FROM admins WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);
    $name = mysqli_fetch_column($result, 0);

    if(!isset($_SESSION['id'])){
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8" />
	<title>Dashboard</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<link href="assets/css/vendor.min.css" rel="stylesheet" />
	<link href="assets/css/app.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
	<link href="assets/css/main.css" rel="stylesheet" />

</head>
<body>
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
	
	<!-- BEGIN app -->
	<div id="app" class="app app-header-fixed app-sidebar-fixed" style="padding: 0px">
		<!-- BEGIN header -->
		<div id="header" class="app-header">
			<!-- BEGIN navbar-header -->
			<div class="navbar-header">
				<a href="dashboard.php" class="navbar-brand"><b class="text-white">Dashboard</b></a>
				<button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
					<span class="icon-bar bg-white"></span>
					<span class="icon-bar bg-white"></span>
					<span class="icon-bar bg-white"></span>
				</button>
			</div>
			<!-- END navbar-header -->
		</div>
		<!-- END header -->
	
		<!-- BEGIN sidebar -->
		<div id="sidebar" class="app-sidebar" style="background-color: #523A28">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" id="sidebarCont" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="mb-5">
						<a href="accountSettings.php" class="d-flex justify-content-center mt-5">
                    	<img src="./assets/img/batman.png" class="rounded-circle" style="width: 75%; height: auto; position: relative;">
						</a>
						<a href="accountSettings.php" class="text-decoration-none"><p class="text-center fw-bold text-white"><?php echo $name;?></p></a>
						<a href="logout.php" class="d-flex justify-content-center text-decoration-none"><button class="border-0 rounded-pill py-2 px-3 fw-bold navbar-btn text-white me-2"><i class="bi bi-box-arrow-right"></i>&nbsp;Log out</button></a>
					</div>
					<div class="menu-item">
						<a href="dashboard.php" class="d-flex justify-content-center menu-link text-center">
							<div class="menu-icon">
								<i class="bi bi-hdd-stack"></i>
							</div>
							<span class="text-decoration-none fw-bold text-white">Dashboard</span>
						</a>

						<div class="multi-level text-center fw-bold mt-3">
							<div class="item">
								<input type="checkbox" id="DropBooks">
								<label for="DropBooks" class="bookdrop text-white w-100"><i class="bi bi-book bookicon"></i>&nbsp;Books&nbsp;<img src="./assets/img/down.png" class="arrow"></label>
							
								<ul class="list-unstyled">
									<a href="addBook.php" class="text-decoration-none fw-light text-white w-100"><li class="ps-5 bookop1 mt-2">Add Book</li></a>
									<a href="booksList.php" class="text-decoration-none fw-light text-white w-100 "><li class="ps-5 bookop2 mt-2">Books list</li></a>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- END menu -->

			</div>
			<!-- END scrollbar -->
		</div>
		<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>
		<!-- END sidebar -->
		
		<!-- BEGIN content -->
		<div id="content" class="app-content mt-3">
		    <h1 class="pt-5"><?php echo "Welcome ". $name. ",this is your dashboard 👋";?></h1>

			<div class="row pt-2">	
				<div class="card col-xl-6 col-lg-6 mb-3 ">
					<div class="card-body">
						<h2 class="card-title">Total Books</h2>
						<h3 class="text-end card-text fw-bold"><?=$numofBooks;?></h3>
					</div>
				</div>

				<div class="card col-xl-6 col-lg-6 mb-3">
					<div class="card-body">
						<h2 class="card-title">Total Users</h2>
						<h3 class="text-end card-text fw-bolder"><?=$numofUsers;?></h3>
					</div>
				</div>

				<div class="card col-xl-12 col-lg-12">
					<div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><h2>Total Books in literature</h2><h3 class="text-end"><?=$numofLitertBooks;?></h3></li>
						<li class="list-group-item"><h2>Total Books in Science</h2><h3 class="text-end"><?=$numofScincBooks;?></h3></li>
						<li class="list-group-item"><h2>Total Books in Other categories</h2><h3 class="text-end"><?=$numofOtherBooks?></h3></li>
					</ul>
					</div>
				</div>
					
				</div>
			</div>
		</div>
		<!-- END content -->
	</div>
	<!-- END app -->
		
	<script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>

</body>
</html>
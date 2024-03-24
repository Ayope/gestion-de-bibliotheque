<?php 
    include 'db.php';

    session_start();
    $Aid = $_SESSION['id'];

    $sql = "SELECT username FROM admins WHERE id = '$Aid';";
    $result = mysqli_query($conn, $sql);
    $name = mysqli_fetch_column($result, 0);

    if(!isset($_SESSION['id'])){
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
	<meta content="" name="author" />
    <title>Account Settings</title>

    <!-- connection with css -->
    
	<link href="assets/css/vendor.min.css" rel="stylesheet" />
	<link href="assets/css/app.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="assets/css/main.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!---->
</head>
<body style="overflow-y: auto;">
    <?php
        if(isset($_POST['Save'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $birthdate = $_POST['birthdate'];
            $city = $_POST['city'];

            $sql = "SELECT * FROM admins WHERE id != '$Aid'  and email LIKE '$email';";
            $result = mysqli_query($conn, $sql);


            $numRows = mysqli_num_rows($result);

            if($numRows > 0){
                $_SESSION['ErrorMessage'] = "Email already Exist";
            } else{
                $sql1 = "";
                if(empty($birthdate)){
                    $sql1 =  "UPDATE `admins`
                    SET `username`='$username',`email`='$email',`password`='$password',`phone`='$phone',`birthdate`=NULL,`city`='$city'
                    WHERE id= $Aid;";
                    $_SESSION['SuccessMessage']="you updated your infos successfully";

                }else{
                    $sql1 =  "UPDATE `admins`
                    SET `username`='$username',`email`='$email',`password`='$password',`phone`='$phone',`birthdate`='$birthdate',`city`='$city'
                    WHERE id= $Aid;";
                    $_SESSION['SuccessMessage']="you updated your infos successfully";
                }

                $result1 = mysqli_query($conn, $sql1);
            }
            
        }

        $sql = "SELECT id, username, email, password, phone, birthdate, city 
        FROM admins
        WHERE id = $Aid ";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
    
    ?>


   	<!-- BEGIN app -->
       <div id="app" class="app app-header-fixed app-sidebar-fixed" style="padding: 0px">
		<!-- BEGIN header -->
		<div id="header" class="app-header">
			<!-- BEGIN navbar-header -->
			<div class="navbar-header">
				<a href="accountSettings.php" class="navbar-brand"><b class="text-white">Account Settings</b></a>
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
            
        <?php if (isset($_SESSION['SuccessMessage'])) : ?>   
            <div class="alert alert-success">
            <?php 
                echo $_SESSION['SuccessMessage'];
                unset($_SESSION['SuccessMessage']);             
            ?>             
            </div>     
        <?php endif; ?>

        <?php if (isset($_SESSION['ErrorMessage'])) : ?>         
            <div class="alert alert-danger">
            <?php 
                echo $_SESSION['ErrorMessage'];
                unset($_SESSION['ErrorMessage']);             
            ?>             
            </div>     
        <?php endif ?>

		    <h1 class="pt-5">Modify your account settings 🔨</h1>
            <form action="" method="POST" class= "col-12 col-md-6">
                <div class="mb-2">
                    <label for="username">Username*</label>
                    <input type="text" class="form-control" name="username" id="username" value = "<?=$row['username'];?>" required>
                </div>

                <div class="mb-2">
                    <label for="email">Email*</label>
                    <input type="email" class="form-control" name="email" id="email" value = "<?=$row['email'];?>" required>
                </div>

                <div class="mb-2">
                    <label for="password">Password*</label>
                    <input type="password" class="form-control" name="password" id="password" value = "<?=$row['password'];?>" required>
                    <input class="form-check-input" onclick="passhow()" id="passcheck" type="checkbox" style="cursor: pointer;">Show Password</input>
                </div>

                <div class="mb-2">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control mb-0" id="phone" name="phone" value = "<?=$row['phone'];?>"
                    pattern="^(?:(?:(?:\+|00)212[\s]?(?:[\s]?\(0\)[\s]?)?)|0){1}(?:5[\s.-]?[2-3]|6[\s.-]?[13-9]){1}[0-9]{1}(?:[\s.-]?\d{2}){3}$">
                    
                    <small><strong>Format</strong>: Any Format that much moroccan number</small>
                </div>

                <div class="mb-2">
                    <label for="birthdate">Birthdate</label>
                    <input  class="form-control" type="date" name="birthdate" id="birthdate" value = "<?=$row['birthdate'];?>">
                </div>

                <div class="mb-2">
                    <label for="city">City</label>
                    <input type="text" class="form-control" name="city" id="city" value = "<?=$row['city'];?>">
                </div>

                <button class="btn btn-success rounded-pill text-white fw-bold " type="submit" name="Save">Save</button>
            </form> 
    
		</div>
		<!-- END content -->
	</div>
	<!-- END app -->


    <script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>
    <script src= "assets/js/app.js"></script>
</body>
</html>
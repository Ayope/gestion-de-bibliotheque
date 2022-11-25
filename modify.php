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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
	<meta content="" name="author" />
    <title>Modify Book</title>

    <!-- connection with css -->
    <link href="assets/css/vendor.min.css" rel="stylesheet" />
	<link href="assets/css/app.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="assets/css/main.css" rel="stylesheet"/>
    <!---->
</head>
<body style="overflow-y: auto">
    <?php
        $sql = "SELECT id, isbn, name, publicationYear, author, img_url, category_id
        FROM book
        WHERE id = $_GET[id];";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);

        // $_SESSION['smtng']=  $row['img_url'];


        if(isset($_POST['Save'])){
            $new_img_name;
            
            if(isset($_FILES['img'])){
            
                $img_name = $_FILES['img']['name'];
                $img_type = $_FILES['img']['type'];
                $tmp_name = $_FILES['img']['tmp_name'];
                $error = $_FILES['img']['error'];
                $img_size = $_FILES['img']['size'];
    
    
                if($error === 0){
                    if($img_size > 500000){
                        $_SESSION['img_size_err'] = "Sorry your image is too large (maximum of 500KB allowed)";
                        $new_img_name = $row['img_url'];
                    } else{
                        $img_extns = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_extns_lowCase = strtolower($img_extns);
    
                        $allowed_extns = array("jpg", "png", "jpeg");
                        if(in_array($img_extns_lowCase, $allowed_extns)){
                            $new_img_name = uniqid("IMG-", true). '.' .$img_extns_lowCase;
                            $path = 'assets/img/bookCover/'.$new_img_name;
                            move_uploaded_file($tmp_name, $path);
                        }else{
                            $_SESSION['img_type_err'] = "Image type not allowed";
                            $new_img_name = $row['img_url'];
                        }
                    }
                } else {
                    $new_img_name = $row['img_url'];
                }
            }else{ 
                $_SESSION['smtng'] = "error";
                $new_img_name = $row['img_url'];
            }

            // $_SESSION['smtng'] = $new_img_name;

            $isbn = $_POST['ISBN'];
            $name = $_POST['Name'];
            $author = $_POST['Author'];
            $category = $_POST['Category'];
            $year = $_POST['Year'];
            
            $sql = "SELECT isbn, name, author 
            FROM book 
            WHERE isbn = '$isbn' or (name = '$name' and author = '$author')";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_num_rows($result);

            if($row != 1){
                $_SESSION['ErrorMessage'] = "Already Exist";
            }else{
                $sql =  "UPDATE book 
                SET `isbn`='$isbn',`name`='$name',`publicationYear`='$year',`category_id`='$category',`author`='$author',`img_url`='$new_img_name'
                WHERE id = $_GET[id];";
                $result = mysqli_query($conn, $sql);

                
                // echo $sql ;
                header('location: booksList.php');
                
                $_SESSION['Success1Message']="you modified your book successfully";
            }

        }


    
    ?>

       	<!-- BEGIN app -->
           <div id="app" class="app app-header-fixed app-sidebar-fixed" style="padding: 0px">
		<!-- BEGIN header -->
		<div id="header" class="app-header">
			<!-- BEGIN navbar-header -->
			<div class="navbar-header">
				<a href="modify.php" class="navbar-brand"><b class="text-white">Modify book</b></a>
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
            <?php if (isset($_SESSION['ErrorMessage'])) : ?> 
                <div class="alert alert-danger">
                <?php 
                    echo $_SESSION['ErrorMessage'];
                    unset($_SESSION['ErrorMessage']);             
                ?>             
                </div>     
            <?php endif ?>
            
            <h1 class="pt-5">Modify a book 📝</h1>
            
            <form action="" method="POST" class="col-12 col-md-6" enctype="multipart/form-data">
                
                <div class="mb-2">
                    <label for="img_input">Image</label>
                    <input type="file" class="form-control" name="img" id="img_inpt">
                </div>

                <div class="mb-2">
                    <label for="isbn">ISBN</label>
                    <input  class="form-control" type="text" name="ISBN" id="isbn" 
                    required pattern = "^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$"
                    value="<?=$row['isbn'];?>">

                    <small class="d-block">--> Should be 10-13 digits</small>
                </div>

                <div class="mb-2">
                    <label for="name">Name</label>
                    <input  class="form-control" type="text" name="Name" id="name" value="<?=$row['name'];?>" required>
                </div>

                <div class="mb-2">
                    <label for="author">Author</label>
                    <input  class="form-control" type="text" name="Author" id="author" value="<?=$row['author'];?>" required>
                </div>

                <div class="mb-2">
                    <label for="category">Category</label>
                    <select class="form-select" type="number" name="Category" id="category" required>
                        <option value="">please select</option>
                        <option value="1" <?php if($row['category_id'] == "1") echo"selected"; ?>>literature</option>
                        <option value="2" <?php if($row['category_id'] == "2") echo"selected"; ?>>science</option>
                        <option value="3" <?php if($row['category_id'] == "3") echo"selected"; ?>>other</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label for="year">Year</label>
                    <input  class="form-control" type="text" placeholder="YYYY" name="Year" id="year" 
                    required pattern = "[0-9]{4}" title = "Enter a valid year"
                    value="<?=$row['publicationYear'];?>">

                </div>

                <button type="submit" class="btn btn-success rounded-pill text-white fw-bold" name="Save">Save Changes</button>
            </form> 
                    
		</div>
		<!-- END content -->
	</div>
	<!-- END app --> 

    <script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>

</body>
</html>
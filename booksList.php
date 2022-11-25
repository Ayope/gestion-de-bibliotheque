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
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="" name="description" />
	  <meta content="" name="author" />
    <title>Book's list</title>

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
      if(isset($_POST['confirm_delete'])){
        $id = $_POST['id_to_delete'];
        $sql = "DELETE FROM book WHERE id='$id';";
        $result = mysqli_query($conn, $sql);
        header("Location:booksList.php");
      }
    ?>
   	<!-- BEGIN app -->
	<div id="app" class="app app-header-fixed app-sidebar-fixed" style="padding: 0px">
		<!-- BEGIN header -->
		<div id="header" class="app-header">
			<!-- BEGIN navbar-header -->
			<div class="navbar-header">
				<a href="booksList.php" class="navbar-brand"><b class="text-white">Books List</b></a>
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

      <?php if (isset($_SESSION['smtng'])) : ?> 
        <div class="alert alert-danger">
        <?php 
            echo $_SESSION['smtng'];
            unset($_SESSION['smtng']);             
        ?>             
        </div>     
      <?php endif ?>

    <?php if (isset($_SESSION['img_size_err'])) : ?> 
      <div class="alert alert-danger">
      <?php 
          echo $_SESSION['img_size_err'];
          unset($_SESSION['img_size_err']);             
      ?>             
      </div>     
    <?php endif ?>
             
    <?php if (isset($_SESSION['img_type_err'])) : ?> 
      <div class="alert alert-danger">
      <?php 
          echo $_SESSION['img_type_err'];
          unset($_SESSION['img_type_err']);             
      ?>             
      </div>     
    <?php endif ?>  

    <?php if (isset($_SESSION['Success1Message'])) : ?>         
      <div class="alert alert-success">
      <?php 
        echo $_SESSION['Success1Message'];
        unset($_SESSION['Success1Message']);             
      ?>             
      </div>     
    <?php endif ?>
    
    <h1 class="pt-5">This is your Books list 📚</h1>
    <div class="table-responsive py-3 px-3">
    <table class="table table-bordered border-dark">
    <thead>
        <tr>
        <th scope="col">ISBN</th>
        <th scope="col">Name</th>
        <th scope="col">Image</th>
        <th scope="col">Author</th>
        <th scope="col">category</th>
        <th scope="col">Year of Publication</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
          $sql ="SELECT book.id, book.isbn, book.name, book.publicationYear, book.author, book.img_url , category.name as category
          FROM book, category 
          WHERE category_id = category.id";
          $result = mysqli_query($conn, $sql);
        ?>

        <?php while($row=mysqli_fetch_assoc($result)):?>
        <tr>
        <td><?php echo $row['isbn']?></td>
        <td><?php echo $row['name']?></td>
        <td><img src="assets/img/bookCover/<?=$row['img_url']?>" height=130px width=90px></td>
        <td><?php echo $row['author']?></td>
        <td><?php echo $row['category']?></td>
        <td><?php echo $row['publicationYear']?></td>
        <td><a href="modify.php?id=<?=$row['id']?>"><button class="mb-2 btn btn-success rounded-pill text-white fw-bold">Modify</button></a>&nbsp;
        &nbsp;<button onclick="func(<?=$row['id']?>)" data-bs-toggle="modal" data-bs-target="#confirmodal" class="mb-2 btn btn-danger rounded-pill text-white fw-bold">Delete</></td>
        </tr>
        <?php endwhile;?>

    </tbody>
    </table>  
    </div>

		</div>
		<!-- END content -->
	</div>
	<!-- END app -->
           
  <!-- Modal -->
  <div class="modal fade overflow-hidden" id="confirmodal" tabindex="-1" aria-labelledby="confirmodalabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #3F2918">
          <h5 class="modal-title text-white fw-bold" id="confirmodalabel">Confirm delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background-color:#FFF7EA">
          <strong> Are you sure to delete this book ! </strong>
        </div>
        <div class="modal-footer"  style= "background-color: ">
          <form action="" method="POST">
            <input type="hidden" id="modal_id" name="id_to_delete">
            <button type="button" class="btn border-none" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" name="confirm_delete">Delete</button>
          </form>    
        </div>
        
      </div>
    </div>
  </div>


  <script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>
  <script src="assets/js/app.js"></script>
</body>
</html>
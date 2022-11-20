<?php 
    include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
	<meta content="" name="author" />
    <title>Book's list</title>

    <!-- connection with css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="assets/css/main.css" rel="stylesheet"/>
    <!---->
</head>
<body>
    <?php 
      if(isset($_POST['confirm_delete'])){
        $id = $_POST['id_to_delete'];
        $sql = "DELETE FROM book WHERE id='$id';";
        $result = mysqli_query($conn, $sql);
        header("Location:booksList.php");
      }
    ?>
    <table class="table table-bordered border-dark">
    <thead>
        <tr>
        <th scope="col">ISBN</th>
        <th scope="col">image</th>
        <th scope="col">Name</th>
        <th scope="col">Author</th>
        <th scope="col">category</th>
        <th scope="col">Year of Publication</th>
        <th scope="col">Modify & Delete</th>

        </tr>
    </thead>
    <tbody>
        <?php
          $sql ="SELECT book.id, book.isbn, book.name, book.publicationYear, book.author, category.name as category
          FROM book, category 
          WHERE category_id = category.id";
          $result = mysqli_query($conn, $sql);
        ?>

        <?php while($row=mysqli_fetch_assoc($result)):?>
        <tr>
        <td><?php echo $row['isbn']?></td>
        <td></td>
        <td><?php echo $row['name']?></td>
        <td><?php echo $row['author']?></td>
        <td><?php echo $row['category']?></td>
        <td><?php echo $row['publicationYear']?></td>
        <td><a href="modify.php?id=<?=$row['id']?>"><button>Modify</button></a>&nbsp;
        &nbsp;<button onclick="func(<?=$row['id']?>)" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>
        </tr>
        <?php endwhile;?>

    </tbody>
    </table>         
        
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <strong> Are you sure to delete this book ! </strong>
          </div>
          <div class="modal-footer">
            <form action="" method="POST">
              <input type="hidden" id="modal_id" name="id_to_delete">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="confirm_delete">Save changes</button>
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
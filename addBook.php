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
    <title>Add Book</title>

    <!-- connection with css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="assets/css/main.css" rel="stylesheet"/>
    <!---->
</head>
<body>
    <?php
        if(isset($_POST['Save'])){
            $isbn = $_POST['ISBN'];
            $name = $_POST['Name'];
            $author = $_POST['Author'];
            $category = $_POST['Category'];
            $year = $_POST['Year'];

            $sql1 = "INSERT INTO author(name) VALUES ('$author')";
            $result1 = mysqli_query($conn, $sql1);

            $sql2 = "SELECT id FROM author WHERE name = '$author'";
            $result2 = mysqli_query($conn, $sql2);
            
            $authorId = mysqli_fetch_column($result2, 0);
            echo $authorId;

            // $sql3 = "INSERT INTO book(isbn, name, publicationYear, category_id, author_id) 
            // VALUES ('$isbn', '$name', '$year', '$category', '$authorId')";
            // $result3 = mysqli_query($conn, $sql3);

        }
    
    ?>

    <form action="" method="POST" class="mt-5">
        <div>
            <label for="isbn">ISBN</label>
            <input type="number" name="ISBN" id="isbn" required>
        </div>

        <div>
            <label for="name">Name</label>
            <input type="text" name="Name" id="name" required>
        </div>

        <div>
            <label for="author">Author</label>
            <input type="text" name="Author" id="author" required>
        </div>

        <div>
            <label for="category">Category</label>
            <input type="number" name="Category" id="category" required>
        </div>

        <div>
            <label for="year">Year</label>
            <input type="number" name="Year" id="year" min="0000" max="2022" required>
        </div>

        <button type="submit" name="Save">Save</button>
    </form> 
</body>
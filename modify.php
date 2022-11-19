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
    <title>Modify Book</title>

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

            $sql = "SELECT isbn, name, publicationYear, category_id, author 
            FROM book 
            WHERE isbn = '$isbn' and  name = '$name' and publicationYear = '$year' and category_id = '$category' and author = '$author' ";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_num_rows($result);

            if($row != 0){
                echo '<div class="alert alert-danger" role="alert">Change Something</div>';
            }else{
                $sql =  "UPDATE book 
                SET `isbn`='$isbn',`name`='$name',`publicationYear`='$year',`category_id`='$category',`author`='$author' 
                WHERE id = $_GET[id];";
                $result = mysqli_query($conn, $sql);

                header('location: booksList.php');
            }
        }

        $sql = "SELECT id, isbn, name, publicationYear, author, category_id
        FROM book
        WHERE id = $_GET[id];";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
    
    ?>

    <form action="" method="POST">
        <div>
            <label for="isbn">ISBN</label>
            <input type="number" name="ISBN" id="isbn" value="<?=$row['isbn'];?>" required>
        </div>

        <div>
            <label for="name">Name</label>
            <input type="text" name="Name" id="name" value="<?=$row['name'];?>" required>
        </div>

        <div>
            <label for="author">Author</label>
            <input type="text" name="Author" id="author" value="<?=$row['author'];?>" required>
        </div>

        <div>
            <label for="category">Category</label>
            <select type="number" name="Category" id="category" required>
                <option value="">please select</option>
                <option value="1" <?php if($row['category_id'] == "1") echo"selected"; ?>>literature</option>
                <option value="2" <?php if($row['category_id'] == "2") echo"selected"; ?>>science</option>
                <option value="3" <?php if($row['category_id'] == "3") echo"selected"; ?>>other</option>
            </select>
        </div>

        <div>
            <label for="year">Year</label>
            <input type="number" name="Year" id="year" value="<?=$row['publicationYear'];?>" required>
        </div>

        <button type="submit" name="Save">Save Changes</button>
    </form> 
</body>
</html>
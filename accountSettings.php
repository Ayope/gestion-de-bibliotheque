<?php 
    include 'db.php';

    session_start();
    $Aid = $_SESSION['id'];
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="assets/css/main.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!---->
</head>
<body>
    <?php
        if(isset($_POST['Save'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $birthdate = $_POST['birthdate'];
            $city = $_POST['city'];

            $sql1 = "";
            if(empty($birthdate)){
                $sql1 =  "UPDATE `admins`
                SET `username`='$username',`email`='$email',`password`='$password',`phone`='$phone',`birthdate`=NULL,`city`='$city'
                WHERE id= $Aid;";
            }else{
                $sql1 =  "UPDATE `admins`
                SET `username`='$username',`email`='$email',`password`='$password',`phone`='$phone',`birthdate`='$birthdate',`city`='$city'
                WHERE id= $Aid;";
            }

            $result1 = mysqli_query($conn, $sql1);

            header("location: dashboard.php");
            
        }

        $sql = "SELECT id, username, email, password, phone, birthdate, city 
        FROM admins
        WHERE id = $Aid ";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
    
    ?>

    <form action="" method="POST">
        <div>
            <label for="username">Username*</label>
            <input type="text" name="username" id="username" value = "<?=$row['username'];?>" required>
        </div>

        <div>
            <label for="email">Email*</label>
            <input type="email" name="email" id="email" value = "<?=$row['email'];?>" required>
        </div>

        <div>
            <label for="password">Password*</label>
            <input type="password" name="password" id="password" value = "<?=$row['password'];?>" required>
            <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>

        </div>

        <div>
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" value = "<?=$row['phone'];?>"
            pattern="^(?:(?:(?:\+|00)212[\s]?(?:[\s]?\(0\)[\s]?)?)|0){1}(?:5[\s.-]?[2-3]|6[\s.-]?[13-9]){1}[0-9]{1}(?:[\s.-]?\d{2}){3}$">
            <br>
            <small><strong>Format</strong>: Any Format that much moroccan number</small>
        </div>

        <div>
            <label for="birthdate">Birthdate</label>
            <input type="date" name="birthdate" id="birthdate" value = "<?=$row['birthdate'];?>">
        </div>

        <div>
            <label for="city">City</label>
            <input type="text" name="city" id="city" value = "<?=$row['city'];?>">
        </div>

        <button type="submit" name="Save">Save</button>
    </form> 

    <script src= "assets/js/app.js"></script>
</body>
</html>
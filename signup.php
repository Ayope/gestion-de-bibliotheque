<?php
    require "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
	<meta content="" name="author" />
    <title>Signup</title>

    <!-- connection with css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="assets/css/main.css" rel="stylesheet"/>
    <link href="assets/css/parsley.css" rel="stylesheet"/>
    <!---->
</head>
<body>
    <?php 
        if(isset($_POST['signup'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql0 = "SELECT email FROM admins;";
            $result0 = mysqli_query($conn, $sql0);

            $count = 0;
            while($row = mysqli_fetch_assoc($result0)){
                if(strcmp($email,$row['email'])==0){
                    $count++;
                    break;
                }
            }

            if($count == 0){
                $sql = "INSERT INTO admins(username, email, password)
                VALUES ('$username','$email','$password');";

                $result = mysqli_query($conn, $sql);

                header('location: login.php');
            } else{
                echo '<div class="alert alert-danger" role="alert">Account already Exist</div>';
            }
           
        } 
    ?>

    <div class="d-flex justify-content-center align-items-center formLogin">
        
        <form action="" method="POST">
            <div class="text-center mb-4">
                <img class="books" src="assets/img/writing.png"/>
                <h1 id="title">Sign Up</h1>
            </div>
            
            <div class="pb-3">
                <label for="username_inpt" id="usernameLabel">Username</label>
                <input type="text" id="username_inpt" class="form-control" name="username" required>
            </div>

            <div class="pb-3">
                <label for="email_inpt" id="emaiLabel">Email</label>
                <input type="email" id="email_inpt" class="form-control" name="email" required>
            </div>

            <div>
                <label for="pass_inpt" id="passLabel">Password</label>
                <input type="password" id="pass_inpt" class="form-control" size="30" name="password" required>
            </div>

            <div class="mt-2 text-center">
                <button type="submit" class="mt-2 w-100 rounded-pill p-2 text-white fw-bold" style="border:none; background: #523A28;" name="signup">Sign up</button>
            </div>
            
        </form>

    </div>


    
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/parsley.js"></script>

</body>

</html>
<?php
    include 'db.php';

    session_start();
    
    if(isset($_SESSION['id'])){
        header('location: dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
	<meta content="" name="author" />
    <title>Login</title>

    <!-- connection with css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="assets/css/main.css" rel="stylesheet"/> 
    <!---->
</head>
<body>
    <?php
        if(isset($_POST['login'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $sql = "SELECT id, email, password FROM admins WHERE email = '$email' and password = '$password';";
            
            $result = mysqli_query($conn, $sql);
            
            $row = mysqli_num_rows($result);
            if($row != 0){
                $id = mysqli_fetch_column($result, 0);
                $_SESSION['id'] = $id;
                header("location: dashboard.php");
            }else{
                echo '<div class="alert alert-danger" role="alert">Account not Exist</div>';
            }
        }
    ?>

    <div class="d-flex justify-content-center align-items-center formLogin">
        
        <form id="loginForm" action="" method="POST">
            
        <div class="text-center mb-4">
            <img class="books" src="assets/img/book.png"/>
            <h1 id="title">Login</h1>
        </div>
        
        <div class="pb-3">
            <label for="email_inpt1" id="emaiLabel">Email</label>
            <input type="email" id="email_inpt1" class="form-control"
            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Invalid email address" name="email" required>
        </div>

        <div>
            <label for="pass_inpt1" id="passLabel">Password</label>
            <input type="password" id="pass_inpt1" class="form-control " size="25" name="password" required>
        </div>

        <div class="mt-2 text-center">
            <button id="login" type="submit" class="mt-2 w-100 rounded-pill p-2 text-white fw-bold" style="border:none; background: #523A28;" name="login">Login</button>
        </div>
        
        <div class="text-center mt-3">
            <p class="mb-0 text-secondary">Don't have an account?</p>
            <a href="signup.php" style="text-decoration: none; color: #523A28">Sign up here</a>
        </div>
        </form>

    </div>

</body>
</html>
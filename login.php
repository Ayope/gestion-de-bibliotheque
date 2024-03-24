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

    <div class="d-flex justify-content-center align-items-center formLogin">
        
        <form >
        <div class="text-center mb-4">
            <img class="books" src="assets/img/book.png"/>
            <h1 id="title">Login</h1>
        </div>
        
        <div class="pb-3">
            <label for="email_inpt" id="emaiLabel">Email</label>
            <input type="text" id="email_inpt" class="form-control">
        </div>

        <div>
            <label for="pass_inpt" id="passLabel">Password</label>
            <input type="password" id="pass_inpt" class="form-control " size="25">
        </div>

        <div class="mt-2 text-center">
            <button type="submit" class="mt-2 w-100 rounded-pill p-2 text-white fw-bold" style="border:none; background: #523A28;">Login</button>
        </div>
        
        <div class="text-center mt-3">
            <p class="mb-0 text-secondary">Don't have an account?</p>
            <a href="signup.html" style="text-decoration: none; color: #523A28">Sign up here</a>
        </div>
        </form>

    </div>
</body>
</html>
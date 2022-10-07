<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Login Form</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="css/signin.css">

</head>
<body>
<div class="signup-form">
    <form action="" method="post">
		<h2>Login</h2>
		<p class="hint-text">Login to your account</p>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Login</button>
        </div>
    </form>
	<div class="text-center">Don't have an account? <a href="signup.php">Sign up</a></div>
</div>
</body>
</html>
<?php
    if(isset($_COOKIE["username"])) {
        header("Location: index.html");
        die;
    }
    require_once("database.php");

    if (!empty($_POST)) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = $db->find($email, $password);
        if ($result) {
            $username =  $result["username"];
            setcookie("username", $username, time() + (86400 * 30), "/");
            setcookie("email", $email, time() + (86400 * 30), "/");
            header("Location: index.html");

        }
        else {
            echo "<script>";
            echo "alert('Invalid Email or Password');";
            echo "</script>";
        }

    }
?>
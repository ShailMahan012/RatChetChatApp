<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Registration Form</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="css/signin.css">

</head>
<body>
<div class="signup-form">
    <form action="" method="post">
		<h2>Register</h2>
		<p class="hint-text">Create your account</p>
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" required value="user">
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email" required value="mail@mail.com">
        </div>
		<div class="form-group">
            <input type="password" id="pass" class="form-control" name="password" placeholder="Password" required value="test">
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>

    </form>
	<div class="text-center">Already have an account? <a href="signin.php">Sign in</a></div>
</div>
</body>
</html>
<?php
    session_start();
    if(isset($_SESSION["ID"])) {
        header("Location: contacts.php");
        die;
    }
    require_once("database.php");
    if (!empty($_POST)) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = $db->insert_user($username, $email, $password);
        echo "<script>";
        if (!$result) {
            echo "alert('This Email is already in use');";
        }
        else {
            echo "alert('Your Account has been created');";
            echo "window.location.href='signin.php'";
        }
        echo "</script>";
    }
?>
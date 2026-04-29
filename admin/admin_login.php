<?php
include('../config/db.php');
session_start();

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Invalid email format');</script>";
    }

    elseif(!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@#$%^&*]).{8}$/', $password)){
        echo "<script>alert('Password must be have 8 characters with letter, number and symbol (@#$%^&*)');</script>";
    } 
    
    else {

        $result = mysqli_query($conn, 
            "SELECT * FROM admin WHERE admin_email='$email' AND admin_password='$password'"
        );

        if(mysqli_num_rows($result) > 0){
            $_SESSION['admin'] = $email;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Email or password incorrect');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body class="login-page">

<div class="login-left-container">

    <div class="login-left">
        <img src="../image/logo_Only.png">

        <div class="login-left-text">
            <h1>WELCOME<br>BACK</h1>
        </div>
    </div>

    <div class="login-right">
        <div class="login-form">

            <h2>ADMIN LOGIN</h2>

            <form method="POST">

                <label>Email</label>
                <input type="text" name="email" placeholder="xxxxxx@gmail.com" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="xxxxxxxx" maxlength="8" required>

                <button name="login">LOG IN</button>

            </form>

        </div>
    </div>

</div>

<script>
document.querySelector("form").addEventListener("submit", function(e) {

    let email = document.querySelector("input[name='email']").value.trim();
    let password = document.querySelector("input[name='password']").value.trim();

    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

    let passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@#$%^&*]).{8}$/;

    if (!emailPattern.test(email)) {
        alert("Invalid email format");
        e.preventDefault();
        return;
    }

    if (!passwordPattern.test(password)) {
        alert("Password must be exactly 8 characters with letters, numbers, and symbols (@#$%^&*)");
        e.preventDefault();
    }

});
</script>

</body>
</html>
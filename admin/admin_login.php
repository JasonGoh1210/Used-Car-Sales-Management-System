<?php
include('../config/db.php');
session_start();

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Invalid email format');</script>";
    }

    elseif(!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@#$%^&*]).{8,}$/', $password)){
        echo "<script>alert('Password must be at least 8 characters with letter, number and symbol (@#$%^&*)');</script>";
    } 
    
    else {

        $result = mysqli_query($conn, 
            "SELECT * FROM admin WHERE admin_email='$email'"
        );

        if(mysqli_num_rows($result) > 0){

            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row['admin_password'])){

                $_SESSION['admin_id'] = $row['admin_id'];
                $_SESSION['admin_name'] = $row['admin_username'];

                header("Location: dashboard.php");
                exit();

            } else {
                echo "<script>alert('Wrong password');</script>";
            }

        } else {
            echo "<script>alert('Email not found');</script>";
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
        <img src="../image/logo.png">

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
                <input type="password" name="password" placeholder="XXXXXXXX" required>

                <button type="submit" name="login">LOG IN</button>

            </form>

        </div>
    </div>

</div>

<script>
document.querySelector("form").addEventListener("submit", function(e) {

    let email = document.querySelector("input[name='email']").value.trim();
    let password = document.querySelector("input[name='password']").value.trim();

    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    let passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@#$%^&*]).{8,}$/;

    if (!emailPattern.test(email)) {
        alert("Invalid email format");
        e.preventDefault();
        return;
    }

    if (!passwordPattern.test(password)) {
        alert("Password must be at least 8 characters with letters, numbers, and symbols (@#$%^&*)");
        e.preventDefault();
    }

});
</script>

</body>
</html>
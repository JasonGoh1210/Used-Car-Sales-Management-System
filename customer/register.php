<?php
include 'db.php';

if (isset($_POST['signup_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.location.href='register.php';</script>";
        exit();
    }

    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $run_check = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($run_check) > 0) {
        echo "<script>alert('Email already exists!'); window.location.href='register.php';</script>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, phone, email, password)
            VALUES ('$name', '$phone', '$email', '$hashed_password')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registration Successful!'); window.location.href='home.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveX Motors - Register</title>
    <link rel="stylesheet" href="style.css">

<style>
.register-page {
    display: flex !important;
    min-height: calc(100vh - 74px) !important;
}

.register-left {
    width: 50% !important;
    min-height: calc(100vh - 74px) !important;
    background: linear-gradient(135deg, #1a2038, #2c3e70);
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
}

.register-right {
    width: 50% !important;
    min-height: calc(100vh - 74px) !important;
    background: #f4f6fb !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
}

.register-left img {
    width: 80% !important;
    max-width: 520px !important;
}

.register-card {
    width: 400px !important;
    background: white !important;
    padding: 35px !important;
    border-radius: 16px !important;
    box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
    text-align: center !important;
    margin: 0 !important;
}
</style>
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <a href="home.php" style="text-decoration: none; color: inherit;">
                DriveX <span>Motors</span>
            </a>
        </div>

        <div class="nav-links">
            <a href="buy_car.php">Buy Car</a>
            <a href="home.php">Sell Car</a>
            <button type="button" id="loginBtn" class="nav-signin-btn">Login</button>
        </div>
    </div>
</nav>

<main class="register-page">
    <section class="register-left">
        <img src="image/drivex_motors.png" alt="DriveX Motors Logo">
    </section>

    <section class="register-right">
        <form class="register-card" action="register.php" method="POST">
            <h2>Create Account</h2>
            <p>Fill in your personal details</p>

            <input type="text" name="name" placeholder="Full Name" required>

            <input type="tel"
                   name="phone"
                   placeholder="Phone Number"
                   pattern="[0-9]{3}-[0-9]{7,8}"
                   required
                   title="Please enter phone number like 018-7643458">

            <input type="email" name="email" placeholder="Email Address" required>

            <input type="password"
                   name="password"
                   placeholder="Password"
                   minlength="6"
                   required>

            <input type="password"
                   name="confirm_password"
                   placeholder="Confirm Password"
                   required>

            <button type="submit" name="signup_btn" class="register-btn otp-btn">
                Sign Up
            </button>
        </form>
    </section>
</main>

<div id="modal-container"></div>
<script src="home.js"></script>

<script>
document.getElementById("loginBtn2").addEventListener("click", function () {
    document.getElementById("loginBtn").click();
});
</script>

</body>
</html>
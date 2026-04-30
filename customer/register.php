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
    <title>Register - USEDCAR FYP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="register-container">
    <form class="register-card" action="register.php" method="POST">
        <h2>Create Account</h2>
        <p>Fill in your personal details</p>

        <input type="text"
               name="name"
               placeholder="Full Name"
               required
               title="Please enter your full name">

        <input type="tel"
               name="phone"
               placeholder="Phone Number"
               pattern="[0-9]{3}-[0-9]{7,8}"
               required
               title="Please enter phone number like 018-7643458">

        <input type="email"
               name="email"
               placeholder="Email Address"
               required
               title="Please enter a valid email">

        <input type="password"
               name="password"
               placeholder="Password"
               minlength="6"
               required
               title="Password must be at least 6 characters">

        <input type="password"
               name="confirm_password"
               placeholder="Confirm Password"
               required
               title="Please confirm your password">

               <button type="submit" name="signup_btn" class="register-btn otp-btn">
                Sign Up
            </button>

        <p>
            <button type="submit" name="submit_auth" class="otp-btn" id="mainAuthBtn">Login</button>
        </p>
    </form>
</div>

</body>
</html>
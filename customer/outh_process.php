<?php
include 'db.php';
session_start();

if (isset($_POST['submit_auth'])) {
    $mode = $_POST['auth_mode']; // 获取是 login 还是 signup
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if ($mode == 'signup') {
        // 注册逻辑 
        $confirm_password = $_POST['confirm_password'];
        if ($password !== $confirm_password) {
            echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
            exit();
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password) VALUES ('New User', '$email', '$hashed_password')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Account created! Please login.'); window.location.href='home.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

    } else {
        // 登录逻辑 
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        
        if ($row = mysqli_fetch_assoc($result)) {
            // 验证加密后的密码
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                echo "<script>alert('Welcome back, " . $row['name'] . "!'); window.location.href='home.php';</script>";
            } else {
                echo "<script>alert('Wrong password!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('User not found!'); window.history.back();</script>";
        }
    }
}
?>
<?php
include 'db.php'; // 引入你的数据库连接

if (isset($_POST['signup_btn'])) {
    // 1. 接收数据
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $name = "New User"; // 截图 2 有 Name 列，这里可以先设个默认值

    // 2. 检查两次密码是否一致
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.location.href='home.php';</script>";
        exit();
    }

    // 3. 密码加密 (重要！截图 2 里的密码是加密过的，这是 FYP 加分项)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 4. 检查 Email 是否已经被注册
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $run_check = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($run_check) > 0) {
        echo "<script>alert('Email already exists!'); window.location.href='home.php';</script>";
    } else {
        // 5. 插入数据库 (字段名要和你截图 2 一模一样)
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registration Successful!'); window.location.href='home.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
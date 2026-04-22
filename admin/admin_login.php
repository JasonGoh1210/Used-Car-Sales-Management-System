<?php
session_start();
include("../config/db.php");

$error = "";

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE admin_username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['admin_password'])) {

            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['admin_username'] = $row['admin_username'];

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Wrong password!";
        }

    } else {
        $error = "Username not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>

<h2>Admin Login</h2>

<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>

<p style="color:red;"><?php echo $error; ?></p>

</body>
</html>
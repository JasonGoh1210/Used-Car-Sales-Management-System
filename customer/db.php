<?php
$servername = "localhost";
$username = "root";   // XAMPP 默认用户名
$password = "";       // XAMPP 默认密码为空
$dbname = "Used_Car_Sales"; // 确保和你刚才在 phpMyAdmin 建的名字一模一样

// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);

// 检查连接是否成功
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully"; // 测试时可以取消注释看看
?>
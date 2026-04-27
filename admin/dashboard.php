<?php
session_start();
include("../config/db.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>DriveX Motors Dashboard</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>

<div class="sidebar">

    <div class="sidebar-header">
        <img src="../image/logo.png">
        <h3>DriveX Motors</h3>
    </div>

    <p class="menu-title">MENU</p>

    <a href="dashboard.php" class="active">Overview</a>
    <a href="manage_car.php">Manage Car</a>
    <a href="manage_booking.php">Bookings</a>
    <a href="manage_enquiry.php">Enquiry</a>
    <a href="../index.php">View Website</a>

    <div class="sidebar-bottom">
        <p class="signed">SIGNED AS</p>
        <p class="email">
            <?php 
            echo isset($_SESSION['admin_username']) 
                ? $_SESSION['admin_username'] 
                : 'admin@gmail.com'; 
            ?>
        </p>

        <a href="logout.php" class="logout">Logout</a>
    </div>

</div>

<div class="content">
    <div class="card">
        <h3>Dashboard</h3>
        <p>Welcome Back.</p>
    </div>
</div>

</body>
</html>
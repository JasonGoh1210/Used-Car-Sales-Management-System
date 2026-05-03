<?php
session_start();
include('../config/db.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>DriveX Motors Dashboard</title>

    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>

<div class="topbar">
    <div class="logo">
        <img src="../image/logo.png" alt="logo">
        <h2>DriveX Motors</h2>
    </div>

    <div>
        <a href="admin_logout.php" class="logout-btn" 
        onclick="return confirm('Are you sure you want to logout?');">
        Logout
        </a>
    </div>
</div>

<div class="sidebar">

    <a href="dashboard.php">Overview</a>
    <a href="manage_car.php">Manage Car</a>
    <a href="manage_category.php">Manage Category</a>
    <a href="manage_booking.php">Manage Booking</a>
    <a href="manage_payment.php">Manage Payment</a>
    <a href="manage_enquiry.php">Customer Enquiry</a>
    <a href="manage_customer.php">Customer</a>
    <a href="report.php">Reports</a>
    <a href="../index.php">View Website</a>

</div>

<div class="content">

    <div class="card">
        <h3>Dashboard</h3>
        <p>Welcome to DriveX Motors Admin Page.</p>
    </div>

</div>

</body>
</html>
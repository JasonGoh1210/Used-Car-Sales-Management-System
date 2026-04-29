<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}
include('../config/db.php');

if(isset($_POST['add'])){

    $name = $_POST['category_name'];

    mysqli_query($conn, "INSERT INTO category (category_name) VALUES ('$name')");

    echo "<script>alert('Category added'); window.location='manage_category.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>

<div class="topbar">
    <div class="logo">
        <img src="../image/logo.png">
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
    <a href="manage_category.php" style="background:#40444e;">Manage Category</a>
    <a href="manage_booking.php">Manage Booking</a>
    <a href="manage_payment.php">Manage Payment</a>
    <a href="manage_enquiry.php">Customer Enquiry</a>
    <a href="manage_customer.php">Customer</a>
    <a href="report.php">Reports</a>
    <a href="../index.php">View Website</a>
</div>

<div class="content">

    <div class="form-box">
        <form method="POST">

            <label>Category Name</label>
            <input type="text" name="category_name" required>

            <button class="btn" name="add">Add Category</button>

        </form>
    </div>

</div>

</body>
</html>
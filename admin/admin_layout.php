<?php
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}
?>

<!-- TOPBAR -->
<div class="topbar">

    <div class="top-left">
        <i class="fas fa-bars menu-btn" onclick="toggleSidebar()"></i>

        <div class="logo">
            <img src="../image/logo.png">
            <h2>DriveX Motors</h2>
        </div>
    </div>

    <div>
        <a href="admin_logout.php" class="logout-btn"
        onclick="return confirm('Are you sure you want to logout?');">
        Logout
        </a>
    </div>
</div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <a href="dashboard.php"><i class="fas fa-home"></i> <span>Overview</span></a>
    <a href="manage_car.php"><i class="fas fa-car"></i> <span>Manage Car</span></a>
    <a href="manage_category.php"><i class="fas fa-list"></i> <span>Manage Category</span></a>
    <a href="manage_booking.php"><i class="fas fa-calendar"></i> <span>Manage Booking</span></a>
    <a href="manage_payment.php"><i class="fas fa-credit-card"></i> <span>Manage Payment</span></a>
    <a href="manage_enquiry.php"><i class="fas fa-envelope"></i> <span>Customer Enquiry</span></a>
    <a href="manage_customer.php"><i class="fas fa-user"></i> <span>Customer</span></a>
    <a href="report.php"><i class="fas fa-chart-bar"></i> <span>Reports</span></a>
    <a href="../index.php"><i class="fas fa-globe"></i> <span>View Website</span></a>
</div>

<script>
function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle("collapsed");
    document.getElementById("content").classList.toggle("expanded");
    document.querySelector(".topbar").classList.toggle("collapsed");
}
</script>
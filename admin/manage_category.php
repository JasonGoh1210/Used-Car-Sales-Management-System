<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}
include('../config/db.php');

$result = mysqli_query($conn, "SELECT * FROM category");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Category</title>
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
    <a href="manage_category.php">Manage Category</a>
    <a href="manage_booking.php">Manage Booking</a>
    <a href="manage_payment.php">Manage Payment</a>
    <a href="manage_enquiry.php">Customer Enquiry</a>
    <a href="manage_customer.php">Customer</a>
    <a href="report.php">Reports</a>
    <a href="../index.php">View Website</a>
</div>

<div class="content">

    <div class="page-header">
        <h2>Manage Category</h2>
        <a href="add_category.php" class="btn">+ Add Category</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Status</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['category_id']; ?></td>
            <td><?php echo $row['category_name']; ?></td>

            <td>
                <?php if($row['category_status'] == 'Active') { ?>
                    <a href="update_category_status.php?id=<?php echo $row['category_id']; ?>&status=Inactive"
                       class="edit-btn"
                       onclick="return confirm('Change to Inactive?');">
                       Active
                    </a>
                <?php } else { ?>
                    <a href="update_category_status.php?id=<?php echo $row['category_id']; ?>&status=Active"
                       class="delete-btn"
                       onclick="return confirm('Change to Active?');">
                       Inactive
                    </a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>
<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

include('../config/db.php');

$result = mysqli_query($conn, "SELECT * FROM customer");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Customer</title>
    <link rel="stylesheet" href="../css/admin_style.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>

<?php $active = 'customer'; ?>

<?php include('admin_layout.php'); ?>

<div class="content" id="content">

    <div class="page-header">
        <h2>Manage Customer</h2>

        <!-- ⭐ 新增按钮 -->
        <a href="add_customer.php" class="btn">+ Add Customer</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th> 
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td><?php echo $row['cust_id']; ?></td>
            <td><?php echo $row['cust_name']; ?></td>
            <td><?php echo $row['cust_email']; ?></td>
            <td><?php echo $row['cust_phone']; ?></td>

            <td>
                <?php echo $row['cust_status']; ?>
            </td>

            <td>
                <a href="view_customer.php?id=<?php echo $row['cust_id']; ?>" class="edit-btn">View</a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
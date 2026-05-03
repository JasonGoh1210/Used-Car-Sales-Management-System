<?php
session_start();
include('../config/db.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM customer WHERE cust_id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $status = $_POST['status'];

    mysqli_query($conn, "UPDATE customer 
        SET cust_status='$status'
        WHERE cust_id='$id'
    ");

    echo "<script>alert('Customer updated'); window.location='manage_customer.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Customer</title>
    <link rel="stylesheet" href="../css/admin_style.css">

    <!-- ICON -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>

<?php $active = 'customer'; ?>
<?php include('admin_layout.php'); ?>

<div class="content">

<div class="form-box">
    <h2>Customer Details</h2>

    <form method="POST">

        <!-- ⭐ Customer ID -->
        <label>Customer ID</label>
        <input type="text" value="CTM<?php echo str_pad($row['cust_id'],4,'0',STR_PAD_LEFT); ?>" readonly>

        <label>Name</label>
        <input type="text" value="<?php echo $row['cust_name']; ?>" readonly>

        <label>Email</label>
        <input type="text" value="<?php echo $row['cust_email']; ?>" readonly>

        <label>Phone</label>
        <input type="text" value="<?php echo $row['cust_phone']; ?>" readonly>

        <!-- ⭐ IC -->
        <label>IC Number</label>
        <input type="text" value="<?php echo $row['cust_ic']; ?>" readonly>

        <!-- ⭐ Address -->
        <label>Address</label>
        <input type="text" value="<?php echo $row['cust_address']; ?>" readonly>

        <label>City</label>
        <input type="text" value="<?php echo $row['cust_city']; ?>" readonly>

        <label>State</label>
        <input type="text" value="<?php echo $row['cust_state']; ?>" readonly>

        <label>Postcode</label>
        <input type="text" value="<?php echo $row['cust_postcode']; ?>" readonly>

        <!-- ⭐ Status（唯一可以改） -->
        <label>Status</label>
        <select name="status">
            <option value="Active" <?php if($row['cust_status']=="Active") echo "selected"; ?>>Active</option>
            <option value="Inactive" <?php if($row['cust_status']=="Inactive") echo "selected"; ?>>Inactive</option>
        </select>

        <br><br>

        <!-- ⭐ IC 图片 -->
        <label>IC Front</label><br>
        <?php if($row['ic_front'] != "") { ?>
            <img src="../image/<?php echo $row['ic_front']; ?>" width="150"><br><br>
        <?php } else { echo "No Image<br><br>"; } ?>

        <label>IC Back</label><br>
        <?php if($row['ic_back'] != "") { ?>
            <img src="../image/<?php echo $row['ic_back']; ?>" width="150"><br><br>
        <?php } else { echo "No Image<br><br>"; } ?>

        <button class="btn" name="update">Update</button>

    </form>
</div>

</div>

</body>
</html>
<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

include('../config/db.php');

if(isset($_POST['add'])){

    $cust_id = generateCustomerID($conn);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];

    mysqli_query($conn, "INSERT INTO customer
    (cust_id, cust_name, cust_email, cust_phone, cust_status)
    VALUES
    ('$cust_id','$name','$email','$phone','$status')");

    echo "<script>alert('Customer added'); window.location='manage_customer.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Customer</title>
    <link rel="stylesheet" href="../css/admin_style.css">

    <!-- ICON -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>

<?php $active = 'customer'; ?>
<?php include('admin_layout.php'); ?>

<div class="content">

<div class="form-box">
    <h2>Add Customer</h2>

    <form method="POST">

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Phone</label>
        <input type="text" name="phone" required>

        <label>Status</label>
        <select name="status">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>

        <button class="btn" name="add">Add Customer</button>

    </form>
</div>

</div>

</body>
</html>
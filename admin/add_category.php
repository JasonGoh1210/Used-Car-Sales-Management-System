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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>

<?php $active = 'category'; ?>

<?php include('admin_layout.php'); ?>

<div class="content" id="content">

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
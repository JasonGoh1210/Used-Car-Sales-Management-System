<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}
include('../config/db.php');

if(isset($_GET['id']) && isset($_GET['status'])){

    $id = $_GET['id'];
    $status = $_GET['status'];

    mysqli_query($conn, 
        "UPDATE category SET category_status='$status' WHERE category_id='$id'"
    );

    header("Location: manage_category.php");
}
?>
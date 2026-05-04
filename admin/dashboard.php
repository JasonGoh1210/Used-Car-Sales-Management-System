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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>

<?php $active = 'dashboard'; ?>
<?php include('admin_layout.php'); ?>

<div class="content" id="content">

    <div class="card">
        <h3>Dashboard</h3>
        <p>Welcome to DriveX Motors Admin Page.</p>
    </div>

</div>

</body>
</html>
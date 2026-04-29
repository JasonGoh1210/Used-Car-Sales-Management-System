<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}
include('../config/db.php');

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM car WHERE car_id='$id'");
$row = mysqli_fetch_assoc($result);

$cat_result = mysqli_query($conn, 
    "SELECT * FROM category WHERE category_status='Active'"
);

if(isset($_POST['update'])){

    $category_id = $_POST['category_id'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $mileage = $_POST['mileage'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    if($_FILES['image']['name'] != ""){

        $image = time() . "_" . $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "../image/".$image);

    } else {
        $image = $row['car_image'];
    }

    mysqli_query($conn, "UPDATE car SET
        category_id='$category_id',
        car_brand='$brand',
        car_model='$model',
        car_year='$year',
        car_price='$price',
        car_mileage='$mileage',
        car_status='$status',
        car_image='$image',
        car_description='$description'
        WHERE car_id='$id'
    ");

    echo "<script>alert('Car updated'); window.location='manage_car.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Car</title>
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
    <a href="manage_car.php" style="background:#40444e;">Manage Car</a>
    <a href="manage_category.php">Car Category</a>
    <a href="manage_booking.php">Manage Booking</a>
    <a href="manage_payment.php">Manage Payment</a>
    <a href="manage_enquiry.php">Customer Enquiry</a>
    <a href="manage_customer.php">Customer</a>
    <a href="report.php">Reports</a>
    <a href="../index.php">View Website</a>
</div>

<div class="content">

<div class="form-box">
    <h2>Edit Car</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Category</label>
        <select name="category_id" required>
            <?php while($cat = mysqli_fetch_assoc($cat_result)) { ?>
                <option value="<?php echo $cat['category_id']; ?>"
                <?php if($cat['category_id'] == $row['category_id']) echo "selected"; ?>>
                    <?php echo $cat['category_name']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Brand</label>
        <input type="text" name="brand" value="<?php echo $row['car_brand']; ?>" required>

        <label>Model</label>
        <input type="text" name="model" value="<?php echo $row['car_model']; ?>" required>

        <label>Year</label>
        <input type="number" name="year" value="<?php echo $row['car_year']; ?>" required>

        <label>Price (RM)</label>
        <input type="number" name="price" value="<?php echo $row['car_price']; ?>" required>

        <label>Mileage (KM)</label>
        <input type="number" name="mileage" value="<?php echo $row['car_mileage']; ?>">

        <label>Status</label>
        <select name="status">
            <option value="Available" <?php if($row['car_status']=="Available") echo "selected"; ?>>Available</option>
            <option value="Pending" <?php if($row['car_status']=="Pending") echo "selected"; ?>>Pending</option>
            <option value="Sold" <?php if($row['car_status']=="Sold") echo "selected"; ?>>Sold</option>
        </select>

        <label>Current Image</label><br>
        <img src="../image/<?php echo $row['car_image']; ?>" width="120"><br><br>

        <label>Change Image</label>
        <input type="file" name="image">

        <label>Description</label>
        <textarea name="description"><?php echo $row['car_description']; ?></textarea>

        <button class="edit-btn" name="update">Update Car</button>

    </form>
</div>

</div>

</body>
</html>
<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}
include('../config/db.php');

$cat_result = mysqli_query($conn, 
    "SELECT * FROM category WHERE category_status='Active'"
);

if(isset($_POST['submit'])){

    $category_id = $_POST['category_id'];   // ⭐ 新增
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $mileage = $_POST['mileage'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    $admin_id = 1;

    $image = time() . "_" . $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "../image/".$image);

    mysqli_query($conn, "INSERT INTO car
    (category_id, admin_id, car_brand, car_model, car_year, car_price, car_mileage, car_status, car_image, car_description)
    VALUES
    ('$category_id','$admin_id','$brand','$model','$year','$price','$mileage','$status','$image','$description')");

    echo "<script>alert('Car added'); window.location='manage_car.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Car</title>
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
    <a href="manage_category.php">Manage Category</a>
    <a href="manage_booking.php">Manage Booking</a>
    <a href="manage_payment.php">Manage Payment</a>
    <a href="manage_enquiry.php">Customer Enquiry</a>
    <a href="manage_customer.php">Customer</a>
    <a href="report.php">Reports</a>
    <a href="../index.php">View Website</a>
</div>

<div class="content">

<div class="form-box">
    <h2>Add Car</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Brand</label>
        <input type="text" name="brand" required>
        
        <label>Category</label>
        <select name="category_id" required>
            <option value="">-- Select Category --</option>

            <?php while($cat = mysqli_fetch_assoc($cat_result)) { ?>
                <option value="<?php echo $cat['category_id']; ?>">
                    <?php echo $cat['category_name']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Model</label>
        <input type="text" name="model" required>

        <label>Year</label>
        <input type="number" name="year" required>

        <label>Price (RM)</label>
        <input type="number" name="price" required>

        <label>Mileage (KM)</label>
        <input type="number" name="mileage">

        <label>Status</label>
        <select name="status">
            <option>Available</option>
            <option>Pending</option>
            <option>Sold</option>
        </select>

        <label>Car Image</label>
        <input type="file" name="image" required>

        <label>Description</label>
        <textarea name="description"></textarea>

        <button class="btn" name="submit">Add Car</button>

    </form>
</div>

</div>

</body>
</html>
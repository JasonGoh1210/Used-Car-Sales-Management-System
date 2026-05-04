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

    $category_id = $_POST['category_id'];
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

    <!-- ICON -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>

<!-- ⭐ 当前页面 -->
<?php $active = 'car'; ?>

<!-- ⭐ 统一 layout -->
<?php include('admin_layout.php'); ?>

<!-- CONTENT -->
<div class="content" id="content">

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
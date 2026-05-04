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

// 👉 拿多图
$images = mysqli_query($conn, "SELECT * FROM car_images WHERE car_id='$id'");

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

    // ✅ 主图
    if(!empty($_FILES['image']['name'])){

        $image = time() . "_" . basename($_FILES['image']['name']);
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "../image/".$image);

    } else {
        $image = $row['car_image'];
    }

    // ✅ 更新 car
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

    // ✅ 新增多图（🔥改这里：image_path）
    if(!empty($_FILES['new_images']['name'][0])){

        foreach($_FILES['new_images']['name'] as $key => $name){

            if(!empty($name)){
                $newName = time() . "_" . basename($name);
                $tmp = $_FILES['new_images']['tmp_name'][$key];

                move_uploaded_file($tmp, "../image/".$newName);

                mysqli_query($conn, "INSERT INTO car_images (car_id, image_path)
                VALUES ('$id', '$newName')");
            }
        }
    }

    echo "<script>alert('Car updated'); window.location='manage_car.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Car</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>

<?php include('admin_layout.php'); ?>

<div class="content" id="content">

<div class="form-box">
    <h2>Edit Car</h2>

    <label>Car Images</label><br><br>

    <div style="display:flex; flex-wrap:wrap; gap:15px;">
        <?php if(!empty($row['car_image'])) { ?>
        <div style="position:relative;">
            <img src="../image/<?php echo htmlspecialchars($row['car_image']); ?>" width="120">

            <div style="
                position:absolute;
                bottom:5px;
                left:5px;
                background:green;
                color:white;
                padding:3px 6px;
                font-size:12px;
            ">MAIN</div>
        </div>
        <?php } ?>

        <?php while($img = mysqli_fetch_assoc($images)) { ?>
            <?php if(!empty($img['image_path'])) { ?>
            <div style="position:relative;">
                <img src="../image/<?php echo htmlspecialchars($img['image_path']); ?>" width="120">

                <a href="delete_image.php?id=<?php echo $img['id']; ?>&car_id=<?php echo $id; ?>"
                   style="
                        position:absolute;
                        top:5px;
                        right:5px;
                        background:orange;
                        color:white;
                        border-radius:50%;
                        padding:3px 8px;
                        text-decoration:none;
                   ">×</a>

                <a href="set_main.php?car_id=<?php echo $id; ?>&img=<?php echo urlencode($img['image_path']); ?>"
                   style="
                        position:absolute;
                        bottom:5px;
                        left:5px;
                        background:#ff8906;
                        color:white;
                        padding:3px 6px;
                        font-size:12px;
                        text-decoration:none;
                   ">
                   Set Main
                </a>
            </div>
            <?php } ?>
        <?php } ?>

    </div>

    <br>

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
        <input type="text" name="brand" value="<?php echo htmlspecialchars($row['car_brand']); ?>" required>

        <label>Model</label>
        <input type="text" name="model" value="<?php echo htmlspecialchars($row['car_model']); ?>" required>

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

        <label>Change Main Image</label>
        <input type="file" name="image">

        <label>Add More Images</label>
        <input type="file" name="new_images[]" multiple>

        <label>Description</label>
        <textarea name="description"><?php echo htmlspecialchars($row['car_description']); ?></textarea>

        <button class="edit-btn" name="update">Update Car</button>

    </form>
</div>

</div>

</body>
</html>
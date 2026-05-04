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

    // ✅ 多图处理
    $images = [];

    foreach($_FILES['image']['name'] as $key => $name){

        if(!empty($name)){

            $newName = time() . "_" . $name;
            $tmp = $_FILES['image']['tmp_name'][$key];

            move_uploaded_file($tmp, "../image/".$newName);

            $images[] = $newName;
        }
    }

    // ✅ 主图 = 第一张
    $mainImage = $images[0] ?? '';

    // ✅ 插入 car（主图）
    mysqli_query($conn, "INSERT INTO car
    (category_id, admin_id, car_brand, car_model, car_year, car_price, car_mileage, car_status, car_image, car_description)
    VALUES
    ('$category_id','$admin_id','$brand','$model','$year','$price','$mileage','$status','$mainImage','$description')");

    // ✅ 拿 car_id
    $car_id = mysqli_insert_id($conn);

    foreach($images as $img){
        mysqli_query($conn, "INSERT INTO car_images (car_id, image_path)
        VALUES ('$car_id', '$img')");
    }

    echo "<script>alert('Car added'); window.location='manage_car.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Car</title>
    <link rel="stylesheet" href="../css/admin_style.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>

<?php include('admin_layout.php'); ?>

<div class="content" id="content">

<div class="form-box">
    <h2>Add Car</h2>

    <form method="POST" enctype="multipart/form-data" id="carForm">

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

        <!-- ✅ 多图 -->
        <label>Car Images</label>
        <input type="file" id="imageInput" name="image[]" multiple accept="image/*">

        <div id="preview"></div>

        <label>Description</label>
        <textarea name="description"></textarea>

        <button class="btn" name="submit">Add Car</button>

    </form>
</div>

</div>

<script>
let selectedFiles = [];

const input = document.getElementById("imageInput");
const preview = document.getElementById("preview");

// 选图
input.addEventListener("change", function(e) {
    let files = Array.from(e.target.files);

    files.forEach(file => {
        selectedFiles.push(file);
    });

    renderPreview();
});

function renderPreview() {
    preview.innerHTML = "";

    selectedFiles.forEach((file, index) => {

        let reader = new FileReader();

        reader.onload = function(e) {
            let div = document.createElement("div");
            div.style.display = "inline-block";
            div.style.position = "relative";
            div.style.margin = "10px";

            div.innerHTML = `
                <img src="${e.target.result}" width="120" style="border-radius:8px;">
                <button onclick="removeImage(${index})"
                    style="
                        position:absolute;
                        top:5px;
                        right:5px;
                        background:#ff8906;
                        color:white;
                        border:none;
                        border-radius:50%;
                        width:28px;
                        height:28px;
                        cursor:pointer;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:16px;
                        font-weight:bold;
                    ">×</button>
            `;

            preview.appendChild(div);
        };

        reader.readAsDataURL(file);
    });
}

function removeImage(index) {
    selectedFiles.splice(index, 1);
    renderPreview();
}

document.getElementById("carForm").addEventListener("submit", function() {

    let dataTransfer = new DataTransfer();

    selectedFiles.forEach(file => {
        dataTransfer.items.add(file);
    });

    input.files = dataTransfer.files;
});
</script>

</body>
</html>
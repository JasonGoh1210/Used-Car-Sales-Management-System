<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

include('../config/db.php');

$admin_id = $_SESSION['admin_id'];

$cat_result = mysqli_query($conn, 
    "SELECT * FROM category WHERE category_status='Active'"
);

$brand_result = mysqli_query($conn,
    "SELECT * FROM brand ORDER BY brand_name ASC"
);

$model_result = mysqli_query($conn,
    "SELECT * FROM model ORDER BY model_name ASC"
);

if(isset($_POST['submit'])){

    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $model_id = $_POST['model_id'];

    $car_name = $_POST['car_name'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $mileage = $_POST['mileage'];
    $car_cc = $_POST['car_cc'];
    $car_color = $_POST['car_color'];
    $car_plate = $_POST['car_plate'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    $images = [];

    foreach($_FILES['image']['name'] as $key => $name){

        if(!empty($name)){

            $newName = time() . "_" . basename($name);
            $tmp = $_FILES['image']['tmp_name'][$key];

            move_uploaded_file($tmp, "../image/".$newName);

            $images[] = $newName;
        }
    }

    // 主图
    $mainImage = $images[0] ?? '';

    mysqli_query($conn, "INSERT INTO car
    (
        category_id,
        admin_id,
        car_name,
        car_year,
        car_price,
        car_mileage,
        car_cc,
        car_status,
        car_image,
        car_description,
        brand_id,
        model_id,
        car_color,
        car_plate
    )
    VALUES
    (
        '$category_id',
        '$admin_id',
        '$car_name',
        '$year',
        '$price',
        '$mileage',
        '$car_cc',
        '$status',
        '$mainImage',
        '$description',
        '$brand_id',
        '$model_id',
        '$car_color',
        '$car_plate'
    )");

    $car_id = mysqli_insert_id($conn);

    // 多图
    foreach($images as $img){

        mysqli_query($conn, "INSERT INTO car_images
        (car_id, image_path)
        VALUES
        ('$car_id', '$img')");
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

        <label>Car Name</label>
        <input type="text" name="car_name" id="car_name" required readonly>

        <!-- Category -->
        <label>Category</label>
        <select name="category_id" required>

            <option value="">-- Select Category --</option>

            <?php while($cat = mysqli_fetch_assoc($cat_result)) { ?>

                <option value="<?php echo $cat['category_id']; ?>">
                    <?php echo $cat['category_name']; ?>
                </option>

            <?php } ?>

        </select>

        <!-- Brand -->
        <label>Brand</label>
        <select name="brand_id" id="brand" required>

            <option value="">-- Select Brand --</option>

            <?php while($brand = mysqli_fetch_assoc($brand_result)) { ?>

                <option value="<?php echo $brand['brand_id']; ?>">
                    <?php echo $brand['brand_name']; ?>
                </option>

            <?php } ?>

        </select>

        <!-- Model -->
        <label>Model</label>

        <select name="model_id" id="model" required>

            <option value="">-- Select Model --</option>

            <?php while($model = mysqli_fetch_assoc($model_result)) { ?>

                <option
                    value="<?php echo $model['model_id']; ?>"
                    data-brand="<?php echo $model['brand_id']; ?>"
                >
                    <?php echo $model['model_name']; ?>
                </option>

            <?php } ?>

        </select>

        <!-- Year -->
        <label>Year</label>
        <input type="number" name="year" required>

        <!-- Price -->
        <label>Price (RM)</label>
        <input type="number" name="price" required>

        <!-- Mileage -->
        <label>Mileage (KM)</label>
        <input type="number" name="mileage">

        <!-- CC -->
        <label>Engine CC</label>
        <input type="text" name="car_cc" placeholder="Example: 1.5CC">

        <!-- Color -->
        <label>Car Color</label>
        <input type="text" name="car_color" placeholder="Example: White">

        <!-- Plate -->
        <label>Car Plate</label>
        <input type="text" name="car_plate" placeholder="Example: VAB1234">

        <!-- Status -->
        <label>Status</label>
        <select name="status">

            <option>Available</option>
            <option>Pending</option>
            <option>Sold</option>

        </select>

        <!-- Images -->
        <label>Car Images</label>

        <input type="file"
               id="imageInput"
               name="image[]"
               multiple
               accept="image/*">

        <div id="preview"></div>

        <!-- Description -->
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

// BRAND + MODEL FILTER
const brand = document.getElementById("brand");
const model = document.getElementById("model");
const cc = document.querySelector("input[name='car_cc']");
const carName = document.getElementById("car_name");

brand.addEventListener("change", function(){

    let brandId = this.value;

    Array.from(model.options).forEach(option => {

        if(option.value == ""){
            option.style.display = "block";
            return;
        }

        if(option.dataset.brand == brandId){
            option.style.display = "block";
        } else {
            option.style.display = "none";
        }

    });

    model.value = "";

    updateCarName();
});

// MODEL CHANGE
model.addEventListener("change", function(){
    updateCarName();
});

// CC CHANGE
cc.addEventListener("input", function(){
    updateCarName();
});

// AUTO CAR NAME
function updateCarName(){

    let brandText =
        brand.options[brand.selectedIndex]?.text || "";

    let modelText =
        model.options[model.selectedIndex]?.text || "";

    let ccText = cc.value;

    if(brand.value == ""){
        brandText = "";
    }

    if(model.value == ""){
        modelText = "";
    }

    let finalName =
        brandText + " " +
        modelText + " " +
        ccText;

    carName.value = finalName.trim();
}

// Select Images
input.addEventListener("change", function(e) {

    let files = Array.from(e.target.files);

    files.forEach(file => {
        selectedFiles.push(file);
    });

    renderPreview();
});

// Preview
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

                <img src="${e.target.result}"
                     width="120"
                     style="border-radius:8px;">

                ${
                    index === 0
                    ?
                    `<div style="
                        position:absolute;
                        bottom:5px;
                        left:5px;
                        background:green;
                        color:white;
                        padding:3px 6px;
                        font-size:12px;
                        border-radius:4px;
                    ">
                        MAIN
                    </div>`
                    :
                    ""
                }

                <button type="button"
                    onclick="removeImage(${index})"
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
                    ">
                    ×
                </button>
            `;

            preview.appendChild(div);
        };

        reader.readAsDataURL(file);
    });
}

// Remove
function removeImage(index) {

    selectedFiles.splice(index, 1);

    renderPreview();
}

// Submit
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
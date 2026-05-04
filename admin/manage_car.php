<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

include('../config/db.php');

$result = mysqli_query($conn, "SELECT * FROM car");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Car</title>
    <link rel="stylesheet" href="../css/admin_style.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>

<?php include('admin_layout.php'); ?>

<div class="content" id="content">

    <div class="page-header">
        <h2>Manage Cars</h2>
        <a href="add_car.php" class="btn">+ Add Car</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Year</th>
            <th>Price</th>
            <th>Mileage</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td><?php echo $row['car_id']; ?></td>

            <td>
                <img src="../image/<?php echo $row['car_image']; ?>" width="80">
            </td>

            <td><?php echo $row['car_brand']; ?></td>
            <td><?php echo $row['car_model']; ?></td>
            <td><?php echo $row['car_year']; ?></td>
            <td>RM <?php echo number_format($row['car_price'], 2); ?></td>
            <td>
                <?php 
                    if(!empty($row['car_mileage'])){
                    echo number_format($row['car_mileage']) . " KM";
                    } else {
                    echo "-";
                    }
                ?>
            </td>
            
            <td><?php echo $row['car_status']; ?></td>

            <td>
                <a href="edit_car.php?id=<?php echo $row['car_id']; ?>" class="edit-btn">Edit</a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
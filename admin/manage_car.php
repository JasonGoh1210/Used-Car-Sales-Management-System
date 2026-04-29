<?php
include('../config/db.php');

$result = mysqli_query($conn, "SELECT * FROM car");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Car</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>

<div class="topbar">
    <h2>DriveX Motors</h2>
</div>

<div class="sidebar">
    <a href="dashboard.php">Overview</a>
    <a href="manage_car.php">Manage Car</a>
    <a href="manage_booking.php">Manage Booking</a>
    <a href="manage_enquiry.php">Manage Enquiry</a>
</div>

<div class="content">

    <h2>Manage Cars</h2>


    <a href="add_car.php" class="btn">+ Add Car</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Year</th>
            <th>Price</th>
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
            <td>RM <?php echo $row['car_price']; ?></td>
            <td><?php echo $row['car_status']; ?></td>

            <td>
                <a href="delete_car.php?id=<?php echo $row['car_id']; ?>">Delete</a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
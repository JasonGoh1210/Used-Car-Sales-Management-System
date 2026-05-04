<?php
include('../config/db.php');

$id = $_GET['id'];
$car_id = $_GET['car_id'];

mysqli_query($conn, "DELETE FROM car_images WHERE id='$id'");

header("Location: edit_car.php?id=$car_id");
?>
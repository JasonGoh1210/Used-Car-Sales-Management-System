<?php
include('../config/db.php');

$car_id = $_GET['car_id'];
$img = $_GET['img'];

mysqli_query($conn, "UPDATE car SET car_image='$img' WHERE car_id='$car_id'");

header("Location: edit_car.php?id=$car_id");
?>
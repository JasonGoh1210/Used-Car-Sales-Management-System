<?php
$conn = mysqli_connect("localhost", "root", "", "used_car_system");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
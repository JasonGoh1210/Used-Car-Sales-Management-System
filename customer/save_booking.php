<?php

include("../database/connection.php");

// ==========================
// GET DATA
// ==========================

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$postcode = $_POST['postcode'];
$state = $_POST['state'];
$city = $_POST['city'];

$testDate = $_POST['test_date'] ?? '';
$testTime = $_POST['test_time'] ?? '';

// combine datetime
$fullDateTime = $testDate . " " . $testTime;


// ==========================
// INSERT BOOKING
// ==========================

$sql = "INSERT INTO booking
(customer_name, email, phone, address, postcode, state, city, booking_date)

VALUES
('$name', '$email', '$phone', '$address', '$postcode', '$state', '$city', NOW())";

mysqli_query($conn, $sql);


// ==========================
// INSERT TEST DRIVE（🔥重点在这里）
// ==========================

if(!empty($testDate) && !empty($testTime)){

    $sql2 = "INSERT INTO test_drive
    (cust_id, car_id, tdrive_date, tdrive_status)

    VALUES
    ('1', '1', '$fullDateTime', 'Pending')";

    mysqli_query($conn, $sql2);
}


// ==========================
// AUTO REDIRECT TO PAYMENT
// ==========================
?>

<form id="autoForm" action="payment.php" method="POST">

    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="hidden" name="price" value="<?php echo $_POST['price']; ?>">

</form>

<script>
document.getElementById("autoForm").submit();
</script>
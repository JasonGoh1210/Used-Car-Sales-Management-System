<?php
include('../config/db.php');

$car_id = $_GET['car_id'] ?? 1;

$car = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT * FROM car WHERE car_id = $car_id"
));

$price = $car['car_price'];
$discount = 2000;
$fee = 500;
$total = $price - $discount + $fee;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Booking</title>
    <link rel="stylesheet" href="../css/payment.css">
</head>

<body>

<div class="container">

    <div class="box">
        <h2>1. Vehicle Information</h2>

        <p><strong>Car:</strong> <?php echo $car['car_brand'] . " " . $car['car_model']; ?></p>
        <p><strong>Year:</strong> <?php echo $car['car_year']; ?></p>
        <p><strong>Price:</strong> RM <?php echo $price; ?></p>
    </div>

    <div class="box">
        <h2>2. Customer Details</h2>

        <form method="POST">

            <div class="row">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="row">
                <input type="text" name="phone" placeholder="Phone Number" required>
                <input type="text" name="postcode" placeholder="Postcode" required>
            </div>

            <div class="row">
                <input type="text" name="city" placeholder="City" required>
                <input type="text" name="state" placeholder="State" required>
            </div>

            <textarea name="address" placeholder="Full Address"></textarea>

            <button type="submit">Confirm Booking</button>

        </form>
    </div>

    <div class="box">
        <h2>3. Payment Summary</h2>

        <div class="price-row">
            <span>Car Price</span>
            <span>RM <?php echo $price; ?></span>
        </div>

        <div class="price-row">
            <span>Discount</span>
            <span>- RM <?php echo $discount; ?></span>
        </div>

        <div class="price-row">
            <span>Service Fee</span>
            <span>+ RM <?php echo $fee; ?></span>
        </div>

        <hr>

        <div class="price-row total">
            <span>Total</span>
            <span>RM <?php echo $total; ?></span>
        </div>

    </div>

</div>

</body>
</html>
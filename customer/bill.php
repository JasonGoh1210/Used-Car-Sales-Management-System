<?php
$status = $_POST['status'] ?? 'success';
$name = $_POST['card_name'] ?? '';
$card = $_POST['card_number'] ?? '';
$email = $_POST['email'] ?? '';
$price = $_POST['price'] ?? 0;

$last4 = substr($card, -4);
$masked = "**** " . $last4;

$txn = "TXN-" . rand(100000000,999999999);
$date = date("M d, Y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Bill</title>
<link rel="stylesheet" href="../css/payment.css">

</head>

<body class="bill-page">

<div class="container">

<?php if($status == "success"): ?>
    <div class="icon success">✔</div>
    <h2 class="success-text">Payment Successful!</h2>
<?php else: ?>
    <div class="icon fail">✖</div>
    <h2 class="fail-text">Payment Failed!</h2>
<?php endif; ?>

<p>
<?php if($status == "success"): ?>
Your payment has been processed successfully.
<?php else: ?>
Payment failed. Please check your card details.
<?php endif; ?>
</p>

<div class="box">
    <div class="row">
        <span>Amount</span>
        <b>RM <?php echo $price; ?></b>
    </div>

    <div class="row">
        <span>Transaction ID</span>
        <span><?php echo $txn; ?></span>
    </div>

    <div class="row">
        <span>Card</span>
        <span><?php echo $masked; ?></span>
    </div>

    <div class="row">
        <span>Date</span>
        <span><?php echo $date; ?></span>
    </div>

    <div class="row">
        <span>Name</span>
        <span><?php echo $name; ?></span>
    </div>
</div>

<div></div>

<a href="dashboard.php">
    <button class="back">Return to Store</button>
</a>

</div>

</body>
</html>
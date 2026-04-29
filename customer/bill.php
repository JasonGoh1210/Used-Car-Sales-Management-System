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
<title>Result</title>

<style>
body {
    font-family: Arial;
    background: #f4f4f4;
    display: flex;
    justify-content: center;
    padding: 40px;
}

.container {
    width: 500px;
    background: white;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
}

.icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    font-size: 35px;
}

.success { background:#d4f5df; color:green; }
.fail { background:#ffd6d6; color:red; }

h2.success-text { color:green; }
h2.fail-text { color:red; }

.box {
    background: #f0f0f0;
    padding: 15px;
    border-radius: 10px;
    margin-top: 20px;
    text-align:left;
}

.row {
    display:flex;
    justify-content:space-between;
    margin:8px 0;
}

button {
    width:100%;
    padding:12px;
    margin-top:10px;
    border:none;
    border-radius:8px;
}

.back { background:#eee; }
</style>

</head>

<body>

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

<a href="dashboard.php">
    <button class="back">Return to Store</button>
</a>

</div>

</body>
</html>
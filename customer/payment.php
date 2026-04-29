<?php
$price = $_POST['price'] ?? 0;
$email = $_POST['email'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Payment</title>
<link rel="stylesheet" href="../css/payment.css">
</head>

<body>

<form action="success.php" method="POST" id="payForm">

<div class="container">

<h3>Credit Card Details</h3>

<div class="section">
    <div class="input-group">
        <label>Name on card</label>
        <input type="text" name="card_name" required>
    </div>

    <div class="input-group">
        <label>Card number</label>
        <input type="text" name="card_number" required>
    </div>

    <div class="row">
        <div class="input-group">
            <label>Month</label>
            <select name="month" required>
                <option value="">Month</option>
                <option>Jan</option>
                <option>Feb</option>
                <option>Mar</option>
            </select>
        </div>

        <div class="input-group">
            <label>Year</label>
            <select id="year" name="year" required>
                <option value="">Year</option>
            </select>
        </div>
    </div>

    <div class="input-group">
        <label>CVV</label>
        <input type="text" name="cvv" required>
    </div>
</div>

<!-- hidden data -->
<input type="hidden" name="price" value="<?php echo $price; ?>">
<input type="hidden" name="email" value="<?php echo $email; ?>">
<input type="hidden" name="status" id="status" value="success">

<button type="submit">Pay</button>

</div>
</form>

<script>
    
const yearSelect = document.getElementById("year");
const currentYear = new Date().getFullYear();
for (let i = 0; i < 10; i++) {
    let y = currentYear + i;
    let opt = document.createElement("option");
    opt.text = y;
    yearSelect.add(opt);
}

// 模拟 payment validation
document.getElementById("payForm").addEventListener("submit", function(e){

    let card = document.querySelector("[name='card_number']").value;
    let cvv = document.querySelector("[name='cvv']").value;

    if(card.length < 16 || cvv.length != 3){
        document.getElementById("status").value = "fail";
    }
});
</script>

</body>
</html>
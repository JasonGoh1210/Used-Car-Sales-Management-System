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

<body class="payment-page">

<form action="success.php" method="POST" id="payForm">

<div class="container">

    <h3>Credit Card Details</h3>

    <div class="payment-icons">
        <img src="https://img.icons8.com/color/48/mastercard-logo.png"/>
        <img src="https://img.icons8.com/color/48/visa.png"/>
        <img src="https://img.icons8.com/color/48/amex.png"/>
    </div>

    <div class="section">
        <div class="input-group">
            <label>Name on card</label>
            <input type="text" name="card_name" placeholder="Meet Patel" required>
        </div>

        <div class="input-group">
            <label>Card number</label>
            <input type="text" name="card_number" placeholder="0000 0000 0000 0000" required>
        </div>

        <div class="row">
            <div class="input-group">
                <label>Month</label>
                <select name="month" required>
                    <option value="">Month</option>
                    <option>Jan</option>
                    <option>Feb</option>
                    <option>Mar</option>
                    <option>Apr</option>
                    <option>May</option>
                    <option>Jun</option>
                    <option>Jul</option>
                    <option>Aug</option>
                    <option>Sep</option>
                    <option>Oct</option>
                    <option>Nov</option>
                    <option>Dec</option>
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
            <label>Card Security Code</label>
            <input type="text" name="cvv" placeholder="Code" required>
        </div>
    </div>

    <!-- Billing -->
    <div class="section">
        <h3>Billing Address</h3>

        <div class="input-group">
            <label>Country</label>
            <select name="country" required>
                <option value="">Country</option>
                <option>Malaysia</option>
            </select>
        </div>

        <div class="input-group">
            <label>Address</label>
            <input type="text" name="address" placeholder="Address" required>
        </div>

        <div class="input-group">
            <label>City</label>
            <input type="text" name="city" placeholder="City" required>
        </div>

        <div class="input-group">
            <label>State</label>
            <input type="text" name="state" placeholder="State" required>
        </div>

        <div class="input-group">
            <label>ZIP CODE</label>
            <input type="text" name="zip" placeholder="ZIP CODE" required>
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
    let year = currentYear + i;
    let option = document.createElement("option");
    option.value = year;
    option.textContent = year;
    yearSelect.appendChild(option);
}

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
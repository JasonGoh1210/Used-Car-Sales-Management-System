<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Payment</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    display: flex;
    justify-content: center;
    padding: 40px;
}

.container {
    width: 500px;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

h3 {
    margin-bottom: 15px;
}

.section {
    margin-bottom: 25px;
}

.input-group {
    margin-bottom: 12px;
}

.input-group label {
    display: block;
    font-size: 13px;
    margin-bottom: 5px;
    color: #333;
}

.input-group input, 
.input-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
}

.row {
    display: flex;
    gap: 10px;
}

.row .input-group {
    flex: 1;
}

.payment-icons {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}

.payment-icons img {
    width: 40px;
}

button {
    width: 100%;
    padding: 12px;
    background: black;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #333;
}
</style>
</head>

<body>

<div class="container">

    <h3>Credit Card Details</h3>

    <div class="payment-icons">
        <img src="https://img.icons8.com/color/48/mastercard-logo.png"/>
        <img src="https://img.icons8.com/color/48/visa.png"/>
        <img src="https://img.icons8.com/color/48/amex.png"/>
    </div>

    <!-- Card Info -->
    <div class="section">
        <div class="input-group">
            <label>Name on card</label>
            <input type="text" placeholder="Meet Patel">
        </div>

        <div class="input-group">
            <label>Card number</label>
            <input type="text" placeholder="0000 0000 0000 0000">
        </div>

        <div class="row">
            <div class="input-group">
                <label>Month</label>
                <select>
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
                <select id="year">
                    <option value="">Year</option>
                </select>
            </div>
        </div>

        <div class="input-group">
            <label>Card Security Code</label>
            <input type="text" placeholder="Code">
        </div>
    </div>

    <!-- Billing -->
    <div class="section">
        <h3>Billing Address</h3>

        <div class="input-group">
            <label>Country</label>
            <select>
                <option value="">Country</option>
                <option>Malaysia</option>
            </select>
        </div>

        <div class="input-group">
            <label>Address</label>
            <input type="text" placeholder="Address">
        </div>

        <div class="input-group">
            <label>City</label>
            <input type="text" placeholder="City">
        </div>

        <div class="input-group">
            <label>State</label>
            <input type="text" placeholder="State">
        </div>

        <div class="input-group">
            <label>ZIP CODE</label>
            <input type="text" placeholder="ZIP CODE">
        </div>
    </div>

    <!-- Contact -->
    <div class="section">
        <h3>Contact Information</h3>

        <div class="input-group">
            <label>Email</label>
            <input type="email" placeholder="Email">
        </div>

        <div class="input-group">
            <label>Phone</label>
            <input type="text" placeholder="Phone">
        </div>
    </div>

    <button>Pay</button>

</div>

</body>
<script>
const yearSelect = document.getElementById("year");

if (yearSelect) {
    const currentYear = new Date().getFullYear();

    for (let i = 0; i < 10; i++) {
        let year = currentYear + i;
        let option = document.createElement("option");
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
    }
}
</script>
</html>
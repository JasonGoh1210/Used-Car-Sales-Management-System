<?php
$price = $_GET['price'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout</title>
<link rel="stylesheet" href="../css/payment.css">
</head>

<body class="payment-page">

<div class="container">

<div class="page">

<div class="left">

<form action="payment.php" method="POST" enctype="multipart/form-data">

<div class="card">
<h3>Personal Information</h3>

<div class="row">
    <div class="input-group">
        <label>Name as per IC *</label>
        <input type="text" name="name" required placeholder="Enter your name">
    </div>

    <div class="input-group">
        <label>Nationality *</label>
        <select name="nationality" required>
            <option value="">Select Nationality</option>
            <option>Malaysia</option>
        </select>
    </div>
</div>

<div class="row">
    <div class="input-group">
        <label>IC Number *</label>
        <input type="text" name="ic" required placeholder="000000-00-0000"
        maxlength="14"
        pattern="\d{6}-\d{2}-\d{4}">
    </div>

    <div class="input-group">
        <label>Date of Birth *</label>
        <input type="date" name="dob" required>
    </div>
</div>

<div class="row">
    <div class="input-group">
        <label>Email *</label>
        <input type="email"
        name="email"
        required
        pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
        title="Only Gmail accounts are allowed">
    </div>

    <div class="input-group">
        <label>Mobile Number *</label>
        <input type="text"
        name="phone"
        required
        placeholder="+60123456789"
        pattern="^\+60[0-9]{8,10}$"
        title="Must start with +60 followed by 8-10 digits">

    </div>
</div>

<div class="input-group">
    <label>Address *</label>
<textarea name="address" required placeholder="Enter your address" class="fixed-textarea"></textarea>
</div>

<div class="row">
    <div class="input-group">
        <label>Postcode *</label>
        <input type="text" name="postcode" required>
    </div>

    <div class="input-group">
        <label>State *</label>
        <select name="state" required>
            <option value="">Select state</option>
            <option>Johor</option>
            <option>Kuala Lumpur</option>
            <option>Kedah</option>
            <option>Kelantan</option>
            <option>Melaka</option>
            <option>Negeri Sembilan</option>
            <option>Pahang</option>
            <option>Penang</option>
            <option>Perak</option>
            <option>Perlis</option>
            <option>Selangor</option>
            <option>Terengganu</option>
            <option>Sabah</option>
            <option>Sarawak</option>
        </select>
    </div>
</div>

<div class="input-group">
    <label>City *</label>
    <select name="city" required>
        <option value="">Select city</option>
        <option>Kuala Lumpur</option>
        <option>Johor Bahru</option>
        <option>Melaka City</option>
        <option>George Town</option>
        <option>Ipoh</option>
        <option>Alor Setar</option>
        <option>Kota Bharu</option>
        <option>Subang Jaya</option>
    </select>
</div>

</div>

<!-- Upload Section -->
<div class="card">
<h3>Additional Details (optional)</h3>

<div class="row">
    <div class="upload-box">
        <p>Photo of IC (Front)</p>
        <input type="file" name="ic_front">
    </div>

    <div class="upload-box">
        <p>Photo of IC (Back)</p>
        <input type="file" name="ic_back">
    </div>
</div>

<p class="note">
Please upload your documents:<br>
1. jpg, png or pdf<br>
2. smaller than 5MB<br>
3. clear and readable
</p>

</div>

<!-- Hidden price -->
<input type="hidden" name="price" value="<?php echo $price; ?>">

<button type="submit">Proceed to Payment</button>

</form>

</div>

</div>

</div>

<script>
document.querySelector('input[name="ic"]').addEventListener('input', function (e) {
    let value = e.target.value;

    value = value.replace(/\D/g, '');

    if (value.length > 6) {
        value = value.substring(0, 6) + '-' + value.substring(6);
    }
    if (value.length > 9) {
        value = value.substring(0, 9) + '-' + value.substring(9);
    }

    value = value.substring(0, 14);

    e.target.value = value;
});
</script>

<script>
document.querySelector('input[name="email"]').addEventListener('input', function (e) {
    let value = e.target.value;

    if (value && !value.endsWith('@gmail.com')) {
        e.target.setCustomValidity("Only Gmail emails are allowed (@gmail.com)");
    } else {
        e.target.setCustomValidity("");
    }
});
</script>

<script>
document.querySelector('input[name="phone"]').addEventListener('input', function (e) {
    let value = e.target.value;

    if (!value.startsWith('+60')) {
        value = '+60' + value.replace(/\D/g, '');
    } else {
        value = '+60' + value.substring(3).replace(/\D/g, '');
    }

    value = value.substring(0, 13);

    e.target.value = value;
});
</script>

</body>
</html>
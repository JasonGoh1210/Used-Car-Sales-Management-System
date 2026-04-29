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

<body>

<div class="container">

<div class="page">

<div class="left">

<form action="payment.php" method="POST" enctype="multipart/form-data">

<div class="card">
<h3>Personal Information</h3>

<div class="row">
    <div class="input-group">
        <label>Name as per NRIC/Passport *</label>
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
        <label>NRIC/Passport Number *</label>
        <input type="text" name="ic" required placeholder="901011-12-1234">
    </div>

    <div class="input-group">
        <label>Date of Birth *</label>
        <input type="date" name="dob" required>
    </div>
</div>

<div class="row">
    <div class="input-group">
        <label>Email *</label>
        <input type="email" name="email" required>
    </div>

    <div class="input-group">
        <label>Mobile Number *</label>
        <input type="text" name="phone" required>
    </div>
</div>

<div class="input-group">
    <label>Address *</label>
    <textarea name="address" required placeholder="Enter your address"></textarea>
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
            <option>Selangor</option>
            <option>Johor</option>
            <option>Melaka</option>
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

</body>
</html>
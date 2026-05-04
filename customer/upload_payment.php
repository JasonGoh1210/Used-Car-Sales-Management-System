 <?php
include("../config/db.php");

$booking_id = $_POST['booking_id'] ?? 0;
$price = $_POST['price'] ?? 0;

$receipt_name = $_FILES['receipt']['name'];
$tmp = $_FILES['receipt']['tmp_name'];
$size = $_FILES['receipt']['size'];

$folder = "../uploads/receipts/";
$new_name = time() . "_" . $receipt_name;
$path = $folder . $new_name;

$allowed = ['jpg','jpeg','png','pdf'];
$ext = strtolower(pathinfo($receipt_name, PATHINFO_EXTENSION));

if (!in_array($ext, $allowed)) {
    die("❌ Only JPG, PNG, PDF allowed");
}

if ($size > 5 * 1024 * 1024) {
    die("❌ File too large (max 5MB)");
}

if (move_uploaded_file($tmp, $path)) {

    $sql = "INSERT INTO deposit (booking_id, deposit_amount, deposit_receipt, deposit_status)
            VALUES ('$booking_id', '$price', '$new_name', 'Pending')";

    if (mysqli_query($conn, $sql)) {

        header("Location: bill.php?status=success&amount=$price");
        exit();

    } else {
        echo "❌ Database error: " . mysqli_error($conn);
    }

} else {
    echo "❌ Upload failed";
}
?>
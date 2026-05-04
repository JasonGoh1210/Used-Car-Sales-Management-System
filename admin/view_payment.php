<?php
include("../database/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Payment</title>
<link rel="stylesheet" href="../css/payment.css">
</head>

<body class="admin-page">

<h2>Payment Records</h2>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Amount</th>
<th>Status</th>
<th>Date</th>
<th>Receipt</th>
</tr>

<?php

$sql = "SELECT * FROM transaction_record ORDER BY transaction_id DESC";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['transaction_id']; ?></td>

<td><?php echo $row['card_name']; ?></td>

<td>RM <?php echo $row['amount']; ?></td>

<td class="<?php echo ($row['payment_status'] == 'Paid') ? 'paid' : 'fail'; ?>">
    <?php echo $row['payment_status']; ?>
</td>

<td><?php echo $row['transaction_date']; ?></td>

<td>
<?php if(!empty($row['receipt'])){ ?>
    <a href="../uploads/<?php echo $row['receipt']; ?>" target="_blank">
        View
    </a>
<?php } else { ?>
    No File
<?php } ?>
</td>

</tr>

<?php } ?>

</table>

</body>
</html>
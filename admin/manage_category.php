<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

include('../config/db.php');

$result = mysqli_query($conn, "SELECT * FROM category");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Category</title>
    <link rel="stylesheet" href="../css/admin_style.css">

    <!-- ICON -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
<?php include('admin_layout.php'); ?>

<!-- CONTENT -->
<div class="content" id="content">

    <div class="page-header">
        <h2>Manage Category</h2>
        <a href="add_category.php" class="btn">+ Add Category</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Status</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['category_id']; ?></td>
            <td><?php echo $row['category_name']; ?></td>

            <td>
                <?php if(isset($row['category_status']) && $row['category_status'] == 'Active') { ?>
                    <a href="update_category_status.php?id=<?php echo $row['category_id']; ?>&status=Inactive"
                       class="edit-btn"
                       onclick="return confirm('Change to Inactive?');">
                       Active
                    </a>
                <?php } else { ?>
                    <a href="update_category_status.php?id=<?php echo $row['category_id']; ?>&status=Active"
                       class="delete-btn"
                       onclick="return confirm('Change to Active?');">
                       Inactive
                    </a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>
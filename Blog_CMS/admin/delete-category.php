<?php
include 'config.php';

$_SERVER['PHP_SELF'];
$cid = $_GET['id'];

$sql = "DELETE FROM category WHERE category_id = {$cid}";
if (mysqli_query($conn, $sql)) {
    header("Location: {$path}/admin/category.php");
} else {
    echo "Deletion Failed!!" . mysqli_error($conn);
}

mysqli_close($conn);
?>
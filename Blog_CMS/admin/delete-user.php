<?php

include 'config.php';

$_SERVER['PHP_SELF'];
$uid = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id = '{$uid}'";
if (mysqli_query($conn,  $sql)) {
    header("Location: {$path}/admin/users.php");
} else {
    echo "Deletion Failed!!" . mysqli_error($conn);
}

mysqli_close($conn);
?>
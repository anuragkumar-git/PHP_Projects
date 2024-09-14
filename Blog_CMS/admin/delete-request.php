<?php

include 'config.php';

$_SERVER['PHP_SELF'];
$rqid = $_GET['rqid'];

$sql = "DELETE FROM requests WHERE rq_id = '{$rqid}'";
if (mysqli_query($conn,  $sql)) {
    header("Location: {$path}/admin/requests.php");
} else {
    echo "Deletion Failed!!" . mysqli_error($conn);
}

mysqli_close($conn);
?>
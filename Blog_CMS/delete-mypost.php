<?php

include 'config.php';


$_SERVER['PHP_SELF'];
$post_id = $_GET['postid'];
$cat_id = $_GET['catid'];

$sql1 = "SELECT * FROM post WHERE post_id = {$post_id}";
$result = mysqli_query($conn, $sql1) or die ("Query failed..");
$row = mysqli_fetch_assoc($result) ;

unlink("uploaded/".$row['post_img']);

$sql = "DELETE FROM post WHERE post_id = {$post_id};";
$sql .= "UPDATE category SET post = post-1 WHERE category_id = {$cat_id}";
if (mysqli_multi_query($conn, $sql)) {
    header("Location: {$path}/mypost.php");
} else {
    echo "opration failed" . mysqli_error($conn);
}

mysqli_close($conn);
?>
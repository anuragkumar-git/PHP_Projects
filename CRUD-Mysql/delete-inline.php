<?php
include 'connect.php';

$s_id = $_GET['id'];
$sql = "DELETE FROM student WHERE sid= {$s_id}";
$result = mysqli_query($conn, $sql) or die("Failed!!");

header("Location:index.php");
mysqli_close($conn);
?>
<?php
include 'connect.php';

$s_id = $_POST['sid'];
$s_name = $_POST['sname'];
$s_address = $_POST['saddress'];
$s_class = $_POST['sclass'];
$s_phone = $_POST['sphone'];

$sql = "UPDATE student SET sname = '{$s_name}', saddress ='{$s_address}', sclass ='{$s_class}', sphone = '{$s_phone}' WHERE sid = '{$s_id}' ";
$result = mysqli_query($conn, $sql);

header("Location:index.php");



mysqli_close($conn);
?>
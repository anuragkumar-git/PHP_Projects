<?php

include 'connect.php';

$s_name = $_POST['sname'];
$s_address = $_POST['saddress'];
$s_class = $_POST['class'];
$s_phone = $_POST['sphone'];

$sql = "INSERT INTO student(sname, saddress, sclass, sphone) VALUES ('{$s_name}', '{$s_address}', '{$s_class}', '{$s_phone}')";
$result = mysqli_query($conn, $sql);

header("Location:index.php");

mysqli_close($conn);
?>
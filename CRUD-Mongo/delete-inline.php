<?php
include 'config.php';

$id = $_GET['id'];

$oid =  new MongoDB\BSON\ObjectId($id);
$db->user->deleteOne(['_id' => $oid]);

header("Location:index.php");
?>
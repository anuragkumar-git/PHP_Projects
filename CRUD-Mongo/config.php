<?php 
    require 'vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    $db = $conn->mongocrud;
?>
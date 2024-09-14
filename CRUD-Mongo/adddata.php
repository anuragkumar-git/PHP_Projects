<?php
include 'config.php';

if ($_POST) {

    if (isset($_POST['name'])) {
        $rec['name'] = $_POST['name'];
    }
    if (isset($_POST['email'])) {
        $rec['email'] = $_POST['email'];
    }

    if (!empty($rec)) {
        $db->user->insertOne($rec);
        header("Location:index.php");
    } else {
        echo "No valid data to insert.";
    }
}

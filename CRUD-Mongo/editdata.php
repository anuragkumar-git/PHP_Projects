<?php
include 'config.php';

use MongoDB\BSON\ObjectId;
// print_r($_POST);

if ($_POST) {

    $id = new ObjectId($_POST['id']);
    // $db->user->updateOne(['_id' => $id],['$set'=>['name' => $_POST['name'], 'email' => $_POST['email']]]);
    $db->user->updateOne(
        ['_id' => $id],
        [
            '$set' => [
                'name' => $_POST['name'],
                'email' => $_POST['email']
            ]
        ]
    );

    // exit;
    header('Location:index.php');
}

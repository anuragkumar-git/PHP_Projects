<?php

include 'config.php';

$_SERVER['PHP_SELF'];
$rqid = $_GET['rqid'];
$sql = "INSERT INTO user (first_name, email, username, password, role)
SELECT name, email, username, password, role
FROM requests
WHERE rq_id = {$rqid};";

$sql .= "DELETE FROM requests
WHERE rq_id = {$rqid}";

$resul = mysqli_multi_query($conn, $sql);

$to = "SELECT * FROM `user` ORDER BY `user_id` DESC LIMIT 0,1;";
$res = mysqli_query($conn, $to);
$rs = mysqli_fetch_assoc($res);
$fnam = $rs['first_name'];
$email = $rs['email'];
$user = $rs['username'];
$sub = "Welcome.. $fnam";
$msg = "Congratulations.../n your ID: $user now you can contribute at Blog CMS";
$headers = "From: patelanurag3971@gmail.com";

$mail = mail($to, $sub, $msg, $headers);
if ($mail) {
    header("Location: {$path}/admin/requests.php");
} else {
    echo "<h2>User not added</h2>";
}

mysqli_close($conn);

<?php
session_name('blog_session');
session_start();
if (!isset($_SESSION['blog_session']["u_name"])) {
    header("Location:index.php");
}


include 'config.php';
if (isset($_FILES['fileToUpload'])) {
    $f_name = $_FILES['fileToUpload']['name'];
    $f_size = $_FILES['fileToUpload']['size'];
    $f_temp = $_FILES['fileToUpload']['tmp_name'];
    $f_type = $_FILES['fileToUpload']['type'];
    $f_ext = strtolower(pathinfo($f_name, PATHINFO_EXTENSION));

    $extention = ["jpeg", "jpg", "png"];
    $error = false;

    if (!in_array($f_ext, $extention)) {
        $_SESSION['flash_message'] = "Please Upload 'jpg' or 'png' File..";
        header("Location:add-mypost.php ");
        $error = true;
        exit();
    }

    if ($f_size > 2097152) {
        $_SESSION['flash_message'] = "please Upload file less then 2Mb";
        header("Location:add-mypost.php ");
        $error = true;
        exit();
    }

    if ($error == false) {
        move_uploaded_file($f_temp, "admin/uploaded/" . $f_name);
        // header("Location: http://localhost/PHP_Projects/Blog_CMS/mypost.php ");
    } else {
        $_SESSION['flash_message'] = "Failed to Add new post...";
        header("Location:add-mypost.php");
        exit();
    }
}


$p_title = mysqli_real_escape_string($conn, $_POST['post_title']);
$p_decs = mysqli_real_escape_string($conn, $_POST['postdesc']);
$p_cat = mysqli_real_escape_string($conn, $_POST['category']);
$p_date = date("Y-m-d");
$p_athor = $_SESSION['blog_session']["u_id"];
$author_mail = $_SESSION['blog_session']["email"];


$sql = "INSERT INTO post(title, description, category, post_date, author, post_img) VALUES ('{$p_title}', '{$p_decs}', {$p_cat}, '{$p_date}', {$p_athor}, '{$f_name}');";
$sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$p_cat}; ";

$to = "$author_mail"; //"anuraggkumaar@gmail.com"; fatch from user mail
$subject = "About your post";
$txt = "Thanks for updating a post on". $p_title." in". $p_cat." on". $p_date ;
$headers = "From: patelanurag3971@gmail.com";
// echo "mail($to,$subject,$txt,$headers)";
// exit;
if (mysqli_multi_query($conn, $sql) && mail($to,$subject,$txt,$headers)) {


    header("Location:mypost.php");
    exit();
} else {
    echo "Query went wrong!!." . mysqli_error($conn) . $sql;
}
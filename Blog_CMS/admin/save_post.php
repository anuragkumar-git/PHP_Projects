<?php
session_name('admin_session');
session_start();

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
        header("Location: http://localhost/PHP_Projects/Blog_CMS/admin/add-post.php ");
        $error = true;
        exit();

    }

    if ($f_size > 2097152) {
        $_SESSION['flash_message'] = "please Upload file less then 2Mb";
        header("Location: http://localhost/PHP_Projects/Blog_CMS/admin/add-post.php ");      
        $error = true;
        exit(); 
    }

    if ($error == false) {
        move_uploaded_file($f_temp, "uploaded/" . $f_name);
        header("Location: http://localhost/PHP_Projects/Blog_CMS/admin/post.php ");      
    } else {
        $_SESSION['flash_message'] = "Failed to Add new post...";
        header("Location: http://localhost/PHP_Projects/Blog_CMS/admin/add-post.php");
        exit();
    }
}


$p_title = mysqli_real_escape_string($conn, $_POST['post_title']);
$p_decs = mysqli_real_escape_string($conn, $_POST['postdesc']);
$p_cat = mysqli_real_escape_string($conn, $_POST['category']);
$p_date = date("Y-m-d");
$p_athor = $_SESSION['admin']["user_id"];

$sql = "INSERT INTO post(title, description, category, post_date, author, post_img) VALUES ('{$p_title}', '{$p_decs}', {$p_cat}, '{$p_date}', {$p_athor}, '{$f_name}');";
$sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$p_cat}; ";

if (mysqli_multi_query($conn, $sql)) {
    header("Location: http://localhost/PHP_Projects/Blog_CMS/admin/post.php");
    exit();
} else {
    echo "Query went wrong!!.". mysqli_error($conn).$sql;
}
?>
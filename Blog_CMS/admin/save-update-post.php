<?php
include 'config.php';

session_name('admin_session');
session_start(); // Make sure to start the session

if (empty($_FILES['new-image']['name'])) {
    // No new image uploaded, keep the old image
    $f_name = $_POST['old-image'];
} else {
    // New image is uploaded
    $f_name = $_FILES['new-image']['name'];
    $f_size = $_FILES['new-image']['size'];
    $f_tmp_name = $_FILES['new-image']['tmp_name'];
    $f_ext = strtolower(pathinfo($f_name, PATHINFO_EXTENSION));
    $extensions = ["jpeg", "jpg", "png"];
    $error = false;

    // Check file extension
    if (!in_array($f_ext, $extensions)) {
        $_SESSION['flash_message'] = "Please upload jpeg, jpg, or png";
        $error = true;
    }

    // Check file size
    if ($f_size > 2097152) {
        $_SESSION['flash_message'] = "Please upload a file less than 2MB";
        $error = true;
    }

    // Handle file upload if no errors
    if ($error == false) {
        // Optionally make the file name unique to avoid overwriting
        $f_name = time() . "_" . $f_name;
        move_uploaded_file($f_tmp_name, "uploaded/" . $f_name);
    } else {
        // Redirect with error message
        header("Location: http://localhost/PHP_Projects/Blog_CMS/admin/update-post.php");
        exit();
    }
}

// Escape user inputs for security
$p_title = mysqli_real_escape_string($conn, $_POST['post_title']);
$p_desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
$p_cat = mysqli_real_escape_string($conn, $_POST['category']);
$p_date = date("Y-m-d");

// Update the post in the database
$sql = "UPDATE post SET 
            title = '{$p_title}', 
            description = '{$p_desc}', 
            category = {$p_cat}, 
            post_date = '{$p_date}', 
            post_img = '{$f_name}' 
        WHERE post_id = {$_POST['post_id']};";

if ($_POST['old-category'] != $_POST['category']) {
    $sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$_POST['old-category']};";
    $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$_POST['category']}";
}

if (mysqli_multi_query($conn, $sql)) {
    // Redirect to posts page on success
    header("Location: http://localhost/PHP_Projects/Blog_CMS/admin/post.php");
} else {
    // Output error message if query fails
    echo "Query failed: " . mysqli_error($conn);
}

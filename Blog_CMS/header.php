<?php
// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
include 'config.php';
$currentPage = basename($_SERVER['PHP_SELF']);
switch ($currentPage) {
    case 'category.php':
        if (isset($_GET['id'])) {
            $sql_title = "SELECT category_name FROM category WHERE category_id = {$_GET['id']}";
            $result_title = mysqli_query($conn, $sql_title);
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title =  $row_title['category_name'];
        } else  $page_title = "No Post Found";
        break;

    case 'author.php':
        if (isset($_GET['id'])) {
            $sql_title = "SELECT first_name FROM user WHERE user_id = {$_GET['id']}";
            $result_title = mysqli_query($conn, $sql_title);
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['first_name'];
        } else  $page_title = "No Post Found";
        break;

    case 'single.php':
        if (isset($_GET['id'])) {
            $sql_title = "SELECT title FROM post WHERE post_id = {$_GET['id']}";
            $result_title = mysqli_query($conn, $sql_title);
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['title'];
        } else  $page_title = "No Post Found";
        break;

    case 'search.php':
        if (isset($_GET['search'])) {
            $page_title = "Search";
        }
        break;

    default:
        $page_title = "BLOG CMS";
        break;
}


session_name('blog_session');
session_start();
// Get the current script name to determine which page is active
$cat_id = isset($_GET['id']) ? intval($_GET['id']) : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="x-icon" href="images/b2.png">
    <title><?php echo $page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header-admin">
        <div class="container">
            <div class="row">
                <?php if (!isset($_SESSION['blog_session']["u_name"])) { ?>
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/blog.png">
                    </div>
                    <div class="col-md-offset-2 col-md-2">
                        <p class="admin-logout"></p><br>
                        <a href="blog-signup.php" class="admin-logout">Sign Up</a>
                    </div>
                <?php } else { ?>
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/blog.png">
                    </div>
                    <div class="col-md-offset-2 col-md-2">
                        <p class="admin-logout">Hello, <?php echo htmlspecialchars($_SESSION['blog_session']["u_name"]); ?></p><br>
                        <a href="blog-logout.php" class="admin-logout">Logout</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- /HEADER -->

    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    include 'config.php';

                    $sql = "SELECT * FROM category WHERE post > 0";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        echo "<ul class='menu'>";
                        if (!isset($_SESSION['blog_session']["u_name"])) {
                            echo "<li><a href='blog-login.php'>Login</a></li>";
                        } else {
                            // Active class for "My Posts"
                            $mypostsActive = ($currentPage == 'mypost.php') ? 'active' : '';
                            echo "<li><a class='{$mypostsActive}' href='mypost.php'>My Posts</a></li>";
                        }

                        // Active class for "Home"
                        // $homeActive = ($currentPage == 'index.php') ? 'active' : '';
                        // echo "<li><a class='{$homeActive}' href='{$path}'>Home</a></li>";
                        echo "<li><a href='{$path}'>Home</a></li>";

                        // Loop through categories and add active class if category is selected
                        while ($row = mysqli_fetch_assoc($result)) {
                            $active = ($row['category_id'] == $cat_id) ? 'active' : '';
                            echo "<li><a class='{$active}' href='category.php?id={$row['category_id']}'>{$row['category_name']}</a></li>";
                        }

                        echo "</ul>";
                    } else {
                        if (!isset($_SESSION['blog_session']["u_name"])) {
                            echo "<ul class='menu'>";
                            echo "<li><a href='blog-login.php'>Login</a></li>";
                            echo "<li><a href='{$path}'>Home</a></li>";
                            echo "</ul>";
                        }else{
                            echo "<ul class='menu'>";
                            echo "<li><a href='add-mypost.php'>Add post</a></li>";
                            echo "<li><a href='{$path}'>Home</a></li>";
                            echo "</ul>";

                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->
</body>

</html>
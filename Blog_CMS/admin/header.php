
<?php
include 'config.php';
session_name('admin_session');
session_start();
// print_r($_SESSION);
if (!isset($_SESSION['admin']["user_name"])) {
    header("Location: http://localhost/PHP_Projects/Blog_CMS/admin/");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="x-icon" href="images/b3.png">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ADMIN Panel</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header-admin">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-offset-1 col-md-4">
                    <a href="post.php"><img class="logo" src="images/blog.png"></a>
                </div>
                <!-- /LOGO -->
                
                <div class="col-md-offset-4  col-md-3">
                    <!-- /Display-USERNAME -->
                    <p class="admin-logout">Hello, <?php echo $_SESSION['admin']["user_name"];?></p><br>
                    <!-- LOGO-Out -->
                    <a href="logout.php" class="admin-logout">logout</a>
                </div>
                <!-- /LOGO-Out -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="admin-menubar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="admin-menu">
                        <li>
                            <a href="post.php">Post</a>
                        </li>
                        <?php
                        // if ($_SESSION['admin']["user_role"] == '1') {
                        ?>
                            <li>
                                <a href="category.php">Category</a>
                            </li>
                            <li>
                                <a href="users.php">Users</a>
                            </li>
                            <li>
                                <a href="requests.php">Requests</a>
                            </li>
                        <?php //}  ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->
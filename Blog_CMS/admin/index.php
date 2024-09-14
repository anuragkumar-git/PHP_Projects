<?php //securing the page not working 
// echo $_SERVER['DOCUMENT_ROOT'].'/PHP_Projects/Blog_CMS/admin/session';exit;
include 'config.php';
// ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT'])));
// Set the session save path to a specific folder
// $sessionSavePath = realpath(__DIR__ . '/admin/session');

// // Ensure the path exists and is writable
// if ($sessionSavePath !== false && is_dir($sessionSavePath) && is_writable($sessionSavePath)) {
//     ini_set('session.save_path', $sessionSavePath);
// } else {
//     // Handle the error, e.g., log it or show an error message
//     error_log('Invalid session save path: ' . $sessionSavePath);
// }
session_name('admin_session');
session_start();
// print_r($_SESSION);

if (isset($_SESSION['admin']["user_name"])) {
    header("Location: http://localhost/PHP_Projects/Blog_CMS/admin/post.php");
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="x-icon" href="images/b3.png">
    <title>ADMIN | Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <img class="logo" src="images/blog1.png">
                    <h3 class="heading">Admin</h3>
                    <!-- Form Start -->
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="" required>
                        </div>
                        <input type="submit" name="login" class="btn btn-primary" value="login" />
                    </form>
                    <!-- /Form  End -->
                    <?php
                    if (isset($_POST['login'])) {

                        include 'config.php';

                        $unam = mysqli_real_escape_string($conn, $_POST['username']);
                        $pass = md5($_POST['password']);

                        $sql = "SELECT user_id, username, role FROM user WHERE username = '{$unam}' AND password = '{$pass}' AND role = 1 ";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {


 /* $web  = 0/false;
session start()
$web =1/true;

if(isset($_SESSION["user_name"]) && $web == 1/true ){
    code.....
}

session destroy()
$web = 0/false;
*/

                                // session_start();
                                $_SESSION['admin']["admin_login"] = 1;
                                $_SESSION['admin']["user_name"] = $row['username'];
                                $_SESSION['admin']["user_id"] = $row['user_id'];
                                $_SESSION['admin']["user_role"] = $row['role'];
                                header("Location: {$path}/admin/post.php");
                            }
                        } else {
                            echo '<div class=" alert alert-danger">Login failed!!</div>';
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
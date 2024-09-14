<?php //securing the page not working 
include 'config.php';
session_name('blog_session');
session_start();
// print_r($_SESSION);
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="x-icon" href="images/b2.png">
    <title>Login</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="wrapper-web" class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <a href="index.php"><img class="logo" src="images/blog1.png"></a>
                    <h3 class="heading">User</h3>
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

                        <input type="submit" name="login" class="btn btn-primary" value="login">

                        <div class="col">
                            <a  id = "forgotpass" name = "forgotpass" shift-right href="forgotpass.php" style="color: blue;">Forgot Password</a>
                        </div>

                    </form>
                    <!-- /Form  End -->
                    <?php
                    if (isset($_POST['login'])) {

                        $unam = mysqli_real_escape_string($conn, $_POST['username']);
                        $pass = md5($_POST['password']);

                        $sql = "SELECT user_id, email,  username, role FROM user WHERE username = '{$unam}' AND password = '{$pass}' ";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                                // session_start();
                                $_SESSION['blog_session']["u_name"] = $row['username'];
                                $_SESSION['blog_session']["u_id"] = $row['user_id'];
                                $_SESSION['blog_session']["u_role"] = $row['role'];
                                $_SESSION['blog_session']["email"] = $row['email'];
                                $_SESSION['blog_session']["website_login"] = 1;
                                header("Location: {$path}/index.php");
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
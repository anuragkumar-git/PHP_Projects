<?php
include 'config.php';
session_name('OTP');
session_start();
print_r($_SESSION);
echo '<button><a href="terminate.php">terminate</a></button>';
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <a href="index.php"><img class="logo" src="images/blog1.png"></a>
                    <h3 class="heading">Reset Password</h3>
                    <!-- Form Start -->
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="<?php echo $_SESSION['OTP']['u_name']; ?>">
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="text" name="password" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="text" name="cpassword" class="form-control" placeholder="" required>
                        </div>
                        <?php
                        if (isset($_SESSION['OTP']['passnotmatched'])) {
                            echo "<div class='alert alert-danger' role='alert'>";
                            echo $_SESSION['OTP']['passnotmatched'];
                            echo "</div>";
                            unset($_SESSION['OTP']['passnotmatched']);
                        }
                        ?>
                        <input type="submit" name="resetpassword" class="btn btn-primary" value="Reset Password">
                    </form>
                    <?php
                    if (isset($_POST['resetpassword'])) {
                        // $_SESSION['OTP']['password'] = $_POST['password'];
                        $pass = md5($_POST['password']);
                        $cpass = md5($_POST['cpassword']);

                        if ($pass == $cpass) {
                            echo $pass, $cpass;
                            $sql = "UPDATE user SET password = '{$pass}' WHERE username = '{$_SESSION['OTP']['u_name']}'";
                            echo $sql;
                            $query = mysqli_query($conn, $sql);
                            $to = $_SESSION['OTP']['email'];
                            $sub = 'Password changed';
                            $msg = 'Your Password has been changed';
                            $headers = 'From: patelanurag3971@gmail.com';
                            $mail = mail($to, $sub, $msg, $headers);
                            if ($query && $mail) {
                                header("Location:blog-login.php");
                            } elseif (!$query) {
                                echo "query failed";
                            } elseif (!$mail) {
                                echo "mailfailed";
                            } elseif (!$query && !$mail) {
                                echo "both faild";
                            }
                        } else {
                            $_SESSION['OTP']['passnotmatched'] = "Passwords didn't Matched";
                            // echo $pass, $cpass . "check pass";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</body>
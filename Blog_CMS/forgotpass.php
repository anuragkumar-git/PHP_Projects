<?php
include 'config.php';
session_name('OTP');
session_start();
print_r($_SESSION);
echo'<button><a href="terminate.php">terminate</a></button>';
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="x-icon" href="images/b2.png">
    <title>Recover Password</title>
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
                    <h3 class="heading">Recover Password</h3>
                    <!-- Form Start -->
                    <?php if (!isset($_POST['sendotp'])) {   ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="sendotp" class="btn btn-primary" value="Send OTP">
                            <?php
                            // $uname = $_POST['user_name'];
                            // $sql = "SELECT * FROM user WHERE username = '{$uname}' ";
                            // $result = mysqli_query($conn, $sql);
                            // if (mysqli_num_rows($result) > 0) {
                            //     echo '<input type="submit" name="sendotp" class="btn btn-primary" value="Send OTP">';
                            // }else{
                            // echo "Username Doesn't Exists";}
                            ?>
                        </form>
                    <?php } ?>

                    <!-- /Form  End -->
                    <!-- Form Start -->
                    <?php
                    if (isset($_POST['sendotp'])) {
                    ?>
                        <form action="reset.php" method="POST">
                            <div class="form-group">
                                <label>Username</label><!--fetch -->
                                <span name="username" class="form-control" placeholder=""><?php echo $_POST['username']; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Enter OTP</label><br>
                                <span>Check Your Registerd Email</span>
                                <input type="text" name="enterotp" class="form-control" placeholder="" required></input>
                            </div>
                            <input type="submit" name="submitotp" class="btn btn-primary" value="Submit OTP">
                            <!-- <span>countdown</span> -->

                        <?php
                        $unam = mysqli_real_escape_string($conn, $_POST['username']);
                        //     $pass = md5($_POST['password']);

                        $sql1 = "SELECT username, email FROM user WHERE username = '{$unam}' ";
                        // echo $sql; 
                        // echo "<br>";
                        $result1 = mysqli_query($conn, $sql1);
                        if (mysqli_num_rows($result1) > 0) {
                            while ($row = mysqli_fetch_assoc($result1)) {
                                // print_r($row);
                                $_SESSION['OTP']['u_name'] = $row['username'];
                                $_SESSION['OTP']['email'] = $row['email'];
                                //Generating otp
                                $otp = random_int(10000, 99999);
                                echo $otp; 
                                // echo '<br>';

                                //Mail
                                $to = $row['email'];
                                $sub = "OTP";
                                $msg = "Your OTP is: " . $otp;
                                $headers = "From: patelanurag3971@gmail.com";
                                mail($to, $sub, $msg, $headers);
                            }
                        } else {
                            echo "User doesn't exsists";
                        }
                        // exit;
                    }
                        ?>
                        </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
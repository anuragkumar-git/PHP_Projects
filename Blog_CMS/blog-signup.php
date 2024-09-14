<?php //securing the page not working 
include 'config.php';
session_name('blog_session');
session_start();
// print_r($_SESSION);
if (isset($_POST['signup'])) {
    include "config.php";

    $fnam = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    // $role = mysqli_real_escape_string($conn, $_POST['role']);


    $sql = "SELECT username, email FROM user WHERE username = '{$user}' AND email = '{$email}' ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "User name already exsist..";
    } else {
        $sql1 = "INSERT INTO requests ( name, email, username, password, role) VALUES ('{$fnam}', '{$email}', '{$user}', '{$pass}', '0')";

        // $urole = $_POST['role'] . "<br>";
        $password = ($_POST['password']);

        $to = "$email";
        $sub = "Hello.. $fnam";
        $msg = "Your request is being processing";
        $headers = "From: patelanurag3971@gmail.com";

        // exit;
        $mail = mail($to, $sub, $msg, $headers);
        if (mysqli_query($conn, $sql1) && $mail) {

            header("Location:index.php");
        } else {
            echo "<h2>User not added</h2>";
        }
    }
}

?>


<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="x-icon" href="images/b2.png">
    <title>Sign Up</title>
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
                    <h3 class="heading">Sign Up</h3>
                    <!-- Form Start -->
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="fullname" class="form-control" placeholder="First Name Last Name" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <input type="submit" name="signup" class="btn btn-primary" value="Request" />
                    </form>
                    <!-- /Form  End -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>
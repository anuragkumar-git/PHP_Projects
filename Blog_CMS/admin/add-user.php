 <?php
    include "header.php";
    // if($_SESSION['admin']["user_role"] == '0'){
    //     header("Location: {$path}/admin/post.php");
    // }

    if (isset($_POST['save'])) {
        include "config.php";

        $fnam = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $role = mysqli_real_escape_string($conn, $_POST['role']);


        $sql = "SELECT username FROM user WHERE username = '{$user}' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "User name already exsist..";
        } else {
            $sql1 = "INSERT INTO user (first_name, email, username, password, role) VALUES ('{$fnam}', '{$email}', '{$user}', '{$pass}', '{$role}')";

            $urole = $_POST['role'] . "<br>";
            $password = ($_POST['password']);
            
            $to = "$email";
            $sub = "Welcome.. $fnam";
            if ($urole == 1) {
                $msg = "Congratulations.. you are admin now. Your ID: $user and Password: $password";
            } else {
                $msg = "Congratulations.. your ID: $user and Password: $password now you can contribute at Blog CMS";
            }
            $headers = "From: patelanurag3971@gmail.com";

            // exit;
            $mail = mail($to, $sub, $msg, $headers);
            if (mysqli_query($conn, $sql1) && $mail) {
                header("Location: {$path}/admin/users.php");
            } else {
                echo "<h2>User not added</h2>";
            }
        }
    }

    ?>
 <div id="admin-content">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="heading">Add User</h1>
             </div>
             <div class="col-md-offset-3 col-md-6">
                 <!-- Form Start -->

                 <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                     <div class="form-group">
                         <label>Name</label>
                         <input type="text" name="fullname" class="form-control" placeholder="First Name Last Name" required>
                     </div>
                     <div class="form-group">
                         <label>Email</label>
                         <input type="email" name="email" class="form-control" placeholder="Email" required>
                     </div>
                     <div class="form-group">
                         <label>User Name</label>
                         <input type="text" name="user" class="form-control" placeholder="Username" required>
                     </div>

                     <div class="form-group">
                         <label>Password</label>
                         <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <div class="form-group">
                         <label>User Role</label>
                         <select class="form-control" name="role">
                             <option value="0">Normal User</option>
                             <option value="1">Admin</option>
                         </select>
                     </div>
                     <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                 </form>
                 <!-- Form End-->
             </div>
         </div>
     </div>
 </div>
 <?php include "footer.php"; ?>
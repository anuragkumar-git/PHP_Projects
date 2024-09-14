<?php 
include 'header.php';
include 'config.php';

if($_SESSION['admin']["user_role"] == '0'){
    header("Location: {$path}/admin/post.php");
 }

if (isset($_POST['update'])) {
    $uid = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fnam = mysqli_real_escape_string($conn, $_POST['f_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    //$pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "UPDATE user SET first_name = '{$fnam}', email = '{$email}', username='{$user}', password = '{$pass}', role= '{$role}' WHERE user_id = '{$uid}'";
   
    // $pass = $_POST['password'];
    // $urole = $_POST['role'];
    // $to = "$email";
    // $sub = "About you";
    // if ($urole == 1) {
    //     $msg = "Congratulations.. $user, you are admin now.";
    // } else {
    //     $msg = "Hey there $user, Your ID: $user and Password: $password now you can contribute at Blog CMS";
    // }
    // $headers = "From: patelanurag3971@gmail.com";
    // $mail = mail($to, $sub, $msg, $headers);

    if (mysqli_query($conn, $sql)) {
        header("Location: {$path}/admin/users.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php
                $uid = $_GET['id'];
                $sql = "SELECT * FROM user WHERE user_id={$uid}";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" required>
                    </div>
                    <!-- <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="<?php // echo $row['password']; ?>" required>
                    </div> -->
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0" <?php echo ($row['role'] == 0) ? 'selected' : ''; ?>>User</option>
                            <option value="1" <?php echo ($row['role'] == 1) ? 'selected' : ''; ?>>Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="update" class="btn btn-primary" value="Update" />
                </form>
                <?php
                    }
                }
                ?>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

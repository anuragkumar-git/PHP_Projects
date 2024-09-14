<?php
include "header.php";
include "config.php";

if($_SESSION['admin']["user_role"] == '0'){
    header("Location: {$path}/admin/post.php");
 }

if (isset($_POST['update'])) {
    $uid = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $snam = mysqli_real_escape_string($conn, $_POST['cat_name']);
    // $post =mysqli_real_escape_string($conn, $_POST['post']);

    $sql1 = "UPDATE category SET category_name = '{$snam}' WHERE category_id ='{$uid}'";
    if (mysqli_query($conn, $sql1)) {
        header("Location: {$path}/admin/category.php");
    } else {
        echo "Updation Failed.." . mysqli_error($conn);
    }
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">

                <?php
                $uid = $_GET['id'];
                $sql = "SELECT * FROM category WHERE category_id={$uid}";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="cat_id" class="form-control" value="<?php echo $uid ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>" required>
                            </div>
 
                            <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                        </form>
                <?php
                    }
                }

                ?>

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
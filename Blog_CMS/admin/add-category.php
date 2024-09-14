<?php
include "header.php";
include "config.php";

if($_SESSION['admin']["user_role"] == '0'){
    header("Location:post.php");
 }

if(isset($_POST['save'])){
    $uid = mysqli_real_escape_string($conn,$_POST['cat']);
    // $post =mysqli_real_escape_string($conn, $_POST['post']);

    $sql = "INSERT INTO category (category_name) VALUES ('{$uid}')";
    if(mysqli_query($conn, $sql)){
        header("Location:category.php");
    }else{echo "
        Adition Failed!!". mysqli_error($conn);}
    
        mysqli_close($conn);}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->


                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat" class="form-control" placeholder="Category Name" required>    
                    </div>
                    
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>


                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
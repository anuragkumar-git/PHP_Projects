<?php
include 'header.php';
include 'config.php';

// session_start();
if (!isset($_SESSION['blog_session']["u_name"])) {
    header("Location:index.php");
}

// echo "<pre>";
// print_r($_SESSION['blog_session']);
// echo "</pre>";
// echo "<br>";
if ($_SESSION['blog_session']['u_role'] == 0 || 1) {
    $postid = $_GET['postid'];
    $sql2 = "SELECT author FROM post WHERE post_id = {$postid}";
    // echo $sql2;
    // echo "<br>";
    // exit;
    $resql = mysqli_query($conn, $sql2);
    // echo "<pre>";
    // print_r($resql);
    // echo "</pre>";
    // echo "<br>";
    // exit;
    $row2 = mysqli_fetch_assoc($resql);
    // echo "<pre>";
    // print_r($row2);
    // echo "</pre>";
    // echo "<br>";
    // exit;

    if ($row2['author'] != $_SESSION['blog_session']['u_id']) {
        // $_SESSION['accessDenied'] = "Access Denied";
        // $_SESSION['accessDenied'] = "<div class='alert alert-danger'>Access Denied</div>";
        header("Location:mypost.php");
       
    }
}
?>

<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2 class="heading">Update Post</h2>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->
                <?php
                $pid = $_GET['postid'];
                //$sqlo = "SELECT * FROM post WHERE post_id = {$pid}";

                $sql = "SELECT  post.post_id, post.title, post.description, post.post_img, post.category,  category.category_name FROM post 
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id WHERE post_id={$pid}";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>

                        <form class="post-container" action="save-update-mypost.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="post_id" class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="post_title">Title</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDescription"> Description</label>
                                <textarea name="postdesc" class="form-control" required rows="5"><?php echo $row['description']; ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCategory">Category</label>
                                <select class="form-control" name="category">
                                    <option disabled>Select Category </option>
                                    <?php
                                    $sql1 = "SELECT * FROM category";
                                    $result1 = mysqli_query($conn, $sql1);
                                    if (mysqli_num_rows($result1) > 0) {
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                            $selected = ($row['category'] == $row1['category_id']) ? "selected" : "";
                                            echo "<option value='{$row1['category_id']}' {$selected}>{$row1['category_name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="old-category" value="<?php echo $row['category'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Post image</label>
                                <input type="file" name="new-image">


                                <img id="update-post" src="admin/uploaded/<?php echo $row['post_img']; ?>">

                                <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?>">
                            </div>
                            <input type="submit" name="update" class="btn btn-primary" value="Update" />
                        </form>
                <?php
                    }
                } else {
                    echo "<p>Post not found.</p>";
                }
                ?>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>
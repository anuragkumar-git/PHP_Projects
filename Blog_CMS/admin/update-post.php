<?php
include 'header.php';
include 'config.php';

// to stop chnge post id in url while updating post 
// if ($_SESSION['admin']['user_role'] == 0 || 1) {
//     $postid = $_GET['id'];
//     $sql0 = "SELECT author FROM post WHERE post_id = {$postid}";
//     $resql = mysqli_query($conn, $sql0);
//     $row0 = mysqli_fetch_assoc($resql);
//     if ($row0['author'] != $_SESSION['admin']['user_id']) {
//         header('Location:post.php');
//     }
// }


?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->
                <?php
                $pid = $_GET['id'];
                //$sqlo = "SELECT * FROM post WHERE post_id = {$pid}";

                $sql = "SELECT  post.post_id, post.title, post.description, post.post_img, post.category,  category.category_name FROM post 
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id WHERE post_id={$pid}";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>

                        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="post_id" class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTile">Title</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Description</label>
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

                                            // if ($row['category'] == $row1['category_id']) {
                                            //     $selected = "selected";
                                            // } else {
                                            //     $selected = "";
                                            // }
                                            echo "<option value='{$row1['category_id']}' {$selected}>{$row1['category_name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="old-category" value="<?php echo $row['category']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Post image</label>
                                <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?>">
                                <input type="file" name="new-image">

                                <img id="update-post" src="uploaded/<?php echo $row['post_img']; ?>" height="150px" width="150px">

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
<?php include "footer.php"; ?>
<?php
include 'header.php';
include 'config.php';

// session_start();
if (!isset($_SESSION['blog_session']["u_name"])) {
    header("Location:index.php;");
}
if (isset($_SESSION['accessDenied'])) {
    $message = $_SESSION['accessDenied']; 
    echo "<script>alert('$message')</script>"; // update-mypost.php 34
    // echo $message; // update-mypost.php 35
    unset($_SESSION['accessDenied']);
?>    
<?php
}
?>

<div id="main-content">
    <div class="container">
        <!-- add post -->
        <div class="row">
            <div class="col-md-10">
                <h2 class="page-heading">All Posts</h2>
            </div>
            <div class="col-md-2"><!--pull-right-->
                <a class="add-mynew" href="add-mypost.php">Add Post</a>
            </div>

            <div class="col-md-12">
                <?php
                $limit = 3;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($page - 1) * $limit;
                $sql = "SELECT post.post_img, post.post_id, post.title, post.description, post.post_date, user.username, category.category_name, post.category 
                                    FROM post 
                                    LEFT JOIN category ON post.category = category.category_id
                                    LEFT JOIN user ON post.author = user.user_id 
                                    WHERE post.author = {$_SESSION['blog_session']["u_id"]}
                                    ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";


                $result = mysqli_query($conn, $sql) or die("Query Unsuccessful: " . mysqli_error($conn));


                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?><!-- post-container -->
                        <div class="post-container">
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="update-mypost.php?postid=<?php echo $row['post_id']; ?>"><img src="admin/uploaded/<?php echo $row['post_img']; ?>"></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='update-mypost.php?postid=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <?php echo $row['category_name']; ?>

                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo $row['description']; ?>
                                                <!-- if words < 130 then remove readmore and "..." -->
                                            </p>
                                            <a class='edit' href='update-mypost.php?postid=<?php echo $row['post_id']; ?>'><i class='fa fa-edit'></i></a>
                                            <a class='delete' href='delete-mypost.php?postid=<?php echo $row['post_id']; ?>&catid=<?php echo $row['category']; ?>'><i class='fa fa-trash-o'></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /post-container -->
                <?php
                    }
                } else {
                    echo "<h2> No Record Found!!</h2>";
                }
                ?>
                <?php
                //--------------Pagination--------------------
                $sql1 = "SELECT * FROM post LEFT JOIN user ON post.author = user.user_id WHERE post.author = {$_SESSION['blog_session']['u_id']} ";
                $result1 = mysqli_query($conn, $sql1);

                if (mysqli_num_rows($result1) > $limit) {
                    $records = mysqli_num_rows($result1);
                    $pages = ceil($records / $limit);

                    echo "<ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo '<li><a href="mypost.php?page=' . ($page - 1) . '">Prev</a></li>';
                    }

                    for ($i = 1; $i <= $pages; $i++) {
                        $active = ($i == $page) ? "active" : "";
                        echo '<li class="' . $active . '"><a href="mypost.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                    if ($pages > $page) {
                        echo '<li><a href="mypost.php?page=' . ($page + 1) . '">Next</a></li>';
                    }
                    echo "</ul>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
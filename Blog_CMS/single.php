<?php
include 'header.php';
include 'config.php';
$id = $_GET['id'];
?>

<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <?php
                $sql = "SELECT post.post_id, post.author, post.title, post.description, category.category_name, post.post_date,post.category, user.username, post.post_img FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id
                WHERE post_id = {$id}";

                if ($result = mysqli_query($conn, $sql)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <!-- post-container -->
                        <div class="post-container">
                            <div class="post-content single-post">
                                <h3><?php echo $row['title'];?></h3>
                                <div class="post-information">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        <a href="category.php?id=<?php echo $row['category']; ?>"><?php echo $row['category_name']; ?></a>
                                    </span>
                                    <span>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <a href='author.php?id=<?php echo $row['author'] ?>'><?php echo $row['username']; ?></a>
                                        <!-- <a href='author.php'><?php echo $row['username'];?></a> -->
                                    </span>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?php echo $row['post_date'];?>
                                    </span>
                                </div>
                                <img class="single-feature-image" src="admin/uploaded/<?php echo $row['post_img']?>" alt="" />
                                <p class="description">
                                    <?php echo $row['description']; ?>
                                </p>
                            </div>
                        </div>
                        <!-- /post-container -->
                <?php }
                }
                ?>

            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<?php
include 'header.php';
include 'config.php';
?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php

                $limit = 3;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                $sql = "SELECT post.post_id, post.title, post.description, category.category_name,  post.post_date, post.category, user.username, post.post_img, post.author FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id
                ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <!-- post-container -->
                        <div class="post-container">
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a aspect-ratio: 16:9 class="post-img" href="single.php?id=<?php echo $row['post_id']; ?> "><img src="admin/uploaded/<?php echo $row['post_img']; ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?id=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>

                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?id=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row['description'], 0, 130) . "..."; ?>
                                                <!-- if words < 130 then remove readmore and "..." -->
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /post-container -->

                    <?php
                    }
                } else {
                    echo "<h2>No Posts Found!..</h2>";
                }

                $sql1 = "SELECT * FROM post ";
                $result1 = mysqli_query($conn, $sql1);

                if (mysqli_num_rows($result1) > $limit) {
                    $records = mysqli_num_rows($result1);
                    $pages = ceil($records / $limit);

                    echo "<ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo '<li><a href="index.php?page=' . ($page - 1) . '">Prev</a></li>';
                    }

                    for ($i = 1; $i <= $pages; $i++) {
                        $active = ($i == $page) ? "active" : "";
                        echo '<li class="' . $active . '"><a href="index.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                    if ($pages > $page) {
                        echo '<li><a href="index.php?page=' . ($page + 1) . '">Next</a></li>';
                    }
                    echo "</ul>";
                }


                echo "</div>";
                if(mysqli_num_rows($result) > 0){
                include 'sidebar.php';} ?>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
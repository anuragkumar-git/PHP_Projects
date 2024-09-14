<?php
include 'header.php';
include 'config.php';
if (isset($_GET['search'])) {
    $search = ($_GET['search']);
}
?>

    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                   
                <?php
                    // $sql0 = "SELECT * FROM user WHERE user_id = {$auth_id}";
                    // $result0 = mysqli_query($conn, $sql0);
                    // if ($row0 = mysqli_fetch_assoc($result0)) {
                    ?>

                        <h2 class="page-heading">Search: <?php echo $search; ?> </h2>
                        <?php
                    
                    $limit = 3;
                    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                    $offset = ($page - 1) * $limit;

                    $sql = "SELECT post.post_id, post.title, post.description, post.category, category.category_name, post.post_date, user.username, post.post_img,post.author FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id
                    WHERE post.title LIKE '%{$search}%'
                    ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";

                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/uploaded/<?php echo $row['post_img']; ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?id=<?php echo $row['category'] ?>'><?php echo $row['category_name']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?id=<?php echo $row['author'] ?>'><?php echo $row['username']; ?></a>
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
                    <?php
                        }
                    } else {
                        echo "<h2> No Record Found!!</h2>";
                    }
                    echo   " </div><!-- /post-container -->";


                    
                    // $sql1 = "SELECT post FROM category WHERE category_id = {$auth_id} ";
                    $sql1 = "SELECT * FROM post WHERE post.title LIKE '%{$search}%' ";
                    $result1 = mysqli_query($conn, $sql1);
                    $row1 = mysqli_fetch_assoc($result1);

                    // if ($row1['total_posts'] > 0) {
                    //     $records = $row1['total_posts'];
                    //     $pages = ceil($records / $limit);

                        if (mysqli_num_rows($result1) > $limit) {
                            $records = mysqli_num_rows($result1);
                            $pages = ceil($records / $limit);

                        echo "<ul class='pagination admin-pagination'>";
                        if ($page > 1) {
                            echo '<li><a href="search.php?search=' . $search . '&page=' . ($page - 1) . '">Prev</a></li>';
                        }

                        for ($i = 1; $i <= $pages; $i++) {
                            $active = ($i == $page) ? "active" : "";
                            echo '<li class="' . $active . '"><a href="search.php?search=' . $search . '&page=' . $i . '">' . $i . '</a></li>';
                        }
                        if ($pages > $page) {
                            echo '<li><a href="search.php?search=' . $search . '&page=' . ($page + 1) . '">Next</a></li>';
                        }
                        echo "</ul>";
                    }
                    ?>
                </div><!-- /post-container -->
           
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
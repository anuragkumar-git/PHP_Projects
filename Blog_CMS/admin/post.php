<?php
include 'header.php';
include 'config.php';
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">Add Post</a>
            </div>
            <div class="col-md-12">

                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php

                        $limit = 5;
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $offset = ($page - 1) * $limit;
                        $sql = "SELECT post.post_id, post.title, post.description, post.post_date, user.username, category.category_name, post.category 
                                    FROM post 
                                    LEFT JOIN category ON post.category = category.category_id
                                    LEFT JOIN user ON post.author = user.user_id 
                                    ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";

                        $result = mysqli_query($conn, $sql) or die("Query Unsuccessful: " . mysqli_error($conn));

                        if (mysqli_num_rows($result) > 0) {
                            $count = $offset + 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td class='id'><?php echo $count ?></td>
                                    <td class='hidden'><?php echo htmlspecialchars($row['post_id']); 
                                                        ?></td>
                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                    <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['post_date']); ?></td>
                                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id']; ?>&catid=<?php echo $row['category']; ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        <?php
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Posts Found!...</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <?php
                //--------------Pagination--------------------

                if ($_SESSION['admin']["user_role"] == '1') {
                    $sql1 = "SELECT * FROM post ";
                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1) > $limit) {
                        $records = mysqli_num_rows($result1);
                        $pages = ceil($records / $limit);

                        echo "<ul class='pagination admin-pagination'>";
                        if ($page > 1) {
                            echo '<li><a href="post.php?page=' . ($page - 1) . '">Prev</a></li>';
                        }

                        for ($i = 1; $i <= $pages; $i++) {
                            $active = ($i == $page) ? "active" : "";
                            echo '<li class="' . $active . '"><a href="post.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                        if ($pages > $page) {
                            echo '<li><a href="post.php?page=' . ($page + 1) . '">Next</a></li>';
                        }
                        echo "</ul>";
                    }
                } elseif ($_SESSION['admin']["user_role"] == '0') {
                    $sql1 = "SELECT * FROM post LEFT JOIN user ON post.author = user.user_id WHERE post.author = {$_SESSION['admin']['user_id']} ";
                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1) > $limit) {
                        $records = mysqli_num_rows($result1);
                        $pages = ceil($records / $limit);

                        echo "<ul class='pagination admin-pagination'>";
                        if ($page > 1) {
                            echo '<li><a href="post.php?page=' . ($page - 1) . '">Prev</a></li>';
                        }

                        for ($i = 1; $i <= $pages; $i++) {
                            $active = ($i == $page) ? "active" : "";
                            echo '<li class="' . $active . '"><a href="post.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                        if ($pages > $page) {
                            echo '<li><a href="post.php?page=' . ($page + 1) . '">Next</a></li>';
                        }
                        echo "</ul>";
                    }
                }


                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
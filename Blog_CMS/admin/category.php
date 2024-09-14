<?php
include "header.php";
include "config.php";
if ($_SESSION['admin']["user_role"] == '0') {
    header("Location: {$path}/admin/post.php");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <?php

                    $limit = 5;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;


                    $sql = "SELECT * FROM category  ORDER BY category_id DESC LIMIT {$offset}, {$limit}";
                    $result = mysqli_query($conn, $sql) or die("Query Failed");

                    if (mysqli_num_rows($result) > 0) {
                        $count = $offset + 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tbody>
                                <tr>
                                    <td class='id' value=$count><?php echo $count; ?></td>
                                    <td class='hidden'><?php echo $row['category_id']; ?></td>
                                    <td><?php echo $row['category_name']; ?></td>

                                    <td><?php echo $row['post']; ?></td>

                                    <td class='edit'><a href='update-category.php?id=<?php echo $row["category_id"]; ?>'><i class='fa fa-edit'></i></a></td>

                                    <td class='delete'><a href='delete-category.php?id=<?php echo $row["category_id"]; ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>


                        <?php
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>No Categories Found</td></tr>";
                    }
                        ?>
                            </tbody>
                </table>

                <?php

                $sql1 = "SELECT * FROM category";
                $result1 = mysqli_query($conn, $sql1);

                if (mysqli_num_rows($result1) > $limit) {
                    $records = mysqli_num_rows($result1);

                    $pages = ceil($records / $limit);

                    echo "<ul class='pagination admin-pagination'>";

                    if ($page > 1) {
                        echo '<li><a href = "category.php?page=' . ($page -  1) . '">Prev</a></li>';
                    }

                    for ($i = 1; $i <= $pages; $i++) {
                        $active = ($i == $page) ? "active" : "";
                        echo '<li class = "' . $active . '"><a href= "category.php?page=' . $i . '">' . $i . '</a></li>';
                    }

                    if ($pages > $page) {
                        echo '<li><a href = "category.php?page=' . ($page + 1) . '">Next</a></li>';
                    }

                    echo "</ul>";
                }

                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
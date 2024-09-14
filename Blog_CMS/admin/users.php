<?php
include "header.php";
include 'config.php';
// if ($_SESSION["user_role"] == '0') {
//     header("Location: {$path}/admin/post.php");
// }
?>

<div id="admin-content">
    <div class="container">

        <div class="row">
            <div class="col-md-10">
                <h1 class="heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">Add User</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>User Name</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>

                    <?php
                    //--------------------------pegination
                    /**/ $limit = 5;
                    if (isset($_GET['page'])) {
                        /**/
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    /**/
                    $offset = ($page - 1) * $limit;

                    //-----------------------------------------------------
                    $sql = "SELECT * FROM user ORDER BY user_id LIMIT {$offset}, {$limit}";
                    $result = mysqli_query($conn, $sql) or die("Unsuccessful");

                    if (mysqli_num_rows($result) > 0) {
                        $count = $offset + 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tbody>
                                <tr>
                                    <td class='id'><?php echo $count ?></td>
                                    <td class='hidden'><?php echo $row['user_id'] ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo ($row['role'] == 1) ? "Admin" : "User"; ?></td>
                                    <td class='edit'><a href='update-user.php?id=<?php echo $row["user_id"]; ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-user.php?id=<?php echo $row["user_id"]; ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        <?php
                        $count++;
                        }
                    } else {
                        echo "<tr><td colspan='6'>No Users Found!...</td></tr>";
                    }
                        ?>
                            </tbody>
                </table>

                <?php
                //--------------pegination--------------------
                $sql1 = "SELECT * FROM user";
                $result1 = mysqli_query($conn, $sql1);

                if (mysqli_num_rows($result1) > $limit) {
                    $records = mysqli_num_rows($result1);
                    $pages = ceil($records / $limit);

                    echo "<ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo '<li><a href="users.php?page=' . ($page - 1) . '">Prev</a></li>';
                    }

                    for ($i = 1; $i <= $pages; $i++) {
                        $active = ($i == $page) ? "active" : "";
                        echo '<li class="' . $active . '"><a href="users.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                    if ($pages > $page) {
                        echo '<li><a href = "users.php?page=' . ($page + 1) . '">Next</a></li>';
                    }
                    echo "</ul>";
                }

                ?>

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
<?php
include 'header.php';
include 'config.php';
?>


<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="heading">Requests</h1>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Approve</th>
                        <th>Delete</th>
                    </thead>
                    <?php
                    //--------------------------pegination
                    $limit = 5;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;

                    $sql = "SELECT * FROM requests";
                    $result = mysqli_query($conn, $sql) or die("Unsuccessful");
                    if (mysqli_num_rows($result) > 0) {
                        $count = $offset + 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tbody>
                                <tr>
                                    <td class='id'><?php echo $count; ?></td>
                                    <td class='hidden'><?php echo $row['rq_id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td class='check'><a href='approve-request.php?rqid=<?php echo $row['rq_id']; ?>'><i class='fa fa-check'></i></a></td>
                                    <td class='delete'><a href='delete-request.php?rqid=<?php echo $row['rq_id']; ?>'> <i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            </tbody>
                    <?php $count++;
                        }
                    } else {
                        echo "<tr><td colspan='6'>No Requests Found!...</td></tr>";
                    } ?>
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
<?php include 'footer.php' ?>
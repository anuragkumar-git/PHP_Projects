<?php
include 'header.php';
include 'config.php';

?>
<div id="main-content">
    <h2>All Records</h2>

    <table cellpadding="7px">
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            $count = $db->user->countDocuments();
            if ($count == 0) {
                echo "<tr>
                    <td colspan='3'>No data Found!..</td>
                </tr>";
            } else {
                $mObj = $db->user->find();
                foreach ($mObj as $row) {
            ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <a href='edit.php?id=<?php echo $row['_id']; ?>'>Edit</a>
                            <a href='delete-inline.php?id=<?php echo $row['_id']; ?>'>Delete</a>
                        </td>
                <?php
                }
            }
                ?>
        </tbody>
    </table>

</div>
</div>
</body>

</html>
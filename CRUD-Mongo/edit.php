<?php
include 'header.php';
include 'config.php';

$id = $_GET['id'];

$oid = new MongoDB\BSON\ObjectId($id);
$row = $db->user->findOne(['_id' => $oid]);

?>

<body>
    <div id="main-content">
        <h2>Update Record</h2>
        <form class="post-form" action="editdata.php" method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="hidden" name="id" value="<?php echo $row['_id']; ?>" />
                <input type="text" name="name" value="<?php echo $row['name']; ?>" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $row['email']; ?>" />
            </div>
            <input class="submit" type="submit" value="Update" />
        </form>
    </div>
</body>

</html>
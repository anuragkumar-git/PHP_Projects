<?php
include 'header.php';
?>
<div id="main-content">
    <h2>Add New Record</h2>
    <form class="post-form" action="adddata.php" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" />
        </div>
        <!-- <div class="form-group">
            <label>Class</label>
            <select name="class">
                <option value="" selected disabled>Select Class</option>
                <?php
                // $sql = "SELECT * FROM studentclass";
                // $result = mysqli_query($conn, $sql) or die("Query unsuccessful!!");
                // while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <option value="<?php // echo $row['cid']; 
                                    ?>"><?php //echo $row['cname']; 
                                        ?></option>

                <?php // } 
                ?>

            </select>
        </div> -->

        <input class="submit" type="submit" value="Save" />
    </form>
</div>
</body>

</html>
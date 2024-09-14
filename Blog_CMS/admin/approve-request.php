<?php

include 'config.php';

$rqid = intval($_GET['rqid']);  // Sanitize rqid to be an integer

// SQL to insert user and delete the request
$sql = "INSERT INTO user (first_name, email, username, password, role)
SELECT name, email, username, password, role
FROM requests
WHERE rq_id = {$rqid};";

$sql .= "DELETE FROM requests WHERE rq_id = {$rqid};";

// Execute the multi-query
if (mysqli_multi_query($conn, $sql)) {
    // Loop through all the results from the multi-query
    do {
        // Store first result set
        if ($result = mysqli_store_result($conn)) {
            mysqli_free_result($result); // Free result memory
        }
        // If there are more result sets, move to the next one
    } while (mysqli_more_results($conn) && mysqli_next_result($conn));

    // Now it's safe to run another query
    $query = "SELECT * FROM `user` ORDER BY `user_id` DESC LIMIT 1;";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $fnam = $user_data['first_name'];
        $email = $user_data['email'];
        $user = $user_data['username'];
        
        // Email details
        $sub = "Welcome, $fnam!";
        $msg = "Congratulations! $user\n\nYour Request is accepted \nNow you can contribute at Blog CMS.";
        $headers = "From: patelanurag3971@gmail.com";
        
        // Send the email
        $mail = mail($email, $sub, $msg, $headers);
        
        if ($mail) {
            // Redirect to requests page
            header("Location: {$path}/admin/requests.php");
        } else {
            echo "<h2>Email could not be sent</h2>";
        }
    } else {
        echo "<h2>Error fetching user data</h2>";
    }
} else {
    echo "<h2>User not added</h2>";
}

// Close the connection
mysqli_close($conn);
?>

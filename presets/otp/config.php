<?php session_start();
echo "<br>";
echo "
<pre>";
print_r($_SESSION);
echo "</pre>";
echo "<button> <a href=session_termination.php> terminate session</a></button>";
$con = mysqli_connect("localhost", "root", "", "otp") or die("Connection unsuccessful!.." . mysqli_connect_error());

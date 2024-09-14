<?php 
session_name('OTP');
session_start();
session_unset();
session_destroy();
header("Location:forgotpass.php");
?>
<?php
include 'config.php';

session_name('blog_session');
session_start();

session_unset();

session_destroy();

header("Location:index.php");

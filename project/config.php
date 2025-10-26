<?php
// Basic configuration
$site_name = "Golden Theatres";
date_default_timezone_set("Asia/Singapore");

// Example database connection (optional)
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "ie4727_project";

// If you need to connect:
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection (optional)
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
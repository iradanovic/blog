<?php
session_start();

// Determine if the connection is HTTPS
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";

// Define ROOT_URL dynamically
define("ROOT_URL", $protocol . $_SERVER['HTTP_HOST'] . "/blog/");

// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'blog');

$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($connection->connect_error) {
    error_log("Database connection error: " . $connection->connect_error);
    die("Database connection failed. Please try again later.");
}
?>

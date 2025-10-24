<?php
// Base template for all pages

// Run config once at startup
require_once "./config.php";

// Switch pages with hyperlink to /index.php?page=... (GET request with param 'page')
$page = $_GET['page'] ?? 'home';
$page_path = "./pages/" . basename($page) . ".php";

// Header
include "./includes/header.php";

// Content
echo "<div class='content'>";
if (file_exists($page_path)) {
    include $page_path;
} else {
    echo "<h2>404 - Page not found</h2>";
}
echo "</div>";

// Footer
include "./includes/footer.php";

$conn->close();
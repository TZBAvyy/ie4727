<?php
require_once "./config.php";

$page = $_GET['page'] ?? 'home';
$page_path = "./pages/" . basename($page) . ".php";

include "./includes/header.php";

echo "<div class='content'>";
if (file_exists($page_path)) {
    include $page_path;
} else {
    echo "<h2>404 - Page not found</h2>";
}
echo "</div>";

include "./includes/footer.php";

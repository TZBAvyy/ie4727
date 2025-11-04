<?php
require_once '../config.php';

// Ensure POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php?page=404");
    exit();
}

// Check required inputs
if (!isset($_POST['movie_id']) || !isset($_POST['name']) || !isset($_POST['description'])) {
    header("Location: ../index.php?page=404");
    exit();
}

$sql = "SELECT * FROM movies WHERE movie_id=? LIMIT 1;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if ($row['name']==$_POST['name'] && $row['description']==$_POST['description']) {
    header("Location: ../index.php?page=home");
    exit();
} else {
    $sql = "UPDATE movies SET name=?,description=? WHERE movie_id=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $_POST['name'], $_POST['description'], $_POST['movie_id']);
    $success = $stmt->execute();
    $stmt->close();
}

if ($success) {
    header("Location: ../index.php?page=home");
    exit();
} else {
    header("Location: ../index.php?page=error");
    exit();
}
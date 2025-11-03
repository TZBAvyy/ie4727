<?php

require_once "../config.php";

// Ensure POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php?page=404");
    exit();
}

// Check for important inputs are set
if (!isset($_POST['date-search'])) {
    header("Location: ../index.php?page=404");
    exit();
}

$sql = "SELECT * FROM ( SELECT s.schedule_id,m.movie_id,m.name,m.rating,m.movie_poster,s.date,CAST(s.date as DATE) AS d FROM schedules s JOIN movies m ON s.movie_id=m.movie_id ) t1 WHERE t1.d = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_POST['date-search']);
$success = $stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$conn->close();

if ($success) {
    $_SESSION['movie-search'] = [];
    while ($row = $result->fetch_assoc()) {
        $_SESSION['movie-search'][] = $row;
    }
    header("Location: ../index.php?page=home&search=true");
    exit();
} else {
    header("Location: ../index.php?page=error");
    exit();
}
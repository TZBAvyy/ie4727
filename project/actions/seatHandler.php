<?php 
require_once "../config.php";

// Ensure POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php?page=404");
    exit();
}

// Check for important inputs are set
if (!isset($_POST['schedule_id']) or !isset($_POST['chosen_seats']) or !isset($_POST['email'])) {
    header("Location: ../index.php?page=404");
    exit();
}

foreach ($_POST['chosen_seats'] as $seat_id) {
    createTicketEntry($conn, $seat_id, $_POST['schedule_id'], $_POST['email']);
}
$conn->close();
header("Location: ../index.php?page=home");
exit();

function createTicketEntry($conn, $seat_id, $schedule_id, $email) : bool {
    $sql = "INSERT INTO tickets (seat_id, schedule_id, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $seat_id, $schedule_id, $email);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}
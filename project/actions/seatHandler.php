<?php 
require_once "../config.php";

// Ensure POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php?page=404");
    exit();
}

// Check required inputs
if (!isset($_POST['schedule_id']) || !isset($_POST['chosen_seats']) || !isset($_POST['email'])) {
    header("Location: ../index.php?page=404");
    exit();
}

$schedule_id = $_POST['schedule_id'];
$email = $_POST['email'];
$chosen_seats = $_POST['chosen_seats'];

// Optional fields (if available from your seat page form)
$movie = $_POST['movie'] ?? '';
$showtime = $_POST['showtime'] ?? '';

// Insert each seat into the database
$successfulSeats = [];
foreach ($chosen_seats as $seat_id) {
    if (createTicketEntry($conn, $seat_id, $schedule_id, $email)) {
        $successfulSeats[] = $seat_id;
    }
}

$conn->close();

// Save booking info in session for confirmation page
$_SESSION['booking'] = [
    'schedule_id' => $schedule_id,
    'seats' => $successfulSeats,
    'email' => $email,
    'movie' => $movie,
    'showtime' => $showtime
];

// Redirect to confirmation page
header("Location: ../index.php?page=confirmation");
exit();

function createTicketEntry($conn, $seat_id, $schedule_id, $email): bool {
    $sql = "INSERT INTO tickets (seat_id, schedule_id, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $seat_id, $schedule_id, $email);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}
?>

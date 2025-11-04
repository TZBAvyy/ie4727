<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../config.php';

$booking = $_SESSION['booking'] ?? null;
if (!$booking || empty($booking['seats'])) {
  echo "<p style='color:white;text-align:center;'>No booking found. Please try again.</p>";
  exit;
}

// Get the seat_type values directly from the Seats table
$seatIds = array_map('intval', $booking['seats']);
$placeholders = implode(',', array_fill(0, count($seatIds), '?'));
$types = str_repeat('i', count($seatIds));

$sql = "SELECT seat_type FROM seats WHERE seat_id IN ($placeholders)";
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$seatIds);
$stmt->execute();
$result = $stmt->get_result();

$seatTypes = [];
while ($row = $result->fetch_assoc()) {
    $seatTypes[] = $row['seat_type'];
}
$stmt->close();
$conn->close();
?>

<link rel="stylesheet" href="./pages/booking.css">

<div class="booking-wrapper">
  <h2>Booking Confirmed!</h2>

  <div class="booking-result">
    <p><strong>Movie:</strong> <?= htmlspecialchars($booking['movie'] ?? 'N/A') ?></p>
    <p><strong>Showtime:</strong> <?= htmlspecialchars($booking['showtime'] ?? 'N/A') ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($booking['email']) ?></p>
    <p><strong>Seats:</strong> <?= htmlspecialchars(implode(', ', $seatTypes)) ?></p>
  </div>

  <p class="booking-message">
    Your booking has been saved successfully. A confirmation email will be sent shortly.
  </p>

  <a href="index.php?page=home" style="color:#ffd700; text-decoration:underline;">Return to Home</a>
</div>

<?php
unset($_SESSION['booking']);
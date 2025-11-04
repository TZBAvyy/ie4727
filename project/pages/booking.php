<?php
$q = trim($_GET['q'] ?? '');
$rows = [];
$message = '';

if ($q === '') {
    $message = 'Enter your email or booking ID to check your booking.';
} else {
    $sql = "
        SELECT 
            t.ticket_id AS booking_ref,
            m.name AS movie,
            DATE_FORMAT(s.date, '%Y-%m-%d %H:%i') AS showtime,
            se.seat_type AS seat
        FROM Tickets t
        JOIN Schedules s ON s.schedule_id = t.schedule_id
        JOIN Movies m ON m.movie_id = s.movie_id
        JOIN Seats se ON se.seat_id = t.seat_id
        WHERE t.email = ? OR t.ticket_id = ?
        ORDER BY s.date DESC
    ";
    
    $stmt = mysqli_prepare($conn, $sql);
    $ticket_id = ctype_digit($q) ? (int)$q : 0;
    mysqli_stmt_bind_param($stmt, 'si', $q, $ticket_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($res)) {
        $showtime = $row['showtime'];
        if (!array_key_exists($showtime, $rows)) {
          $rows[$showtime] = [];
        }
        $rows[$showtime][] = $row;
    }

    if (empty($rows)) {
        $message = "No bookings found for '$q'.";
    }
}
?>

<link rel="stylesheet" href="./pages/booking.css">

<div class="booking-wrapper">
  <h2>Check Your Booking</h2>

  <form method="get" action="index.php" class="booking-form">
    <input type="hidden" name="page" value="booking">
    <label for="q">Enter Email or Booking ID:</label>
    <input id="q" name="q" type="text" required>
    <button type="submit">Search</button>
  </form>



  <?php if ($message): ?>
    <p class="booking-message"><?= $message ?></p>
  <?php endif; ?>

  <?php if (!empty($rows)): ?>
    <hr>
    <h3>Results</h3>
    <div class="booking-result-grid">
      <?php foreach ($rows as $st=>$seats): ?>
        <div class="booking-result">
          <p><strong>Movie:</strong> <?= htmlspecialchars($seats[0]['movie']) ?></p>
          <p><strong>Showtime:</strong> <?= htmlspecialchars($st) ?></p>
          <p><strong>Seats:</strong> 
            <?php 
            $seats_output = "";
            foreach ($seats as $seat) {
              $seats_output = $seats_output.htmlspecialchars($seat['seat']).", ";
            }
            echo trim($seats_output, ", ");
            ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php
function sendConfirmationMail(string $to, string $movie, string $showtime, array $seatLabels): bool {
    $subject = "Your Golden Theatres Booking Confirmation";
    $seats = implode(', ', $seatLabels);

    $message  = "Hello,\n\n";
    $message .= "Thank you for booking with Golden Theatres.\n";
    $message .= "Here are your booking details:\n\n";
    $message .= "Movie: $movie\n";
    $message .= "Showtime: $showtime\n";
    $message .= "Seats: $seats\n\n";
    $message .= "Please arrive 15 minutes before the show.\n";
    $message .= "Enjoy your movie!\n\n";
    $message .= "- Golden Theatres";

    $headers = "From: Golden Theatres <support@goldentheatres.com>\r\n";

    return mail($to, $subject, $message, $headers);
}
?>

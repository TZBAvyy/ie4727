<style>
<?php 
include './pages/movie.css'; 

include './pages/seats.css'; 

if (isset($_GET['schedule_id'])) {
    $schedule_id = $_GET['schedule_id'];
} else {
    header("Location: index.php?page=404");
    exit();
}

$seat_sql = "SELECT t2.*,t1.ticket_id,t1.contact_info 
    FROM (  
        SELECT s.*, t.ticket_id, t.contact_info 
        FROM seats s 
        JOIN tickets t ON s.seat_id=t.seat_id 
        WHERE t.schedule_id=?
    ) t1 
    RIGHT JOIN seats t2 ON t1.seat_id=t2.seat_id;";
$stmt = $conn->prepare($seat_sql);
$stmt->bind_param("i", $schedule_id);
$stmt->execute();
$seat_result = $stmt->get_result();
$stmt->close();

$seat_matrix = [];
while ($seat = $seat_result->fetch_assoc()) {
    $seat_letter = $seat["seat_type"][0];
    if (!array_key_exists($seat_letter,$seat_matrix)) {
        $seat_matrix[$seat_letter] = [];
    }
    $seat_matrix[$seat_letter][] = $seat;
} 

$movie_sql = "SELECT sc.date,m.* FROM schedules sc JOIN movies m ON sc.movie_id=m.movie_id WHERE sc.schedule_id=? LIMIT 1;";
$stmt = $conn->prepare($movie_sql);
$stmt->bind_param("i", $schedule_id);
$stmt->execute();
$movie_result = $stmt->get_result();
$stmt->close();

$movie = $movie_result->fetch_assoc();
?>
</style>

<h1><?= $movie['name'] ?></h1>

<section class="movie-information">
    <img src="./images/<?= $movie['movie_poster'] ?>" alt="Movie Poster Here" class="movie-poster">
    <div class="movie-description">
        <div>
            <h2>Description: </h2>
            <h3><?= $movie['description'] ?></h3>
        </div>
        <div>
            <h2>Seats:</h2>
            <form class="seats" action="./actions/seatHandler.php" method="post">
                <table>
                <?php
                $max_cols = 0;
                $num_row = "<td> </td><td>1</td>";
                foreach ($seat_matrix as $letter => $seat_row) {
                    echo '<tr><td>'.$letter.'</td>';
                    foreach ($seat_row as $col_num => $seat) {
                        if ($col_num > $max_cols) {
                            $max_cols = $col_num;
                            $num_row = $num_row."<td>".($col_num+1)."</td>";
                        }
                        if ($seat['ticket_id'] != NULL) {
                            echo "<td><input type='checkbox' disabled class='seat-checkbox'></td>";
                        } else {
                ?>
                <td><input type="checkbox" name="chosen_seats[]" value="<?=$seat['seat_id']?>" class='seat-checkbox'></td>
                <?php
                        }
                    }
                    echo '</tr>';
                }
                ?>
                <tr><?= $num_row ?></tr>
                </table>
                <div>
                    <div>
                        <label for="email">*Email Address:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <input type="submit" name="submit">
                </div>
            </form>
        </div>
    </div>
</section>
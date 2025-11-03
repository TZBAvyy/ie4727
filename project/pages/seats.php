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

$seat_sql = "SELECT t2.*,t1.ticket_id 
    FROM (  
        SELECT s.*, t.ticket_id
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
    <div class="seats-description">
        <div class="desc">
            <h2>Description: </h2>
            <h3><?= $movie['description'] ?></h3>
        </div>
        <div class="seats">
            <h2>Seats:</h2>
            <form class="seats" action="./actions/seatHandler.php" method="post">
                <table>
                <tr>
                    <td></td>
                    <td colspan="100%">
                        <hr class="screen">
                        <div class="screen-text">Screen</div>
                    </td>
                </tr>
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
                <td><input 
                    type="checkbox" 
                    name="chosen_seats[]" 
                    value="<?=$seat['seat_id']?>" 
                    class='seat-checkbox' 
                    data-seat="<?=$seat['seat_type']?>"
                    data-price="<?=$seat['seat_price']?>"
                ></td>
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
                    <input type="hidden" name="schedule_id" value="<?=$schedule_id?>">
                    <input type="hidden" name="movie" value="<?= htmlspecialchars($movie['name']) ?>">
                    <input type="hidden" name="showtime" value="<?= htmlspecialchars($movie['date']) ?>">
                    <input type="submit" name="submit">
                </div>
            </form>
        </div>
        <div class="booking-info">
            <h2>Booking Info:</h2>
            <div class="booking-table">
                <table id="bt">
                    <tr class="booking-headers"><th>Seat</th><th>Amount</th></tr>
                </table>
                <div class="total">
                    <h3>Total Amount: $</h3>
                    <h3 id="total-amount">0</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
const seat_elements = document.querySelectorAll('.seat-checkbox');
seat_elements.forEach(element => {
    element.addEventListener("click",e => {
        const total_amt_element = document.getElementById("total-amount");
        const booking_table = document.getElementById("bt");

        const seat_inp = e.target;

        const seat_type = seat_inp.dataset.seat;
        const seat_price = seat_inp.dataset.price;
        const isChecked = seat_inp.checked;
        if (isChecked) {
            const row = booking_table.insertRow();

            seat_inp.dataset.rowIndex = row.rowIndex;

            const seat_cell = row.insertCell(0);
            const amt_cell = row.insertCell(1);

            seat_cell.innerHTML = seat_type;
            amt_cell.innerHTML = "$"+seat_price;
            total_amt_element.textContent = parseInt(total_amt_element.textContent)+parseInt(seat_price);
        } else {
            const rowIndex = seat_inp.dataset.rowIndex;
            const row = booking_table.rows[rowIndex];
            row.style.display = 'none';
            total_amt_element.textContent = parseInt(total_amt_element.textContent)-parseInt(seat_price);
        }
    });
});
</script>
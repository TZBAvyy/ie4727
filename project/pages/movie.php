<style>
<?php 
include './pages/movie.css'; 

$current_date = date("Y-m-d");
$sql = "SELECT m.*,s.schedule_id,s.date FROM movies m INNER JOIN schedules s ON m.movie_id=s.movie_id WHERE m.movie_id=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['movie_id']);
$stmt->execute();
$result = $stmt->get_result();
$first_row = $result->fetch_assoc();
?>
</style>

<section class="search-section">
    <p>Search for showtimes on: </p>
    <input type="date" name="date-search" id="date-search" value=<?=$current_date?>>
    <input type="submit" name="search-btn" id="search-btn">
</section>

<h1><?= $first_row['name'] ?></h1>

<section class="movie-information">
    <img src="./images/<?= $first_row['movie_poster'] ?>" alt="Movie Poster Here" class="movie-poster">
    <div class="movie-description">
        <div>
            <h2>Description: </h2>
            <h3><?= $first_row['description'] ?></h3>
        </div>
        <div>
            <h2>Showtimes:</h2>
            <h3><?= $first_row['date'] ?></h3>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?> 
            <h3><?= $row['date'] ?></h3>
            <?php
            }
            ?>
        </div>
    </div>
</section>
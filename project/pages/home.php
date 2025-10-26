<style>
<?php 
include './pages/home.css'; 

$current_date = date("Y-m-d");
$sql = "SELECT m.movie_id,m.name,m.rating,m.movie_poster,s.schedule_id,s.date FROM movies m INNER JOIN schedules s ON m.movie_id=s.movie_id;";
$result = $conn->query($sql);
?>
</style>

<section class="search-section">
    <p>Search for showtimes on: </p>
    <input type="date" name="date-search" id="date-search" value=<?=$current_date?>>
    <input type="submit" name="search-btn" id="search-btn">
</section>

<h1>Movies</h1>

<section class="movies-section">
<?php
$last_movie = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['name'] != $last_movie) {
?> 
<div>
    <a class="movie-link" href="index.php?page=movie&movie_id=<?= $row['movie_id'] ?>">
        <img src="./images/<?= $row['movie_poster'] ?>" alt="Movie Poster Here" class="movie-poster">
    </a>
    <a class="movie-link" href="index.php?page=movie&movie_id=<?= $row['movie_id'] ?>">
        <h2><?= $row['name'] ?></h2>
        <p><em>Rating: <?= $row['rating'] ?></em></p>
    </a>
</div>
<?php
        }
        $last_movie = $row['name'];
    }
}
?>
</section>
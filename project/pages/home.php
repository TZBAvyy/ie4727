<style>
<?php 
include './pages/home.css'; 

$current_date = date("Y-m-d");
$sql = "SELECT m.*,s.schedule_id,s.date FROM movies m INNER JOIN schedules s ON m.movie_id=s.movie_id;";
$result = $conn->query($sql);
?>
</style>

<section class="search-section">
    <p>Search for Movies on: </p>
    <input type="date" name="date-search" id="date-search" value=<?=$current_date?>>
</section>

<h1>Movies</h1>

<section class="movies-section">
<?php
$last_movie = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['name'] != $last_movie) {
?>        
<!-- TODO: Change href to movie detail page -->
<a class="movie" href="https://google.com"> 
    <img src="./images/<?= $row['movie_poster'] ?>" alt="Movie Poster Here" class="movie-poster">
    <h2><?= $row['name'] ?></h2>
    <p><?= $row['description'] ?></p>
    <p><em>Rating: <?= $row['rating'] ?></em></p>
</a>
<?php
        }
        $last_movie = $row['name'];
    }
}
?>
</section>
<style>
<?php 
include './pages/home.css'; 

$current_date = date("Y-m-d");
$sql = "SELECT m.movie_id,m.name,m.rating,m.movie_poster FROM movies m;";
$result = $conn->query($sql);
?>
</style>

<h1>Movies (Select to update)</h1>

<section class="movies-section">
<?php while ($movie = $result->fetch_assoc()) { ?> 
<div class="movie-div">
    <a class="movie-link" href="index.php?page=update_movie&movie_id=<?= $movie['movie_id'] ?>">
        <img src="./images/<?= $movie['movie_poster'] ?>" alt="Movie Poster Here" class="movie-poster">
    </a>
    <a class="movie-link" href="index.php?page=update_movie&movie_id=<?= $movie['movie_id'] ?>">
        <h2><?= $movie['name'] ?></h2>
        <p><em>Rating: <?= $movie['rating'] ?></em></p>
    </a>
</div>
<?php } ?>
</section>
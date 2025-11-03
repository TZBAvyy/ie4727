<style>
<?php 
include './pages/home.css'; 

$current_date = date("Y-m-d");
$sql = "SELECT m.movie_id,m.name,m.rating,m.movie_poster FROM movies m;";
$result = $conn->query($sql);

if (isset($_SESSION['movie-search'])) {
    $movies = $_SESSION['movie-search'];
} else {
    $movies = [];
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
}
unset($_SESSION['movie-search']);
?>
</style>

<form class="search-section" action="./actions/searchHandler.php" method="post">
    <p>Search for showtimes on: </p>
    <input type="date" name="date-search" id="date-search" value=<?=$current_date?>>
    <input type="submit" name="search-btn" id="search-btn">
</form>

<h1>Movies</h1>

<section class="movies-section">
<?php foreach ($movies as $movie) { ?> 
<div class="movie-div">
    <a class="movie-link" href="index.php?page=movie&movie_id=<?= $movie['movie_id'] ?>">
        <img src="./images/<?= $movie['movie_poster'] ?>" alt="Movie Poster Here" class="movie-poster">
    </a>
    <a class="movie-link" href="index.php?page=movie&movie_id=<?= $movie['movie_id'] ?>">
        <h2><?= $movie['name'] ?></h2>
        <p><em>Rating: <?= $movie['rating'] ?></em></p>
    </a>
    <?php 
    if (isset($movie['schedule_id'])) {
        $date = date("d M Y\nh:i:s a",strtotime($movie['date']));
    ?>
    <a class="showtime-link" href="index.php?page=seats&schedule_id=<?= $movie['schedule_id'] ?>">
        <?= $date ?>
    </a>
    <?php } ?>
</div>
<?php } ?>
</section>
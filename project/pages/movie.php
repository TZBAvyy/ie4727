<style>
<?php 
include './pages/movie.css'; 

$current_date = date("Y-m-d");

if (isset($_GET['movie_id'])) {
    $movie_id = $_GET['movie_id'];
} else {
    header("Location: index.php?page=404");
    exit();
}

$sql = "SELECT m.*,s.schedule_id,s.date FROM movies m INNER JOIN schedules s ON m.movie_id=s.movie_id WHERE m.movie_id=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
</style>

<h1><?= $row['name'] ?></h1>

<section class="movie-information">
    <img src="./images/<?= $row['movie_poster'] ?>" alt="Movie Poster Here" class="movie-poster">
    <div class="movie-description">
        <div>
            <h2>Description: </h2>
            <h3><?= $row['description'] ?></h3>
        </div>
        <div>
            <h2>Showtimes:</h2>
            <div class="showtimes">
                <?php
                do {
                    $date = date("d-m-Y\nh:i:s a",strtotime($row['date']));
                ?>
                <a href="index.php?page=seats&schedule_id=<?=$row['schedule_id']?>"><?= $date ?></a>
                <?php
                } while ($row = $result->fetch_assoc());
                ?>
            </div>
        </div>
    </div>
</section>
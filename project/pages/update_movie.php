<style>
<?php 
include './pages/movie.css'; 
include './pages/update_movie.css'; 

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

<form class="update-form" action="./actions/updateMovie.php" method="post">
    <h1>Updating: <input class="title-input" type="text" name="name" value="<?= $row['name'] ?>"></h1>
    <input type="hidden" name="movie_id" value="<?= $row['movie_id'] ?>">
    <div class="movie-information">
        <img src="./images/<?= $row['movie_poster'] ?>" alt="Movie Poster Here" class="movie-poster">
        <div class="movie-description">
            <div>
                <h2>Description: </h2>
                <h3><textarea 
                    name="description"
                    cols="90"
                    rows="5"
                ><?= $row['description'] ?></textarea></h3>
            </div>
            <input type="submit" class="submit-update" value="Update changes">
        </div>
    </div>

    
</form>
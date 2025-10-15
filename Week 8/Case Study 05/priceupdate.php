<?php
$conn = new mysqli("localhost", "root", "", "javajam");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['update'])) {
        foreach ($_POST['update'] as $drinkId => $val) {
            $newSingle = $_POST['single'][$drinkId];
            $newDouble = $_POST['double'][$drinkId];

            if ($newSingle != "" && $newDouble != "") {
                $stmt = $conn->prepare("UPDATE categories SET price=? WHERE drinksid=? AND name='Single'");
                $stmt->bind_param("di", $newSingle, $drinkId);
                $stmt->execute();

                $stmt = $conn->prepare("UPDATE categories SET price=? WHERE drinksid=? AND name='Double'");
                $stmt->bind_param("di", $newDouble, $drinkId);
                $stmt->execute();
            }
        }
        $message = "Prices updated successfully!";
    }
}

$result = $conn->query("
    SELECT d.id AS drink_id, d.name, d.description,
           MAX(CASE WHEN c.name='Single' THEN c.price END) AS single_price,
           MAX(CASE WHEN c.name='Double' THEN c.price END) AS double_price
    FROM drinks d
    JOIN categories c ON d.id = c.drinksid
    GROUP BY d.id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price Update - JavaJam Coffee House</title>
    <link rel="stylesheet" href="base.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>JavaJam Coffee House</h1>
        </header>

        <nav id="left-col">
            <div class="nav-links">
                <a href="index.html">Home</a>
                <a href="menu.php">Menu</a>
                <a href="music.html">Music</a>
                <a href="jobs.html">Jobs</a>
                <a href="priceupdate.php">Update Prices</a>
                <a href="salesreport.php">Sales Report</a>
            </div>
        </nav>

    <div class="content">
        <h2>Click to update product prices:</h2>
        <?php if ($message) echo "<p style='color:green;'>$message</p>"; ?>

        <form method="POST">
            <table class="menu-table">
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <th>
                        <input type="checkbox" name="update[<?= $row['drink_id'] ?>]">
                        <strong><?= htmlspecialchars($row['name']) ?></strong>
                    </th>
                <td>
                    <?= htmlspecialchars($row['description']) ?><br>
                <strong>
                    Single:
                    <input type="number" step="0.01" name="single[<?= $row['drink_id'] ?>]" 
                    value="<?= number_format($row['single_price'], 2) ?>" style="width:70px;">
                    Double:
                    <input type="number" step="0.01" name="double[<?= $row['drink_id'] ?>]" 
                    value="<?= number_format($row['double_price'], 2) ?>" style="width:70px;">
                </strong>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="2" style="text-align:right;">
                <button type="submit">Update Prices</button>
                </td>
            </tr>
            </table>
        </form>
    </div>

    <footer class="footer">
        <small><i>Copyright &copy; 2014 JavaJam Coffee House</i></small><br>
        <small><a href="mailto:rongjun@choo.com">rongjun@choo.com</a></small>
    </footer>
    </div>
</body>
</html>

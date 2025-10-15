<?php
$conn = new mysqli("localhost", "root", "", "javajam");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getCategories($conn, $drinkName) {
    $sql = "
        SELECT c.name AS category, c.price 
        FROM categories c
        JOIN drinks d ON c.drinksid = d.id
        WHERE d.name = ?
        ORDER BY c.id";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $drinkName);
    $stmt->execute();
    return $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaJam Coffee House</title>
    <link rel="stylesheet" href="base.css">
    <script src="MenuUpdate.js" defer></script>
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
    </div>
</nav>

<div class="content">
    <h2>Coffee at JavaJam</h2>
    <form action="checkout.php" method="post">
        <table class="menu-table">
            <tr>
                <th><strong>Just Java</strong></th>
                <td>Regular house blend, decaffeinated coffee, or flavor of the day.<br>
                <strong>
                    <?php
                    $res = getCategories($conn, 'Just Java');
                    $i = 1;
                    while ($row = $res->fetch_assoc()):
                        $id = $i == 1 ? "Qty_Cafe_Single1" : "Qty_Cafe_Double1";
                    ?>
                        <input type="radio" 
                               id="<?= $id ?>" 
                               name="JustJava" 
                               value="<?= $row['price'] ?>"> 
                        <?= $row['category'] ?> $<?= number_format($row['price'], 2) ?>
                    <?php $i++; endwhile; ?>
                </strong></td>
                <td><input type="number" id="QtyCafe1" name="QtyCafe1" min="0" value=0></td>
                <td><input type="number" id="Price_Cafe1" name="Price_Cafe1" value=0 readonly></td>
            </tr>
            <tr>
                <th><strong>Cafe au Lait</strong></th>
                <td>House blended coffee infused into a smooth, steamed milk.<br>
                <strong>
                    <?php
                    $res = getCategories($conn, 'Cafe au Lait');
                    $i = 2;
                    while ($row = $res->fetch_assoc()):
                        $id = $i == 2 ? "Qty_Cafe_Single2" : "Qty_Cafe_Double2";
                    ?>
                        <input type="radio" 
                               id="<?= $id ?>" 
                               name="CafeAuLait" 
                               value="<?= $row['price'] ?>"> 
                        <?= $row['category'] ?> $<?= number_format($row['price'], 2) ?>
                    <?php $i++; endwhile; ?>
                </strong></td>
                <td><input type="number" id="QtyCafe2" name="QtyCafe2" min="0" value=0></td>
                <td><input type="number" id="Price_Cafe2" name="Price_Cafe2" value=0 readonly></td>
            </tr>
            <tr>
                <th><strong>Iced Cappuccino</strong></th>
                <td>Sweetened espresso blended with icy-cold milk and served in a chilled glass.<br>
                <strong>
                    <?php
                    $res = getCategories($conn, 'Iced Cappuccino');
                    $i = 3;
                    while ($row = $res->fetch_assoc()):
                        $id = $i == 3 ? "Qty_Cafe_Single3" : "Qty_Cafe_Double3";
                    ?>
                        <input type="radio" 
                               id="<?= $id ?>" 
                               name="IcedCappuccino" 
                               value="<?= $row['price'] ?>"> 
                        <?= $row['category'] ?> $<?= number_format($row['price'], 2) ?>
                    <?php $i++; endwhile; ?>
                </strong></td>
                <td><input type="number" id="QtyCafe3" name="QtyCafe3" min="0" value=0></td>
                <td><input type="text" id="Price_Cafe3" name="Price_Cafe3" value=0 readonly></td>
            </tr>

            <!-- Total -->
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Total Price:</strong></td>
                <td><input type="text" id="Total_Price" name="Total_Price" readonly></td>
            </tr>

            <tr>
                <td colspan="4" style="text-align:right;">
                    <button type="submit">Submit Order</button>
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

<?php $conn->close(); ?>

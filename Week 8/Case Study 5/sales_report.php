<?php
$conn = new mysqli('localhost','root','','ie4727_case_study_5');

if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report - JavaJam Coffee House</title>
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
            </div>
        </nav>
        <div class="content">
            <h2>Daily Sales Report</h2>
            <h3>Sales by Product</h3>
            <table class="menu-table">
            <tr>
                <th>Name</th>
                <th>Total Dollar Sales</th>
                <th>Quantity Sales</th>
            </tr>
            <?php 
            $drink_query = "SELECT d.id, d.name FROM drink d;";
            $drinks = $conn->query($drink_query);

            foreach ($drinks as $drink) {
                ?>
                <tr>
                <?php
                $total_qty = 0;
                $total_sales = 0.0;
            
                $cat_query = "SELECT dc.id, dc.price FROM drinkcategory dc WHERE dc.drink_id = ".$drink["id"].";";
                $categories = $conn->query($cat_query);
                foreach ($categories as $cat) {
                    $order_query = "SELECT oi.drink_id, oi.quantity FROM orderitem oi WHERE oi.drink_id = ".$cat["id"].";";
                    $orders = $conn->query($order_query);
                    foreach ($orders as $order) {
                        $total_qty += $order["quantity"];
                        $total_sales += $order["quantity"] * $cat["price"];
                    }
                }
            ?>
            <td><?= $drink['name'] ?></td>
            <td><?= number_format($total_sales, 2) ?></td>
            <td><?= $total_qty ?></td>
            </tr>
            <?php
            }
            ?>
            </table>

            <h3>Sales by Category</h3>
            <table class="menu-table">
            <tr>
                <th>Category</th>
                <th>Total Dollar Sales</th>
                <th>Quantity Sales</th>
            </tr>
            <?php 
            $drink_query = "SELECT d.id, d.name FROM drink d;";
            $drinks = $conn->query($drink_query);

            foreach ($drinks as $drink) {
                ?>
                <tr>
                <?php
                $total_qty = 0;
                $total_sales = 0.0;
            
                $cat_query = "SELECT dc.id, dc.price FROM drinkcategory dc WHERE dc.drink_id = ".$drink["id"].";";
                $categories = $conn->query($cat_query);
                foreach ($categories as $cat) {
                    $order_query = "SELECT oi.drink_id, oi.quantity FROM orderitem oi WHERE oi.drink_id = ".$cat["id"].";";
                    $orders = $conn->query($order_query);
                    foreach ($orders as $order) {
                        $total_qty += $order["quantity"];
                        $total_sales += $order["quantity"] * $cat["price"];
                    }
                }
            ?>
            <td><?= $drink['name'] ?></td>
            <td><?= number_format($total_sales, 2) ?></td>
            <td><?= $total_qty ?></td>
            </tr>
            <?php
            }
            ?>
            </table>
        </div>
        <footer class="footer">
            <small>
                <i>
                    Copyright &copy; 2014 JavaJam Coffee House<br>
        
                </i>
            </small>
            <small>
                <i>
                    <a href="mailto:avisena@gibraltar.com">
                        avisena@gibraltar.com
                    </a>
                </i>
            </small>
        </footer>
    </div>
</body>
<?php 
$conn->close(); 
?>
</html>
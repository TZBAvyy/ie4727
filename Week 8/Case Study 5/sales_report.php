<?php
$conn = new mysqli('localhost','root','','ie4727_case_study_5');

if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
}
$pop_query = "SELECT d.name AS ProductName, c.category AS OptionName, o.quantity AS Qty, o.quantity * c.price AS TotalSales 
            FROM orderitem o 
            JOIN drinkcategory c ON o.drink_id = c.id 
            JOIN drink d ON c.drink_id = d.id 
            ORDER BY TotalSales DESC 
            LIMIT 1;";
$pop = $conn->query($pop_query)->fetch_assoc();
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
                <a href="menu_edit.php">Edit Menu</a>
                <a href="sales_report.php">Show Sales Report</a>
            </div>
        </nav>
        <div class="content">
            <h2>Sales Report</h2>
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
            $cat_array = [];

            foreach ($drinks as $drink) {
                ?>
                <tr>
                <?php
                $total_qty = 0;
                $total_sales = 0.0;
            
                $cat_query = "SELECT dc.id, dc.price, dc.category FROM drinkcategory dc WHERE dc.drink_id = ".$drink["id"].";";
                $categories = $conn->query($cat_query);
                foreach ($categories as $cat) {
                    if (!array_key_exists($cat["category"], $cat_array)) {
                        $cat_array[$cat["category"]] = ["total_sales" => 0.0, "total_qty" => 0];
                    }
                    $order_query = "SELECT oi.drink_id, oi.quantity FROM orderitem oi WHERE oi.drink_id = ".$cat["id"].";";
                    $orders = $conn->query($order_query);
                    foreach ($orders as $order) {
                        $total_qty += $order["quantity"];
                        $total_sales += $order["quantity"] * $cat["price"];

                        $cat_array[$cat["category"]]["total_sales"] += $order["quantity"] * $cat["price"];
                        $cat_array[$cat["category"]]["total_qty"] += $order["quantity"];
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
            <?php foreach ($cat_array as $key => $value) { ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= number_format($value['total_sales'], 2) ?></td>
                <td><?= $value['total_qty'] ?></td>
            </tr>
            <?php
            }
            ?>
            </table>
            <h3>Popular option of best selling product: <strong><?=$pop['OptionName']?></strong> of <strong><?=$pop['ProductName']?></strong></h3>
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
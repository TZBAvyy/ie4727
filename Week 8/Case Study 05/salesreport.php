<?php
$conn = new mysqli("localhost", "root", "", "javajam");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$productReport = "";
$categoryReport = "";
$popularOption = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['by_product'])) {
        $sql = "
            SELECT d.name AS Product,
                   SUM(o.quantity * c.price) AS TotalSales,
                   SUM(o.quantity) AS TotalQty
            FROM orders o
            JOIN categories c ON o.categoryid = c.id
            JOIN drinks d ON c.drinksid = d.id
            GROUP BY d.name
            ORDER BY d.name ASC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $productReport = "
            <h3>Total Dollar and Quantity Sales by Products</h3>
            <table class='menu-table'>
              <tr><th>Product</th><th>Total Dollar Sales ($)</th><th>Quantity Sales</th></tr>";
            while ($row = $result->fetch_assoc()) {
                $productReport .= "<tr>
                    <td>{$row['Product']}</td>
                    <td>" . number_format($row['TotalSales'], 2) . "</td>
                    <td>{$row['TotalQty']}</td>
                </tr>";
            }
            $productReport .= "</table><br>";
        }
    }

    if (isset($_POST['by_category'])) {
        $sql = "
            SELECT 
                CASE 
                    WHEN d.name = 'Just Java' THEN 'Null' 
                    ELSE c.name 
                END AS Category,
                SUM(o.quantity * c.price) AS TotalSales,
                SUM(o.quantity) AS TotalQty
            FROM orders o
            JOIN categories c ON o.categoryid = c.id
            JOIN drinks d ON c.drinksid = d.id
            GROUP BY Category
            ORDER BY Category";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $categoryReport = "
            <h3>Total Dollar and Quantity Sales by Categories</h3>
            <table class='menu-table'>
              <tr><th>Category</th><th>Total Dollar Sales ($)</th><th>Quantity Sales</th></tr>";
            while ($row = $result->fetch_assoc()) {
                $categoryReport .= "<tr>
                    <td>{$row['Category']}</td>
                    <td>" . number_format($row['TotalSales'], 2) . "</td>
                    <td>{$row['TotalQty']}</td>
                </tr>";
            }
            $categoryReport .= "</table><br>";
        }
    }

    $sql = "
        SELECT d.name AS Product, SUM(o.quantity * c.price) AS TotalSales
        FROM orders o
        JOIN categories c ON o.categoryid = c.id
        JOIN drinks d ON c.drinksid = d.id
        GROUP BY d.name
        ORDER BY TotalSales DESC
        LIMIT 1";
    $best = $conn->query($sql)->fetch_assoc();

    if ($best) {
        $productName = $best['Product'];

        // Find popular option (Single/Double) of that product
        $sql2 = "
            SELECT c.name AS OptionName, SUM(o.quantity) AS Qty
            FROM orders o
            JOIN categories c ON o.categoryid = c.id
            JOIN drinks d ON c.drinksid = d.id
            WHERE d.name = '$productName'
            GROUP BY c.name
            ORDER BY Qty DESC
            LIMIT 1";
        $pop = $conn->query($sql2)->fetch_assoc();
        $popularOption = "Popular option of best selling product: <strong>{$pop['OptionName']}</strong> of <strong>{$productName}</strong>";
    }
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
                <a href="menu.html">Menu</a>
                <a href="music.html">Music</a>
                <a href="jobs.html">Jobs</a>
                <a href="priceupdate.php">Update Prices</a>
                <a href="salesreport.php">Sales Report</a>
            </div>
        </nav>

        <div class="content">
             <h2>Daily Sales Report</h2>
                <form method="POST">
                    <table class="menu-table">
                        <tr>
                            <th>Click to generate daily sales report:</th>
                                <td>
                                    <label><input type="checkbox" name="by_product"> Total dollar and quantity sales by products</label><br>
                                    <label><input type="checkbox" name="by_category"> Total dollar and quantity sales by categories</label>
                                </td>
                        </tr>
                        <tr>
                            <th>Popular option of best selling product:</th>
                            <td><?= $popularOption ?: "—" ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:right;"><button type="submit">Generate Report</button></td>
                        </tr>
                    </table>
                </form>
                <?= $productReport ?>
                <?= $categoryReport ?>
        </div>

        <footer class="footer">
            <small><i>Copyright &copy; 2014 JavaJam Coffee House</i></small><br>
            <small><a href="mailto:rongjun@choo.com">rongjun@choo.com</a></small>
        </footer>
    </div>
</body>
</html>

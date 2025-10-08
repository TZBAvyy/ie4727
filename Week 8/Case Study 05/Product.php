<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaJam Coffee House</title>
    <link rel="stylesheet" href="base.css">
    <script type="module" src="MenuUpdate.js"></script>
</head>
<body>
    <div class="container">
        <header class = "header">
            <h1>JavaJam Coffee House</h1>
        </header>
        <nav id="left-col">
            <div class="nav-links">
                <a href="Product.html">Product</a>
                <a href="Price.html">Price</a>
                <a href="Update.html">Update</a>
            </div>
        </nav>
    <div class = "content">
        <h2>Click to update product prices:</h2>
        <form action="Product.php" method="post">
            <table class="menu-table">
                <tr>
                    <td><input type="checkbox" name="JustJava"></td>
                    <th><strong>Just Java</strong></th>
                    <td>Regular house blend, decaffeinated coffee, or flavor of the day.<br>
                    <strong>Single $1.00 Double $2.00</strong></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="CafeAuLait"></td>
                    <th><strong>Cafe au Lait</strong></th>
                    <td>House blended coffee infused into a smooth, steamed milk.<br>
                    <strong>Single $2.00 Double $3.00</strong></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="Cappuccino"></td>
                    <th><strong>Iced Cappuccino</strong></th>
                    <td>Sweetened espresso blended with icy-cold milk and served in a chilled glass.<br>
                    <strong>Single $5.00 Double $6.00</strong> </td>
                </tr>
            </table>
        </form>
    </div>
    <footer class = "footer">
        <small>
            <i>
                Copyright &copy; 2014 JavaJam Coffee House<br>
            </i>
        </small>
        <small>
            <a href="mailto:rongjun@choo.com">
                rongjun@choo.com
            </a>
        </small>
    </footer>
    </div>
</body>
</html>
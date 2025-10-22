<?php
// PHP code to generate table rows for menu items
@ $db = new mysqli('localhost','root','','ie4727_case_study_5');

if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
}

$all_drinks_query = "SELECT * FROM drink;";
$drinks = $db->query($all_drinks_query);

$count = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaJam Coffee House</title>
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
            <h2>Coffee at JavaJam</h2>
            <form action="update_item_price.php" method="post">
            <table class="menu-table">
                <tbody>
                <?php foreach ($drinks as $drink) { 
                    $drink_cat_query = "SELECT `id`, `drink_id`, `price`, `category` FROM `drinkcategory` WHERE drink_id=".$drink['id'].";";
                    $drink_cat = $db->query($drink_cat_query);
                    if ($drink_cat === false) {
                        continue;
                    }    
                    $count = $count + 1;
                ?>
                <tr>
                    <td><input type="radio" name="selected" value=<?= $count ?> class="select-item"></td>
                    <td class="dark-row menu-item"><strong><?= htmlspecialchars($drink['name']) ?></strong></td>
                    <td class="dark-row"><?= htmlspecialchars($drink['desc']) ?>
                        <br><strong>
                            <?php foreach ($drink_cat as $cat) { ?>
                                <?= htmlspecialchars($cat['category']) ?> 
                                $<input 
                                    type="number" 
                                    name=<?= htmlspecialchars($cat['drink_id'])."-".htmlspecialchars($cat['id']) ?>
                                    value=<?= htmlspecialchars($cat['price']) ?> 
                                    placeholder=<?= htmlspecialchars($cat['price']) ?>
                                    class="price-input"
                                >  
                                <?php } ?>
                            NIL
                        </strong>
                    </td>
                </tr>
                <?php 
                } 
                $db->close();
                ?>
                </tbody>
            </table>
            <input type="submit" value="Edit Selected Item" style="align-self:right;">
            </form>
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
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaJam Coffee House</title>
    <link rel="stylesheet" href="base.css">
    <script type="module" src="./MenuUpdate.js"></script>
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
            <table class="menu-table">
                <tbody>
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
                    foreach ($drinks as $drink) {
                        $drink_cat_query = "SELECT `id`, `drink_id`, `price`, `category` FROM `drinkcategory` WHERE drink_id=".$drink['id'].";";
                        $drink_cat = $db->query($drink_cat_query);
                        if ($drink_cat === false) {
                            continue;
                        }

                        $count = $count + 1;
                        if ($count % 2 == 0) {
                            $top_output_html = "<tr><td class='menu-item'><strong>".$drink['name']."</strong></td><td>".$drink['desc']."<br><strong>";
                        } else {
                            $top_output_html = "<tr><td class='dark-row menu-item'><strong>".$drink['name']."</strong></td><td class='dark-row'>".$drink['desc']."<br><strong>";
                        }
                        $drink_options_html = "";
                        foreach ($drink_cat as $cat) {
                            $drink_options_html = $drink_options_html.$cat['category']." $".$cat['price']." <input type='radio' name='item-".$count."' value='".$cat['price']."'> ";
                        }
                        $drink_options_html = $drink_options_html."NIL <input type='radio' name='item-".$count."' value='0' checked='checked'></strong></td>";
                        $bot_output_html = "
                            <td>Qty: <input class='quantity-input' type='number' name='quantity-item-1' id='quantity-item-".$count."' min='0' max='10' step='1' value='0'></td>
                            <td>$<input class='subtotal-input' type='text' name='subtotal-item-".$count."' id='subtotal-item-".$count."' readonly value='0.00'></td>
                        </tr>";
                        echo $top_output_html.$drink_options_html.$bot_output_html;
                    }
                    $db->close();
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><p style="text-align:right">Total:</p></td>
                        <td>$<input class="subtotal-input" type="text" name="total" id="total" readonly value="0.00"></td>
                    </tr>
                </tbody>
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
</html>
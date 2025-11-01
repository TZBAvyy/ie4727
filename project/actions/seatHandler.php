<?php 
echo "<p>".$_POST["email"]."</p>";
foreach ($_POST['chosen_seats'] as $seat) { 
    echo "<p>$seat</p>";
}
?>
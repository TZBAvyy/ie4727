<?php
$conn = new mysqli("localhost", "root", "", "javajam");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("INSERT INTO receipts (orderdate) VALUES (NOW())");
$receiptId = $conn->insert_id;
$drinks = [
    ["name" => "Just Java", "priceKey" => "JustJava", "qtyKey" => "QtyCafe1"],
    ["name" => "Cafe au Lait", "priceKey" => "CafeAuLait", "qtyKey" => "QtyCafe2"],
    ["name" => "Iced Cappuccino", "priceKey" => "IcedCappuccino", "qtyKey" => "QtyCafe3"]
];

foreach ($drinks as $drink) {
    $drinkName = $drink["name"];
    $price = $_POST[$drink["priceKey"]] ?? 0;
    $qty = intval($_POST[$drink["qtyKey"]] ?? 0);

    if ($qty > 0 && $price > 0) {
        $categoryId = null;

        $stmt = $conn->prepare("
            SELECT c.id FROM categories c
            JOIN drinks d ON c.drinksid = d.id
            WHERE d.name = ? AND ABS(c.price - ?) < 0.01
            LIMIT 1
        ");
        $stmt->bind_param("sd", $drinkName, $price);
        $stmt->execute();
        $stmt->bind_result($categoryId);
        $stmt->fetch();
        $stmt->close();

        if ($categoryId) {
            $insert = $conn->prepare("
                INSERT INTO orders (categoryid, quantity, receiptid)
                VALUES (?, ?, ?)
            ");
            $insert->bind_param("iii", $categoryId, $qty, $receiptId);
            $insert->execute();
            $insert->close();
        }
    }
}

echo "<div style='text-align:center; margin-top:20px; font-size:20px;'>
        <h2>Thank you for your order!</h2>
        <p>Your order has been saved successfully.</p>
        <p><a href='menu.php'>Back to Menu</a></p>
      </div>";

$conn->close();
?>

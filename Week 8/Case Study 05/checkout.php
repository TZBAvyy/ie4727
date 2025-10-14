<?php
$conn = new mysqli("localhost", "root", "", "javajam");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("INSERT INTO receipts (orderdate) VALUES (NOW())");
$receiptId = $conn->insert_id;

// Helper function
function insertOrder($conn, $drinkName, $optionValue, $qty, $receiptId) {
    if ($qty > 0 && $optionValue !== '') {

        // Map numeric radio value → "Single"/"Double"
        if (in_array($optionValue, [1, 2])) $option = $optionValue == 1 ? "Single" : "Double";
        elseif (in_array($optionValue, [2, 3])) $option = $optionValue == 2 ? "Single" : "Double";
        elseif (in_array($optionValue, [5, 6])) $option = $optionValue == 5 ? "Single" : "Double";
        else return;

        $categoryId = null;
        $stmt = $conn->prepare("
            SELECT c.id 
            FROM categories c
            JOIN drinks d ON c.drinksid = d.id
            WHERE d.name = ? AND c.name = ?
            LIMIT 1
        ");
        $stmt->bind_param("ss", $drinkName, $option);
        $stmt->execute();
        $stmt->bind_result($categoryId);
        $stmt->fetch();
        $stmt->close();

        if (!empty($categoryId)) {
            $stmt = $conn->prepare("INSERT INTO orders (categoryid, quantity, receiptid) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $categoryId, $qty, $receiptId);
            $stmt->execute();
            $stmt->close();
        }
    }
}

// Call for each drink
insertOrder($conn, "Just Java", $_POST["JustJava"] ?? '', $_POST["QtyCafe1"] ?? 0, $receiptId);
insertOrder($conn, "Cafe au Lait", $_POST["CafeAuLait"] ?? '', $_POST["QtyCafe2"] ?? 0, $receiptId);
insertOrder($conn, "Iced Cappuccino", $_POST["IcedCappuccino"] ?? '', $_POST["QtyCafe3"] ?? 0, $receiptId);

echo "<h2>Thank you for your order!</h2>";
echo "<p>Your order has been saved successfully.</p>";
echo "<p><a href='menu.html'>Back to Menu</a></p>";

$conn->close();
?>

<?php
@ $conn = new mysqli('localhost','root','','ie4727_case_study_5');

if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
}

$conn->query("INSERT INTO `order` (date_of_purchase) VALUES (NOW())");
$orderId = $conn->insert_id;

// Helper function
function insertOrder($conn, $drinkId, $price, $qty, $orderId) {
    $categoryId = null;
    $stmt = $conn->prepare("
        SELECT c.id 
        FROM drinkcategory c
        WHERE c.drink_id = ? AND c.price = ?
        LIMIT 1
    ");
    $stmt->bind_param("ss", $drinkId, $price);
    $stmt->execute();
    $stmt->bind_result($categoryId);
    $stmt->fetch();
    $stmt->close();

    if (!empty($categoryId)) {
        $stmt = $conn->prepare("INSERT INTO `orderitem` (order_id, drink_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $orderId, $categoryId, $qty);
        $stmt->execute();
        $stmt->close();
    }
}

// Call for each drink
if (isset($_POST["quantity-item-1"]) && isset($_POST["item-1"]) && $_POST["quantity-item-1"] != 0 && $_POST["item-1"] != 0) {
    insertOrder($conn, 1, $_POST["item-1"], $_POST["quantity-item-1"], $orderId);
}
if (isset($_POST["quantity-item-2"]) && isset($_POST["item-2"]) &&$_POST["quantity-item-2"] != 0  && $_POST["item-2"] != 0) {
    insertOrder($conn, 2, $_POST["item-2"], $_POST["quantity-item-2"], $orderId);
}
if (isset($_POST["quantity-item-3"]) && isset($_POST["item-3"]) &&$_POST["quantity-item-3"] != 0  && $_POST["item-3"] != 0) {
    insertOrder($conn, 3, $_POST["item-3"], $_POST["quantity-item-3"], $orderId);
}

echo "<h2>Thank you for your order!</h2>";
echo "<p>Your order has been saved successfully.</p>";
echo "<p><a href='menu.php'>Back to Menu</a></p>";

$conn->close();
?>
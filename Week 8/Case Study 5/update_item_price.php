<?php

$selected = $_POST["selected"];
$catToChange = [];

@ $db = new mysqli('localhost','root','','ie4727_case_study_5');

if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
}

$retrieve_all_catID_query = "SELECT c.id, c.price FROM drinkcategory c WHERE c.drink_id=?;";
$stmt = $db->prepare($retrieve_all_catID_query); 
$stmt->bind_param("i", $selected);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $catToChange[] = $row; 
}

foreach ($catToChange as $catRow) 
{
    updateOrder($db, $catRow["id"], $_POST[$selected."-".$catRow["id"]]);
}

function updateOrder($conn, $catId, $price) {
    $sql = "UPDATE drinkcategory SET price=? WHERE id=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("di", $price, $catId);
    $stmt->execute();
    $stmt->close();
}

$db->close();

echo "<h2>Updated!</h2>";
echo "<p>Your changes has been saved successfully.</p>";
echo "<p><a href='menu_edit.php'>Back to Editing</a></p>";
echo "<p><a href='menu.php'>Back to Menu</a></p>";
?>


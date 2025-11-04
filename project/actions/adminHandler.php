<?php
require_once "../config.php";
$success = false;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php?page=error");
    exit();
}
$action = $_POST['action'] ?? ''; // Which action to perform on user

switch ($action) {
    case 'login':
        if (isset($_POST['username']) &&
            isset($_POST['password'])) 
        {   
            $username = trim($_POST['username']);
            $password = md5(trim($_POST['password']));
            $stmt = $conn->prepare("SELECT * FROM admins WHERE username=? AND password=?");
            $stmt->bind_param("ss",$username, $password);
            $success = $stmt->execute();
            $admin_result = $stmt->get_result();
            $admin = $admin_result->fetch_assoc();
            $_SESSION['admin'] = $admin;
        }
        break;

    case 'register':
        if (isset($_POST['username']) &&
            isset($_POST['password'])) 
        {
            $username = trim($_POST['username']);
            $password = md5(trim($_POST['password']));
            $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss",$username, $password);
            $success = $stmt->execute();
        }
        break;
    
    // TODO: Update user details
    case 'update_user':
        $id = intval($_POST['id']);
        $name = trim($_POST['name']);
        $stmt = $conn->prepare("UPDATE users SET name=? WHERE id=?");
        $stmt->bind_param("si", $name, $id);
        $stmt->execute();
        break;

    // TODO: Delete user account
    case 'delete_user':
        $id = intval($_POST['id']);
        $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        break;
}

$conn->close();

if ($success) {
    header("Location: ../index.php?page=home");
    exit();
} else {
    header("Location: ../index.php?page=error");
    exit();
}
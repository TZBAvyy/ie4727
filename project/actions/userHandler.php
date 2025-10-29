<?php
require_once "../config.php";
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? ''; // Which action to perform on user
    
    switch ($action) {
        case 'login':
            if (isset($_POST['username']) &&
                isset($_POST['password'])) 
            {   
                $username = trim($_POST['username']);
                $password = md5(trim($_POST['password']));
                $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND hashpassword=?");
                $stmt->bind_param("ss",$username, $password);
                $success = $stmt->execute();
                // TODO: keep session state of user
            }
            break;

        case 'register':
            if (isset($_POST['username']) &&
                isset($_POST['name']) &&
                isset($_POST['email']) &&
                isset($_POST['password'])) 
            {
                $username = trim($_POST['username']);
                $name = trim($_POST['name']);
                $email = trim($_POST['email']);
                $password = md5(trim($_POST['password']));
                $stmt = $conn->prepare("INSERT INTO users (username, name, email, hashpassword) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss",$username, $name, $email, $password);
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
}

header("Location: ../public/index.php?page=home&success=$success");
$conn->close();
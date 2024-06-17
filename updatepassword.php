<?php
// updatepassword.php

require_once 'include/db.php'; // Include your database connection file

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $password = $_POST['password'];
    $userId = $_SESSION['userId']; // Ensure the session contains the userId

    // Check if the userId is set in the session
    if (!isset($userId)) {
        echo "User not logged in.";
        exit();
    }

    // Prepare and bind
    $stmt = $con->prepare("UPDATE `passwordmanager`.`passwords` SET description = ?, password = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssii", $description, $password, $id, $userId);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$con->close();
?>
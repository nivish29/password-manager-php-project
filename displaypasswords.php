<?php
// displaypasswords.php

require_once 'include/db.php'; // Include your database connection file
$userId = $_SESSION['userId']; // Ensure the session contains the userId
// Check if the userId is set in the session
if (!isset($userId)) {
  echo "User not logged in.";
  exit();
}

// Prepare and execute the query
$stmt = $con->prepare("SELECT id,description, password FROM `passwordmanager`.`passwords` WHERE user_id = ? ORDER BY id DESC");
if (!$stmt) {
  echo "Prepare failed: (" . $con->errno . ") " . $con->error;
  exit();
}

$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
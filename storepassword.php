<?php
// storepassword.php
require_once 'include/db.php'; // Include your database connection file

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // echo  $_POST['password']; Password received in string 
  $description = $_POST['description'];
  $password = $_POST['password'];
  $userId = $_SESSION['userId']; // Ensure the session contains the userId

  // Check if the userId is set in the session
  if (!isset($userId)) {
    echo "User not logged in.";
    exit();
  }

  // Prepare and bind
  $stmt = $con->prepare("INSERT INTO `passwordmanager`.`passwords` (user_id, description, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $userId, $description, $password);

  if ($stmt->execute()) {
    return true;
  } else {
    return false;
  }

  $stmt->close();
}

$con->close();
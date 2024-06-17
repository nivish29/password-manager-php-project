<?php
require_once 'include/db.php'; // Include your database connection file
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($email) || empty($password)) {
    $error_message = "All fields are required.";
  }

  echo 'testing';
  // Prepare and execute the SQL query
  $sql = "SELECT id, password FROM `passwordmanager`.`users` WHERE email = ?";
  $stmt = mysqli_prepare($con, $sql);
  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $hashed_password);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Verify the password
    if (password_verify($password, $hashed_password)) {
      // Create session variables
      $_SESSION['userId'] = $id;
      header('Location: index.php'); // Redirect to a dashboard or another page
      exit();
    } else {
      $error_message = "Invalid email or password.";
    }
  } else {
    $error_message = "Error preparing the statement: " . mysqli_error($con);
  }
}
// Close the database connection
mysqli_close($con);
<?php
  include "middleware.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="bg-white min-vh-100 d-flex flex-column justify-content-center align-items-center">
    <h1 class="display-4 font-weight-bold text-dark mb-4">
      Welcome to Your Dashboard
    </h1>
    <p class="h5 text-secondary text-center mb-4">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    </p>
    <img src="https://placehold.co/400" alt="Dashboard Image" class="rounded-lg shadow-lg mb-4" />
    <button class="btn btn-primary px-4 py-2">
      Get Started
    </button>
    <a href="logout.php" class="btn btn-danger mt-3 px-4 py-2">
      Logout
    </a>
  </div>
</body>

</html>
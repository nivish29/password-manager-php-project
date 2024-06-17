<?php
    session_start();
    //Destroy the session
    session_unset();
    session_destroy();
    // redirect to login page
    header('Location:login.php');
    exit();
?>
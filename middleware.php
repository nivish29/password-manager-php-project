<?php
    session_start();
    if(!(isset($_SESSION['userId'])) || $_SESSION['userId']==''){
        header('location:login.php');
        exit();
    }
?>
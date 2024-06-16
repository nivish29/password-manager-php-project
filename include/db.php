<?php
    $server="localhost:3307";
    $username="root";
    $password="";
    $con=mysqli_connect($server,$username,$password);
    if(!$con){
        die("Could not connect to the database due to ".mysqli_connect_error());
    }
    // echo "Connection was successful<br>";
?>
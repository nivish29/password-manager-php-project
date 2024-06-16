<?php
   include "include/db.php";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        if(empty($username)||empty($email)||empty($password)){
            $error_message="All fields are required";
        }else{
            $email_check_query="SELECT * FROM `passwordmanager`.`users` where email=?";
            $stmt=mysqli_prepare($con,$email_check_query);
            mysqli_stmt_bind_param($stmt,"s",$email); // s is a type
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                $error_message="Email already exists. Please use a different email.";
              } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                // Prepare the SQL statement
                $sql = "INSERT INTO `passwordmanager`.`users` (username, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($con, $sql);
                if ($stmt) {
                    // Bind the parameters
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);
        
                    // Execute the statement
                    if (mysqli_stmt_execute($stmt)) {
                        $success_message="New record created successfully";
                    } else {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
        
                    // Close the statement
                    mysqli_stmt_close($stmt);
                } else {
                    $error_message="Error preparing the statement: " . mysqli_error($con);
                }
            }
        }
        mysqli_close($con);
    }
?>
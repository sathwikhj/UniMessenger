<?php
    // Start or resume a session
    session_start();

    // Check if the user is logged in
    if(isset($_SESSION['unique_id'])){
        // Include the database configuration file
        include_once "config.php";

        // Get the logout_id from the GET request, escaping it to prevent SQL injection
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);

        // Check if logout_id is set
        if(isset($logout_id)){
            // Set the status to "Offline now" for the user with the specified unique_id
            $status = "Offline now";
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}");

            // Check if the status update was successful
            if($sql){
                // Unset all session variables and destroy the session
                session_unset();
                session_destroy();
                header("location: ../login.php"); // Redirect to the login page after logout
            }
        }else{
            header("location: ../users.php"); // Redirect to the users page if logout_id is not set
        }
    }else{  
        header("location: ../login.php"); // Redirect to the login page if the user is not logged in
    }
?>

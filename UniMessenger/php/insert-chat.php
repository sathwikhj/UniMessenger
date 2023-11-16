<?php 
    // Start or resume a session
    session_start();

    // Check if the user is logged in
    if(isset($_SESSION['unique_id'])){
        // Include the database configuration file
        include_once "config.php";

        // Get the outgoing user's unique_id from the session
        $outgoing_id = $_SESSION['unique_id'];

        // Get the incoming user's unique_id from the POST request
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);

        // Get the message content from the POST request
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        // Check if the message is not empty
        if(!empty($message)){
            // Insert the message into the messages table in the database
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }else{
        // If the user is not logged in, redirect to the login page
        header("location: ../login.php");
    }
?>

<?php
    // Start or resume a session
    session_start();

    // Include the database configuration file
    include_once "config.php";

    // Get the outgoing user's unique_id from the session
    $outgoing_id = $_SESSION['unique_id'];

    // Query to select all users except the outgoing user, ordered by user_id in descending order
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC";

    // Execute the query
    $query = mysqli_query($conn, $sql);

    // Initialize the output variable
    $output = "";

    // Check if there are users available
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat"; // Display a message if no users are available
    }elseif(mysqli_num_rows($query) > 0){
        // Include data.php, which presumably contains code to display user information
        include_once "data.php";
    }

    // Output the constructed result
    echo $output;
?>

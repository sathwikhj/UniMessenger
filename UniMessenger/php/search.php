<?php
    // Start or resume a session
    session_start();

    // Include the database configuration file
    include_once "config.php";

    // Get the outgoing user's unique_id from the session
    $outgoing_id = $_SESSION['unique_id'];

    // Get the search term from the POST request, escaping it to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    // Query to select users based on the search term
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    
    // Initialize the output variable
    $output = "";

    // Execute the query
    $query = mysqli_query($conn, $sql);

    // Check if there are matching users
    if(mysqli_num_rows($query) > 0){
        // Include data.php, which presumably contains code to display user information
        include_once "data.php";
    }else{
        // If no users are found, construct a message for no results
        $output .= 'No user found related to your search term';
    }

    // Output the constructed result
    echo $output;
?>

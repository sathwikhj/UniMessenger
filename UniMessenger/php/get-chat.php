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

        // Initialize the output variable
        $output = "";

        // Query to retrieve messages between the outgoing and incoming users
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);

        // Check if there are messages
        if(mysqli_num_rows($query) > 0){
            // Loop through each row in the result set
            while($row = mysqli_fetch_assoc($query)){
                // Check if the message is outgoing (sent by the current user)
                if($row['outgoing_msg_id'] === $outgoing_id){
                    // Build HTML for outgoing message
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    // Build HTML for incoming message
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            // If there are no messages, display a message indicating so
            $output .= '<div class="text">No messages are available. Once you send a message, it will appear here.</div>';
        }

        // Output the constructed HTML
        echo $output;
    }else{
        // If the user is not logged in, redirect to the login page
        header("location: ../login.php");
    }
?>

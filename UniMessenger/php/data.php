<?php
    // Loop through each row in the result set obtained from the first query
    while($row = mysqli_fetch_assoc($query)){
        // Query to fetch the latest message for the current user
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);

        // If there is a message, assign it to $result; otherwise, set $result to a default message
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";

        // If the message is longer than 28 characters, truncate it and add '...' at the end
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;

        // Determine if the message is from the current user ("You")
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }

        // Determine the status of the user (Online or Offline)
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

        // Hide the message preview for the current user
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

        // Build the HTML output for each user, including their profile image, name, message preview, and status
        $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                    <div class="content">
                    <img src="php/images/'. $row['img'] .'" alt="">
                    <div class="details">
                        <span>'. $row['fname']. " " . $row['lname'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';
    }
?>

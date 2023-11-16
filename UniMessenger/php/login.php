<?php 
    // Start or resume a session
    session_start();

    // Include the database configuration file
    include_once "config.php";

    // Get email and password from the POST request, escaping them to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if both email and password are not empty
    if(!empty($email) && !empty($password)){
        // Query to select user information based on the provided email
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

        // Check if there is a user with the provided email
        if(mysqli_num_rows($sql) > 0){
            // Fetch user details
            $row = mysqli_fetch_assoc($sql);

            // Encrypt the provided password for comparison
            $user_pass = md5($password);
            $enc_pass = $row['password'];

            // Check if the encrypted password matches the stored password
            if($user_pass === $enc_pass){
                // Update user status to "Active now"
                $status = "Active now";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                
                // Check if the status update was successful
                if($sql2){
                    // Set the user's unique_id in the session
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "success"; // Signal success to the client
                }else{
                    echo "Something went wrong. Please try again!"; // Display an error message
                }
            }else{
                echo "Email or Password is Incorrect!"; // Display an error message for incorrect credentials
            }
        }else{
            echo "$email - This email does not exist!"; // Display an error message for non-existent email
        }
    }else{
        echo "All input fields are required!"; // Display an error message for empty fields
    }
?>

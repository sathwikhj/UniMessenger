<?php 
  // Start the session to manage user sessions
  session_start();
  
  // Include the configuration file
  include_once "php/config.php";
  
  // Check if the user is not logged in, redirect to the login page
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<?php include_once "header.php"; ?>

<body>
  <!-- Main wrapper -->
  <div class="wrapper">
    
    <!-- Chat area section -->
    <section class="chat-area">
      
      <!-- Header section within the chat area -->
      <header>
        <?php 
          // Get the user_id from the URL parameter and sanitize it
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          
          // Query to retrieve user information based on unique_id
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          
          // Check if the user exists
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          } else {
            // Redirect to the users page if the user doesn't exist
            header("location: users.php");
          }
        ?>
        <!-- Back button and user details -->
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      
      <!-- Chat box section -->
      <div class="chat-box">
        <!-- Messages will be displayed here -->
      </div>
      
      <!-- Typing area and form for sending messages -->
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
      
    </section>
  </div>

  <!-- Include the JavaScript file for chat functionality -->
  <script src="javascript/chat.js"></script>

</body>
</html>

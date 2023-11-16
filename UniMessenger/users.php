<?php 
  // Start the session to manage user sessions
  session_start();
  
  // Include the configuration file
  include_once "php/config.php";
  
  // If the user is not logged in, redirect to the login page
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>

<body>
  <!-- Main wrapper -->
  <div class="wrapper">
    
    <!-- Users section -->
    <section class="users">
      
      <!-- Header section within the users section -->
      <header>
        <div class="content">
          <?php 
            // Query to retrieve user information based on unique_id
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            
            // Check if the user exists
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <!-- Display user image and details -->
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <!-- Logout link with a dynamic URL for logout functionality -->
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
      </header>
      
      <!-- Search bar section -->
      <div class="search">
        <span class="text">Select a user to start a chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      
      <!-- Users list section -->
      <div class="users-list">
        <!-- User list will be displayed here dynamically -->
      </div>
    </section>
  </div>

  <!-- Include JavaScript file for users functionality -->
  <script src="javascript/users.js"></script>

</body>
</html>

<?php 
  // Start the session to manage user sessions
  session_start();
  
  // If the user is already logged in, redirect to the users.php page
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>

<body>
  <!-- Main wrapper -->
  <div class="wrapper">
    
    <!-- Login form section -->
    <section class="form login">
      <!-- Form header -->
      <header>UniMessenger</header>
      
      <!-- Login form -->
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <!-- Error message display area -->
        <div class="error-text"></div>
        
        <!-- Email address input -->
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        
        <!-- Password input with show/hide functionality -->
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i> <!-- Icon for password visibility toggle -->
        </div>
        
        <!-- Submit button -->
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      
      <!-- Link to the signup page for users who are not yet signed up -->
      <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
    </section>
  </div>

  <!-- Include JavaScript files for password show/hide and login functionality -->
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>

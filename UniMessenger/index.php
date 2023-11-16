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
    
    <!-- Signup form section -->
    <section class="form signup">
      <!-- Form header -->
      <header>UniMessenger</header>
      
      <!-- Signup form -->
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <!-- Error message display area -->
        <div class="error-text"></div>
        
        <!-- User details: First Name and Last Name -->
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        
        <!-- Email address input -->
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        
        <!-- Password input with show/hide functionality -->
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i> <!-- Icon for password visibility toggle -->
        </div>
        
        <!-- Image upload input -->
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        
        <!-- Submit button -->
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      
      <!-- Link to the login page for users who are already signed up -->
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>

  <!-- Include JavaScript files for password show/hide and signup functionality -->
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>

<?php
session_start();

// If user is not logged in, redirect them to the login page
if(!isset($_SESSION['user_id'])) {
  header('Location: adminlogin.php');
  exit();
}

// If the user clicks the logout button, unset session variables and destroy the session
if(isset($_POST['logout'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    session_destroy();
    header('Location: adminlogin.php');
    exit();
  }

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'try_db');

// Check if the connection was successful
if(!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// If the user submits the form, update the password in the database
if(isset($_POST['submit'])) {
  // Get the current password from the form
  $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);

  // Query the database to check if the current password is correct
  $query = "SELECT * FROM users WHERE id={$_SESSION['user_id']} AND password='$current_password'";
  $result = mysqli_query($conn, $query);

  // If the query returns one row, the current password is correct
  if(mysqli_num_rows($result) == 1) {
    // Get the new password from the form
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);

    // Update the password in the database
    $update_query = "UPDATE users SET password='$new_password' WHERE id={$_SESSION['user_id']}";
    mysqli_query($conn, $update_query);

    // Set a success message
    $success_message = "Password updated successfully.";

    // Destroy the current session and redirect to the login page
    session_destroy();
    header('Location: adminlogin.php');
    exit();
  } else {
    // Set an error message
    $error_message = "Current password is incorrect.";
  }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Account Settings | Crust and Rolls® </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="accountsettings.css?v=<?php echo time(); ?>">
  <link rel="icon" href="cricon.ico" type="image/x-icon" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2>Crust And Rolls</h2>
        <ul>
            <li><a href="homepage.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="orders.php"><i class="fas fa-user"></i>Orders</a></li>
            <li><a href="products.php"><i class="fas fa-address-card"></i>Products</a></li>
            <li><a href="sitesettings.php"><i class="fas fa-project-diagram"></i>Site Settings</a></li>
            <li><a href="accountsettings.php"><i class="fas fa-blog"></i>Account Settings</a></li>
         
        </ul> 
        <div class="social_media">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
   
</div>

</body>
</html>
<div class="container">
        <div class="header"> <div class="titleheader">
          <h3 > ACCOUNT SETTINGS</h3>
         </div>
        <div class="dropdown">
        <button class="dropbtn" class="dropdown"><?php echo $_SESSION['username']; ?> </button>  
            <div class="dropdown-content">
                <form method="post" class="log">
                    <input type="submit" name="logout" value="Logout" class="logbtn">
                </form>
            </div> 
      </div> 

        </div>



<body>

  <?php if(isset($error_message)) { ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
  <?php } ?>

  <?php if(isset($success_message)) { ?>
    <p style="color: green;"><?php echo $success_message; ?></p>
  <?php } ?>

  <div class="content">
  <header>Change Password</header>
          <?php if(isset($error_message)) { ?>
          <p style="color: #ffb897;"><?php echo $error_message; ?></p>
          <?php } ?> <br>
          <form method="post">
             <div class="field">
             <span class="fa fa-lock"></span>
                <input type="password" name="current_password" placeholder="Current Password"><br><br>
             </div>
             <div class="field space">
                <span class="fa fa-lock"></span>
                <input type="password" name="new_password" class="pass-key" placeholder="New Password"><br>
                  <span class="show">SHOW</span>
             </div>
           
             <div class="field">
            <input type="submit" name="submit" value="Save Changes" class="button">
             </div>
          </form>
      
      
       </div>
    </div>
    <script>
       const pass_field = document.querySelector('.pass-key');
       const showBtn = document.querySelector('.show');
       showBtn.addEventListener('click', function(){
        if(pass_field.type === "password"){
          pass_field.type = "text";
          showBtn.textContent = "HIDE";
          showBtn.style.color = "#3498db";
        }else{
          pass_field.type = "password";
          showBtn.textContent = "SHOW";
          showBtn.style.color = "#222";
        }
       });
    </script>
  </form>
</body>
</html>







<?php
session_start();

// If user is already logged in, redirect them to the dashboard
if(isset($_SESSION['user_id'])) {
  header('Location: Products.php');
  exit();
}

// Check if the login form has been submitted
if(isset($_POST['submit'])) {
  // Connect to the database
  $conn = mysqli_connect('localhost', 'root', '', 'try_db');

  // Check if the connection was successful
  if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Get the username and password from the form
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Query the database to check if the username and password are correct
  $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);

  // If the query returns one row, the login was successful
  if(mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    // Set session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    // Redirect to the dashboard
    header('Location: products.php');
    exit();
  } else {
    $error_message = "Invalid username or password.";
  }

  // Close the database connection
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Admin Login Crust and Rolls® </title>
      <link rel="stylesheet" href="adminlogin.css?v=<?php echo time(); ?>">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>

 

      <div class="bg-img">
         <div class="content">
            <header>Login</header>
            <?php if(isset($error_message)) { ?>
            <p style="color: #ffb897;"><?php echo $error_message; ?></p>
            <?php } ?> <br>
            <form method="post">
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" name="username" placeholder="Username"><br>
               </div>
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" name="password" class="pass-key" placeholder="Password"><br>
                  <span class="show">SHOW</span>
               </div>
               <div class="pass">
                 <br>
               <div class="field">
               <input type="submit" name="submit" value="Login" class="button">
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
   </body>
</html>






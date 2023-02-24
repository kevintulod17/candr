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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Products | Crust and Rolls® </title>
	<link rel="stylesheet" href="products.css?v=<?php echo time(); ?>">
  <link rel="icon" href="cricon.ico" type="image/x-icon" />
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2>Crust And Rolls</h2>
        <ul>
            <li><a href="homepage.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="orders.php"><i class="fas fa-user"></i>Orders</a></li>
            <li><a href="products.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i></i>Products</a></li>
            <li><a href="sitesettings.php"><i class="fas fa-project-diagram"></i>Site Settings</a></li>
            <li><a href="accountsettings.php"><i class="fas fa-blog"></i>Account Settings</a></li>
         
        </ul> 
        <div class="social_media">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="main_content">
      
        <div class="header">
          <div class="titleheader">
          <h3 > PRODUCTS INFORMATION </h3>
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
        <div class="info">
            <div class="productform"> 
                <iframe src="productform.php" class="productformclass" width=100%  height=100%></iframe>
            </div>
            <div class="productedit"> 
                <iframe src="productedit.php" class="producteditlass" width=100% height=100% window.location.reload();></iframe>
            </div>
      </div>
    </div>
</div>

</body>
</html>


</body>
</html>



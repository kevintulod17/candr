<html> 

    <head>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="icon" href="cricon.ico" type="image/x-icon" />
		<title> Crust and Rolls </title>
          <script src="script.js"></script>
		<link rel="stylesheet" href="usersushicss.css?v=<?php echo time(); ?>">
    </head>

    <body style = "margin:0">
    <div class = "whole">
    <div class = "child">
    <div id="footer">
        Crust and Rolls®
        <button class="scroll-up">Scroll up</button>
    <button class="scroll-down">Scroll down</button>
   
                </div>  
                
            <div class="page1" id="scrollable">
                <div class="heading"> 
                <img src="crustandrolls.png" class="image">
                <ul>
                <li> <a href="#"> HOME </a></li> 
                <li> <a href="#"> ABOUT US</a></li> 
                <li> <a href="#"> HELP </a></li> 
                <li> <a href="#"> SUPPORT </a></li> 
                <li> <a href="#" class="special1"> CONTACT US</a></li> 
                </ul>
                </div>
                
            <div class="preorder">
                <center> <h2 class="pobutton"> <a href="#page3"> PRE-ORDER NOW! </a></h2>
            </div>    
       
        </div>

            <div class="page3" id="scrollable">
                <?php

@include 'conn.php';

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="container">

<section class="products">

   <h1 class="p3buy">What would you like to buy?</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `productinfo`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['product_image']; ?>" alt="">
            <h3><?php echo $fetch_product['product_name']; ?></h3>
            <div class="price">₱<?php echo $fetch_product['product_price']; ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['product_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['product_price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['product_image']; ?>">
            <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
         </div>
      </form>
    
      <?php
         };
      };
      ?>

   </div>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
            </div>
            
            <div class="page4" id="scrollable"><br> <br><br><br><br><br> <br><br><br><br><br> <br><br><br><br><br> <br>
            <div class="inputcontainer">
                <center><h1 class="tagname"> What's your name?</h1> 
                <form action=userconnect.php method="post">
                    <label for="name"> </label>
                    <input type="text" id="name" name="name" required placeholder="Enter Here" size="50" maxlength="50" required="required" class="formname"> 
                    <a href="scrollable">Next</a>
            </div>
            </div>
            <div class="page2" id="scrollable"><br><br><br><br><br><br><br><br><br><br><br>
                <center><h1 class="formname"> When do you want to order?</h1> <br> <br><br>
                <h3 class="showdates">Showing next available dates </h3> <br><br><br>
                

<?php
// Get the current date
$current_date = date('Y-m-d');
$max_date = date('Y-m-d', strtotime('+10 days'));
$min_date1 = date('Y-m-d', strtotime('+5 days'));
$min_date2 = date('Y-m-d', strtotime('+6 days'));
$min_date3 = date('Y-m-d', strtotime('+7 days'));
$min_date4 = date('Y-m-d', strtotime('+8 days'));
$min_date5 = date('Y-m-d', strtotime('+9 days'));

// Connect to the database
$db = new mysqli('localhost', 'root', '', 'try_db');

// Check for errors
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}


// If the user submitted a date, insert it into the database
if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $sql = "INSERT INTO orders (date) VALUES ('$date')";
    if ($db->query($sql) === false) {
        die('Error inserting event: ' . $db->error);
    }
}

// Get the events within the next 5 days
$sql = "SELECT * FROM events WHERE event_date BETWEEN '$current_date' AND '$max_date'";
$result = $db->query($sql);

// Display the calendar

echo '<input type="radio" name="date" id= "date1" value="' . $min_date1 . '"><label for="date1" class="dates">' . $min_date1 . '</label> <br>'; 
echo '<input type="radio" name="date" id= "date2" value="' . $min_date2 . '"><label for="date2" class="dates">' . $min_date2 . '</label> <br>';
echo '<input type="radio" name="date" id= "date3" value="' . $min_date3 . '"><label for="date3" class="dates">' . $min_date3 . '</label> <br>';
echo '<input type="radio" name="date" id= "date4" value="' . $min_date4 . '"><label for="date4" class="dates">' . $min_date4 . '</label> <br>';
echo '<input type="radio" name="date" id= "date5" value="' . $min_date5 . '"><label for="date5" class="dates">' . $min_date5 . '</label> <br>';




// Close the database connection
$db->close();
?>
 
            </div>

            <div class="page5" id="scrollable">
            <center> <h1 class="adnum"> What is your address? </h1>
                <input type="text" id="address" name="address" required placeholder="Enter Here" size="50" maxlength="50" required="required"class="formname" > 
      
            </div>

            <div class="page6" id="scrollable">
            <center> <h1 class="adnum"> What is your Number? </h1>
                <input type="number" id="number" name="number" required placeholder="Enter Here" size="50" maxlength="50" required="required" class="formname"> 
            </div>

            <div class="page7" id="scrollable">
            <center>  <h1 class="adnum"> What is your Email? </h1>
                <input type="email" id="email" name="email" required placeholder="Enter Here" size="50" maxlength="50" required="required" class="formname"> 

            </div>
            <div class="page8" id="scrollable">
            <center>   <h1 class="adnum"> Please Confirm the Mode of Payment </h1><br><br><br>
                <input type="radio" name="method" id= "mop" value="G-CASH"><label for="mop" class="dates">G-CASH</label> <br> <br> <br> <br>
                <input type="submit" name="submit" value="Proceed to Checkout" class="btn-checkout">

            </div>
            </form>
            </div>
</div>
</div>
    </body>
    <script>
const scrollables = document.querySelectorAll('#scrollable');
const scrollUpButton = document.querySelector('.scroll-up');
const scrollDownButton = document.querySelector('.scroll-down');
const parent = document.querySelector('.parent');

let currentScrollableIndex = 0;

scrollUpButton.addEventListener('click', () => {
  if (currentScrollableIndex > 0) {
    currentScrollableIndex--;
    scrollables[currentScrollableIndex].scrollIntoView({ behavior: "smooth" });
  }
});

scrollDownButton.addEventListener('click', () => {
  if (currentScrollableIndex < scrollables.length - 1) {
    currentScrollableIndex++;
    scrollables[currentScrollableIndex].scrollIntoView({ behavior: "smooth" });
  }
});
</script>
</html>


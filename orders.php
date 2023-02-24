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
    <title> Orders | Crust and Rolls® </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="orders.css?v=<?php echo time(); ?>">
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
          <h3 > ORDERS INFORMATION </h3>
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

    

<div class="title">  <br> <br> <br>
	<center> <h1> Order Details </h1>  <br> <br> <br>
</div>


<div class="ordertable">
    
<?php include('userconnect.php'); 

?>


<table border="5" class="tab">
			<thead class="thead">
				<th class="tname">Customer Name</th>
				<th class=taddress>Address</th>
				<th class="tnumber">Number</th>
				<th class="temail">Email</th>
				<th class="tmethod">Payment Method</th>
				<th class="tproducts">Ordered Products</th>
                <th class="ttotal">Price Total</th>
                <th class="tdate">Order Date</th>
                <th class="tcontrol">Verify</th>
				<th class="tcontrol">Order Status</th>
				<th class="tcontrol">Payment Status</th>
			</thead>

<tbody> 
	<?php
	$query = "SELECT * FROM `orders`";
	$result = mysqli_query($conn, $query);
	while ($row_fetch=mysqli_fetch_assoc($result)) 
	{
		echo"<tr class='trow'>";
		echo"<td class='tname'>" . $row_fetch['name'] . "</td>";
		echo"<td class='tdesc'>" . $row_fetch['address'] . "</td>";
		echo"<td class='tsize'>" . $row_fetch['number'] . "</td>";
		echo"<td class='tprice'>" . $row_fetch['email'] . "</td>";
        echo"<td class='tdesc'>" . $row_fetch['method'] . "</td>";
		echo"<td class='tsize'>" . $row_fetch['total_products'] . "</td>";
		echo"<td class='tprice'>" . $row_fetch['price_total'] . "</td>"; 	
        echo"<td class='tprice'>" . $row_fetch['date'] . "</td>";
		echo"<form action='verification.php?id=1' method='post'>";
		echo "<td><a href='verification.php?id=" . $row_fetch["id"] . "' class='verify-button'>Verify</a></td>";
		echo"</form>";

		if($row_fetch["order_status"]==0){
			echo "<td><button class='btn btn-danger' onclick=\"changeOrderStatus('" . $row_fetch['id'] . "')\">Pending</button></td>";
		}else{
			echo "<td><button class=\"btn btn-success\">Delivered</button></td>";
		}
		if($row_fetch["pay_status"]==0){
			echo "<td><button class='btn btn-danger' onclick=\"changePayStatus('" . $row_fetch['id'] . "')\">Unpaid</button></td>";
		}else if($row_fetch["pay_status"]==1){
			echo "<td><button class='btn btn-success'>Paid</button></td>";
		}
	}
	

	?>
</tbody>
</div>

</html>

</div>  

<script>
function changeOrderStatus(id) {
    // Ask the user to confirm the action
    if (!confirm('Are you sure you want to change the order status?')) {
        return;
    }

    // Send an AJAX request to the server to change the order status
    $.ajax({
        url: 'updateorderstatus.php',
        type: 'POST',
        data: {id: id},
        success: function(response) {
            // If the server returns a success response, update the button text
            if (response == 'success') {
                $('button[onclick="changeOrderStatus(' + id + ')"]').removeClass('btn-danger').addClass('btn-success').text('Delivered');
                location.reload();
            }
        }
    });
}

function changePayStatus(id) {
    // Ask the user to confirm the action
    if (!confirm('Are you sure you want to change the payment status?')) {
        return;
    }

    // Send an AJAX request to the server to change the payment status
    $.ajax({
        url: 'updatepaystatus.php',
        type: 'POST',
        data: {id: id},
        success: function(response) {
			console.log(response);
            // If the server returns a success response, update the button text
            if (response == 'success') {
                $('button[onclick="changePayStatus(' + id + ')"]').removeClass('btn-danger').addClass('btn-success').text('Paid');
                location.reload();
            }
        }
    });
}
</script>
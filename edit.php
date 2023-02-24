<link rel="stylesheet" href="edit.css?v=<?php echo time(); ?>">

<?php
	include('conn.php');
	$id=$_GET['id'];
	$query=mysqli_query($conn,"select * from `productinfo` where id='$id'");
	$row=mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
<head>
<title>Editing Products</title>
<style>
	
</style>
</head>
<body>
	<center><h1 class="title">Edit Product:  <?php echo $row['product_name']; ?></h1> </center> <br> <br>
	<form method="POST" action="update.php?id=<?php echo $id; ?>">
		<label class="pname">Product Name:</label><input type="text" value="<?php echo $row['product_name']; ?>" name="product_name" required placeholder="Enter Here" size="40" maxlength="50" required="required" class="namef"> <br> <br> <br>
		<label class="pdesc">Product Description:</label><textarea rows='6' cols='40' type="text" value="<?php echo $row['product_description']; ?>" name="product_description" required placeholder="Enter Here" size="50" maxlength="1000" required="required" class="descf"> </textarea><br> <br>
		<label class="psize">Product Size:</label><input type="text" value="<?php echo $row['product_size']; ?>" name="product_size" required placeholder="Enter Here" size="40" maxlength="50" required="required" class="sizef"> <br>
		<label class="pprice">Product Price:</label><input type="number" value="<?php echo $row['product_price']; ?>" name="product_price" required placeholder="Enter Here" size="40" maxlength="50" required="required" class="pricef"> <br>
		<label class="pimage">Product Image:</label><input type="file" value="<?php echo $row['product_image']; ?>" name="product_image" required="required" class="imagef"> <br>
		<center>  <input type="submit" name="submit" class="sbutton" value ="Update"> </center> <br> <br>
		 <a href="productedit.php" class="bbutton">Back</a> 
	</form>
</body>
</html>
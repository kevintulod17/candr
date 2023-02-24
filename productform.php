<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="productform.css?v=<?php echo time(); ?>">
<title>Product List</title>
<script type="text/javascript">
	function displaymessage()
	{
		alert ("Product Added! Reload to see Updated Product List")
	}
</script>
</head>
<body>
<div class="main">
		<div class=containerform>
		<form method="POST" action="add.php"> <br> <br>
      <h1> <center> Product Form (Add a Product) </h1>  <br> <br>
			<label class="pname">Product Name: </label><input type="text" name="product_name" required placeholder="Enter Here" size="40" maxlength="50" required="required" class="namef" rows="5" > <br> <br> <br>
			<label class="pdesc">Product Description: </label><textarea rows='6' cols='40' type="text" name="product_description" required placeholder="Enter Here" size="50" maxlength="1000" required="required" class="descf"> </textarea> <br>
			<label class="psize">Product Size:</label><input type="text" name="product_size" required placeholder="Enter Here" size="40" maxlength="50" required="required" class="sizef"> <br>
			<label class="pprice">Product Price:</label><input type="number" name="product_price" required placeholder="Enter Here" size="40" maxlength="50" required="required" class="pricef"> <br>
			<label class="pimage">Product Image:</label><input type="file" name="product_image" required="required" class="hide_file"> <br> <br>
			<center> <input type="submit" name="add" required="required" onclick="displaymessage()" class="sbutton" value="Enter" ><br> <br>
		
		</form>
		</div>
	</div>

	


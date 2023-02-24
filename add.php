<?php
	include('conn.php');
	
	$product_name=$_POST['product_name'];
	$product_description=$_POST['product_description'];
	$product_price=$_POST['product_price'];
	$product_size=$_POST['product_size'];
	$product_image=$_POST['product_image'];
		
	mysqli_query($conn,"insert into `productinfo` (product_name,product_description, product_price ,product_size, product_image) values ('$product_name','$product_description',
	'$product_price','$product_size','$product_image')");	
	header('location:productform.php');
	
?>
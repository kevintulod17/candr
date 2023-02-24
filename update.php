<?php
	include('conn.php');
	$id=$_GET['id'];
	
	$product_name=$_POST['product_name'];
	$product_description=$_POST['product_description'];
	$product_price=$_POST['product_price'];
	$product_size=$_POST['product_size'];
	$product_image=$_POST['product_image'];
	
	mysqli_query($conn,"update `productinfo` set product_name='$product_name', product_description='$product_description' , product_size='$product_size', product_price='$product_price' , product_image='$product_image' where id='$id'");
	header('location:productedit.php');
?>
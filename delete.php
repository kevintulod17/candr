<?php
	$id=$_GET['id'];
	include('conn.php');
	mysqli_query($conn,"delete from `productinfo` where id='$id='");
	header('location:productedit.php');
?>
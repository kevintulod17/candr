<link rel="stylesheet" href="productedit.css?v=<?php echo time(); ?>">

<div class="title">  <br> <br> <br>
	<center> <h1> Product List (Update and Delete) </h1>  <br> <br> <br>

</div>
<div class="producttable">
<?php include('conn.php'); if (isset($_POST['upload'])) {
	$img_loc = $_FILES['product_image']['tmp_name'];
	$img_name = $_FILES['product_image']['name'];
	$img_ext = pathinfo($img_name, PATHINFO_EXTENSION);

	$img_des = "crud/" . $uname . "." . $img_ext;

	$query = "INSERT INTO 'productinfo' ('product_image') VALUES ('$img_des')";
	if(mysqli_query($conn, $query))
	{
		move_uploaded_file($img_loc, $img_des);
		echo "<script>alert('Successful');</script>";
	} 
	else 
	{
		echo "<script>alert('unSuccessful');</script>";
	}
}
 ?>



<table border="5" class="tab">
			<thead class="thead">
				<th class="tname">Product Name</th>
				<th class=tdesc>Description</th>
				<th class="tsize">Size</th>
				<th class="tprice">Price</th>
				<th class="timage">Image</th>
				<th class="tcontrol">Controls</th>
			
			</thead>

<tbody> 
	<?php
	$query = "SELECT * FROM `productinfo`";
	$result = mysqli_query($conn, $query);
	while ($row_fetch=mysqli_fetch_assoc($result)) 
	{
		echo"<tr class='trow'>";
		echo"<td class='tname'>" . $row_fetch['product_name'] . "</td>";
		echo"<td class='tdesc'>" . $row_fetch['product_description'] . "</td>";
		echo"<td class='tsize'>" . $row_fetch['product_size'] . "</td>";
		echo"<td class='tprice'>" . $row_fetch['product_price'] . "</td>";
		echo "<td class='timage'> <img src = '$row_fetch[product_image]' width='190px'> </td>";
		echo "<td>";
		echo "<div class='btn-group'>";
		echo "<a class='editbutton'href='./edit.php?id= " . $row_fetch['id'] . "'> Edit </a>";
		echo "<a class='deletebutton'href='./delete.php?id= " . $row_fetch['id'] . "'> Delete </a>";
		echo "<script>
   								 var elems = document.getElementsByClassName('deletebutton');
									var confirmIt = function (e) {
										if (!confirm('Are you sure you want to delete?')) e.preventDefault();
									};
									for (var i = 0, l = elems.length; i < l; i++) {
										elems[i].addEventListener('click', confirmIt, false);
									}
								</script>";
	}
	

	?>
</tbody>
</div>

</html>


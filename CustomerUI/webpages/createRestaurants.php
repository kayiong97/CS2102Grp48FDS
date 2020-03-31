<!DOCTYPE html>
<head>
<title>Create</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {listt-style: none;}
</style>
</head>

<body>
<h2>Enter information regarding restaurant</h2>
<ul>
	<form name="insert" action="createRestaurants.php" method="POST" >
		<li>Restaurant ID:</li><li><input type="text" name="restaurant_id" disabled/></li>
		<li>Name:</li><li><input type="text" name="name" /></li>
		<li>Contact Number:</li><li><input type="text" name="contactNo" /></li>
		<li>Address:</li><li><input type="text" name="address" /></li>
		<li>Area:</li><li><input type="text" name="area" /></li>
		<li>Min Monetary Amount:</li><li><input type="number" name="minMonetaryAmount" /></li>
		<li><input type="submit" /></li>
	</form>
</ul>
</body>
</html>	

<?php
$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
$query = "INSERT INTO restaurant(name, contactno, address, area, minmonetaryamount) VALUES ('$_POST[name]',
'$_POST[contactNo]','$_POST[address]','$_POST[area]',
'$_POST[minMonetaryAmount]')";
$result = pg_query($query); 
?>
<!DOCTYPE html>
<head>  <title>Restaurant</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>
	li {list-style: none;}
	</style>
</head>
<body>
	<h2>Enter restaurant_id and enter</h2>
	<ul>
	<form name="display" action="retrieveRestaurants.php" method="POST" >
	<li>Restaurant ID:</li><li><input type="text" name="restaurant_id" /></li>
	<li><input type="submit" name="submit" /></li>
	</form>
	</ul>
</body>
</html>

<?php

session_start();

$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
$result = pg_query($db, "SELECT * FROM restaurant WHERE restaurant_id = '$_POST[restaurant_id]'");
$row = pg_fetch_assoc($result);


if (isset($_POST['submit']))
{
	//$row[0] = '8129';
	echo "   ".$row[0];
	
	if (empty($row[0])){
		echo "IF: contactNo: ".$row['contactNo'];
	}
	else
		echo "ELSE: ".$row[0];
	
echo "
<ul>
	<form name='update' action='retrieveRestaurants.php' method='POST' >
	<li>Restaurant ID:</li><li><input type='text' name='restaurant_id_updated' value='$row[restaurant_id]' disabled /></li>
	<li>Name:</li><li><input type='text' name='name_updated' value='$row[name]' /></li>
	<li>Contact Number:</li><li><input type='text' name='contactNo_updated' value='$row[contactno]' /></li>
	<li>Address:</li><li><input type='text' name='address_updated' value='$row[address]' /></li>
	<li>Area:</li><li><input type='text' name='area_updated' value='$row[area]' /></li>
	<li>Min Monetary Amount:</li><li><input type='number' name='minMonetaryAmount_updated' value='$row[minmonetaryamount]' /></li>  
	<li><input type='submit' name='new' value='Update'/></li>
	<li><input type='submit' name='delete' value='Delete'/></li>	
	</form>
</ul>";

	$_SESSION['restaurantId'] = $row[restaurant_id];
	echo " SUBMIT ****** restaurantId: ".$_SESSION['restaurantId'];
}

if (isset($_POST['new']))
{
	
	$restaurantId = $_SESSION['restaurantId'];
	echo " NEW ****** restaurantId: ".$_SESSION['restaurantId'];
	
	$result1 = pg_query($db, "UPDATE restaurant SET name = '$_POST[name_updated]', 
	contactNo = '$_POST[contactNo_updated]', address = '$_POST[address_updated]',area = '$_POST[area_updated]',
	minMonetaryAmount = '$_POST[minMonetaryAmount_updated]' WHERE restaurant_id = '$restaurantId'");
	if (!$result1)
	{
	echo "Update failed!!";
	} else
	{
	echo "Update successfull;";
	}
}

if (isset($_POST['delete'])){
	$restaurantId = $_SESSION['restaurantId'];
	echo " NEW ****** restaurantId: ".$_SESSION['restaurantId'];
	
	$result2 = pg_query($db, "DELETE FROM restaurant WHERE restaurant_id = '$restaurantId'");
	if (!$result2)
	{
	echo "Delete failed!!";
	} else
	{
	echo "Delete successfull;";
	}
}
?>
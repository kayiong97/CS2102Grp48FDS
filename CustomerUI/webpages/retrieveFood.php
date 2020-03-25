<!DOCTYPE html>
<head>  <title>Restaurant</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>
	li {list-style: none;}
	</style>
</head>
<body>
	<h2>Choose Restaurant name, Food name and submit</h2>
	<ul>
	<form name="display" action="retrieveFood.php" method="POST" >
	<li>Restaurant Name:</li>
		<li><select id="restaurantid" name="restaurantid">
		<?php
			session_start();
			$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
			$result = pg_query($db,"SELECT restaurantid, name FROM restaurant");
			
			while ($row = pg_fetch_array( $result)) { echo "<option value=".$row['restaurantid'].">" . $row['name'] . "</option>"; } 
			
		?>
	</select></li>
	
	<input type="submit" name="submitRestaurantChosen" value="Choose Restaurant"/>
	
	<!--
		<li>Food Name:</li>
			<li><select id="name" name="name">
			<?php
			$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
			$result = pg_query($db,"SELECT name FROM restaurantfood");
			
			while ($row = pg_fetch_array( $result)) { echo "<option value=".$row['name'].">" . $row['name'] . "</option>"; } 
				
			?>
		</select></li>
	-->
	
	</form>
	</ul>
</body>
</html>

<?php

if (isset($_POST['submitRestaurantChosen']))
{	
	$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");

	$result = pg_query($db, "SELECT * FROM restaurantfood WHERE restaurantid = $_POST[restaurantid]");
	//$row = pg_fetch_assoc($result);
	
	echo "<form method='post'>";
	echo "<li>Food Name:</li>";
	echo "<li><select id='name' name='name'>";
	while ($row = pg_fetch_row( $result)) {
		echo "<option value=".$row[1].">" . $row[1] . "</option>"; 
		$foodName = $row[1];
	}
	echo "</select></li>";
	
	echo "<li><input type='submit' name='submitFood' value='Submit Food' /></li>";
	echo "</form>";
	
	$result2 = pg_query($db, "SELECT * FROM restaurantFood WHERE restaurantid = $_POST[restaurantid] AND name = '$foodName'");
	while ($row = pg_fetch_row( $result2)) {
		
		$restaurantInfo = $row[3];
		$restaurantAvailability = $row[4];
		$restaurantDailyLimit = $row[6];
		$restaurantPrice = $row[0];
	}
	
	$restaurantId = $_POST[restaurantid];
	$_SESSION['restaurantId'] = $restaurantId;
	
	$_SESSION['foodName'] = $foodName;
	$_SESSION['restaurantInfo'] = $restaurantInfo;
	$_SESSION['restaurantAvailability'] = $restaurantAvailability;
	$_SESSION['restaurantDailyLimit'] = $restaurantDailyLimit;
	$_SESSION['restaurantPrice'] = $restaurantPrice;
	
}

if (isset($_POST['submitFood']))
{	
echo "
<ul>
	<form name='update' action='retrieveFood.php' method='POST' >
	<li>Restaurant ID:</li><li><input type='text' name='restaurantid_updated' value='$_SESSION[restaurantId]' disabled /></li>
	<li>Name:</li><li><input type='text' name='name_updated' value='$_SESSION[foodName]' disabled/></li>
	<li>Information:</li><li><input type='text' name='information_updated' value='$_SESSION[restaurantInfo]' /></li>
	<li>Availability Status:</li><li><input type='text' name='availabilitystatus_updated' value='$_SESSION[restaurantAvailability]' /></li>
	<li>Daily Limit:</li><li><input type='text' name='dailylimit_updated' value='$_SESSION[restaurantDailyLimit]' /></li>
	<li>Price:</li><li><input type='number' name='price_updated' value='$_SESSION[restaurantPrice]' /></li>  
	<li><input type='submit' name='new' value='Update'/></li>
	<li><input type='submit' name='delete' value='Delete'/></li>	
	</form>
</ul>";

	$_SESSION['restaurantId'] = $row[restaurantid];
	$_SESSION['name'] = $row[name];
	echo " SUBMIT ****** restaurantId: ".$_SESSION['restaurantId']." NAME: ".$_SESSION['name'];
}

if (isset($_POST['new']))
{
	
	$restaurantId = $_SESSION['restaurantId'];
	$name = $_SESSION['name'];
	echo " NEW ****** restaurantId: ".$_SESSION['restaurantId'];
	
	$result1 = pg_query($db, "UPDATE restaurantfood SET price = '$_POST[price_updated]', 
	information = '$_POST[information_updated]', availabilitystatus = '$_POST[availabilitystatus_updated]', dailylimit = '$_POST[dailylimit_updated]'
	WHERE restaurantid = '$restaurantId' AND name= '$name'");
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
	$name = $_SESSION['name'];
	echo " NEW ****** restaurantId: ".$_SESSION['restaurantId'];
	
	$result2 = pg_query($db, "DELETE FROM restaurantfood WHERE restaurantid = '$restaurantId' AND name= '$name'");
	if (!$result2)
	{
	echo "Delete failed!!";
	} else
	{
	echo "Delete successfull;";
	}
}
?>
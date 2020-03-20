<!DOCTYPE html>
<html lang="en">
<head>
	<title>Retrieve All Restaurants</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<h1>List of all restaurats</h1>

<?php
$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
$result = pg_query($db,"SELECT * FROM restaurant");
echo "<table>";
while($row=pg_fetch_assoc($result)){echo "<tr>";
echo "<td align='center' width='200'>" . $row['restaurant_id'] . "</td>";
echo "<td align='center' width='200'>" . $row['name'] . "</td>";
echo "<td align='center' width='200'>" . $row['contactNo'] . "</td>";
echo "<td align='center' width='200'>" . $row['address'] . "</td>";
echo "<td align='center' width='200'>" . $row['area'] . "</td>";
echo "<td align='center' width='200'>" . $row['minMonetaryAmount'] . "</td>";
echo "</tr>";}echo "</table>";?>

</body>
</html>
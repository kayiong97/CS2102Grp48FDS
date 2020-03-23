<!DOCTYPE html>
<html lang="en">
<head>
	<title>View All Fds Manager</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
</head>
<body>
<h1>View All Fds Manager</h1>

<?php
//Hiding Errors 
error_reporting(E_ERROR | E_PARSE);
$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
$result = pg_query($db,"SELECT u.userid, u.name, u.username, u.password, u.contactno 
						FROM users u 
						RIGHT JOIN fdsManager fdsM 
						ON u.userId = fdsM.userId");
echo "<table>";
	echo "<th align='center' width='200'>" . Id . "</th>";
	echo "<th align='center' width='200'>" . Name. "</th>";
	echo "<th align='center' width='200'>" . UserName. "</th>";
	echo "<th align='center' width='200'>" . Password. "</th>";
	echo "<th align='center' width='200'>" . Contact. "</th>";

while($row=pg_fetch_assoc($result)){echo "<tr>";
echo "<td align='center' width='200'>" . $row['userid'] . "</td>";
echo "<td align='center' width='200'>" . $row['name'] . "</td>";
echo "<td align='center' width='200'>" . $row['username'] . "</td>";
echo "<td align='center' width='200'>" . $row['password'] . "</td>";
echo "<td align='center' width='200'>" . $row['contactno'] . "</td>";
echo "</tr>";}echo "</table>";?>

</body>
</html>
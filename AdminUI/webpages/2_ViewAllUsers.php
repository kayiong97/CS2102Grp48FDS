<!DOCTYPE html>
<html lang="en">
<head>
	<title>Retrieve All Users</title>
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
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  float: right;
}

</style>

</head>
<h1>View All Users</h1>
<h5>Delete / Edit Users</h5>
<form name="display" action="2_ViewAllUsers.php" method="POST" >
  	<label for="userid">User ID:</label2><br>
  	<input type='text'name='userid'><br>
	<input type='submit' name='submit' value='Delete'/>
	<input type='submit' name='submit1' value='Edit'/>
</form>

<form action="/cs2102grp48fds/AdminUI/webpages/1_CreateUser.php">
	<button class="button">New User</button>
</form>
<?php
//Hiding Errors 
error_reporting(E_ERROR | E_PARSE);
$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");

$result = pg_query($db,"SELECT * FROM users ORDER BY userid");
$row = pg_fetch_assoc($result);

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
	echo "</tr>";}echo "</table>";


if (isset($_POST['submit'])){
	$userid = $_POST['userid'];
	$result1 = pg_query($db, "DELETE FROM users WHERE userid = '$_POST[userid]'");
	if (!$result1)
	{
	echo "Update failed!!";
	} else
	{
		//header('location: /cs2102grp48fds/AdminUI/webpages/2_ViewAllUsers.php');
	echo "USER ID $_POST[userid] has been deleted successful";
	}
}

$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
$result3 = pg_query($db, "SELECT * FROM users WHERE userid = '$_POST[userid]'");
$row = pg_fetch_assoc($result3);

if (isset($_POST['submit1']))
{
		//$row[0] = '8129';
	echo "   ".$row[0];
	
	if (empty($row[0])){
		
	}
	else
		echo "ELSE: ".$row[0];
echo "
<ul>
	<form name='update' method='POST'>
	<h2>Edit User</h2>
	<li>User ID:</li><li><input type='text' name='userid1' value='$row[userid]' disabled /></li>
	<li>Name:</li><li><input type='text' name='name_updated' value='$row[name]'/></li>
	<li>Username:</li><li><input type='text' name='username_updated' value='$row[username]' /></li>
	<li>Password:</li><li><input type='text' name='password_updated' value='$row[password]' /></li>
	<li>Contact No:</li><li><input type='text' name='contactno_updated' value='$row[contactno]' /></li>  
	<li><input type='submit' name='update' value='Update'/></li>
	</form>
</ul>";
		//$userid = $row[userid];
}

if (isset($_POST['update'])){
	//$userid1 = $_POST[userid];
	//$name = $_POST['name'];
	$db5 = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
	$result5 = pg_query($db5, "UPDATE users SET name = '$_POST[name_updated]', 
		username = '$_POST[username_updated]', password = '$_POST[password_updated]', 
		contactno = '$_POST[contactno_updated]' 
	WHERE userid = '$_POST[userid1]'");
	if (!$result5)
	{
	echo "Update failed!!";
	} else
	{
	echo "Update successful";
	}
}

?>
</body>
</html>
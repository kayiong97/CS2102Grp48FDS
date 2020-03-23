<!DOCTYPE html>
<head>
<title>Create New User Account</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body {
  font-family: Arial;
}

input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
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

<body>
<h2>Create New User Account</h2>
<form action="/cs2102grp48fds/AdminUI/webpages/2_ViewAllUsers.php">
  <button class="button">View All user</button>
</form>
<div class="container">
    <form name="insert" action="1_CreateUser.php" method="POST" >
        <label for="Name">Name</label><input type="text" name="name" />
        <label for="Username">Username</label><input type="text" name="username" />
        <label for="Password">Password</label><input type="text" name="password" />
        <label for="Contact Number">Contact Number</label><input type="text" name="contactNo" />
        <input type="submit" />
    </form>
</body>
</div>
</html> 

<?php
//Hiding Errors 
error_reporting(E_ERROR | E_PARSE);
$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
$query = "INSERT INTO users(name, username, password, contactNo) VALUES ('$_POST[name]','$_POST[username]','$_POST[password]','$_POST[contactNo]')";
$result = pg_query($query); 
// if (!$result){
 
//   echo 'Insert Not Successful';

// } else {
//     header('Location: /cs2102grp48fds/AdminUI/webpages/2_ViewAllUsers.php');
//   }
?>
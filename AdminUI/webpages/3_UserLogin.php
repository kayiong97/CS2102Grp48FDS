<?php
//session_start();

if(isset($_POST['btnLogin'])){
    
    $username=($_POST["username"]);
    $password=($_POST["password"]);
    $link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
    $query = "SELECT u.username, u.password FROM users u WHERE u.username = '$username' and u.password = '$password';";
    $result = pg_query($link, $query);
    
    //$count = mysql_num_rows($result);

       while ($row = pg_fetch_row($result)) {
        if ($row[0] == $username && $row[1] == $password) {
            //$_SESSION["username"] = $username;
            header('Location: /cs2102grp48fds/AdminUI/webpages/0_Dashboard.php'); 
        }
    }
 
}

?> 

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  height: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<h2>Admin Login Page</h2>

<form method="post">
  <div class="imgcontainer">
    <img src="companylogo.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit" name="btnLogin">Login</button>
  </div>
</form>

</body>
</html>

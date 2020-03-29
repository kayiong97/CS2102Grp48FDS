<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create New User</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
  <style>
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
    th, td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
      background-color: Purple;
      color: white;
    }
  </style>
  <!-- For Style of Admin Page -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
</head>
<body>
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <div class="logo">
        <a class="simple-text logo-mini">
          Admin Menu List
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
      <li class="nav-item active  ">
        <a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/2_ViewAllUsers.php">
          <i class="material-icons">dashboard</i>
          <p>All Users</p>
        </a>
      </li>
      
      <li class="nav-item active  ">
        <a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/6_viewAllRiders.php">
          <i class="material-icons">dashboard</i>
          <p>Riders</p>
        </a>
      </li>
      
      <li class="nav-item active  ">
        <a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/5_ViewAllFdsManager.php">
          <i class="material-icons">dashboard</i>
          <p>FDS Manager</p>
        </a>
      </li>
      
      <li class="nav-item active  ">
        <a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/4_ViewAllRestaurantStaff.php">
          <i class="material-icons">dashboard</i>
          <p>Restaurant Staff</p>
        </a>
      </li>
      
      <li class="nav-item active  ">
        <a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/JretrieveAllRestaurants.php">
          <i class="material-icons">dashboard</i>
          <p>All Restaurants</p>
        </a>
      </li>
      
      <li class="nav-item active  ">
        <a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/JretrieveAllFoods.php">
          <i class="material-icons">dashboard</i>
          <p>All Foods</p>
        </a>
      </li>
      
      <li class="nav-item active  ">
        <a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/7_ViewAllCustomerOrder.php">
          <i class="material-icons">dashboard</i>
          <p>Customer Order</p>
        </a>
      </li>
      
        </ul>
      </div>
    </div>
  
  
    <div class="main-panel">
      
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Create New User</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="javascript:;">
                  <i class="material-icons">notifications</i> Notifications
                </a>
              </li>

              <form action="/cs2102grp48fds/AdminUI/webpages/3_UserLogin.php">
                <button class="button">Logout</button>
              </form>              
            </ul>
          </div>
        </div>
      </nav>    
      <!-- End Navbar -->
    
    <!-- Start Content -->
      <div class="content">
        <div class="container-fluid">
       
    <a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/2_ViewAllUsers.php">
          <i class="material-icons">dashboard</i>
          Back
    </a>
    
    <form name="insert" action="1_CreateUser.php" method="POST" >
      <table>
      <td><label for="userid">User ID:</label></td>
      <td><input type="text" name="userid" disabled/></td></tr>
      
      <td><label for="name">Name:</label></td>
      <td><input type="text" name="name" /></td></tr>
      
      <td><label for="username">Username:</label></td>
      <td><input type="text" name="username" /></td></tr>
      
      <td><label for="password">Password:</label></td>
      <td><input type="text" name="password" /></td></tr>
      
      <td><label for="contactno">Contact No.:</label></td>
      <td><input type="text" name="contactno" /></td></tr>
  
   <td><label for="role">Role:</label></td></td></tr>
        <td><input type="radio" id="fdsmanager" name="role" value="FDSManager"></td>
        <td><label for="fdsmanager">FDS Manager</label><br></td></tr>
        <td><input type="radio" id="restaurantstaff" name="role" value="Restaurant Staff"></td>
        <td><label for="restaurantstaff">Restaurant Staff</label><br></td></tr>
        <td><input type="radio" id="ptrider" name="role" value="PartTimeRider"></td>
        <td><label for="ptrider">Part Time Rider</label><br></td></tr>
        <td><input type="radio" id="ftrider" name="role" value="FullTimeRider"></td>
        <td><label for="ftrider">Full Time Rider</label><br></td></tr>
      
      <td><input type="submit" name="submitCreate"/></td>
      </table>
    </form>


<?php

$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");

if (isset($_POST['submitCreate']))
{
  $query = "INSERT INTO users(name, username, password, contactno, role) VALUES ('$_POST[name]','$_POST[username]','$_POST[password]','$_POST[contactno]', '$_POST[role]')";
  $query5 = "SELECT userid FROM Users ORDER BY userid DESC LIMIT 1";  
  $num = $query5;

if ($_POST['role'] == "FDSManager"){
    $query1 = "INSERT INTO fdsmanager(userid) VALUES ($num)";

} elseif ($_POST['role'] == "Restaurant Staff"){
    $query2 = "INSERT INTO restaurantstaff(userid) VALUES ($num)";

} elseif ($_POST['role'] == "partTimeRider"){
   $query3 = "INSERT INTO parttimerider(riderid) VALUES ($num)";

} elseif($_POST['role'] == "FullTimeRider"){
  $query4 = "INSERT INTO fulltimerider(riderid) VALUES ($num)";
}

$result = pg_query($query); 
if (!$result)
        {
        echo "Insert Failed!!";
        } else
        {
        echo "Insert Successful";
        }

}
?>

        </div>
      </div>
    <!-- End Content -->
    
    <!-- Start Footer -->
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  PORT'S
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </footer>
    <!-- End Footer -->
    </div>
  </div>
  
</body>
</html>
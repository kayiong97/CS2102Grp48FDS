<!DOCTYPE html>
<html lang="en">
<head>
	<title>Retrieve All Customer Orders</title>
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
            <a class="navbar-brand" href="javascript:;">View All Customer Orders</a>
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
</head>
      <div class="content">
        <div class="container-fluid">
<body>

<?php
//Hiding Errors 
error_reporting(E_ERROR | E_PARSE);
$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
$result = pg_query($db,"SELECT * FROM orders");

echo "<table>";
	echo "<th align='center' width='200'>" . ID . "</th>";
	echo "<th align='center' width='200'>" . Cost. "</th>";
	echo "<th align='center' width='200'>" . Date. "</th>";
	echo "<th align='center' width='200'>" . Location . "</th>";
	echo "<th align='center' width='200'>" . Fee. "</th>";
	echo "<th align='center' width='200'>" . Promotion. "</th>";

while($row=pg_fetch_assoc($result)){echo "<tr>";
	echo "<td align='center' width='200'>" . $row['orderid'] . "</td>";
	echo "<td align='center' width='200'>" . $row['totalordercost'] . "</td>";
	echo "<td align='center' width='200'>" . $row['orderdatetime'] . "</td>";
	echo "<td align='center' width='200'>" . $row['deliverylocation'] . "</td>";
	echo "<td align='center' width='200'>" . $row['deliveryfee'] . "</td>";
	echo "<td align='center' width='200'>" . $row['promotionid'] . "</td>";
	echo "</tr>";}echo "</table>";?>
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
    <!-- End Footer --></body>
</html>
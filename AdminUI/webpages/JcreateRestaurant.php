<!DOCTYPE html>
<html lang="en">
<head>
	<title>Create New Restaurant</title>
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
				<a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/JretrieveAllPromotions.php">
				  <i class="material-icons">dashboard</i>
				  <p>All Promotions</p>
				</a>
			</li>
			
			<li class="nav-item active  ">
				<a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/7_ViewAllCustomerOrder.php">
				  <i class="material-icons">dashboard</i>
				  <p>Customer Order</p>
				</a>
			</li>
			
			<li class="nav-item active  ">
            <a class="nav-link" href="AdminReport.php">
              <i class="material-icons">dashboard</i>
              <p>Admin Report</p>
            </a>
          </li>
	  <li class="nav-item active  ">
            <a class="nav-link" href="UpdateRidersInfo.php">
              <i class="material-icons">dashboard</i>
              <p>Update Rider Details</p>
            </a>
          </li>
	  <li class="nav-item active  ">
            <a class="nav-link" href="AdminOrderView.php">
              <i class="material-icons">dashboard</i>
              <p>Admin Order View</p>
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
            <a class="navbar-brand" href="javascript:;">Create New Restaurant</a>
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

              <form action="/cs2102grp48fds/AdminUI/webpages/AdminLogin.php">
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
       
		<a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/JretrieveAllRestaurants.php">
				  <i class="material-icons">dashboard</i>
				  Back
		</a>
		
		<form name="insert" action="JcreateRestaurant.php" method="POST" >
			<table>
			<td><label for="restaurant_id">Restaurant ID:</label></td>
			<td><input type="text" name="restaurant_id" disabled/></td></tr>
			
			<td><label for="name">Name:</label></td>
			<td><input type="text" name="name" /></td></tr>
			
			<td><label for="contactNo">Contact Number:</label></td>
			<td><input type="text" name="contactNo" /></td></tr>
			
			<td><label for="address">Address:</label></td>
			<td><input type="text" name="address" /></td></tr>
			
			<td><label for="area">Area:</label></td>
			<td><input type="text" name="area" /></td></tr>
			
			<td><label for="minMonetaryAmount">Min Monetary Amount:</label></td>
			<td><input type="number" name="minMonetaryAmount" /></td></tr>
			
			<td><input type="submit" name="submitCreate"/></td>
			</table>
		</form>


<?php

$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");

if (isset($_POST['submitCreate']))
{
$query = "INSERT INTO restaurant(name, contactno, address, area, minmonetaryamount) VALUES ('$_POST[name]',
'$_POST[contactNo]','$_POST[address]','$_POST[area]',
'$_POST[minMonetaryAmount]')";
$result = pg_query($query); 
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
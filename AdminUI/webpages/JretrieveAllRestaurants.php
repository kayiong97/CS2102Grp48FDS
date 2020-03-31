<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Retrieve All Restaurants</title>
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
            <a class="navbar-brand" href="javascript:;">View All Restaurants</a>
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
        <a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/JcreateRestaurant.php">
				  <i class="material-icons">dashboard</i>
				  Add Restaurant
		</a>
		
		<?php
		$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
		$result = pg_query($db,"SELECT * FROM restaurant ORDER BY restaurantid ASC");
		
		echo "<table>";
		
		echo" 
		<tr>
			<th>Restaurant ID</th>
			<th>Restaurant Name</th>
			<th>Contact Number</th>
			<th>Address</th>
			<th>Area</th>
			<th>Minimum Monetary Amount</th>
			<th>Action</th>
		</tr>";
		
		while ($row = pg_fetch_row($result)) {
		
		$restaurantid = $row[0];
        $name = $row[1];
        $contactno = $row[2];
        $address = $row[3];
        $area = $row[4];
		$minmonetaryamount = $row[5];
				
		echo "<tr>";
		echo "<td align='center' width='200'>" . $restaurantid . "</td>";
		echo "<td align='center' width='200'>" . $name . "</td>";
		echo "<td align='center' width='200'>" . $contactno . "</td>";
		echo "<td align='center' width='200'>" . $address . "</td>";
		echo "<td align='center' width='200'>" . $area . "</td>";
		echo "<td align='center' width='200'>" . $minmonetaryamount . "</td>";
		
		echo"<td><form method='post' name='myForm'>
			 <input type='hidden' id='restId' name='restId' value='$restaurantid'>
			 <input type='hidden' id='restName' name='restName' value='$name'>		
             <input type='submit' id='viewRestaurantById' name='btnViewRestaurantById' value='Update' title='Click to view restaurant'/>                                   
             </form></td>";
		
		echo "</tr>";}
		echo "</table>";
				
		?>
		
		<?php
		if(isset($_POST['btnViewRestaurantById'])){
			$restaurantid = $_POST["restId"];
			$_SESSION["storeRestaurantById"] = $restaurantid;
			$name = $_POST["restName"];
			$_SESSION["storeRestaurantByName"] = $name;
			echo "<script>location.href = '/cs2102grp48fds/AdminUI/webpages/JretrieveRestaurant.php'</script>";
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
<?php 
	session_start();
?>

<!DOCTYPE html>
<head> 
	<title>Update/Delete Food Details</title>
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
            <a class="navbar-brand" href="javascript:;">Update/Delete Food Details <?php echo "(Food Name: ".$_SESSION[ "storeFoodByName"].")"; ?></a>
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
       
		<a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/JretrieveAllFoods.php">
				  <i class="material-icons">dashboard</i>
				  Back
		</a>
		
		<?php
			if( isset( $_SESSION[ "storeRestaurantById"] ))
			{
			$restaurantid = $_SESSION["storeRestaurantById"];
			$name = $_SESSION["storeFoodByName"];
			
			$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
			$result = pg_query($db, "SELECT * FROM restaurantfood WHERE restaurantid = $restaurantid AND name = '$name'");
			$row = pg_fetch_assoc($result);


			/*if (isset($_POST['submit']))
			{
				//$row[0] = '8129';
				echo "   ".$row[0];
				
				if (empty($row[0])){
					echo "IF: contactNo: ".$row['contactNo'];
				}
				else
					echo "ELSE: ".$row[0];
			*/	
			echo "
			<ul>
				<form name='update' action='JretrieveFood.php' method='POST' >
				<table>
					<td><label for='restaurant_id'>Restaurant ID:</label></td>
					<td><input type='text' name='restaurant_id_updated' value='$row[restaurantid]' disabled /></td></tr>
					
					<td><label for='name'>Name:</label></td>
					<td><input type='text' name='name_updated' value='$row[name]' disabled/></td></tr>
					
					<td><label for='information'>Information:</label></td>
					<td><input type='text' name='information_updated' value='$row[information]' /></td></tr>
					
					<td><label for='availabilitystatus'>Availability Status:</label></td>
					<td><select id='availabilitystatus' name='availabilitystatus_updated'>
						<option value='$row[availabilitystatus]' disabled>Current Status: $row[availabilitystatus]</option>
						<option value='true'>True</option>
						<option value='false'>False</option>
					</select></td></tr>
					
					<td><label for='dailylimit'>Daily Limit:</label></td>
					<td><input type='text' name='dailylimit_updated' value='$row[dailylimit]' /></td></tr>
					
					<td><label for='price'>Price:</label></td>
					<td><input type='number' name='price_updated' value='$row[price]' /></td></tr>
					
					<td><input type='submit' name='new' value='Update'/></td>
					<td><input type='submit' name='delete' value='Delete'/></td>
				</table>
				</form>
			</ul>";
				echo " SUBMIT ****** Food Name: ".$_SESSION[ "storeFoodByName"];
			//}
			}
			
			if (isset($_POST['new']))
			{
				
				$restaurantId = $_SESSION['storeRestaurantById'];
				$name = $_SESSION['storeFoodByName'];
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
				echo "<script language='javascript'>";
				echo 'window.location.replace("JretrieveFood.php");';
				echo "</script>";
				}
			}

			if (isset($_POST['delete'])){
				$restaurantId = $_SESSION['storeRestaurantById'];
				$name = $_SESSION['storeFoodByName'];
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
  
	<!--<h2>Enter restaurant_id and enter <?php echo "(".$_SESSION[ "storeRestaurantById"].")"; ?> <?php echo "(".$_SESSION[ "storeRestaurantByName"].")"; ?></h2>
	<ul>
	<form name="display" action="retrieveRestaurants.php" method="POST" >
	<li>Restaurant ID:</li><li><input type="text" name="restaurantid" /></li>
	<li><input type="submit" name="submit" /></li>
	</form>
	</ul>-->
</body>
</html>
<?php 
	session_start();
?>

<!DOCTYPE html>
<head> 
	<title>Update/Delete Restaurant Details</title>
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
			
        </ul>
      </div>
    </div>
	
	
    <div class="main-panel">
      
	  <!-- Start Navbar -->
	  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Update/Delete Restaurant Details <?php echo "(Restaurant Name: ".$_SESSION[ "storeRestaurantByName"].")"; ?></a>
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
       
		<a class="nav-link" href="/cs2102grp48fds/AdminUI/webpages/JretrieveAllRestaurants.php">
				  <i class="material-icons">dashboard</i>
				  Back
		</a>
		
		<?php
			if( isset( $_SESSION[ "storeRestaurantById"] ))
			{
			$restaurantid = $_SESSION["storeRestaurantById"];

			$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
			$result = pg_query($db, "SELECT * FROM restaurant WHERE restaurantid = $restaurantid");
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
				<form name='update' action='JretrieveRestaurant.php' method='POST' >
				<table>
					<td><label for='restaurant_id'>Restaurant ID:</label></td>
					<td><input type='text' name='restaurant_id_updated' value='$row[restaurantid]' disabled /></td></tr>
					
					<td><label for='name'>Name:</label></td>
					<td><input type='text' name='name_updated' value='$row[name]' /></td></tr>
					
					<td><label for='contactNo'>Contact Number:</label></td>
					<td><input type='text' name='contactNo_updated' value='$row[contactno]' /></td></tr>
					
					<td><label for='address'>Address:</label></td>
					<td><input type='text' name='address_updated' value='$row[address]' /></td></tr>
					
					<td><label for='area'>Area:</label></td>
					<td><input type='text' name='area_updated' value='$row[area]' /></td></tr>
					
					<td><label for='minMonetaryAmount'>Min Monetary Amount:</label></td>
					<td><input type='number' name='minMonetaryAmount_updated' value='$row[minmonetaryamount]' /></td></tr>
					
					<td><input type='submit' name='new' value='Update'/></td>
					<td><input type='submit' name='delete' value='Delete'/></td>
				</table>
				</form>
			</ul>";
				echo " SUBMIT ****** Restaurant Name: ".$_SESSION[ "storeRestaurantByName"];
			//}
			}
			
			if (isset($_POST['new']))
			{
				
				$restaurantId = $_SESSION['storeRestaurantById'];
				echo " NEW ****** restaurantId: ".$_SESSION['storeRestaurantById'];
				
				$result1 = pg_query($db, "UPDATE restaurant SET name = '$_POST[name_updated]', 
				contactno = '$_POST[contactNo_updated]', address = '$_POST[address_updated]',area = '$_POST[area_updated]',
				minmonetaryamount = '$_POST[minMonetaryAmount_updated]' WHERE restaurantid = '$restaurantId'");
				if (!$result1)
				{
				echo "Update failed!!";
				} else
				{
				echo "Update successfull;";
				
				echo "<script language='javascript'>";
				echo 'window.location.replace("JretrieveRestaurant.php");';
				echo "</script>";
				}
			}

			if (isset($_POST['delete'])){
				$restaurantId = $_SESSION['storeRestaurantById'];
				echo " NEW ****** restaurantId: ".$_SESSION['storeRestaurantById'];
				
				$result2 = pg_query($db, "DELETE FROM restaurant WHERE restaurantid = '$restaurantId'");
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
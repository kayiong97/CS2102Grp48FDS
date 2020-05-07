<?php
$link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
?>
<!doctype html>
<html lang="en">

    <head>
        <title>Admin Page</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- Material Kit CSS -->
        <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    </head>

    <body>
        <div class="wrapper ">
            <div class="sidebar" data-color="purple" data-background-color="white">
                <!--
                Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
          
                Tip 2: you can also add an image using data-image tag
                -->
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
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                    <div class="container-fluid">
                        <div class="navbar-wrapper">
                            <h1><b>Admin Report</b></h1>
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
                                <!-- your navbar here -->
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
                <div class="content">
                    <div class="container-fluid">
                        <?php
                        $result = pg_query($link, "SELECT DISTINCT COUNT(*) as TotalNewCustomer, EXTRACT(MONTH FROM c1.completedDateTime) as Month, 
(SELECT COUNT(*) as TotalOrders FROM completes c2 WHERE EXTRACT(MONTH FROM c2.completedDateTime) = EXTRACT(MONTH FROM c1.completedDateTime)),
(SELECT SUM(p1.paymentAmount) as TotalCost FROM payment p1, completes c3 WHERE c3.paymentId = p1.paymentId AND EXTRACT(MONTH FROM c3.completedDateTime) = EXTRACT(MONTH FROM c1.completedDateTime))
FROM completes c1 GROUP BY  c1.completedDateTime;");
                        echo"<h3><u>New customers, total number of orders and total cost of all orders per month.</u></h3>";
                        echo "<table>";
                        echo"<tr>";
                        echo"<td align='center' width='200'><h4><b>Month</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Total New Customer</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Total Orders</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Total Costs</b></h4></td>";
                        echo"</tr>";
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td align='center' width='200'>" . $row['month'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['totalnewcustomer'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['totalorders'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['totalcost'] . "</td>";
                            echo "</tr>";
                        }echo "</table>";
                        ?>
						<br />
                        <?php
                        $result = pg_query($link, "SELECT DISTINCT EXTRACT(MONTH FROM c1.completedDateTime) as Month, u1.name as CustomerName,
(SELECT COUNT(*) as TotalOrder FROM completes c2 WHERE EXTRACT(MONTH FROM c1.completedDateTime) = EXTRACT(MONTH FROM c2.completedDateTime) AND c2.customerId = c1.customerId),
(SELECT SUM(p1.paymentAmount) as TotalCost FROM payment p1, completes c3 WHERE c3.paymentId = p1.paymentId AND c1.customerId=c1.customerId AND EXTRACT(MONTH FROM c3.completedDateTime) = EXTRACT(MONTH FROM c1.completedDateTime))
FROM completes c1, customers cu1, users u1 WHERE c1.customerId = cu1.customerId AND cu1.userId = u1.userId;
");
                        echo"<h3><u>Total number and cost placed by customer by month</u></h3>";
                        echo "<table>";
                        echo"<tr>";
                        echo"<td align='center' width='200'><h4><b>Month</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Customer Name</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Total Orders</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Total Costs</b></h4></td>";
                        echo"</tr>";
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td align='center' width='200'>" . $row['month'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['customername'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['totalorder'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['totalcost'] . "</td>";
                            echo "</tr>";
                        }echo "</table>";
                        ?>
						<br />
                        <?php
                        $result = pg_query($link, "SELECT DISTINCT EXTRACT(HOUR FROM o1.orderDateTime) as hour,o1.deliveryLocation,
(SELECT COUNT(*) FROM orders o2 WHERE EXTRACT(HOUR FROM o1.orderDateTime)= EXTRACT(HOUR FROM o2.orderDateTime) AND o1.deliveryLocation= o2.deliveryLocation)
FROM orders o1 GROUP BY o1.orderDateTime, o1.deliveryLocation;");
                        echo"<h3><u>Number of delivery at the location by hour</u></h3>";
                        echo "<table>";
                        echo"<tr>";
                        echo"<td align='center' width='200'><h4><b>Hour</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Delivery Location</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Count</b></h4></td>";
                        echo"</tr>";
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td align='center' width='200'>" . $row['hour'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['deliverylocation'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['count'] . "</td>";
                            echo "</tr>";
                        }echo "</table>";
                        ?>
						<br />
                       <?php
                        $result = pg_query($link, "SELECT DISTINCT p1.information, (p1.promoEndDate-p1.promoStartDate) as PromotionDuration,
(SELECT COUNT(*)/(p1.promoEndDate-p1.promoStartDate) as AverageOrders FROM orders o1 WHERE o1.promotionId = p1.promotionId)
 FROM promotion p1 GROUP BY p1.information,(p1.promoEndDate-p1.promoStartDate),p1.promotionId;
SELECT r1.riderId, EXTRACT(MONTH FROM o1.orderDateTime) as ThisMonth, 
(SELECT Count(*) FROM rider r2, completes c2, orders o2, payment p2 WHERE r2.riderId =  c2.riderId AND c2.paymentID = p2.paymentID AND p2.orderId = o2.orderId ) as TotalOrders,
CASE 
WHEN EXISTS (SELECT 1 FROM PartTimeRider WHERE riderId = r1.riderId) THEN (SELECT SUM(w1.duration) FROM WeeklyWorkSchedule w1, PTOwns pt1 WHERE pt1.riderId=r1.riderId  AND pt1.WeeklyWorkSchedule = w1.weeklywsid AND EXTRACT(MONTH FROM w1.operatestarttime)=EXTRACT(MONTH FROM o1.orderDateTime)) 
ELSE (SELECT SUM(wd1.workingDayHours)*7 FROM workingDays wd1, FTOwns ft1 WHERE ft1.riderId=r1.riderId  AND ft1.workingDayId = wd1.workingDayId AND ft1.month = EXTRACT(MONTH FROM o1.orderDateTime)) 
END as TotalWorkingHours,
CASE
WHEN EXISTS (SELECT 1 FROM PartTimeRider WHERE riderId = r1.riderId) THEN (SELECT (pt2.weeklybasesalary*4) FROM parttimerider pt2 WHERE pt2.riderId = r1.riderId)
ELSE (SELECT ft2.MonthlyBaseSalary FROM fulltimerider ft2 WHERE ft2.riderId=r1.riderId)
END as TotalMonthSalary,
(SELECT DISTINCT AVG(d1.orderedTimeStamp-o3.orderDateTime) FROM orders o3, delivery d1 WHERE o3.orderId=d1.orderId AND EXTRACT(MONTH FROM o3.orderDateTime)=EXTRACT(MONTH FROM o1.orderDateTime) AND EXTRACT(MONTH FROM d1.orderedTimeStamp)=EXTRACT(MONTH FROM o1.orderDateTime)) as AverageDeliveryTime,
(SELECT DISTINCT COUNT(c3.ratingsfordelivery) FROM completes c3 WHERE c3.riderId = r1.riderId AND EXTRACT(MONTH FROM c3.completedDateTime)=EXTRACT(MONTH FROM o1.orderDateTime)) as NumberOfRating,
(SELECT DISTINCT ROUND(AVG(c4.ratingsfordelivery)) FROM completes c4 WHERE c4.riderId = r1.riderId AND EXTRACT(MONTH FROM c4.completedDateTime)=EXTRACT(MONTH FROM o1.orderDateTime)) as AverageRating
FROM rider r1, completes c1, orders o1, payment p1 
WHERE r1.riderId =  c1.riderId AND c1.paymentID = p1.paymentID AND p1.orderId = o1.orderId AND r1.riderId<>13 GROUP BY r1.riderId, o1.orderDateTime;
	");
                        echo"<h3><u>Rider's report</u></h3>";
						echo"</br>";
                        echo "<table>";
                        echo"<tr>";
                        echo"<td align='center' width='200'><h4><b>RiderId</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Month</b></h4></td>";
			echo"<td align='center' width='200'><h4><b>Total Orders</b></h4></td>";
			 echo"<td align='center' width='200'><h4><b>Total Working Hours</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Total Monthly Salary</b></h4></td>";
			echo"<td align='center' width='200'><h4><b>Average Delivery Time</b></h4></td>";
			 echo"<td align='center' width='200'><h4><b>Number of Rating</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Average Rating</b></h4></td>";
                                               
                        echo"</tr>";
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td align='center' width='200'>" . $row['riderid'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['thismonth'] . "</td>";
			    echo "<td align='center' width='200'>" . $row['totalorders'] . "</td>";
			    echo "<td align='center' width='200'>" . $row['totalworkinghours'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['totalmonthsalary'] . "</td>";
			    echo "<td align='center' width='200'>" . $row['averagedeliverytime'] . "</td>";
			    echo "<td align='center' width='200'>" . $row['numberofrating'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['averagerating'] . "</td>";
                            echo "</tr>";
                        }echo "</table>";
                        ?>
						<br />
                        <?php
                        $result = pg_query($link, "SELECT DISTINCT COUNT(*)as TotalCompletedOrder,EXTRACT(MONTH FROM c1.completedDateTime) as month,
(SELECT SUM(p1.paymentamount-o1.deliveryFee) FROM orders o1, payment p1, completes c2 WHERE EXTRACT(MONTH FROM c1.completedDateTime)=EXTRACT(MONTH FROM c2.completedDateTime) AND p1.orderId = o1.orderId AND c2.paymentId = p1.paymentId),
(SELECT r1.name FROM restaurantfood r1, orders o2, payment p2, completes c3 WHERE r1.restaurantid = c3.restaurantid AND c3.paymentId = p2.paymentId AND p2.orderId = o2.orderId AND EXTRACT(MONTH FROM c1.completedDateTime)=EXTRACT(MONTH FROM c3.completedDateTime) GROUP BY r1.name ORDER BY COUNT(*) limit 1)
FROM completes c1 GROUP BY c1.completedDateTime;");
                        echo"<h3><u>Total completed orders, sum of order costs and top favorite food per month</u></h3>";
                        echo "<table>";
                        echo"<tr>";
                        echo"<td align='center' width='200'><h4><b>Month</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Total Completed Orders</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Sum</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>TOP FOOD</b></h4></td>";
                        
                        echo"</tr>";
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td align='center' width='200'>" . $row['month'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['totalcompletedorder'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['sum'] . "</td>";
                             echo "<td align='center' width='200'>" . $row['name'] . "</td>";
                            echo "</tr>";
                        }echo "</table>";
                        ?>
						<br />
                        <?php
                        $result = pg_query($link, "SELECT p1.information as promotionCampaign, (p1.promoEndDate-p1.promoStartDate) as PromotionDuration,
(SELECT COUNT(*)/(p1.promoEndDate-p1.promoStartDate) as AverageOrders FROM orders o1 WHERE o1.promotionId = p1.promotionId)
 FROM promotion p1 GROUP BY p1.information,(p1.promoEndDate-p1.promoStartDate),p1.promotionId;");
                        echo"<h3><u>Promotional campaign's duration and average number of orders received during the promotion<u/></h3>";
                        echo "<table>";
                        echo"<tr>";
                        echo"<td align='center' width='200'><h4><b>Promotion Campaign</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Promotion Duration</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Average Orders</b></h4></td>";
                        
                        
                        echo"</tr>";
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td align='center' width='200'>" . $row['promotioncampaign'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['promotionduration'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['averageorders'] . "</td>";
                            echo "</tr>";
                        }echo "</table>";
                        ?>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="float-left">
                            <ul>
                                <li>
                                    <a href="https://www.creative-tim.com">
                                        Creative Tim
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="copyright float-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, made with <i class="material-icons">favorite</i> by
                            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
                        </div>
                        <!-- your footer here -->
                    </div>
                </footer>
            </div>
        </div>
    </body>

</html>

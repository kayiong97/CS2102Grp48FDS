<?php
$link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
?>
<!doctype html>
<html lang="en">

<head>
  <title>Hello, world!</title>
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
            <a class="nav-link" href="#0">
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
            <h1><b>Admin Order View</b></h1>
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
          <!-- your content here -->
		  <?php
                        $result = pg_query($link, "SELECT c.completeid, o.totalordercost,o.deliveryLocation,o.deliveryfee, pr.information, r.rname as ridername from completes c, payment p, orders o,delivery d,rider r, promotion pr WHERE c.paymentid=p.paymentid AND p.orderid=o.orderid AND pr.promotionid = o.promotionid AND o.orderid = d.orderid AND d.riderid = r.riderid;");
                        echo"<h3><u><b>Current Orders and Delivery View</b>	</u></h3>";
                        echo "<table>";
                        echo"<tr>";
						echo"<td align='center' width='200'><h4><b>OrderID</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Total Order Cost</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Delivery Location</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Delivery Fee</b></h4></td>";
                        echo"<td align='center' width='200'><h4><b>Promo Information</b></h4></atd>";
						echo"<td align='center' width='200'><h4><b>Rider Name</b></h4></td>";
                        echo"</tr>";
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>";
							echo "<td align='center' width='200'>" . $row['completeid'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['totalordercost'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['deliverylocation'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['deliveryfee'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['information'] . "</td>";
							echo "<td align='center' width='200'>" . $row['ridername'] . "</td>";
                            echo "</tr>";
                        }echo "</table>";
                        ?>
						
        <form action="AdminOrderView.php" method="post" style='margin-top:10%'>
		<a><b>Please enter orderID to assign: </b></a><input type="textbox" name="completeid" placeholder="Order ID" />  </br></br>
		<input type="submit" name="submit" value="Assign">
		</form>
		<?php 
		
		if (isset($_POST['submit'])){
			$completeID=$_POST['completeid'];
			$result = pg_query($link, "

begin;

Update completes SET riderid=
(SELECT r1.riderid FROM rider r1 
 WHERE 
 NOT EXISTS(SELECT 1 FROM completes c2 WHERE c2.riderid=r1.riderid AND EXTRACT(MINUTE FROM (NOW()-c2.completeddatetime))>30)
 AND
 CASE
 WHEN EXISTS(SELECT 1 FROM PartTimeRider WHERE riderId = r1.riderId) THEN ((NOW()<(SELECT operateendtime FROM weeklyworkschedule ws,ptowns pt WHERE pt.riderid=r1.riderid AND pt.weeklyworkschedule=ws.weeklywsid)) AND (NOW()>(SELECT operatestarttime FROM weeklyworkschedule ws,ptowns pt WHERE pt.riderid=r1.riderid AND pt.weeklyworkschedule=ws.weeklywsid))AND EXISTS(SELECT 1 FROM weeklyworkschedule ws, ptowns pt WHERE pt.riderid=r1.riderid AND pt.weeklyworkschedule=ws.weeklywsid AND (NOW()<ws.breakstarttime OR NOW()>ws.breakendtime))) 
 ELSE (((SELECT 1 FROM workingdays wd,ftowns ft WHERE ft.workingdayid=wd.workingdayid AND ft.riderid=r1.riderid AND 
	  CASE 
	   WHEN wd.workingday=1 THEN (to_char(NOW(),'d')<>'6' OR to_char(NOW(),'d')<>'7')
	   WHEN wd.workingday=2 THEN (to_char(NOW(),'d')<>'7' OR to_char(NOW(),'d')<>'1')
	   WHEN wd.workingday=3 THEN (to_char(NOW(),'d')<>'1' OR to_char(NOW(),'d')<>'2')
	   WHEN wd.workingday=4 THEN (to_char(NOW(),'d')<>'2' OR to_char(NOW(),'d')<>'3')
	   WHEN wd.workingday=5 THEN (to_char(NOW(),'d')<>'3' OR to_char(NOW(),'d')<>'4')
	   WHEN wd.workingday=6 THEN (to_char(NOW(),'d')<>'4' OR to_char(NOW(),'d')<>'5')
	   WHEN wd.workingday=7 THEN (to_char(NOW(),'d')<>'5' OR to_char(NOW(),'d')<>'6')
	  END LIMIT 1
	  )=1)
 AND
 	((SELECT 1 FROM shift s,ftowns ft WHERE ft.shiftid=s.shiftid AND ft.riderid=r1.riderid AND 
	 CASE
	  WHEN s.shift=1 THEN (EXTRACT(HOUR FROM NOW())>10 AND EXTRACT(HOUR FROM NOW())<14) OR (EXTRACT(HOUR FROM NOW())>15 AND EXTRACT(HOUR FROM NOW())<19)
	  WHEN s.shift=2 THEN (EXTRACT(HOUR FROM NOW())>11 AND EXTRACT(HOUR FROM NOW())<15) OR (EXTRACT(HOUR FROM NOW())>16 AND EXTRACT(HOUR FROM NOW())<20)
	  WHEN s.shift=3 THEN (EXTRACT(HOUR FROM NOW())>12 AND EXTRACT(HOUR FROM NOW())<16) OR (EXTRACT(HOUR FROM NOW())>17 AND EXTRACT(HOUR FROM NOW())<21)
	  WHEN s.shift=4 THEN (EXTRACT(HOUR FROM NOW())>13 AND EXTRACT(HOUR FROM NOW())<17) OR (EXTRACT(HOUR FROM NOW())>18 AND EXTRACT(HOUR FROM NOW())<22)
	 END LIMIT 1
	 )=1))
 END
 LIMIT 1) WHERE completeid='$completeID' AND riderid=13;
 
 Update delivery set riderid=(Select co.riderid FROM completes co,payment pa,orders o WHERE o.orderid=pa.orderid AND co.paymentid=pa.paymentid AND co.completeid='$completeID') WHERE deliveryid='$completeID';
 Update customers set accumulatedpoints = (accumulatedpoints+(SELECT pa.paymentamount FROM completes co, payment pa WHERE co.paymentid=pa.paymentid AND co.completeid='$completeID')) from completes co where customers.customerid = co.customerid;
 commit;
");
if (!$result) {
        echo "Something went wrong.";
        exit;
        }else{
			echo"Assign Success";
		}
		}
		?>
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

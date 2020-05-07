<?php
ob_start();
$link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
session_start();
//ft = 1, pt = 2
$_SESSION['ptft'] = null;
$_SESSION['error']=null;
?>
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
                    <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                        CT
                    </a>
                    <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                        Creative Tim
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li class="nav-item active  ">
                            <a class="nav-link" href="AdminReport.php">
                                <i class="material-icons">dashboard</i>
                                <p>Admin Report</p>
                            </a>
                        </li>
                        <li class="nav-item active  ">
                            <a class="nav-link" href="#0">
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
                       <!-- <li class="nav-item active  ">
                            <a class="nav-link" href="#0">
                                <i class="material-icons">dashboard</i>
                                <p>Customer Order</p>
                            </a>
                        </li>
                        <li class="nav-item active  ">
                            <a class="nav-link" href="#0">
                                <i class="material-icons">dashboard</i>
                                <p>FDS Manager</p>
                            </a>
                        </li>
                        <!-- your sidebar here -->
                    </ul>
                </div>
            </div>
            <div class="main-panel">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                    <div class="container-fluid">
                        <div class="navbar-wrapper">
                            <h1><b>Update Riders Info</b></h1>
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
                                <!-- your navbar here -->
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
                <div class="content">
                    <div class="container-fluid">
                        
                        <?php 		
							
                        $result = pg_query($link, "SELECT r1.riderId, u1.name FROM rider r1, users u1 WHERE r1.riderId = u1.userId");
                        echo"<table>";
                        echo"<tr>
                             <td align='center' width='200'><h4><b>Rider's ID</b></h4></td>
                             <td align='center' width='200'><h4><b>Rider's Name</b></h4></td>
                         </tr>";
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td align='center' width='200'>" . $row['riderid'] . "</td>";
                            echo "<td align='center' width='200'>" . $row['name'] . "</td>";
                            echo "</tr>";
                        }echo "</table>";
                        echo"<form>";
                        echo"<a>Please enter rider's ID to edit: </a><input type='textbox' name='riderId'></input>";
                        echo"<input type = 'submit' class = 'button' action = 'UpdateRidersInfo.php' name = 'rselect' value = 'select' />";
                        echo"</form>";
                        if (isset($_GET['rselect'])) {
                            $riderId = $_GET['riderId'];
                            $result2 = pg_query($link, "SELECT 1 FROM fulltimerider f1 where f1.riderId='$riderId'");
                            if ($result2) {
                                $ftptcheck = pg_fetch_object($result2);
                                if ($ftptcheck != null) {
                                    //Rider is fulltimer
                                    $result = pg_query($link, "SELECT riderId, year, month, workingDayId, shiftId FROM ftowns WHERE riderId = '$riderId'");
                                    echo"<h2>View rider records</h2>";
                                    echo "<table>";
                                    echo"<tr>";
                                    echo"<td align='center' width='200'><h4><b>Index</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Year</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Month</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Working Day Choice</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Shift Choice</b></h4></td>";
                                    echo"</tr>";
                                    $num = 0;
                                    while ($row = pg_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td align='center' width='200'>$num";
                                        echo "<td align='center' width='200'>20" . $row['year'] . "</td>";
                                        echo "<td align='center' width='200'>" . $row['month'] . "</td>";
                                        echo "<td align='center' width='200'>" . $row['workingdayid'] . "</td>";
                                        echo "<td align='center' width='200'>" . $row['shiftid'] . "</td>";
                                        echo "</tr>";
                                         $arr[$num] = $row;
                                        $num++;
                                    }                                
                                    echo "</table>";
                                    echo "<form method='post'></br></br>";
                                    echo"<a>Please enter index to edit: </a><input type='textbox' name='index'></input></br></br>";
                                    echo"<a>Please enter new workingdayId: </a><input type='textbox' name='workingdayid'></input></br></br>";
                                    echo"<a>Please enter new shiftId: </a><input type='textbox' name='shiftid'></input></br></br>";
                                    echo"<input type='submit' class = 'button' name = 'kselect' value = 'Submit' />";
                                    
                                     // $_SESSION['error'] = $_POST['kselect'];
                                    if (isset($_POST['kselect'])) { 									
                                        $index = $_POST['index'];
                                        $workingdayid = $_POST['workingdayid'];
                                        $shiftid = $_POST['shiftid'];
                                        $rowdata = $arr[$index];
                                        $oriderid = $rowdata['riderid'];
                                        $oworkingdayid=$rowdata['workingdayid'];
                                        $oshiftid= $rowdata['shiftid'];
                                        $omonth=$rowdata['month'];
                                        $oyear=$rowdata['year'];   
                                        $result3 = pg_query($link,"UPDATE ftowns set workingdayid='$workingdayid',month='$shiftid' where riderid='$oriderid' AND workingdayid='$oworkingdayid' AND shiftid='$oshiftid' AND month='$omonth' AND year='$oyear';");
                                         
                                        if ($result3) {
                                            echo "Updated successfully.";
											header("Refresh:0");
                                        } else {
                                            echo pg_last_error($link);
                                        }
                                    }
									
								   echo"<input type='submit' class = 'button' name = 'dselect' value = 'Delete This Record' />";
								   echo"</form>";
								   
								   if (isset($_POST["dselect"])) {
									$index = $_POST['index'];
									$rowdata = $arr[$index];
                                    $oriderid = $rowdata['riderid'];
                                    $oworkingdayid=$rowdata['workingdayid'];
                                    $oshiftid= $rowdata['shiftid'];
                                    $omonth=$rowdata['month'];
                                    $oyear=$rowdata['year'];
									$sql3 = "delete from ftowns WHERE riderid='$oriderid' AND workingdayid='$oworkingdayid' AND shiftid='$oshiftid' AND month='$omonth' AND year='$oyear'";
									$result3 = pg_query($link, $sql3);
									if ($result3) {
										echo "Deleted successfully\n";
									} else {
									echo pg_last_error($link);
										}
									}
								  
                                } else {
                                    //Rider is parttime
									$result = pg_query($link, "SELECT r.rname, r.riderid, w.weeklywsid, w.operatestarttime, w.operateendtime, w.breakstarttime, w.breakendtime FROM rider r, ptowns pt, weeklyworkschedule w WHERE r.riderid = '$riderId'AND r.riderid = pt.riderid AND pt.weeklyworkschedule = w.weeklywsid");
									echo"<h2>View rider records</h2>";
                                    echo "<table>";
                                    echo"<tr>";
                                    echo"<td align='center' width='200'><h4><b>Index</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Rider Name</b></h4></td>";
									echo"<td align='center' width='200'><h4><b>Rider ID</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Operate Start Time</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Operate End Time</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Break Start Time</b></h4></td>";
									echo"<td align='center' width='200'><h4><b>Break End Time</b></h4></td>";
                                    echo"</tr>";
									$num = 0;
									while ($row = pg_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td align='center' width='200'>$num";
                                        echo "<td align='center' width='200'>" . $row['rname'] . "</td>";
										echo "<td align='center' width='200'>" . $row['riderid'] . "</td>";
                                        echo "<td align='center' width='200'>" . $row['operatestarttime'] . "</td>";
                                        echo "<td align='center' width='200'>" . $row['operateendtime'] . "</td>";
                                        echo "<td align='center' width='200'>" . $row['breakstarttime'] . "</td>";
										echo "<td align='center' width='200'>" . $row['breakendtime'] . "</td>";
                                        echo "</tr>";
                                         $arr[$num] = $row;
                                        $num++;
                                    }
									//Edit boxes
									echo "</table>";
                                    echo "<form method='post'></br>";
                                    echo"<a>Please enter index to edit: </a><input type='textbox' name='findex'></input></br></br>";
                                    echo"<a>Please enter new Operating Start Time: </a><input type='textbox' name='ost'></input></br></br>";
                                    echo"<a>Please enter new operating End Time: </a><input type='textbox' name='oet'></input></br></br>";
                                    echo"<a>Please enter new Break Start Time: </a><input type='textbox' name='bst'></input></br></br>";
                                    echo"<a>Please enter new Break End Time: </a><input type='textbox' name='bet'></input></br></br>";
                                    echo"<input type='submit' class = 'button' name = 'pselect' value = 'Submit' />";
									
									if (isset($_POST['pselect'])) { 						
                                        $findex = $_POST['findex'];
                                        $ost = $_POST['ost'];
										$oet = $_POST['oet'];
										$bst = $_POST['bst'];
										$bet = $_POST['bet'];
                                        $rowdata = $arr[$findex];
										$friderid = $rowdata['riderid'];	
										$_SESSION['error']=$friderid;
                                        $result3 = pg_query($link,"UPDATE weeklyworkschedule set operatestarttime='$ost',operateendtime='$oet',breakstarttime='$bst',breakendtime='$bet' where weeklywsid=(Select weeklyworkschedule FROM ptowns where riderid=$friderid);");
                                         
                                        if ($result3) {
                                            echo "Updated successfully.";
											header("Refresh:0");
                                        } else {
                                            echo pg_last_error($link);
                                        }
                                    }
									echo"<input type='submit' class = 'button' name = 'pdselect' value = 'Delete This Record' />";
									echo"</form>";
									
									
									if (isset($_POST["pdselect"])) {
									$index = $_POST['findex'];
									$rowdata = $arr[$index];
                                    $riderid = $rowdata['riderid'];
									$wwsid = $rowdata['weeklywsid'];
									$sql3 = "delete from ptowns WHERE riderid='$riderid' AND weeklyworkschedule=$wwsid";
									$result3 = pg_query($link, $sql3);
									if ($result3) {
										echo "Deleted successfully\n";
										header("Refresh:0");
									} else {
									echo pg_last_error($link);
										}
									}
									
								}
                            }
                        }
                        ?>
                    </div>
                </div>
                <footer class="footer">
                    
                </footer>
            </div>
        </div>
    </body>

</html>

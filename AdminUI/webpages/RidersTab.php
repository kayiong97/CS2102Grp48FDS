<!doctype html>
<?php
ob_start();
$link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
session_start();
//ft = 1, pt = 2
$_SESSION['ptft'] = null;

?>
<html lang="en">

    <head>

        <title>Riders</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- Material Kit CSS -->
        <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
        <style>
            input{
                display:block;
            }
            </style>
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
            <a class="nav-link" href="RidersLogin.php">
              <i class="material-icons">dashboard</i>
              <p>Logout</p>
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
                            <a class="navbar-brand" href="javascript:;"> <h2><b>Rider's Tab</b></h2></a>
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
                        $riderId = $_SESSION['riderId'];
                        if ($riderId != null) {
                            $result = pg_query($link, "SELECT 1 FROM fulltimerider f1 where f1.riderId='$riderId'");
                            if ($result) {
                                $ftptcheck = pg_fetch_object($result);
                                if ($ftptcheck != null) {
                                    //FULL TIME RIDER
                                    //Retrieve full time rider data
                                    $result = pg_query($link, "SELECT year, month, workingDayId, shiftId FROM ftowns WHERE riderId = '$riderId'");
                                    echo"<a>Below are the shifts available for full time riders</a>
        <ul>
            <li>[Shift 1] 10am to 2pm and 3pm to 7pm.</li>
            <li>[Shift 2] 11am to 3pm and 4pm to 8pm.</li>
            <li>[Shift 3] 12pm to 4pm and 5pm to 9pm.</li>
            <li>[Shift 4] 1pm to 5pm and 6pm to 10pm.</li>
        </ul>
        <br />
        <a>Below are the date choice</a>
        <ul>
            <li>[Choice 1] Monday to Friday</li>
            <li>[Choice 2] Tuesday to Saturday</li>
            <li>[Choice 3] Wednesday to Sunday</li>
            <li>[Choice 4] Thursday to Monday</li>
            <li>[Choice 5] Friday to Tuesday</li>
            <li>[Choice 6] Saturday to Wednesday</li>
            <li>[Choice 7] Sunday to Thursday</li>
        </ul>";
                                    echo"<h2>View my records</h2>";
                                    echo "<table>";
                                    echo"<tr>";
                                    echo"<td align='center' width='200'><h4><b>Year</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Month</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Working Day Choice</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Shift Choice</b></h4></td>";
                                    echo"</tr>";
                                    while ($row = pg_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td align='center' width='200'>20" . $row['year'] . "</td>";
                                        echo "<td align='center' width='200'>" . $row['month'] . "</td>";
                                        echo "<td align='center' width='200'>" . $row['workingdayid'] . "</td>";
                                        echo "<td align='center' width='200'>" . $row['shiftid'] . "</td>";

                                        echo "</tr>";
                                    }echo "</table>";

                                    //Create Full Time Record
                                    echo"
                                    <br />
                                    <br />
                                    <h2>Submit New Record</h2>                                        
                                    <form action = 'RidersTab.php' id = 'ftAddSchedule' method = 'get'>
                                    <a> Choose Shift(Enter 1-4): </a> <input type = 'textbox' name = 'ftShifts' placeholder = 'Please enter shift choice' /></br>
                                    <a> Choose Date Choice(Enter 1-7): </a><input type = 'textbox' name = 'ftDates' placeholder = 'Please enter date choice' />
                                    <input type = 'submit' class = 'button' name = 'ftselect' value = 'Submit' />";

                                    if (isset($_GET['ftselect'])) {
										echo $_GET['ftShifts'];;
                                        $shifts = $_GET['ftShifts'];
                                        $dates = $_GET['ftDates'];
                                        $month = date('m');
                                        $year = date('y');
                                        $sql = "INSERT INTO ftowns(riderid,workingdayid,shiftid,month,year) values('$riderId', '$dates', '$shifts','$month','$year');";
                                        $result = pg_query($link, $sql);
                                        if ($result) {
                                            echo "Record saved";
                                            header("Location:RidersTab.php");
										exit;
                                        } else {
                                            echo "Error";
                                        }
                                    }

                                    $_SESSION['ptft'] = 1;
                                } else {
                                    //PART TIME RIDER
                                    $result = pg_query($link, "SELECT * FROM weeklyworkschedule wws1 INNER JOIN ptowns pt1 on pt1.weeklyworkschedule=wws1.weeklywsid where pt1.riderId = '$riderId'");
                                    echo"<h2>View my records</h2>"; 
                                    echo "<table>";
                                    echo"<tr>";
                                    echo"<td align='center' width='200'><h4><b>Operate Start DateTime</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Operate End DateTime</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Break Start DateTime</b></h4></td>";
                                    echo"<td align='center' width='200'><h4><b>Break End DateTime</b></h4></td>";
                                    echo"</tr>";
                                    while ($row = pg_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td align='center' width='200'>" . $row['operatestarttime'] . "</td>";
                                        echo "<td align='center' width='200'>" . $row['operateendtime'] . "</td>";
                                        echo "<td align='center' width='200'>" . $row['breakstarttime'] . "</td>";
                                        echo "<td align='center' width='200'>" . $row['breakendtime'] . "</td>";

                                        echo "</tr>";
                                    }echo "</table>";

                                    //Create Part time record
                                    echo"<br />";
                                    echo"<br />";
                                    echo"<h2>Submit new record</h2>";
                                    echo"
                        <form id = 'ptAddSchedule' method = 'get'>
                            <a> Enter Operation Start DateTime: </a> <input type = 'datetime-local' name = 'oStartDT' />
                            <a> Enter Operation End DateTime: </a> <input type = 'datetime-local' name = 'oEndDT' /> <br /><br />
                            <a><b> Please input your break time details:</b></a><br />
                            <a> Enter Break Start DateTime: </a> <input type = 'datetime-local' name = 'bStartDT' />
                            <a> Enter Break End DateTime: </a> <input type = 'datetime-local' name = 'bEndDT' />
                            <a> Total working hours: </a> <input type = 'textbox' name = 'duration' />


                            <input type = 'submit' class = 'button' action = 'RidersTab.php' name = 'ptselect' value = 'select' />
                            ";?>
							<?php
                                    if (isset($_GET['ptselect'])) {

                                        $oStart = $_GET['oStartDT'];
                                        $oEnd = $_GET['oEndDT'];
                                        $bStart = $_GET['bStartDT'];
                                        $bEnd = $_GET['bEndDT'];
                                        $duration = $_GET['duration'];
                                        $sql = "INSERT into weeklyworkschedule(operatestarttime,operateendtime,breakstarttime,breakendtime,duration) values ('$oStart', '$oEnd','$bStart','$bEnd',$duration)";
                                        $result = pg_query($link, $sql);
                                        if ($result) {   
                                        } else {
                                            echo "Error";
                                        }
										$sql2 = "SELECT MAX(Weeklywsid) FROM weeklyworkschedule";
										$result2 = pg_query($link, $sql2);
										$row = pg_fetch_assoc($result2);
										$wwsid=$row['max'];
										$sql3 = "INSERT into ptowns(riderid,weeklyworkschedule) values ('$riderId','$wwsid')";
										$result3 = pg_query($link, $sql3);
										if ($result) {
                                            header("Location:RidersTab.php");
                                        } else {
                                            echo "Error";
                                        }
                                        
                                    }
                                    echo"</form> ";
                                    $_SESSION['ptft'] = 2;
                                }
                            }
                        }
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

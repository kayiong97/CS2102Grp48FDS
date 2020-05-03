<?php
$link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
session_start();
//ft = 1, pt = 2
$_SESSION['ptft'] = null;
?>
<html>
    <head>
        
        <style>
            input{
                display:block;
            }
            </style>
    </head>
    <body>
        <h1>Hello welcome to riders</h1>
        <!--Check if rider is full timer or part timer -->
        <?php
        $riderId = $_SESSION['riderId'];
        if ($riderId != null) {
            $result = pg_query($link, "SELECT 1 FROM fulltimerider f1 where f1.riderId='$riderId'");
            if ($result) {
                $ftptcheck = pg_fetch_object($result);
                if ($ftptcheck != null) {
                    echo"FULL TIMER HERE";
                    $_SESSION['ptft'] = 1;
                } else {
                    echo"PART TIMER HERE";
                    $_SESSION['ptft'] = 2;
                }
            }
        }
        echo $_SESSION['ptft'];
        if ($_SESSION['ptft'] == 2) {
            //Retrieve Part Time Rider Data
            $result = pg_query($link, "SELECT * FROM weeklyworkschedule wws1 INNER JOIN ptowns pt1 on pt1.weeklyworkschedule=wws1.weeklywsid where pt1.riderId = '$riderId'");

            $arr = pg_fetch_all($result);

            echo "<pre>";
            print_r($arr);
            echo "</pre>";
        } else {
            //Retrieve full time rider data
             $result = pg_query($link, "SELECT workingDayId, shiftId FROM ftowns WHERE riderId = '$riderId'");

            $arr2 = pg_fetch_all($result);

            echo "<pre>";
            print_r($arr2);
            echo "</pre>";
        }
        ?>
        <a>Below are the shifts available for full time riders</a>
        <ul>
            <li>Shift 1: 10am to 2pm and 3pm to 7pm.</li>
            <li>Shift 2: 11am to 3pm and 4pm to 8pm.</li>
            <li>Shift 3: 12pm to 4pm and 5pm to 9pm.</li>
            <li>Shift 4: 1pm to 5pm and 6pm to 10pm.</li>
        </ul>
        <br />
        <a>Below are the date choice</a>
        <ul>
            <li>Monday to Friday</li>
            <li>Tuesday to Saturday</li>
            <li>Wednesday to Sunday</li>
            <li>Thursday to Monday</li>
            <li>Friday to Tuesday</li>
            <li>Saturday to Wednesday</li>
            <li>Sunday to Thursday</li>
        </ul>
            <form action="Riders.php" id="ftAddSchedule" method="get">
                <a> Choose Shift(Enter 1-4): </a> <input type="textbox" name="ftShifts" placeholder="Please enter shift choice" />  
                <a> Choose Date Choice(Enter 1-7): </a><input type="textbox" name="ftDates" placeholder="Please enter date choice" />
                <input type="submit" class="button"  name="ftselect" value="select" />  
                <?php
                if (isset($_GET['ftselect'])) {

                    $shifts = $_GET['ftShifts'];
                    $dates = $_GET['ftDates'];
                    $month = date('m');
                    $year = date('y');
                    $sql = "INSERT INTO ftowns(riderid,workingdayid,shiftid,month,year) values('$riderId', '$dates', '$shifts','$month','$year');";
                    $result = pg_query($link, $sql);
                    if ($result) {
                        echo "Record saved";

                    } else {
                        echo "Error";
                    }
                }
                ?>
        </form> 
        <form id="ptAddSchedule" method="get">
            <a> Enter Operation Start Time: </a> <input type="datetime-local" name="oStartDT"  />
            <a> Enter Operation End Time: </a> <input type="datetime-local" name="oEndDT"  /> <br /><br />
            <a> Please input your break time details:</a><br />
            <a> Enter Break Start Time: </a> <input type="datetime-local" name="bStartDT"  /> 
            <a> Enter Break End Time: </a> <input type="datetime-local" name="bEndDT"  /> 
            <a> Total working hours: </a> <input type="textbox" name="duration"  />
            

            <input type="submit" class="button" action="Riders.php" name="ptselect" value="select" />  
            <?php
            if (isset($_GET['ptselect'])) {

                $oStart = $_GET['oStartDT'];
                $oEnd = $_GET['oEndDT'];
                $bStart = $_GET['bStartDT'];
                $bEnd = $_GET['bEndDT'];
                $duration = $_GET['duration'];
                $day = date('d');
                $month = date('m');
                $year = date('y');
                $sql = "INSERT into weeklyworkschedule(operatestarttime,operateendtime,breakstarttime,breakendtime,day,month,year,duration) values ('$oStart', '$oEnd','$bStart','$bEnd',$day,$month,$year,$duration)";
                $result = pg_query($link, $sql);
                if ($result) {
                    echo "Record saved";
                } else {
                    echo "Error";
                }
            }
            ?>
        </form> 
       <?php
$result = pg_query($link,"SELECT * FROM restaurant");
echo "<table>";
while($row=pg_fetch_assoc($result)){echo "<tr>";
echo "<td align='center' width='200'>" . $row['restaurant_id'] . "</td>";
echo "<td align='center' width='200'>" . $row['name'] . "</td>";
echo "<td align='center' width='200'>" . $row['contactNo'] . "</td>";
echo "<td align='center' width='200'>" . $row['address'] . "</td>";
echo "<td align='center' width='200'>" . $row['area'] . "</td>";
echo "<td align='center' width='200'>" . $row['minMonetaryAmount'] . "</td>";
echo "</tr>";}echo "</table>";?>
    </body>
</html>
<?php
$link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
session_start();
$_SESSION['riderId']=null;
?>
<html>
    <head> 
        <title> woohoo </title>
        <style>
            input{
                display:block;
            }
        </style>
    </head>
    <body>
        <h1> Rider Login Page </h1>
        <a href="createAccount.php">Create Account</a>
        <a href="Riders.php">Riders View</a>
        <a href="RidersTab.php">Riders tab</a>
		<a href="AdminOrderView.php">Order View</a>
		<a href="UpdateRidersInfo.php">Update Rider Tab</a>
        <a href="AdminReport.php">Admin Report</a>
		<a href="AdminLogin.php">Admin Login</a>
        <form action="index.php" id="createAdmin" method="get">
            <input type="textbox" name="aname" placeholder="Please enter name" />  
            <input type="textbox" name="ausername" placeholder="Please enter username" />
            <input type="textbox" name="apassword" placeholder="Please enter password" />
            <input type="textbox" name="acontactNo" placeholder="Please enter contactNo" />
            <input type="submit" class="button" action="index.php" name="select" value="select" />  
        </form>
        
          
        <form action="index.php" id="loginAdmin" method="get">
            <input type="textbox" name="loginUser" placeholder="Please enter username" />  
            <input type="textbox" name="loginPW" placeholder="Please enter password" />
            <input type="submit" class="button" name="loginSubmit" value="select" />  
        </form>
        
        <p id='usernameText'>UserName</p>
        <p id='passwordText'>Password</p>
        <button onclick="testDisplay()">Click me</button>
        <?php
        if(isset($_GET['loginUser'])){
        $loginUser=$_GET['loginUser'];
        $pwCheck=$_GET['loginPW'];
        $result2 = pg_query($link, "SELECT password FROM users WHERE username='$loginUser';");
        if (!$result2) {
        echo "Something went wrong.";
        exit;
        }
           
        while ($test = pg_fetch_object($result2)) {
        if($pwCheck==($test->password)){
            $result3 = pg_query($link,"SELECT riderId FROM rider r1, users u1 WHERE r1.riderId = u1.userId AND username = '$loginUser'");
            $role=pg_fetch_object($result3);  
            if($role!=null){
                echo"I am a Rider";
                $_SESSION['riderId'] = $role->riderid;
            }
            echo"Log In";
        }else{
            echo"No";
        }
        }

        echo "<pre>";
        print_r($test[0]);
        echo "</pre>";
        }        ?>
      <script>
        function testDisplay(){
        document.getElementById("passwordText").innerHTML="<?php echo $_GET['loginPW']?>";
       document.getElementById('usernameText').innerHTML="<?php echo $_GET['loginUser']?>";
        }
        </script>

    </body>
</html>

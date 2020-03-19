<?php
$link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
global $UserUsername;
global $UserPassword;
?>
<html>
    <head> 
        <title> Create Account Admin </title>
        <style>
            input,a{
                display:block;
            }
        </style>
    </head>
    <body>
        <!-- Create Account -->
        <h1>Create Account Admin</h1>
        <form action="createAccount.php" id="createAdmin" method="get">
            <a> Name: </a> <input type="textbox" name="aname" placeholder="Please enter name" />  
            <a> Username: </a><input type="textbox" name="ausername" placeholder="Please enter username" />
            <a> Password: </a><input type="textbox" name="apassword" placeholder="Please enter password" />
            <a> Contact Number: </a><input type="textbox" name="acontactNo" placeholder="Please enter contactNo" />
            <select id="role" name="roleSelection">
                <option value="1">FDS Manager</option>
                <option value="2">Delivery Rider(Full Time)</option>
                <option value="3">Delivery Rider(Part Time)</option>
                <option value="4">Restaurant Staff</option>
            </select>
            <input type="submit" class="button" action="createAccount.php" name="select" value="select" />  
            <?php
            if (isset($_GET['select'])) {

                $name = $_GET['aname'];
                $username = $_GET['ausername'];
                $password = $_GET['apassword'];
                $UserUsername = $_GET['ausername'];
                $UserPassword = $_GET['apassword'];
                $contactno = $_GET['acontactNo'];
                $role = $_GET['roleSelection'];
                echo $role;

                $sql = "INSERT INTO admin(aName, aUsername, aPassword, aContactNo, aRole) values('$name', '$username', '$password', '$contactno','$role');";
                $result = pg_query($link, $sql);
                if ($result) {
                    echo "Record saved";
                } else {
                    echo "Error";
                }
            }
            ?>
        </form>

        <h1>View Admin Account</h1>
        <a>Your Account Information</a>
        <a>Name: </a><a id="accountName">Name</a>
        <a>Username: </a><a id="accountUserName">Username</a>
        <a>Contact Number: </a><a id="accountContactNo">Contact Number</a>
        <a>Role: </a><a id="accountRole">Role</a>
        <script>
            document.getElementById("accountName").innerHTML = "<?php echo $_GET['aname'] ?>";
            document.getElementById("accountUserName").innerHTML = "<?php echo $_GET['ausername'] ?>";
            document.getElementById("accountContactNo").innerHTML = "<?php echo $_GET['acontactNo'] ?>";
            document.getElementById("accountRole").innerHTML = "<?php echo $_GET['roleSelection'] ?>";
        </script>

        <h1>Update Admin Account</h1>
        <form action="createAccount.php" id="updateAdmin" method="get">
            <a> Name: </a> <input type="textbox" name="uname" placeholder="Please enter name" />  
            <a> Username: </a><input type="textbox" name="uusername" placeholder="Please enter username" />
            <a> Contact Number: </a><input type="textbox" name="ucontactNo" placeholder="Please enter contactNo" />
            <input type="hidden" name="UserUsername" value="123" id="UserUsername"/>
            <input type="hidden" name="UserPassword" value="123" id="UserPassword">
            <select id="urole" name="uroleSelection">
                <option value="1">FDS Manager</option>
                <option value="2">Delivery Rider(Full Time)</option>
                <option value="3">Delivery Rider(Part Time)</option>
                <option value="4">Restaurant Staff</option>
            </select>
            <input type="submit" class="button" action="createAccount.php" name="uselect" />
            <?php
            if (isset($_GET['uselect'])) {
                $UserUsername = $_GET['UserUsername'];
                $UserPassword = $_GET['UserPassword'];
                $uname = $_GET['uname'];
                $uusername = $_GET['uusername'];
                $ucontactno = $_GET['ucontactNo'];
                $urole = $_GET['uroleSelection'];
                $sql2 = "UPDATE admin set aName ='$uname' , aUsername ='$uusername', aContactNo='$ucontactno', aRole='$urole', aPassword='$UserPassword' where aUsername = '$UserUsername';";
                $result2 = pg_query($link, $sql2);
                if ($result2) {
                    echo "Updated successfully.";
                    $UserUsername = $_GET['uusername'];
                    echo $uusername;
                } else {
                    echo pg_last_error($dbconn);
                    ;
                }
            }
            ?>
            <!-- This is used to act as session variable -->
            <script>
                document.getElementById("UserUsername").value = "<?php echo $_GET['ausername'] ?>";
                document.getElementById("UserPassword").value = "<?php echo $_GET['apassword'] ?>";
            </script>
        </form>
        <!-- Refresh the data after updating-->
        <script>
            document.getElementById("accountName").innerHTML = "<?php echo $_GET['uname'] ?>";
            document.getElementById("accountUserName").innerHTML = "<?php echo $_GET['uusername'] ?>";
            document.getElementById("accountContactNo").innerHTML = "<?php echo $_GET['ucontactNo'] ?>";
            document.getElementById("accountRole").innerHTML = "<?php echo $_GET['uroleSelection'] ?>"
            document.getElementById("UserUsername").value = document.getElementById("accountUserName").innerHTML;
        </script>
       
        <form method="GET" action="createAccount.php">
             <input name="DeleteUsername" value="123" id="DeleteUsername"/>
            <input type="submit" value="Delete" name="delete">

            <?php
            if (isset($_GET["delete"])) {
                $dUsername = $_GET['DeleteUsername'];
                $sql3 = "delete from admin where aUsername= '$dUsername'";
                $result3 = pg_query($link, $sql3);
                if ($result3) {
                    echo "Deleted successfully\n";
                } else {
                    echo pg_last_error($link);
                }
            }
            ?>
            <!-- Used to act as session variables-->
            <script>
            document.getElementById("DeleteUsername").value = document.getElementById("accountUserName").innerHTML;;
            </script>
        </form>
    </body>
</html>
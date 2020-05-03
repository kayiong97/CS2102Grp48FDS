<?php
$link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
session_start();
$_SESSION['riderId']=null;
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
            <a class="nav-link" href="AdminLogin.php">
              <i class="material-icons">dashboard</i>
              <p>Admin's Login</p>
            </a>
          </li>
	  <li class="nav-item active  ">
            <a class="nav-link" href="#0">
              <i class="material-icons">dashboard</i>
              <p>Rider's Login</p>
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
            <h1>Rider's Login</h1>
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
         <form  id="loginAdmin" method="get" style='margin-top: 20%'>
            <a><b>Please enter username: </b></a><input type="textbox" name="loginUser" placeholder="Username" />  </br></br>
            <a><b>Please enter password: </b></a><input type="textbox" name="loginPW" placeholder="Password" />
            <input type="submit" class="button" name="loginSubmit" value="Login" />  
        </form>
        
       
        <?php
        if(isset($_GET['loginSubmit'])){
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
                
                $_SESSION['riderId'] = $role->riderid;
				header("Location: RidersTab.php");
            }
            
        }else{
            echo"Incorrect Password Please Try Again";
        }
        }

        
        }        ?>
     

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

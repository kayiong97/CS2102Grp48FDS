<?php
ob_start();
$link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
session_start();
$_SESSION['riderId']=null;
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
        <a class="simple-text logo-mini">
          Admin Menu List
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="#0">
              <i class="material-icons">dashboard</i>
              <p>Admin's Login</p>
            </a>
          </li>
	  <li class="nav-item active  ">
            <a class="nav-link" href="RidersLogin.php">
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
            <h1>Admin Login</h1>
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
        
          
        <form id="loginAdmin" method="get" style='margin-top:20%'>
            <a><b>Please enter username: </b></a><input type="textbox" name="loginUser" placeholder="Please enter username" />  <br /><br />
            <a><b>Please enter password: </b></a><input type="textbox" name="loginPW" placeholder="Please enter password" />
            <input type="submit" class="button" name="loginSubmit" value="Login" />  
        </form>
        
     
		<?php
        if(isset($_GET['loginSubmit'])){
        $loginUser=$_GET['loginUser'];
        $pwCheck=$_GET['loginPW'];
        $result2 = pg_query($link, "SELECT password FROM users u WHERE u.username='$loginUser' AND EXISTS(SELECT 1 FROM fdsmanager f WHERE f.userid=u.userid);");
        if (!$result2) {
        echo "Something went wrong.";
        exit;
        }else{
			$role=pg_fetch_object($result2);  
			if($role!=null){
		header("Location: 0_Dashboard.php");
			}else{
				echo"Wrong Username or Password";
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

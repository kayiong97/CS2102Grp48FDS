<?php
  session_start();

    $username = $_SESSION["username"];
	$link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");

	$query = "SELECT u.username, c.accumulatedPoints, u.name, u.contactNo FROM customers c JOIN users u on c.userId = u.userId WHERE u.username = '$username';";

	$res = pg_query($link, $query);

	while ($row = pg_fetch_row($res)) {
		if ($row[0] == $username) {
            $accumulatedPoints = $row[1];
			$_SESSION["accumulatedPoints"] = $accumulatedPoints;

            $name = $row[2];
			$_SESSION["name"] = $name;

            $contactNo = $row[3];
			$_SESSION["contactNo"] = $contactNo;
		} else {
			// echo "Sorry, no result found.";
        }
	}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Your only PORT's Food Delivery Service</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/animate.css">
        <link rel="stylesheet" href="../assets/css/owl.carousel.css">
        <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="../assets/css/magnific-popup.css">
        <!--HELLO-->
        <!-- MAIN CSS -->
        <link rel="stylesheet" href="../assets/css/templatemo-style.css">

        <style>
            .owl-carousel .owl-stage-outer {
                height: 125px;
            }
            
            section {
                padding: 0px;
            }
            
            .about-info {
                min-height: 500px;
            }
        </style>

    </head>

    <body>

        <!-- PRE LOADER -->
        <section class="preloader">
            <div class="spinner">

                <span class="spinner-rotate"></span>

            </div>
        </section>

        <!-- MENU -->
        <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
            <div class="container">

                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="index.php" class="navbar-brand">PORT'S<span>.</span> Food Delivery Service</a>
                </div>

                <!-- MENU LINKS -->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                        <li><a href="index.php" class="smoothScroll">Home</a></li>
                        <!--<li><a href="#about" class="smoothScroll">About</a></li>-->
                        <li><a href="restaurants.php" class="smoothScroll">Restaurant</a></li>
                        <li><a href="categories.php" class="smoothScroll">Categories</a></li>
                        <!--<li><a href="#contact" class="smoothScroll">Contact</a></li>-->
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <a href="viewAccountProfile.php" class="section-btn" id="navViewAccountProfile" <?php if( isset( $_SESSION[ "username"] ) ){ echo 'style="display:inline-block;"'; }else{ echo 'style="display:none;"'; } ?>>
                    My Account</a>

                        <a href="login.php" class="section-btn" id="navLogin" <?php if( isset( $_SESSION[ "username"] ) ){ echo 'style="display:none;"'; }else{ echo 'style="display:inline-block;"'; } ?>>
                    Login</a>

                        <a href="login.php" class="section-btn" id="navLogout" <?php if( isset( $_SESSION[ "username"] ) ){ echo 'style="display:inline-block;"'; }else{ echo 'style="display:none;"'; } ?>>
                    Logout</a>
                    
                    	<a href="retrieveShoppingCart.php" class="section-btn" id="navLogout" <?php if( isset( $_SESSION[ "username"] ) ){ echo 'style="display:inline-block;"'; }else{ echo 'style="display:none;"'; } ?>>
                    My Cart</a>
                    
                    </ul>
                </div>

            </div>
        </section>

        <!-- NAV BAR BACKGROUND DESIGN -->
        <section id="home" class="slider" data-stellar-background-ratio="0.5">
            <div class="row">

                <div class="owl-carousel owl-theme">
                    <div class="item item-first">
                        <div class="caption">
                            <div class="container">
                                <div class="col-md-8 col-sm-12">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- View Account Profile -->
        <section id="about" data-stellar-background-ratio="0.5">

            <div class="container">
                <div class="row">
                    <h2><u>>> View Account Profile</u></h2>

                    <div class="col-md-6 col-sm-12">
                        <div class="about-info">
                            <!--
                                    <div class="section-title wow fadeInUp" data-wow-delay="0.2s">
                                        <h4>Read our story</h4>
                                        <h2>We've been Making The Delicious Foods Since 1999</h2>
                                    </div>

                                    <div class="wow fadeInUp" data-wow-delay="0.4s">
                                        <p>Fusce hendrerit malesuada lacinia. Donec semper semper sem vitae malesuada. Proin scelerisque risus et ipsum semper molestie sed in nisi. Ut rhoncus congue lectus, rhoncus venenatis leo malesuada id.</p>
                                        <p>Sed elementum vel felis sed scelerisque. In arcu diam, sollicitudin eu nibh ac, posuere tristique magna. You can use this template for your cafe or restaurant website. Please tell your friends about <a href="https://plus.google.com/+templatemo" target="_parent">templatemo</a>. Thank you.</p>
                                    </div>
                                -->
                            <h2>Hi, <b> <?php echo($_SESSION["username"]);?> </b></h2>

                            <h4>Name: <u style="margin-left:19%;"> <?php echo($_SESSION["name"] );?> </u></h4>

                            <h4>Contact No: <u style="margin-left:10%;"> <?php echo($_SESSION["contactNo"] );?> </u></h4>

                            <h4>Membership Points: <u style="margin-left:0%;"> <?php echo($_SESSION["accumulatedPoints"]);?> </u></h4>
         
                            <div>
                            <div class="col-50">
                                <h3>Credit Card Details</h3>
                                
                                <h4 style="border: 1px solid;">Your Credit Cards Registered</h4>
                                <br/>
                                <?php
                                
                                    $customerId = $_SESSION['loggedInCustomerId'];
                                    $db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
                                    $result = pg_query($db,"SELECT * FROM CreditCardDetails ccd WHERE ccd.customerId = $customerId");
                                    
                                    echo "<table>";
                                    
                                    echo" 
                                    <tr>
                                        <th>Card Number</th>
                                        <th>Card Holder Name</th>
                                        <th>CVV Number</th>
                                        <th>Expiry Date (YYYY-MM)</th>
                                    </tr>";
                                    
                                    while ($row = pg_fetch_row($result)) {
                                    
                                        $cardNumber = $row[0];
                                        $cardHolderName = $row[1];
                                        $cvvNumber = $row[2];
                                        $expiryMonth = $row[3];
                                        $expiryYear = $row[4];
                                                
                                        echo "<tr>";
                                        echo "<td align='center' width='200'>" . $cardNumber . "</td>";
                                        echo "<td align='center' width='200'>" . $cardHolderName . "</td>";
                                        echo "<td align='center' width='200'>" . $cvvNumber . "</td>";
                                        echo "<td align='center' width='200'>" . $expiryYear . "-" . $expiryMonth ."</td>";
                                        
                                        echo"<td><form method='post' name='myForm'>
                                             <input type='hidden' id='customerId' name='customerId' value='$customerId'>
                                             <input type='hidden' id='cardNumber' name='cardNumber' value='$cardNumber'>		
                                             <input type='submit' id='btnRemoveCreditCard' name='btnRemoveCreditCard' value='Remove' title='Click to remove this credit card'/>                                   
                                             </form></td>";
                                        
                                        echo "</tr>";
                                    }
                                        echo "</table>";
                                ?>
        
                                <?php
                                if(isset($_POST['btnRemoveCreditCard'])){
                                    $customerId = $_POST["customerId"];
                                    $cardNumber = $_POST["cardNumber"];
                                    
                                    $result2 = pg_query($db, "DELETE FROM creditCardDetails WHERE customerId = $customerId AND cardNumber = $cardNumber");
                                    if (!$result2)
                                    {
                                        echo "Delete failed!!";
                                    } else
                                    {
                                        //echo "Delete successfull;";
                                        echo "<script>alert('This credit card has been removed.'); window.location.href = 'viewAccountProfile.php'; </script>";
                                    }
                                }
                                ?>
                                
                                <hr/>
                                
                                <form method='post'>
                                    <h4 style="border: 1px solid;">Register New Credit Card</h4>
                                    <br/>
                                    <label for="fname">Accepted Cards</label>
                                    <div class="icon-container">
                                      <i class="fa fa-cc-visa" style="color:navy;"></i>
                                      <i class="fa fa-cc-amex" style="color:blue;"></i>
                                      <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                      <i class="fa fa-cc-discover" style="color:orange;"></i>
                                    </div>
                                    <label for="cname">Name on Card</label>
                                    <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                                    <br/>
                                    <label for="ccnum">Credit card number</label>
                                    <input type="text" id="ccnum" name="cardnumber" placeholder="5264710312229301">
                                    <br/>
                                    <label for="expyear">Expiry Year</label>
                                    <input type="text" id="expyear" name="expyear" placeholder="2018">
                                    <br/>
                                    <label for="expmonth">Expiry Month</label>
                                    <input type="text" id="expmonth" name="expmonth" placeholder="12">
                                    <br/>
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="352">
                                    <br/>
                                    
                                    <input type="submit" value="Register Credit Card Details" name="btnRegisterCreditCardDetails"/>
                                </form>
                                <?php
                                if(isset($_POST['btnRegisterCreditCardDetails'])){
                       
                                    $customerId = $_SESSION['loggedInCustomerId'];
                       
                                    $db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");

                                    $query = "INSERT INTO creditCardDetails(cardNumber, cardHolderName, cvvNumber, expiryMonth, expiryYear, customerId)
                                    VALUES ('$_POST[cardnumber]', '$_POST[cardname]',$_POST[cvv],$_POST[expmonth], $_POST[expyear], $customerId)";
                                    $result = pg_query($db, $query); 
                                    
                                    if ($result)
                                    {
                                        echo "<script>alert('This credit card has been registered.')</script>";
                                    }
                                    else
                                    {
                                        echo "<script>alert('This credit card cannot be registered.')</script>";
                                    }
                                }
                                ?>
                                
                                <hr/>
                                
                                <div class="col-50">
                                <h3>My Order History</h3>
                                
                                <h4 style="border: 1px solid;">Past Orders</h4>
                                <br/>
                                <?php
                                
                                    $customerId = $_SESSION['loggedInCustomerId'];
                                    $db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
                                    $result = pg_query($db,"select cc.orderId, cc.completedDateTime, (SELECT name FROM restaurant WHERE restaurantid = cc.restaurantId), o.totalOrderCost from completes cc NATURAL JOIN orders o WHERE cc.customerid = $customerId AND cc.completedDateTime IS NOT NULL");
                                    
                                    echo "<table>";
                                    
                                    echo" 
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Completed Date Time</th>
                                        <th>Restaurant ID</th>
                                        <th>Total Order Cost</th>
                                    </tr>";
                                    
                                    while ($row = pg_fetch_row($result)) {
                                        $orderId = $row[0];
                                        $completedDateTime = $row[1];
                                        $restaurantName = $row[2];
                                        $totalOrderCost = $row[3];
                                                
                                        echo "<tr>";
                                        echo "<td align='center' width='200'>" . $orderId . "</td>";
                                        echo "<td align='center' width='200'>" . $completedDateTime . "</td>";
                                        echo "<td align='center' width='200'>" . $restaurantName . "</td>";
                                        echo "<td align='center' width='200'>" . $totalOrderCost . "</td>";
                                        echo "</tr>";
                                    }
                                        echo "</table>";
                                ?>
                                
                                </div>
                                
                                
                                
                              </div>
                            </div>
                            
                            
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="wow fadeInUp about-image" data-wow-delay="0.6s">
                            <img src="../assets/images/about-image.jpg" class="img-responsive" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer id="footer" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 col-sm-8">
                        <div class="footer-info">
                            <div class="section-title">
                                <h2 class="wow fadeInUp" data-wow-delay="0.2s">Find us</h2>
                            </div>
                            <address class="wow fadeInUp" data-wow-delay="0.4s">
                                        <p>123 nulla a cursus rhoncus,<br> augue sem viverra 10870<br>id ultricies sapien</p>
                                    </address>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-8">
                        <div class="footer-info">
                            <div class="section-title">
                                <h2 class="wow fadeInUp" data-wow-delay="0.2s">Reservation</h2>
                            </div>
                            <address class="wow fadeInUp" data-wow-delay="0.4s">
                                        <p>090-080-0650 | 090-070-0430</p>
                                        <p><a href="mailto:info@company.com">info@company.com</a></p>
                                        <p>LINE: eatery247 </p>
                                    </address>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-8">
                        <div class="footer-info footer-open-hour">
                            <div class="section-title">
                                <h2 class="wow fadeInUp" data-wow-delay="0.2s">Open Hours</h2>
                            </div>
                            <div class="wow fadeInUp" data-wow-delay="0.4s">
                                <p>Monday: Closed</p>
                                <div>
                                    <strong>Tuesday to Friday</strong>
                                    <p>7:00 AM - 9:00 PM</p>
                                </div>
                                <div>
                                    <strong>Saturday - Sunday</strong>
                                    <p>11:00 AM - 10:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-4">
                        <ul class="wow fadeInUp social-icon" data-wow-delay="0.4s">
                            <li>
                                <a href="#" class="fa fa-facebook-square" attr="facebook icon"></a>
                            </li>
                            <li>
                                <a href="#" class="fa fa-twitter"></a>
                            </li>
                            <li>
                                <a href="#" class="fa fa-instagram"></a>
                            </li>
                            <li>
                                <a href="#" class="fa fa-google"></a>
                            </li>
                        </ul>

                        <div class="wow fadeInUp copyright-text" data-wow-delay="0.8s">
                            <p>
                                <br>Copyright &copy; 2018
                                <br>Your Company Name

                                <br>
                                <br>Design: TemplateMo
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </footer>

        <!-- SCRIPTS -->
        <script src="../assets/js/jquery.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.stellar.min.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/jquery.magnific-popup.min.js"></script>
        <script src="../assets/js/smoothscroll.js"></script>
        <script src="../assets/js/custom.js"></script>

    </body>

    </html>
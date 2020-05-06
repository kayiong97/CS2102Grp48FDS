<?php
    session_start();

    if ( !empty( $_SESSION["username"] ) )
    {
        
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


<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  // font-family: arial;
  padding: 5px;
  min-width: 300px;

}

.price {
  color: grey;
  font-size: 22px;
}

.card input[type=submit] {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}
</style>

        <<!-- Restaurants -->
            <section id="about" data-stellar-background-ratio="0.5">

                <div class="container">
                    <div class="row">
                        <h2><u>>> Restaurants <?php echo "(".$_SESSION[ "restaurantsBasedOnCategory"].")"; ?></u></h2> 

                        <div class="col-md-6 col-sm-12">
                            <div class="about-info">
                                <?php
                                
                                    if($_POST){
                                        if(isset($_POST['btnViewFoodBasedOnRestaurant'])){
                                            $restaurantName = $_POST["btnViewFoodBasedOnRestaurant"];
                                            $_SESSION["restaurantIdClickedByUser"] = $_POST["restaurantIdClickedByUser"];
                                                    
                                            $_SESSION["viewFoodByRestaurantName"] = $restaurantName;
                                            echo "<script>location.href = '/cs2102grp48fds/CustomerUI/webpages/viewFoodByRestaurant.php'</script>";
                                        }
                                    }

                                    if( isset( $_SESSION[ "restaurantsBasedOnCategory"] ))
                                    {
                                        $categories = $_SESSION["restaurantsBasedOnCategory"];
            
                                        $link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");

                                        $query = "SELECT distinct r.name, contactNo, address, area, minMonetaryAmount, r.restaurantId FROM restaurant r JOIN restaurantFood rf ON r.restaurantId = rf.restaurantId WHERE rf.category = '$categories' ORDER BY r.name ASC;";
                                        $res = pg_query($link, $query);
                                        
                                        echo "<table>";
                                        echo "<tr>";
                                        while ($row = pg_fetch_row($res)) {
                                            $restaurantName = $row[0];
                                            $contactNo = $row[1];
                                            $address = $row[2];
                                            $area = $row[3];
                                            $minMonetaryAmount = $row[4];
											
                                            $_SESSION["restaurantIdClickedByUser"] = $row[5];
                                                                                  
                                                echo 
                                                "<form method='post' name='myForm'>
                                                <td><div class='card'>
                                                <img src='/cs2102grp48fds/CustomerUI/assets/images/restaurants/$restaurantName.jpg' alt='$restaurantName' style='width: 100%; height: 200px;'>
                                                <p><input type='submit' id='viewFoodButton' name='btnViewFoodBasedOnRestaurant' value='$restaurantName' title='Click to view food sold'/></p>
                                                
                                                <h3>$contactNo</h3>
                                                <h3>$address ($area)</h3>
                                                <h3>Minimum amount: $$minMonetaryAmount</h3>
                                                <input type='hidden' name='restaurantIdClickedByUser' value='$row[5]'>
                                                <input type='hidden' name='restaurantNameClickedByUser' value='$row[0]'>
                      
                                                <br/>
                                                
                                                <input type='submit' id='viewReviewButton' name='btnViewReviewBasedOnRestaurant' value='View Review'/>
                                                
                                                </div></td>
                                                </form>";
                                        }
                                        echo "</tr>";
                                        echo "</table>";
                                    
                                    }
                                ?>
                                
                                <?php 
                                        if(isset($_POST['btnViewReviewBasedOnRestaurant']))
                                            {
                                                $restaurantIdClickedByUser = $_POST['restaurantIdClickedByUser'];  
                                                $restaurantNameClickedByUser = $_POST['restaurantNameClickedByUser'];             
                                                
                                                $link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");

                                                $query = "select cc.reviewdescriptionfororder, u.name FROM completes cc NATURAL JOIN customers c NATURAL JOIN users u 
                                                WHERE cc.restaurantid = $restaurantIdClickedByUser and cc.reviewdescriptionfororder IS NOT NULL;  ";
                                                
                                                $res = pg_query($link, $query);
                                            
                                                        echo "<table>";
                                                        echo "<tr>";
                                                        
                                                        $num = pg_numrows($res);
                                                        if ($num == 0)
                                                        {
                                                            echo "<th>There are no reviews available for this restaurant <u>".$restaurantNameClickedByUser."</u>...</th>"; 
                                                        }
                                                        else{
                                                            while ($row = pg_fetch_row($res)) 
                                                                {
                                                                $reviewDescriptionForOrder = $row[0];
                                                                $name = $row[1];
                                                                
                                                                echo "<th>Here are our reviews from customers for restaurant <u>".$restaurantNameClickedByUser."</u>...</th>";
                                                                echo "</tr>";
                                                                
                                                                echo "<tr>";
                                                                echo "<td>".$name. "   reviewed '".$reviewDescriptionForOrder."'</td>";
                                                            }
                                                        }
                                                        echo "</tr>";
                                                        echo "</table>";
                                            }
                                            
										?>
                                        
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
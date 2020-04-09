﻿<?php
    session_start();
    
//Hiding Errors 
error_reporting(E_ERROR | E_PARSE);
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

        <!-- Restaurants -->
            <section id="about" data-stellar-background-ratio="0.5">

                <div class="container">
                    <div class="row">
                        <h2><u>>> Foods <?php echo "(".$_SESSION[ "viewFoodByRestaurantName"].")"; ?></u></h2> 

                        <div class="col-md-6 col-sm-12">
                            <div class="about-info">
                                <?php
                                                                                             
                                    if( isset( $_SESSION[ "viewFoodByRestaurantName"] ))
                                    {
                                        $restaurantName = $_SESSION["viewFoodByRestaurantName"];
            
                                        $link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");

                                        $query = "SELECT distinct rf.price, rf.name, rf.information, rf.availabilitystatus, rf.dailylimit FROM restaurantfood rf INNER JOIN restaurant r ON rf.restaurantid = r.restaurantid WHERE r.name = '$restaurantName'";
                                        $res = pg_query($link, $query);
                                        
                                        echo "<table>";
                                        echo "<tr>";
                                        while ($row = pg_fetch_row($res)) {
                                            $name = $row[1];
                                            $information = $row[2];
                                            $price = $row[0];
                                            $availabilitystatus = $row[3];
                                            $dailylimit = $row[4];                                        
                                        										
										echo 
                                                "<form method='post' name='myForm'>
                                                <td><div class='card'>
                                                <img src='/cs2102grp48fds/CustomerUI/assets/images/restaurants/$restaurantName.jpg' alt='$restaurantName' style='width: 100%; height: 200px;'>
                                                <p><input type='submit' id='viewFoodButton' name='btnViewFoodBasedOnRestaurant' value='$name'/></p>
                                                
                                                <h3>Details: $information</h3>
                                                <h3>Price: $$price</h3>												
												<h3>Quantity Available: $dailylimit</h3>
												";
                                                
                                                if ($row[4] == 0) { 
                                                    echo "<input type='submit' id='btnAddToCart' name='btnAddToCart' value='Add to Cart' style='background-color:lightgrey' disabled />";
                                                } else { 
                                                    echo "<input type='submit' id='btnAddToCart' name='btnAddToCart' value='Add to Cart' style='background-color:orange' />";
                                                } 
												
												
												
												echo "<input type='hidden' id='foodToAddToCart' name='foodToAddToCart' value='$name'/>
                                                </div></td>
                                                </form>"; 
										}		
                                        echo "</tr>";
                                        echo "</table>";
                                    
                                    }
                                ?>
                                
                                <?php
                                                               
								echo "restaurantIdClickedByUser: ".$_SESSION["restaurantIdClickedByUser"];
								echo "<br/>";
                                echo "loggedInCustomerId: ".$_SESSION["loggedInCustomerId"];
                                
                                    if(isset($_POST['btnAddToCart'])){
                                        
                                            $restaurantIdClickedByUser = $_SESSION["restaurantIdClickedByUser"];
                                            $foodNameToAddToCart = $_POST['foodToAddToCart'];
                                            $loggedInCustomerId = $_SESSION["loggedInCustomerId"];
                                           
                                            //Check if this customer has added food from other restaurant. 
                                            //If have, then clear them and add these food from CURRENT NEW restaurant 
                                            $link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
                                            $queryA = "WITH temp AS (
                                                            SELECT sc.restaurantId as resId FROM ShoppingCart sc 
                                                            WHERE sc.customerId = $loggedInCustomerId
                                                            )

                                                            SELECT distinct sc2.restaurantId FROM ShoppingCart sc2
                                                            WHERE $restaurantIdClickedByUser IN 
                                                            (SELECT resId FROM temp WHERE sc2.customerId = $loggedInCustomerId AND sc2.restaurantId <> $restaurantIdClickedByUser)
                                                        ;";
                                            $resultA = pg_query($link, $queryA);
                                            
                                            if (!$resultA) {
                                                 
                                                //Check if this food item is in shoppingCart database. If it is, just update quantity
                                                $query1 = "SELECT sc.name, sc.quantity FROM ShoppingCart sc 
                                                WHERE sc.customerId = $loggedInCustomerId AND sc.name = '$foodNameToAddToCart' AND sc.restaurantId = '$restaurantIdClickedByUser' ;";
                                                $res1 = pg_query($link, $query1);
                                                
                                                $quantityToBeAdded = 0;
                                                
                                                while ($row = pg_fetch_row($res1)) {
                                                    $quantityToBeAdded = $row[1] + 1;
                                                    
                                                    //echo "This food already added to cart, so jst need udpate quantity.";
                                                     
                                                     if ( $quantityToBeAdded != 0 ) {
                                                        $res2 = pg_query($link, "UPDATE shoppingCart SET quantity = $quantityToBeAdded 
                                                        WHERE customerId = $loggedInCustomerId AND name = '$foodNameToAddToCart' AND sc.restaurantId = '$restaurantIdClickedByUser' ;");
                                                        
                                                        if (!$res2) {
                                                            echo "<script> alert('Update shopping cart for quantity for an item failed!!');</script>";
                                                        } else {
                                                            echo "<script> alert('Update shopping cart for quantity for an item success!!');</script>";
                                                        }
                                                    }
                                                    break;
                                                }   
                                                
                                                //Insert into shopping cart if THIS FOOD ITEM IS NOT EXIST IN shoppingCart DATABASE
                                                $query3 = "INSERT INTO SHOPPINGCART(quantity, customerId, name, restaurantId) 
                                                            VALUES(1, $loggedInCustomerId, '$foodNameToAddToCart', $restaurantIdClickedByUser) ;";
                                                $res3 = pg_query($link, $query3);
                                                        
                                                if ($res3) {
                                                    echo "<script> alert('Insertion into shopping cart is successful.');</script>";
                                                }
                                            
                                            } else { //Delete previous food items in cart and add these CURRENT NEW FOOD 
                                                    $resultB = pg_query($link, "DELETE FROM shoppingCart 
                                                    WHERE customerId = $loggedInCustomerId AND restaurantId <> $restaurantIdClickedByUser; ");
                                                    
                                                    if (!$resultB)
                                                    {
                                                        // echo "Delete failed!!";
                                                    } else {
                                                        // echo "Delete successfull;";
                                                        
                                                        //Check if this food item is in shoppingCart database. If it is, just update quantity
                                                        $query1 = "SELECT sc.name, sc.quantity FROM ShoppingCart sc 
                                                        WHERE sc.customerId = $loggedInCustomerId AND sc.name = '$foodNameToAddToCart' AND sc.restaurantId = '$restaurantIdClickedByUser' ;";
                                                        $res1 = pg_query($link, $query1);
                                                        
                                                        $quantityToBeAdded = 0;
                                                        
                                                        while ($row = pg_fetch_row($res1)) {
                                                            $quantityToBeAdded = $row[1] + 1;
                                                            
                                                            //echo "This food already added to cart, so jst need udpate quantity.";
                                                             
                                                             if ( $quantityToBeAdded != 0 ) {
                                                                $res2 = pg_query($link, "UPDATE shoppingCart SET quantity = $quantityToBeAdded 
                                                                WHERE customerId = $loggedInCustomerId AND name = '$foodNameToAddToCart' AND restaurantId = '$restaurantIdClickedByUser' ;");
                                                                
                                                                if (!$res2) {
                                                                    echo "<script> alert('Update shopping cart for quantity for an item failed!!');</script>";
                                                                } else {
                                                                    echo "<script> alert('Update shopping cart for quantity for an item success!!');</script>";
                                                                }
                                                            } 
                                                            break;
                                                        }

                                                            //Insert into shopping cart if THIS FOOD ITEM IS NOT EXIST IN shoppingCart DATABASE
                                                            $query4 = "INSERT INTO SHOPPINGCART(quantity, customerId, name, restaurantId) 
                                                                            VALUES(1, $loggedInCustomerId, '$foodNameToAddToCart', $restaurantIdClickedByUser) ;";
                                                            $res4 = pg_query($link, $query4);
                                                                        
                                                            if ($res4) {
                                                                echo "<script> alert('Insertion into shopping cart is successful.');</script>";
                                                            }
                                                    }
                                                       
                                                }
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
<?php
    session_start();

//Display review form pop up if never pop up before
if( isset( $_SESSION[ "username"] ) ) {
    $username = $_SESSION[ "username"];
    
    $link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
    $query = "SELECT distinct c.hasAskedForReviewRating, c.customerId, c.orderId, c.completedDateTime FROM completes c
    WHERE c.customerId = (SELECT cc.customerId FROM customers cc WHERE cc.userId = (SELECT userId FROM users WHERE username = '$username'))
    AND c.hasAskedForReviewRating = false;";
    $res = pg_query($link, $query);
    
    while ($row = pg_fetch_row($res)) {
            echo "<script>
                    function closeForm() {
                      document.getElementById('myForm').style.display = 'none';
                    }
                </script>";
                
            echo "<div class='form-popup' id='myForm'>
                      <form class='form-container' method='post' id='reviewForOrder'>
                      
                        <input type='hidden' name='orderId' value='$row[2]'>
                      
                        <h3>Review for <b>Order #$row[2]</b></h3>
                        <label for='reviewOrderDescription'><b>Description</b></label>
                        <textarea placeholder='Enter Description' name='reviewOrderDescription' style='height: 150px'></textarea>

                        <h3>Ratings for <b>Delivery on $row[3]</b></h3>
                        <fieldset class='rating'>
                            <legend>Please rate:</legend>
                            <input type='radio' id='star5' name='rating' value='5' /><label for='star5' title='Rocks!'>5 stars</label>
                            <input type='radio' id='star4' name='rating' value='4' /><label for='star4' title='Pretty good'>4 stars</label>
                            <input type='radio' id='star3' name='rating' value='3' /><label for='star3' title='Meh'>3 stars</label>
                            <input type='radio' id='star2' name='rating' value='2' /><label for='star2' title='Kinda bad'>2 stars</label>
                            <input type='radio' id='star1' name='rating' value='1' /><label for='star1' title='Sucks big time'>1 star</label>
                        </fieldset>

                        <br/><br/><br/><br/><br/><br/>
                        
                        <button type='submit' class='btn' name='btnSubmitReviewForm'>Submit Review</button>
                        <button type='submit' class='btn cancel' onclick='closeForm()' name='btnCloseReviewForm'>Close</button>
                      </form>
                </div>";
        }
}
//Hiding Errors 
error_reporting(E_ERROR | E_PARSE);

 if (isset($_POST['btnCloseReviewForm']) || isset($_POST['btnSubmitReviewForm'])){
            $reviewOrderDescription = $_POST['reviewOrderDescription'];
            $ratingsForDelivery = $_POST['rating'];
            
            if ($reviewOrderDescription == null) { $reviewOrderDescription = null; }
            if ($ratingsForDelivery == null) { $ratingsForDelivery = 0; }
            
            $orderId = $_POST['orderId'];
            
            $link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");   
            $query2 = "UPDATE completes SET hasAskedForReviewRating = true, 
            reviewDescriptionForOrder = '$reviewOrderDescription', ratingsForDelivery = '$ratingsForDelivery' 
            WHERE orderId = $orderId ";
            
            $res2 = pg_query($link, $query2);

            if($res2){
              echo "<script> alert('Thank you for the feedback.') </script> ";
              echo "<style>
                    #myForm {
                        display: none !important;
                    }
                    </style>";
            }
        }

//Search for restaurants based on postal code
if(isset($_POST['btnSearch'])){
    
    $address=($_POST["address"]);
    
    $link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
    $query = "SELECT r.name, r.address, r.restaurantId FROM restaurant r WHERE substring(RIGHT(r.address, 6) from 0 for 3) = LEFT('$address', 2);";
    $res = pg_query($link, $query);
    
    $listOfRestaurantIdToBeRetrievedArray = array();

    while ($row = pg_fetch_row($res)) {
        echo "$row[0] is around your area: $row[1] <br/>";
        array_push($listOfRestaurantIdToBeRetrievedArray, $row[2]);
    }
    //print_r($listOfRestaurantIdToBeRetrievedArray);
    
    $_SESSION["postalCodeEntered"] = $_POST['address'];
    $_SESSION["restaurantsBasedOnPostalCode"] = $listOfRestaurantIdToBeRetrievedArray;
    
    if ($listOfRestaurantIdToBeRetrievedArray == null) {
        echo "<script type='text/javascript'>alert('Sorry, there is no restaurants to deliver to the postal code entered. ');</script>";
    } else {
        header('Location: /cs2102grp48fds/CustomerUI/webpages/viewRestaurantsByPostalCode.php');
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
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

        /* Button used to open the contact form - fixed at the bottom of the page */
        .open-button {
          background-color: #555;
          color: white;
          padding: 16px 20px;
          border: none;
          cursor: pointer;
          opacity: 0.8;
          position: fixed;
          bottom: 23px;
          right: 28px;
          width: 280px;
        }

        /* The popup form - hidden by default */
        .form-popup {
          display: block;
          position: fixed;
          bottom: 0;
          right: 15px;
          border: 3px solid #f1f1f1;
          z-index: 9;
          max-width: 35%;
        }

        /* Add styles to the form container */
        .form-container {
          //max-width: 300px;
          padding: 10px;
          background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text], .form-container textarea {
          width: 100%;
          padding: 15px;
          margin: 5px 0 22px 0;
          border: none;
          background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus, .form-container textarea:focus {
          background-color: #ddd;
          outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
          background-color: #4CAF50;
          color: white;
          padding: 16px 20px;
          border: none;
          cursor: pointer;
          width: 100%;
          margin-bottom:10px;
          opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
          background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, .open-button:hover {
          opacity: 1;
        }
        </style>

        <style>
        /* Rating */
        .rating {
            float:left;
        }

        /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
           follow these rules. Every browser that supports :checked also supports :not(), so
           it doesn’t make the test unnecessarily selective */
        .rating:not(:checked) > input {
            position:absolute;
            top:-9999px;
            clip:rect(0,0,0,0);
        }

        .rating:not(:checked) > label {
            float:right;
            width:1em;
            padding:0 .1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:200%;
            line-height:1.2;
            color:#ddd;
            text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
        }

        .rating:not(:checked) > label:before {
            content: '★ ';
        }

        .rating > input:checked ~ label {
            color: #f70;
            text-shadow:1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0,0,0,.5);
        }

        .rating:not(:checked) > label:hover,
        .rating:not(:checked) > label:hover ~ label {
            color: gold;
            text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
        }

        .rating > input:checked + label:hover,
        .rating > input:checked + label:hover ~ label,
        .rating > input:checked ~ label:hover,
        .rating > input:checked ~ label:hover ~ label,
        .rating > label:hover ~ input:checked ~ label {
            color: #ea0;
            text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
        }

        .rating > label:active {
            position:relative;
            top:2px;
            left:2px;
        }
        </style>
    
        <style>
        .footer-info footer-open-hour { z-index: 1;}
        #myForm { z-index: 100; }
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

        <section id="home" class="slider" data-stellar-background-ratio="0.5">
            <div class="row">

                <div class="owl-carousel owl-theme">
                    <div class="item item-first">
                        <div class="caption">
                            <div class="container">
                                <div class="col-md-8 col-sm-12">
                                    <h3>PORT's Food Delivery Service</h3>
                                    <h1>Our mission is to provide an unforgettable experience</h1>
                                    
                                    <form method="POST">
                                        <input type="text" placeholder="Enter postal code" class="section-btn btn btn-default smoothScroll" style="background: white" name="address" />
                                        <button type="submit" name="btnSearch" class="section-btn btn btn-default smoothScroll">Search</button>
                                    </form>
                                    
                                </div>
                            </div>
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
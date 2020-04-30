<?php
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
			
			th, td {
			  text-align: left;
			  padding: 8px;
			}

			tr:nth-child(even){background-color: #f2f2f2}

			th {
			  background-color: Purple;
			  color: white;
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

		.cartTable{
			width: 1000px;
		}

		td:nth-child(7), td:nth-child(5), td:nth-child(6) {
			padding-right: 15px !important;
			display: inline-block;
		}
		</style>

        <!-- Restaurants -->
            <section id="about" data-stellar-background-ratio="0.5">

                <div class="container">
                    <div class="row" style="width: 200%;">
                        <h2><u>>> My Shopping Cart <?php echo "(".$_SESSION[ "username"].")"; ?></u></h2> 

                        <div class="col-md-6 col-sm-12">
                            <div class="about-info">
                               <script language="javascript">
									function validate()
									{									
										alert('Your order does not meet the minimum amount for delivery!');											
										return true;
									}
								</script>	
								
								<?php
								$checkoutStatusTrue = true;		
								$minmonetaryamount = 0;								
								$cartSubAmount = 0;								
								$deliveryFee = 5;
								
								$username = $_SESSION["username"];
								
								$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
								$result = pg_query($db,"SELECT s.quantity, s.customerid, s.name, r.name, s.restaurantid, rf.price, r.minmonetaryamount FROM shoppingcart s, restaurant r, restaurantfood rf  
								WHERE ischeckout = false AND s.name = rf.name AND s.restaurantid = rf.restaurantid AND s.restaurantid = r.restaurantid AND 
								customerid IN (SELECT customerid from users u, customers c where u.username='$username' and u.userid = c.userid);");
								
								echo "<table class='cartTable'>";
								echo" 
								<tr>
									<th>Food Name</th>
									<th>Quantity</th>
									<th>Restaurant Name</th>
									<th>Price</th>						
									<th colspan='3'>Action</th>	
									
								</tr>";
								
								while($row = pg_fetch_row($result)){
								
								$quantity = $row[0];
								$customerid = $row[1];
								$name = $row[2];
								$rname = $row[3];						
								$restaurantid = $row[4];
								$price = $row[5];
								$minmonetaryamount = $row[6];
								
								$cartSubAmount += $quantity*$price;								
								
								echo "<tr>";
								echo "<td align='center' width='200'>" . $name . "</td>";
								echo "<td align='center' width='200'>" . $quantity . "</td>";
								echo "<td align='center' width='200'>" . $rname  . "</td>";
								echo "<td align='center' width='200'>" . $price  . "</td>";
								
								echo"<td>
									 <form method='post' name='myForm'>
									 <input type='hidden' id='foodname' name='foodname' value='$name'>
									 <input type='hidden' id='retcustomerid' name='retcustomerid' value='$customerid'>
									 <input type='hidden' id='retrestaurantid' name='retrestaurantid' value='$restaurantid'>
									 <input type='hidden' id='retquantity' name='retquantity' value='$quantity'>								 
									 <input type='submit' id='retrieveItemRow' name='btnSubtractQuantity' value='-' title='Click to Subtract Quantity'/>                                   
									 </form>
									 </td>";
								
								echo"<td>
									 <form method='post' name='myForm'>
									 <input type='hidden' id='foodname' name='foodname' value='$name'>
									 <input type='hidden' id='retcustomerid' name='retcustomerid' value='$customerid'>
									 <input type='hidden' id='retrestaurantid' name='retrestaurantid' value='$restaurantid'>
									 <input type='hidden' id='retquantity' name='retquantity' value='$quantity'>
									 <input type='submit' id='retrieveItemRow' name='btnAddQuantity' value='+' title='Click to Add Quantity'/>                                   
									 </form>
									 </td>";
								
								echo"<td>
									 <form method='post' name='myForm'>
									 <input type='hidden' id='foodname' name='foodname' value='$name'>
									 <input type='hidden' id='retcustomerid' name='retcustomerid' value='$customerid'>
									 <input type='hidden' id='retrestaurantid' name='retrestaurantid' value='$restaurantid'>
									 <input type='hidden' id='retquantity' name='retquantity' value='$quantity'>
									 <input type='submit' id='retrieveItemRow' name='btnRemoveRow' value='X' title='Click to Delete Item'/>                                   
									 </form>
									 </td>";
								
								echo "</tr>";}
								echo "</table>";
								
								$cartTotalAmount = $cartSubAmount + $deliveryFee;
								
								echo"</br>";
								echo "*************<b>Minimum Order for Checkout</b>: $" .$minmonetaryamount;
								echo"</br>";
								echo "*************Sub Total: $" .$cartSubAmount;
								echo"</br>";
								echo "*************Delivery Charges: $" .$deliveryFee;
								echo"</br>";
								echo "*************<b>Total Payable Amount</b>: $" .$cartTotalAmount;
								//$_SESSION["payableAmountBeforeDiscount"] = $cartTotalAmount;
								
								echo"<form method='post' name='myForm'>
								<input type='text' id='information' name='information'/>
								<input type='submit' id='retrievePromotionCode' name='btnRetrievePromotionCode' value='Use Promotion Code' title='User Promotion Code'/>
								</form>";
								
								if (isset($_POST['btnRetrievePromotionCode'])){
								$result2 = pg_query($db, "SELECT p.discountamount, p.promotionId, p.information FROM promotion p WHERE information = '$_POST[information]' AND p.restaurantid = $restaurantid;");
								
								if (!pg_num_rows($result2))
								{
									echo "<script>alert('This promotion code cannot be applied.')</script>";
								}
								else 
								{
									while($row = pg_fetch_row($result2)){
										$discountamount = $row[0];
										$promotionId = $row[1];
										
										$_SESSION["storePromotionId"] = $promotionId;
										$_SESSION["storePromotionCode"] = $row[2];	
																		
										echo "*************Discount Amount: $" .$discountamount;
										echo"</br>";
										
										if(($cartTotalAmount - $discountamount) > 0){
										echo "*************Total Payable Amount (After Discount): $" . ($cartTotalAmount - $discountamount);
										}
										else{
										echo "*************Total Payable Amount (After Discount): $0";	
										}
									}
								}

								}
								
								$_SESSION["getCartTotalAmount"] = $cartTotalAmount;
								$_SESSION["getminmonetaryamount"] = $minmonetaryamount;
								$_SESSION["getFinalTotalAmount"] = $cartTotalAmount - $discountamount;		
						
								?>
								
																
								<?php
								if (isset($_POST['btnRemoveRow'])){
								$customerid = $_POST["retcustomerid"];
								$name = $_POST["foodname"];
								$restaurantid = $_POST["retrestaurantid"];
								$quantity = $_POST["retquantity"];;
								
								$result2 = pg_query($db, "DELETE FROM shoppingcart WHERE name = '$name' AND restaurantid = $restaurantid AND customerid = $customerid");
								if (!$result2)
								{
								echo "Delete failed!!";
								} else
								{
								echo "Delete successfull;";
								echo "*******".$customerid.$name.$restaurantid;
								echo "<script language='javascript'>";
								echo 'window.location.replace("retrieveShoppingCart.php");';
								echo "</script>";
								}
								}
								?>	
								
								<?php
								if(isset($_POST['btnSubtractQuantity'])){
								
								
								$customerid = $_POST["retcustomerid"];
								$name = $_POST["foodname"];
								$restaurantid = $_POST["retrestaurantid"];
								$quantity = $_POST["retquantity"];
								

								if($quantity != 1){
								$result1 = pg_query($db, "UPDATE shoppingcart SET quantity = '$quantity'-1 							
								WHERE name = '$name' AND restaurantid = $restaurantid AND customerid = $customerid");
								
								if (!$result1)
								{
								echo "Update failed!!";
								} 
								else
								{
								echo "Update successfull;";
								echo "*******".$customerid.$name.$restaurantid;
								echo "<script language='javascript'>";
								echo 'window.location.replace("retrieveShoppingCart.php");';
								echo "</script>";
								}	
								}	
								}								
								?>
								
								<?php
								if(isset($_POST['btnAddQuantity'])){
																
									$customerid = $_POST["retcustomerid"];
									$name = $_POST["foodname"];
									$restaurantid = $_POST["retrestaurantid"];
									$quantity = $_POST["retquantity"];
									
									//Check if this food item to be added to shoppingcart line is even possible. If it is then can continue adding.
									$query1 = "SELECT rf.dailylimit FROM restaurantfood rf WHERE rf.restaurantid = $restaurantid AND rf.name = '$name'";								
									$res1 = pg_query($db, $query1);
									
									$dailyLimitForThisFood = 0;
									
									while ($row = pg_fetch_row($res1)) {
										$dailyLimitForThisFood = $row[0];
										
										if ($quantity >= $dailyLimitForThisFood)
										{
											echo "<script> alert('Quantity > Daily Limit! Cannot add anymore quantity. Reach max already.'); </script>";
										}
										else
										{
											//echo "<script> alert('Quantity < Daily Limit! Can still add more quantity. '); </script>";
											$result1 = pg_query($db, "UPDATE shoppingcart SET quantity = '$quantity'+1 							
											WHERE name = '$name' AND restaurantid = $restaurantid AND customerid = $customerid");
										
											if ($result1)
											{
												echo "Update successfull;";
												echo "*******".$customerid.$name.$restaurantid;
												echo "<script language='javascript'>";
												echo 'window.location.replace("retrieveShoppingCart.php");';
												echo "</script>";
											}	
										}
									}
								}
								?>
								
								<br/><br/>    
								<!-- DELIVEYR LOCATIONS -->
								
								<label for='deliveryLocations'>Please select your Delivery Locations: </label>  
								<?php
										$link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");

										/*$query2 = "select deliverylocation from delivery d
										JOIN stores s on s.deliveryId = d.deliveryId
										JOIN customers c on s.customerId = c.customerId
										JOIN users u on u.userId = c.userId
										WHERE u.username = '$username'
										ORDER BY d.orderedTimestamp DESC LIMIT 5;";*/
										
										$query2 = "select deliverylocation from delivery d										
										JOIN customers c on d.customerId = c.customerId
										JOIN users u on u.userId = c.userId
										WHERE u.username = '$username'
										ORDER BY d.orderedTimestamp DESC LIMIT 5;";
										
										$res2 = pg_query($link, $query2);

										echo "<form method='post'>";
										
										echo "<select id='mySelectDeliveryLocations' onchange='myFunctionDeliveryLocation()' name='deliveryLocation'>";
										
										//echo "<option value='0'>Select Delivery Location</option>";
												
										while ($row = pg_fetch_row($res2)) {
												$deliveryLocation = $row[0];
												//$_SESSION["deliveryLocation"] = $deliveryLocation;

												echo "<br/> $deliveryLocation <br/>";												
												echo "<option value='$deliveryLocation'>$deliveryLocation</option>";
										}
										echo "</select>";
										
										echo "<input type='submit' name='btnSubmitDeliveryLocation' value='Select Delivery Location'/>
										</form>";
										
										//Start
										echo "<form method='post'>";
										
										echo "<input type='text' id='deliveryLocationManual' name='deliveryLocationManual'/>";
										
										echo "<input type='submit' name='btnSubmitDeliveryLocationManual' value='Enter Your New Delivery Location'/>
										</form>";
										//End
										
										echo "<script>
											function myFunctionDeliveryLocation() {
												var x = document.getElementById('mySelectDeliveryLocations').value;
												if (x == 0) {
													document.getElementById('txtNewAddress').disabled = true;
												}
												else
													document.getElementById('txtNewAddress').disabled = false;
											}
											</script>";
								?>
									
								<?php
										//deliveryLocation dropdownlist
										if (isset($_POST['btnSubmitDeliveryLocation'])){
											$_SESSION['deliveryLocation'] = $_POST['deliveryLocation'];
										}
										//else
										//	unset($_SESSION['deliveryLocation']);
										
										if (isset($_POST['btnSubmitDeliveryLocationManual'])){
											$_SESSION['deliveryLocation'] = $_POST['deliveryLocationManual'];
										}
										//else
										//	unset($_SESSION['deliveryLocation']);
								?>
									
								<!--Not listed here? Enter an address here: 
								<textarea id="txtNewAddress" name="txtNewAddress" rows="3" cols="40" disabled></textarea>
								-->
								<br/><br/>
								
								<!-- PAYMENT -->
								<label for='paymentType'>Please select your Payment Type: </label>  
								<br/>
								<form method='post'>
								
									<select id='mySelectPaymentMethod' onchange='myFunctionPaymentMethod()' name='paymentType'>
										<option value="Cash" >Cash</option>
										<option value="Credit Card">Credit Card</option>
									</select>
									
									<input type='submit' name='btnSubmitPaymentType' value='Select Payment Type'/>
								</form>
								
								<?php
										//Payment dropdownlist
										if (isset($_POST['btnSubmitPaymentType'])){
											$_SESSION['paymentType'] = $_POST['paymentType'];
										}
								?>
								
								<script>
									function myFunctionPaymentMethod() {
										var x = document.getElementById('mySelectPaymentMethod').value;
										
										if (x != 'Cash') 
										{
											document.getElementById("creditCardContainer").style.display = 'block';
											document.getElementById("creditCardText").style.display = 'block';
										}
										else 
										{
											document.getElementById("creditCardContainer").style.display = 'none';
											document.getElementById("creditCardText").style.display = 'none';
										}
									}
								</script>
								
								<label for='creditCard' id="creditCardText" style="display: none;">Please select your Credit Card: </label>  
                                <?php
                                
                                    $customerId = $_SESSION['loggedInCustomerId'];
                                    $db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
                                    $result = pg_query($db,"SELECT * FROM CreditCardDetails ccd WHERE ccd.customerId = $customerId");
                                    
                                    echo "<table id='creditCardContainer' style='display: none;'>";
                                    
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
                                             <input type='submit' id='btnSelectCreditCard' name='btnSelectCreditCard' value='Select' title='Click to select this credit card for payment'/>                                   
                                             </form></td>";
                                        
                                        echo "</tr>";
                                    }
                                        echo "</table>";
                                ?>
								
								<?php
								if(isset($_POST['btnSelectCreditCard'])){
									$_SESSION['selectedCreditCardNumber'] = $_POST['cardNumber'];
								}								
								?>
			
								</br>
								</br>
														
								<!-- Summary details of selected data. -->														
								<label name="selectedThings">
								<?php 
								
								if (isset($_SESSION['deliveryLocation'])) { 
									echo "You have selected delivery location: ".$_SESSION[deliveryLocation];
									echo "<br/>";
								} 
								if (isset($_SESSION['paymentType']))
								{
									echo "You have selected payment type: ".$_SESSION['paymentType'];
									echo "<br/>";
								}
								if (isset($_SESSION['selectedCreditCardNumber']))
								{
									echo "You have selected credit card: ".$_SESSION['selectedCreditCardNumber'];
									echo "<br/>";
								}
								if (isset($_SESSION['storePromotionCode']))
								{
									echo "You have selected promotion code: ".$_SESSION['storePromotionCode'];
									echo "<br/>";
								}		
								
								?>
								</label>
								
								
								<?php 		
								$sessGetCartTotalAmount = $_SESSION["getCartTotalAmount"];
								$sessGetminmonetaryamount = $_SESSION["getminmonetaryamount"];
								$sessGetFinalTotalAmount = $_SESSION["getFinalTotalAmount"];
								$sessGetDeliveryLocation= $_SESSION["deliveryLocation"];
								
								$sessGetPromotionId = $_SESSION["storePromotionId"];
								if($sessGetCartTotalAmount >= $minmonetaryamount){
									echo"</br>";				
									unset($_SESSION["checkoutStatus"]);	
									
									echo "
										<form id='checkoutTrigger' name='checkoutTriggerForm' method='POST' onsubmit='return validate2();'>
										<input type='submit' value='Checkout' name='checkoutTrigger'/>
										</form>";
								
									
									//Checkout Transaction Start 								
									if (isset($_POST['checkoutTrigger']))
									{
										$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres")
										or die ("Could not connect to server\n");
														
										$username = $_SESSION['username'];																	

										$db = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
										$result = pg_query($db,"SELECT distinct s.quantity AS quantityRequired, s.name AS foodName, r.restaurantid AS restaurantId, rf.dailyLimit FROM shoppingcart s, restaurant r, restaurantfood rf  
										WHERE ischeckout = false AND s.name = rf.name AND s.restaurantid = rf.restaurantid AND s.restaurantid = r.restaurantid AND 
										customerid IN (SELECT customerid from users u, customers c where u.username='$username' and u.userid = c.userid);");
									
										$arr = pg_fetch_all($result);									
										//print_r($arr);
										
										echo "<br/>";
										$_SESSION['arrayOfFoodInShoppingCart'] = $arr;	
										echo "<br/>";

										pg_query("BEGIN") or die("Could not start transaction\n");
												
										foreach($_SESSION['arrayOfFoodInShoppingCart'] as $key => $value) {
												echo "<br/>";
												$arrTest = array_values($value);
												
												/*
												echo "*********Quantity: " . $arrTest[0] . "<br/>";
												echo "*********Food Name: " . $arrTest[1]. "<br/>";
												echo "*********RestaurantID: " . $arrTest[2]. "<br/>";
												echo "*********DailyLimit: " . $arrTest[3]. "<br/>";
												*/
												
												$_SESSION['restaurantId'] = $arrTest[2];
												
												if ($arrTest[3] <= 0)
												{
													$_SESSION['checkoutStatus'] = 1;
													break;
													return;
												}
												$result1 = pg_query($db,"SELECT dailyLimit FROM restaurantfood where name='$arrTest[1]' and restaurantId=$arrTest[2]");
											
												while($row = pg_fetch_row($result1)){
														$dailyLimit = $row[0];								
												
														if ($dailyLimit < $arrTest[0] || $dailyLimit <= 0)
														{
															$_SESSION["checkoutStatus"] = 1;
															echo "<script> window.location.replace('retrieveShoppingCart.php');</script>";
															break;
															return;
														}
														else{
															$_SESSION['checkoutStatus'] = 2;
														}
												}
										
												$res1 = pg_query("UPDATE restaurantfood SET dailylimit = dailylimit - $arrTest[0] WHERE name='$arrTest[1]' and restaurantid = $arrTest[2];");
												$res2 = pg_query("UPDATE restaurantfood SET availabilityStatus = false WHERE dailyLimit = 0;");
									
												echo "<br/>";
												echo "<br/>";
										}
												
												if ($sessGetPromotionId != null){
													$res3 = pg_query("INSERT INTO Orders (totalOrderCost, orderDateTime, deliveryLocation, deliveryFee, promotionId) VALUES ($sessGetFinalTotalAmount, current_timestamp, '$sessGetDeliveryLocation', 5,  $sessGetPromotionId) ");
												}
												else{									
													$res4 = pg_query("INSERT INTO Orders (totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) VALUES ($sessGetFinalTotalAmount, current_timestamp, '$sessGetDeliveryLocation', 5)");
												}
												
												$sessGetPaymentType = $_SESSION['paymentType'];
												$sessGetCCDetails = $_SESSION['selectedCreditCardNumber'];
												
												if($sessGetPaymentType != 'Cash'){
													$res5 = pg_query("INSERT INTO Payment (paymentType, paymentAmount, orderId, paymentcardnumber) values ('$sessGetPaymentType', $sessGetFinalTotalAmount, (select max(orderId) FROM Orders), '$sessGetCCDetails')");
												}
												else{
													$res9 = pg_query("INSERT INTO Payment (paymentType, paymentAmount, orderId) values ('$sessGetPaymentType', $sessGetFinalTotalAmount, (select max(orderId) FROM Orders))");
												}
												
												$loggedInCustomerId = $_SESSION['loggedInCustomerId'];
												$res6 = pg_query("INSERT INTO Delivery (deliveryLocation, customerId, orderedTimestamp, orderId) VALUES('$sessGetDeliveryLocation', $loggedInCustomerId, (select orderDateTime FROM Orders WHERE orderId = (select max(orderId) FROM Orders)), (select max(orderId) FROM Orders))");
												
												$sessGetRestaurantId = $_SESSION['restaurantId'];
												$res7 = pg_query("INSERT INTO Completes (restaurantId, customerId, paymentId, orderId) VALUES ($sessGetRestaurantId, $loggedInCustomerId, (select max(paymentId) from payment), (select max(orderId) from orders))");
												
												$res8 = pg_query("UPDATE shoppingcart SET isCheckout = true WHERE customerId = $loggedInCustomerId");
												$res10 = pg_query("DELETE FROM shoppingcart WHERE customerId = $loggedInCustomerId and isCheckout = true");
												if ($res1 && $res2 && ($res3 || $res4) && ($res5 || $res9) && $res6 && $res7 && $res8 && $res10) {
													//echo "Commiting transaction\n";																								
													pg_query("COMMIT") or die("Transaction commit failed\n");
													$_SESSION["checkoutStatus"] = 2;				

													unset($_SESSION['deliveryLocation']);
													unset($_SESSION['paymentType']);
													unset($_SESSION['selectedCreditCardNumber']);
													unset($_SESSION['storePromotionCode']);
													
													echo "<script> alert('Your order has been confirmed!'); window.location.replace('retrieveShoppingCart.php');</script>";
													
													
												} else {
													//echo "Rolling back transaction\n";
													pg_query("ROLLBACK") or die("Transaction rollback failed\n");
													$_SESSION["checkoutStatus"] = 1;
													echo "<script> alert('There is an issue processing your order!');</script>";
												}		
														
										pg_close($db); 
										//Checkout Transaction End
									}
								}
								else
								{
									echo "
										<form id='checkoutTrigger' name='checkoutTriggerForm' method='POST' onsubmit='return validate();'>
										<input type='submit' value='Checkout' name='checkoutTrigger'/>
										</form>";
								}
								?>
                                <br/><br/>

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
<?php
    session_start();

if( isset( $_SESSION[ "username"] ) ) {
    $username = $_SESSION[ "username"];
    
    $link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
    $query = "SELECT distinct c.hasAskedForReviewRating, c.customerId FROM completes c
    WHERE c.customerId = (SELECT cc.customerId FROM customers cc WHERE cc.userId = (SELECT userId FROM users WHERE username = '$username')) AND c.hasAskedForReviewRating = false;";
    $res = pg_query($link, $query);
    
    while ($row = pg_fetch_row($res)) {
        if (is_bool($row[0]) == false)
        {
            echo "this person has never been asked for reviewRating! need pop up.   ".$row[0]."   ".$row[1];
            
            echo "<script>
                    function closeForm() {
                      document.getElementById('myForm').style.display = 'none';
                    }
                </script>";
                
            echo "<div class='form-popup' id='myForm'>
                      <form class='form-container' method='POST' id='reviewForOrder'>
                      
                        <h3>Review for <b>Order</b></h3>
                        <label for='reviewOrderDescription'><b>Description</b></label>
                        <textarea placeholder='Enter Description' name='reviewOrderDescription' required style='height: 150px'></textarea>

                        <h3>Ratings for <b>Delivery</b></h3>
                        <fieldset class='rating'>
                            <legend>Please rate:</legend>
                            <input type='radio' id='star5' name='rating' value='5' /><label for='star5' title='Rocks!'>5 stars</label>
                            <input type='radio' id='star4' name='rating' value='4' /><label for='star4' title='Pretty good'>4 stars</label>
                            <input type='radio' id='star3' name='rating' value='3' /><label for='star3' title='Meh'>3 stars</label>
                            <input type='radio' id='star2' name='rating' value='2' /><label for='star2' title='Kinda bad'>2 stars</label>
                            <input type='radio' id='star1' name='rating' value='1' /><label for='star1' title='Sucks big time'>1 star</label>
                        </fieldset>

                        <br/><br/><br/><br/><br/><br/>
                        
                        <button type='submitReview' class='btn'>Submit Review</button>
                        <button type='button' class='btn cancel' onclick='closeForm()'>Close</button>
                      </form>
                </div>";
        }
        else
            echo "<br/>this person has already been asked for reviewRating! no need pop up.   ".$row[0]."   ".$row[1];
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
  display: none;
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

    </head>

    <body onload="openForm();">

    <script>
        function openForm() {
          document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
          document.getElementById("myForm").style.display = "none";
        }
    </script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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

</head>
<body>


        <div class="form-popup" id="myForm">
          <form class="form-container" method="POST" id="reviewForOrder" style="display: none;">
          
            <h3>Review for <b>Order</b></h3>
            <label for="reviewOrderDescription"><b>Description</b></label>
            <textarea placeholder="Enter Description" name="reviewOrderDescription" required style="height: 150px"></textarea>

            <h3>Ratings for <b>Delivery</b></h3>
            <fieldset class="rating">
                <legend>Please rate:</legend>
                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
                <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
            </fieldset>

            <br/><br/><br/><br/><br/><br/>
            
            <button type="submitReview" class="btn">Submit Review</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
          </form>
        </div>

    </body>

    </html>
<?php

session_start();

if(isset($_POST['btnLogin'])){
    
    $username=($_POST["username"]);
    $password=($_POST["password"]);
    $link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
    $query = "SELECT u.username, u.password, c.customerId FROM customers c JOIN users u on c.userId = u.userId WHERE u.username = '$username' and u.password = '$password';";
    $res = pg_query($link, $query);
    
    while ($row = pg_fetch_row($res)) {
        if ($row[0] == $username && $row[1] == $password) {
            $_SESSION["username"] = $username;
			$_SESSION['loggedInCustomerId'] = $row[2];
            header('Location: /cs2102grp48fds/CustomerUI/webpages/index.php');
        }
        
    }
    echo "Sorry, you have entered incorrect username/password.";     
}

?> 

<!DOCTYPE html> 

<html> 

<head> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 

<style> 
body {
    font-family: Arial, Helvetica, sans-serif;
}


/* Full-width input fields */

input[type=text],
input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}


/* Set a style for all buttons */

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}


/* Extra styles for the cancel button */

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}


/* Center the image and position the close button */

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}


/* The Modal (background) */

.modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
    padding-top: 60px;
}


/* Modal Content/Box */

.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto;
    /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%;
    /* Could be more or less, depending on screen size */
}


/* The Close Button (x) */

.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}


/* Add Zoom Animation */

.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {
        -webkit-transform: scale(0)
    }
    to {
        -webkit-transform: scale(1)
    }
}

@keyframes animatezoom {
    from {
        transform: scale(0)
    }
    to {
        transform: scale(1)
    }
}


/* Change styles for span and cancel button on extra small screens */

@media screen and (max-width: 300px) {
    span.psw {
        display: block;
        float: none;
    }
    .cancelbtn {
        width: 100%;
    }
}

</style> 

<style> 
#imageAvatar {
    width: 20%;
}

form {
    width: 50%;
    /*text-align: left;*/
    /*display: inline-block;*/
}

</style> 

</head> 

<body> 
    <form class="modal-content animate" method="post" style="width: 50%;"> 
        <div class="imgcontainer"> 
            <img src="../assets/images/img_avatar2.png" alt="Avatar" class="avatar" id="imageAvatar"> 
        </div> 
        
        <h1>Customer Login</h1> 
        
        <div class="container"> 
        
            <label for="username"><b>Username</b></label> 
            <input type="text" placeholder="Enter Username" name="username" required> 
            
            <label for="password"><b>Password</b></label> 
            <input type="password" placeholder="Enter Password" name="password" required> 
            
            <button type="submit" name="btnLogin">Login</button> 
            
        </div> 
        
    </form> 
</body> 

</html>
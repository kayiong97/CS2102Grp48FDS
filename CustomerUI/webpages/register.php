<?php

// Turn off all error reporting
error_reporting(0);

session_start();

if(isset($_POST['btnRegister'])){
    
    $name=($_POST["name"]);
    $contactNo=($_POST["contactNo"]);
    $username=($_POST["username"]);
    $password=($_POST["password"]);
    
    $link = pg_connect("host=localhost port=5432 dbname=cs2102fds48 user=postgres password=postgres");
    $query = "SELECT u.username FROM customers c JOIN users u on c.customerId = u.userId WHERE u.username = '$username';";
    $res = pg_query($link, $query);
    
     while ($row = pg_fetch_row($res)) {
        echo "<script>alert('Sorry, this username has been taken. Please try other username.');</script>";
        break;
    }   
    
    $query2 = "INSERT INTO USERS(name, username, password, contactNo, role) 
    values('$name', '$username', '$password', '$contactNo', 'Customer'); 
    
    INSERT INTO CUSTOMERS (accumulatedPoints, userId) 
    values(0, (SELECT userId FROM USERS WHERE username = '$username'));";
    
    $res2 = pg_query($link, $query2);
    if ($res2) {
        echo "<script>alert('Account has been created successfully. You may login now.');</script>";
    }
    else
    {
        echo "<script>alert('Sorry, this username has been taken. Please try other username.');</script>";
    }
}

?> 

<!DOCTYPE html> 

<html> 

<head> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 

<style> 

body {
    font-size: 14px;
    color: #333333;
}

h4 {
    font-size: 18px;
}

h4, h5, h6 {
    margin-top: 10px;
    margin-bottom: 10px;
}

h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-weight: 500;
    line-height: 1.1;
}


/* Table */
td {
    width: 80% !important;
    display: inline-block !important;
    border-top: none !important;
    padding: 5%;
    margin-bottom: -5%;
}

tr {
    display: inline;
}

#table {
    width: 700px;
    height: 575px;
    margin-right: auto;
    margin-left: auto;
    padding: 17px 25px 17px 25px;
    background-color: #ffffff;
    border-radius: 10px;
    -moz-box-shadow: 0 0 15px 1px #bbb;
    -webkit-box-shadow: 0 0 15px 1px #bbb;
    box-shadow: 0 0 15px 1px #bbb;
    font-family: Helvetica;
    text-align: center;
}

.toolbox {
    float: left;
}

/* Numbers for "Header" 1, 2, 3, 4*/
#numberCircle, #numberCircle2 {
    display: inline-block;
    line-height: 0px;
    border-radius: 50%;
    border: 2px solid;
    font-size: 25px;
    background-color: #4ea9da;
    border-color: #4ea9da;
    color: white;
    float: left;
    margin-right: 2%;
}

    #numberCircle span, #numberCircle2 span {
        display: inline-block;
        padding-top: 50%;
        padding-bottom: 50%;
        margin-left: 8px;
        margin-right: 8px;
        background-color: #4ea9da;
        border-color: #4ea9da;
        color: white;
        float: left;
    }


</style> 

</head> 

<body> 
    <form class="modal-content animate" method="post"> 
               
        <h2 style="text-align: center;">Already have an account? Click <a href="./login.php">here</a> to login. </h2>
        
        <div class="container"> 
        
            <div>
                <table id="table" style="border-collapse: initial !important; border-spacing: 0;">
                    <tr style="height: 5%;">
                        <td style="background-color: #146882; color: #b1e3ed; font-family: 'Palatino Linotype'; font-size: 25px;">Registration - <b>PORT's Food Delivery Service. </b>
                        </td>
                    </tr>

                    <tr>
                        <td style="margin-bottom: -10%;">
                        </td>
                    </tr>
                    <tr>
                        <td style="margin-top: 5%;">
                            <span id="numberCircle">
                                <span style="background-color: #4ea9da; color: white">1</span>
                            </span>
                            <h4 style="float: left; color: #626b6e; font-family: Cambria;">Enter your credentials.</h4>
                        </td>
                    </tr>

                    <tr>
                        <td style='margin-top: -2%;'>
                            <div style="padding: 10%; padding-top: 5% !important; background-color: #f4f6f5;">
                                <label for="name" class="toolbox"><b>Name</b></label> 
                                <input type="text" placeholder="Enter name" name="name" required class="toolbox"> 
                                <br/> <br/>
                                <label for="contactNo" class="toolbox"><b>Contact Number</b></label> 
                                <input type="text" placeholder="Enter contact number" name="contactNo" required class="toolbox"> 
                            </div>
                        </td>
                        <!--
                        <td style='margin-top: -5%;'>
                            <div style="padding: 10%; padding-top: 5% !important; background-color: #f4f6f5;">
                            
                            </div>
                        </td>
                        -->
                    </tr>

                    <tr>
                        <td>
                            <span id="numberCircle2">
                                <span style="background-color: #4ea9da; color: white;">2</span>
                            </span>
                            <h4 style="float: left; color: #626b6e; font-family: Cambria;">Enter your in-app login details.</h4>
                        </td>
                    </tr>

                    <tr>
                        <td style='margin-top: -2%;'>
                            <div style="padding: 10%; padding-top: 5% !important; background-color: #f4f6f5;">
                                
                                <label for="username" class="toolbox"><b>Username</b></label> 
                                <input type="text" placeholder="Enter Username" name="username" required class="toolbox"> 
                                <br/> <br/>
                                <label for="password" class="toolbox"><b>Password</b></label> 
                                <input type="password" placeholder="Enter Password" name="password" required class="toolbox"> 
            
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" name="btnRegister" value="Register"/>
                        </td>
                    </tr>

                </table>
            </div>
            
        </div> 
        
    </form> 
</body> 

</html>
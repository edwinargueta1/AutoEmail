<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <!-- CSS File -->
    <link rel="stylesheet" type="text/css" href="lab4.css">
</head>

<body>
    <div class="backgound"></div>
        <img id='bgImage' src= 'wavybackground.avif'>
        
    </div>
    <div class="navBar">
        <div id="logoContainer">
            <img src="maillogo.png" alt="mail image" id="mailIcon">
            <h1>Auto Email</h1>
        </div>
        <?php
        //Will only run if the  user is not logged in
            if(isset($_SESSION["username"])){ //Logout rendered
                echo '<a href="include/logout-include.php"><input class="navButton" id="navLogOut" type="button" value="Log Out"></a>';
            }else{//Login or sign up rendered
                echo '<a href="login.php"><input class="navButton" id="navLoginButton" type="button" value="Log In"></a>';
                echo '<a href="signup.php"><input class="navButton" id="navSignButton" type="button" value="Sign up"></a>';
            }
        ?>
    </div>
    
    <div class="pageContainer" id="pageContainer">
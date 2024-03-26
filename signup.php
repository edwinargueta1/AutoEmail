<?php
include_once 'include/header.php'
?>

<div class="signUpPage">
    <h3>Sign Up</h3>
    <br>
    <br>
    <form action="include/signup-include.php" method="post">
        <input type="text" class="signLogText" id="signUser" name="signUser" placeholder="Username">
        <br>
        <input type="password" class="signLogText" id="signPassword" name="signPassword" placeholder="Password">
        <br>
        <input type="password" class="signLogText" id="signPasswordCheck" name="signPasswordCheck" placeholder="Reenter Password">
        <br>
        <input type="submit" name="insertSignUp" class="submitButton" id="signUpUser" value="Sign Up">
    </form>

    <?php
    //Error Handling Messages
    if (isset($_GET["error"])) {
        if ($_GET['error'] == 'emptyValue') {
            echo "<br><p>Make sure everything is filled out.</p>";
        } else if ($_GET['error'] == 'usernameInvalid') {
            echo "<br><p>Invalid Username.</p>";
        } else if ($_GET['error'] == 'passwordsDoNotMatch') {
            echo "<br><p>Passwords do not match.</p>";
        } else if ($_GET['error'] == 'invalidPassword') {
            echo "<br><p>Password must have at least: 1 number, 1 letter, 1 symbol, and 8 in length.</p>";
        } else if ($_GET['error'] == 'usernameTaken') {
            echo "<br><p>Username is taken. Pick another.</p>";
        } else if ($_GET['error'] == 'invalidEntry') {
            echo "<br><p>Invalid entry to page.</p>";
        } else if ($_GET['error'] == 'stmtFailed') {
            echo "<br><p>Connection Failed</p>";
        } else if ($_GET['error'] == 'none') {
            echo "<br><p>You signed up! Congrats!</p>";
        }
    }
    ?>
</div>

<?php
include_once 'include/footer.php'
?>
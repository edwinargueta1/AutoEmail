<?php
include_once 'include/header.php'
?>

<div class="loginPage">
    <h3>Log In</h3>
    <br>
    <br>
    <form action="include/login-include.php" method="post">
        <input type="text" class="signLogText" id="loginUser" name="loginUser" placeholder="Username">
        <br>
        <input type="password" class="signLogText" id="loginPassword" name="loginPassword" placeholder="Password">
        <br>
        <input type="submit" name="insertLog" class="submitButton" id="submitLoginButton" value="Log In">
    </form>
    <?php
    //Error Handling Messages
    if (isset($_GET["error"])) {
        if ($_GET['error'] == 'emptyValue') {
            echo "<br><p>Make sure everything is filled out.</p>";
        } else if ($_GET['error'] == 'usernameInvalid') {
            echo "<br><p>Invalid Username.</p>";
        } else if ($_GET['error'] == 'invalidPassword') {
            echo "<br><p>Invalid Password.</p>";
        } else if ($_GET['error'] == 'invalidEntry') {
            echo "<br><p>Invalid entry to page.</p>";
        } else if ($_GET['error'] == 'wrongLogin') {
            echo "<br><p>Wrong Login.</p>";
        }
    }
    ?>
</div>

<?php
include_once 'include/footer.php'
?>
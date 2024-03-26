<?php
include_once 'include/header.php';
?>
<div class="sideBar">

</div>
<div class="emailerPage" id="emailerPage">
    <div id="Welcome">
        <h2>Welcome! Login or Sign up to Access!</h2>
        <?php
        //Error Handling Messages
        if (isset($_GET["error"])) {
            if ($_GET['error'] == 'none') {
                echo "<br><p>You signed up! Congrats!</p>";
            }
        }
        ?>
    </div>

</div>
<?php
include_once 'include/footer.php';
?>
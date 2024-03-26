<?php
include_once 'include/header.php'
?>

<div name="emailSenderPage" id="emailSenderPage">
    <!-- Form to send to the mailer script  -->
    <form action="include/autoEmailer-include.php" method="post">
        <div class="header">
            <!-- Outputs the user's name.-->
            <h2><?php echo "Welcome, " . $_SESSION['username'] . "! ";  ?></h2>
        </div>
        <label for="inEmail">Send to:</label>
        <br>
        <input type="text" id="inEmail" name="emailSendTo" class="inputField" placeholder="example@mail.com">
        <br>
        <label for="inDate">Send Date: </label>
        <br>
        <input type="date" id="inDate" name="emailSendDate" class="inputField">
        <br>
        <label for="inTime">Time: </label>
        <br>
        <div class="time">
            <select id="inTime" name="emailSendTime">
                <option value="12:00">12:00</option>
                <option value="12:30">12:30</option>
                <option value="1:00">1:00</option>
                <option value="1:30">1:30</option>
                <option value="2:00">2:00</option>
                <option value="2:30">2:30</option>
                <option value="3:00">3:00</option>
                <option value="3:30">3:30</option>
                <option value="4:00">4:00</option>
                <option value="4:30">4:30</option>
                <option value="5:00">5:00</option>
                <option value="5:30">5:30</option>
                <option value="6:00">6:00</option>
                <option value="6:30">6:30</option>
                <option value="7:00">7:00</option>
                <option value="7:30">7:30</option>
                <option value="8:00">8:00</option>
                <option value="8:30">8:30</option>
                <option value="9:00">9:00</option>
                <option value="9:30">9:30</option>
                <option value="10:00">10:00</option>
                <option value="10:30">10:30</option>
                <option value="11:00">11:00</option>
                <option value="11:30">11:30</option>

            </select>
            <select id="inMidHour" name="emailSendMeridian">
                <option value="AM">AM</option>
                <option value="PM">PM</option>
            </select>
        </div>
        <br>
        <label for="emailSubject">Subject: </label>
        <br>
        <input type="text" id="emailSubject" name="emailSendSubject" class="inputField">
        <br>
        <label for="inMessage">Message: </label>
        <br>
        <textarea id="inMessage" name="emailSendMessage" rows="30" cols="50" placeholder="Enter Message Here..."></textarea>
        <br>
        <input type="submit" id="submitEmailButton" name="submitEmailButton" class="submitButton">
        <br>
        <?php
        //Error Handling Messages
        if (isset($_GET["error"])) {
            if ($_GET['error'] == 'emptyValue') {
                echo "<br><p>Make sure everything is filled out.</p>";
            } else if ($_GET['error'] == 'emailInvalid') {
                echo "<br><p>Invalid email.</p>";
            } else if ($_GET['error'] == 'messageStored') {
                echo "<br><p>Email was stored in Database.</p>";
            }
        }
        ?>
    </form>

</div>
</div>

<?php
include_once 'include/footer.php'
?>
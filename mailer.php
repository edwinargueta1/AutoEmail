<?php
//File searches the database based on the regulation of the cron job.
//Gather all the emails that have a past 'send to' date and sends them to the coresponding recipients.

//including database connection
include 'include/db-include.php';
include 'PHPMailer/sendEmail.php';

//PHPMailer Functions
function dateSearch($connect){
    //Searching DB for entries where date time is less than current time and not sent.
    $sqlSearch = "SELECT * FROM message WHERE dateTime <= ? AND sent = 0;";
    $stmt = mysqli_stmt_init($connect);
    $curTime = date("Y/m/d H:i:s");

    //Making sure the SQL Statement is good if not sending user back to message page.
    if(!mysqli_stmt_prepare($stmt, $sqlSearch)){
        echo "Failed stmt prep.";
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $curTime);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)){
        $recipientEmail = $row['email'];
        $subject = $row['subject'];
        $message = $row['message'];
        $user = findUserFrom($connect, $row['userid']);
        sendEmail($recipientEmail, $subject, $message, $user);
    }
    // if($entryRows = mysqli_fetch_assoc($result)){
    //     return $entryRows;
    // }else {
    //     return false;
    // }
    mysqli_stmt_close($stmt);
    updateSent($connect);
}
function updateSent($connect){
    //Searching DB for entries where date time is less than current time and not sent.
    $sqlSearch = "UPDATE message SET sent = 1 WHERE dateTime <= ? AND sent = 0;";
    $stmt = mysqli_stmt_init($connect);
    $curTime = date("Y/m/d H:i:s");

    //Making sure the SQL Statement is good if not sending user back to message page.
    if(!mysqli_stmt_prepare($stmt, $sqlSearch)){
        header("location: ../autoEmailer.php?error=stmtFailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $curTime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function findUserFrom($connect, $userNumber){
    $sql = "SELECT username FROM user WHERE userid = ?;";
    $stmt = mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Failed stmt prep.";
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $userNumber);
    mysqli_stmt_execute($stmt);
    //returning the name 
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row['username'];
    }else{
        return false;
    }
    mysqli_stmt_close($stmt);
}
//Run Script
dateSearch($connect);
//PHPMailer Function End
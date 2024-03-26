<?php
//Script Checks wether all the inputs are good and then sends them into the database
if(isset($_POST['submitEmailButton'])){

    //Getting Variables for HTML form fom autoEmailer
    $recipientEmail = $_POST['emailSendTo'];
    $date = $_POST['emailSendDate'];
    $time = $_POST['emailSendTime'];
    $meridian = $_POST['emailSendMeridian'];
    $subject = $_POST['emailSendSubject'];
    $message = $_POST['emailSendMessage'];

    //Calling function file and database connection
    require_once 'db-include.php';
    require_once 'functionBank.php';

    //    //debug
    //    echo $date;
    //    echo $time;
    //    echo $meridian;
    //    echo "\n";
    //    echo dateTimeFormat($date, $time, $meridian);
    //    exit();
    //    //debugEnd

    //Error Checking
    //Make sure email and date isn't empty
    if(emptyValueEmail($recipientEmail, $date) !== false){
        header("location: ../autoEmailer.php?error=emptyValue");
        exit();
    }
    //Valid Email Format
    if(validEmail($recipientEmail) !== false){
        header("location: ../autoEmailer.php?error=emailInValid");
        exit();
    }

    //Inserting the message info to the database
    insertEmail($connect, $recipientEmail, $date, $time, $meridian, $subject, $message);
    
} else{
    //If invalid entry send back to mail page
    header("location: ../autoEmailer.php?error=invalidEntry");
    exit();
}
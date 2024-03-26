<?php
session_start();
include 'PHPMailer/mailer.php';
//PHP file contains all the processing functions for all other PHP files.
//Functions for signing up a user to the website.
function emptyValueSignUp($username, $password, $passwordCheck){
    if(empty($username) || empty($password) || empty($passwordCheck)){
        return true;
    }else{
        return  false;
    }
}
//only alphanumeric character are allowed
function validUsername($username){
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        return  true;
    }else{
        return false;
    }
}
//Passwords must match
function matchingPassword($password, $passwordCheck){
    if($password !== $passwordCheck){
        return  true;
    }else{
        return false;
    }
}
//Password must contain a number, letter, special character, and be 8 in length
function validPassword($password){

    $containsLetter  = preg_match('/[a-zA-Z]/',    $password);
    $containsDigit   = preg_match('/\d/',          $password);
    $containsSpecial = preg_match('/[@_!#$%^&*()<>?\|}{~:]/', $password);

    if ($containsLetter && $containsDigit && $containsSpecial && strlen($password) >= 8) {
        return false;
    } else {
        return true;
    }
}

function userAlreadyExists($connect, $username){
    $sql = "SELECT * FROM user WHERE username = ?;";
    $stmt = mysqli_stmt_init($connect);

    //Making sure the SQL Statement is good
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        return false;
    }
    mysqli_stmt_close($stmt);
}

//User Creation into database
function createUser($connect, $username, $password){
    //Prepared Statements
    $sql = "INSERT INTO user (username, password, salt) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($connect);

    //Making sure the SQL Statement is good
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtFailed");
        exit();
    }

    //Creating Salt
    $salt = bin2hex(random_bytes(5));

    //Hashing password with salt 
    $hashedPassword = password_hash($salt.$password, PASSWORD_DEFAULT);
    
    

    mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPassword, $salt);
    mysqli_stmt_execute($stmt);

    // //debug
    // var_dump($salt);
    // echo "----";
    // $userExist = userAlreadyExists($connect, $username);
    // echo password_verify($salt.$password, $hashedPassword);
    // echo "----";
    // $saltCheck = $userExist['salt'];
    // var_dump($saltCheck);
    // echo "-----";
    // echo password_verify($saltCheck.$password, $hashedPassword);
    // //debug end

    mysqli_stmt_close($stmt);
    
    header("location: ../index.php?error=none");
    exit();
}
//Signing up Functions End

//Login functions
function emptyValueLogin($username, $password){
    if(empty($username) || empty($password)){
        return  true;
    }else{
        return false;
    }
}

function loginUser($connect, $username, $password){

    $userExist = userAlreadyExists($connect, $username);

    //Error Handling
    if ($userExist === false) {
        header("location: ../login.php?error=wrongLogin");
        exit();
    }

    //Getting hashed password from database
    $hashedPassword = $userExist["password"];
    $salt = $userExist['salt'];
    $saltedPassword = $salt.$password;

    //Comparing with the salt.
    $passwordChecked = password_verify($saltedPassword, $hashedPassword);

    //If the input and hashed dont match
    if ($passwordChecked === false) {
        header("location: ../login.php?error=wrongLoginP");
        exit();
    } else if ($passwordChecked === true) {
        session_start();
        $_SESSION["username"] = $userExist["username"];
        $_SESSION["userDBid"] = $userExist["userid"];
        header("location: ../autoEmailer.php");
        exit();
    }
}


//Messge Functions
//Checks wether there is an empty value
function emptyValueEmail($recipientEmail, $date){
    if(empty($recipientEmail) || empty($date)){
        return true;
    }else{
        return false;
    }
}

//Check for a valid email format
function validEmail($recipientEmail){
    if(!filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}

function insertEmail($connect, $recipientEmail, $date, $time, $meridian, $subject, $message){
    //Combining time and meridian
    $dateTime = dateTimeFormat($date, $time, $meridian);
    
    //Preparing SQL Statement
    $sql = "INSERT INTO message (userid, email, dateTime, subject, message) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($connect);

    //Making sure the SQL Statement is good if not sending user back to message page.
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../autoEmailer.php?error=stmtFailed");
        exit();
    }
    // //Debug
    // echo $_SESSION['userDBid'];
    // exit();
    // //Debug End
    mysqli_stmt_bind_param($stmt, "sssss", $_SESSION['userDBid'], $recipientEmail, $dateTime, $subject, $message);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../autoEmailer.php?error=messageStored");
    exit();
}
//Combines inputs to get a formatted date.
function dateTimeFormat($date, $time, $meridian){
    $dateString = strtotime($date." ".$time." ".$meridian);
    return date("Y-m-d H:i:s", $dateString);
}
//Message Functions End

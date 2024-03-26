<?php
// login-include.php checks the username and password and makes sure it fits the
// constraints and if all constraints are met then the user gets logged in.
if(isset($_POST['insertLog'])){
    //Getting Variables for HTML form
    $username = $_POST['loginUser'];
    $password = $_POST['loginPassword'];

    //Calling function file and database connection
    require_once 'db-include.php';
    require_once 'functionBank.php';

    //Checking inputs
    //Make sure no value is empty
    if(emptyValueLogin($username, $password) !== false){
        header("location: ../login.php?error=emptyValue");
        exit();
    }

    //check whether username is valid for entry
    if(validUsername($username) !== false){
        header("location: ../login.php?error=usernameInvalid");
        exit();
    }

    //Check whether password is valid for entry
    if(validPassword($password) !== false){
        header("location: ../login.php?error=invalidPassword");
        exit();
    }

    //Attempt to log in the user
    loginUser($connect, $username, $password);
    
} else{
    //If invalid entry send back to index page
    header("location: ../lab4.php?error=invalidEntry");
    exit();
}
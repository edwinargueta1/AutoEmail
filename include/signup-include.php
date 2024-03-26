<?php

//Establishing a connection to database.
if(isset($_POST['insertSignUp'])){

    $username = $_POST['signUser'];
    $password = $_POST['signPassword'];
    $passwordCheck = $_POST['signPasswordCheck'];

    //Calling php files. For linking database and function calling.
    require_once 'db-include.php';
    require_once 'functionBank.php';


    //Constraints for Input Form
    //If there is a value that is left empty, dont run.
    if(emptyValueSignUp($username, $password, $passwordCheck) !== false){
        header("location: ../signup.php?error=emptyValue");
        exit();
    }
    //Checks if the username is valid
    if(validUsername($username) !== false){
        header("location: ../signup.php?error=usernameInvalid");
        exit();
    }
    //If passwords don't match, don't run.
    if(matchingPassword($password, $passwordCheck) !== false){
        header("location: ../signup.php?error=passwordsDoNotMatch");
        exit();
    }
    //Checking if valid password
    if(validPassword($password) !== false){
        header("location: ../signup.php?error=invalidPassword");
        exit();
    }
    //Checking if user already exists in database
    if(userAlreadyExists($connect, $username) !== false){
        header("location: ../signup.php?error=usernameTaken");
        exit();
    }

    createUser($connect, $username, $password);

}else{
    header("location: ../lab4.php?error=invalidEntry");
    exit();
}

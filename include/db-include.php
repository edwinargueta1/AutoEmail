<?php
//Stores the connection to the database.
$serverName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "lab4";


//Connection
$connect = mysqli_connect($serverName, $dbUser, $dbPassword, $dbName);

//Checking Connection
if(!$connect){
    die("Connection Failed. ". mysqli_connect_error());
}
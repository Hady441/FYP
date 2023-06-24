<?php

$dbName = "fyp";
$dbHost = "localhost";
$dbPass = "";
$db = "fyp";

$secretKey = "123456789";

function dbConnect(){

    global $dbName;
    global $secretKey;

    $link = mysqli_connect("localhost", "root", "", "fyp")
     or die("Connection failed. %s\n" . $link -> error);
                                                                                       
     return $link; 
}

function safe($var){
    $var = addslashes(trim($var));

    return $var;
}

function fail($errMsg){
    print $errMsg;

    exit;
}

function CloseConnection($link){
    $link -> close();
}

?>
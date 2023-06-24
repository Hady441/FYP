<?php

include("Common.php");

$link = dbConnect();

$dbcon = mysqli_connect("localhost", "root", "", "fyp");

$result = mysqli_query($dbcon, 'SELECT score FROM LoginSystemDB');

if(!$result){
    die('Could not do the query' . mysqli_error($dbcon));
}

// We have did a safe function before that addSlashes.
$hash = safe($_POST['hash']);

$name = stripcslashes($name);
$name = mysqli_real_escape_string($link, $_POST['name']);


$score = stripcslashes($score);
$score = mysqli_real_escape_string($link, $_POST['score']);

$IP = stripcslashes($IP);
$IP = mysqli_real_escape_string($link, $_POST['IP']);

// $typ is the type.
$typ = mysqli_real_escape_string($link, $_POST['typ']);

$real_hash = md5($name . $secretKey);

$sql = mysqli_query($dbcon,"UPDATE LoginSystemDB SET score='$score' WHERE name='$name'");

if($real_hash == $hash){

    if(($typ == "1") && (mysqli_query($dbcon, $sql))){

        $numrows = mysqli_num_rows($sql);

        echo "success";

        echo $score;
    }

    if($typ == "2"){

        $check = sprintf("UPDATE LoginSystemDB SET IP='".mysqli_real_escape_string($dbcon, $IP)."' WHERE name='$name'") 
        or die(mysqli_error($dbcon));

        echo "successipdb";
    }
}

mysqli_close($link);
?>
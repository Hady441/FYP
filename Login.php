<?php

include("Common.php");

$name = $_POST['name'];
$pass = $_POST['password'];
$getIP = $_POST['IP'];

$link = dbConnect();

//The stripslashes() function is a PHP function used to remove backslashes \ from a string
// $name = stripslashes($name);
// $pass = stripslashes($pass);
// $getIP = stripslashes($getIP);

$getIP = mysqli_real_escape_string($link, $getIP);
$name = mysqli_real_escape_string($link, $name);
$pass = mysqli_real_escape_string($link, $pass);

//The value of `$name` is enclosed within backticks (` `).  Backticks are used in MySQL to escape 
//reserved keywords or column names, but they are not necessary when dealing with string values.

//For example, let's say you have a table named order in your database. Since order is a reserved keyword in SQL,
// using it directly in a query could cause an error. However, by enclosing it in backticks like this: order, you inform the database
// that it should treat it as the name of the table rather than as a keyword.

$check = mysqli_query($link, "SELECT * FROM LoginSystemDB WHERE `name` = '$name'") or die(mysqli_error($link));


$numrows = mysqli_num_rows($check);

if($numrows == 0){
    die("User <color=#FF4500> ". $name . "</color> does not exist \n"); 
} else {

    $pass = md5($pass);

    while($row = mysqli_fetch_assoc($check)){
        if($pass == $row['password']){
            $userid = $row['id'];

            echo "Login Done";
            echo "|";
            echo $row['name'];
            echo "|";
            echo $row['email'];
            echo "|";
            echo $row['score'];
            echo "|";
            echo $row['status'];
            echo "|";

            if($getIP == "1"){
                echo $row['IP'];
                echo "|";
            }

        } else {
            die("Password is incorrect \n");
        }
   }
}

mysqli_close($link);

?>
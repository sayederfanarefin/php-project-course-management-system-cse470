<?php

$servername = "ap-cdbr-azure-east-c.cloudapp.net";
$username = "b7ee0a1471a7bb";
$password = "e070d576a96f3e6";
$db = "yo";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

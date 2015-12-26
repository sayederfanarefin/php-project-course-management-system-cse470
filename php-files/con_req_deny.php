<?php
include 'db_connection.php';
$booking_id = $_POST['booking_id'];
$message = $_POST['message'];
$teacher_email = $_POST['teacher_email'];





$result = mysqli_query($conn, $query);
if($result){
    mysqli_query($conn, $query2);
    mysqli_query($conn, $query3);
    
    mysqli_query($conn, $query5);
   
   echo "0";
}else{
    echo "1";
}

?>
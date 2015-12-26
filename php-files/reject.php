<?php
include 'db_connection.php';
$emailorid = $_POST['emailorid'];
$user_type = $_POST['user_type'];

if( $user_type == "Teacher"){
    $query = "UPDATE `teacher_table` SET `Verified`=2 WHERE `Email`='".$emailorid."'";


}else if ($user_type == "Student") {
   $query = "UPDATE student_table SET Verified=2 WHERE Id='".$emailorid."'";
}else{}



$result = mysqli_query($conn, $query);
if($result){
   echo "0";
}else{
    echo "1";
}
?>
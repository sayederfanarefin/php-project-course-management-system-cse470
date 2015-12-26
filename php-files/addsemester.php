<?php

include 'db_connection.php';

$Semester_name= $_POST['Semester'];
$Semester_date_start= $_POST['Semester_date_start'];
$Semester_date_stop= $_POST['Semester_date_stop'];

$query = 'INSERT INTO semesters 
                    VALUES ("'.$Semester_name.'","'.$Semester_date_start.'","'.$Semester_date_stop.'")';//heya
$result = mysqli_query($conn, $query);
if($result){
    
   echo "0";
}else{
    echo "1";
}

?>

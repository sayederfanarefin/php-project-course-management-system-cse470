<?php
include 'db_connection.php';


$Dept = $_POST['Dept'];


 //current semester
       date_default_timezone_set("Asia/Dhaka");
     $today_date =  date("Y-m-d");
     $semester ;
     $query_current_semester = "SELECT Semester_name FROM semesters WHERE Semester_date_start <= '".$today_date."' AND Semester_date_stop >= '".$today_date."'";
     $result_current_semester = mysqli_query($conn, $query_current_semester);
     $row = $result_current_semester->fetch_assoc();
      $semester = $row["Semester_name"];
      //end of detecting current semester



$query = "SELECT course_Id FROM dept_crs WHERE Semester='".$semester."' AND Dept='".$Dept."'";//erfan

$result = mysqli_query($conn, $query);


$bullshit = array();
$i = 0;
while($row = $result->fetch_assoc()){
    
    $bullshit[$i] = $row["course_Id"];
    $i++;
}

$row_array = json_encode($bullshit);

echo $row_array ;

?>

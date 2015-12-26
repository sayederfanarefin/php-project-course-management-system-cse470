<?php

include 'db_connection.php';
$course_Id = $_POST['course_Id'];
$Dept = $_POST['Dept'];
$crs_title = $_POST['crs_title'];
$semester_show_list_2 = $_POST['semester_show_list_2'];


$query = 'INSERT INTO dept_crs VALUES ("'.$course_Id.'","'.$Dept.'","'.$crs_title.'","'.$semester_show_list_2.'")';//erfan



$result = mysqli_query($conn, $query);
if($result){
   echo "0";
}else{
    echo "1";
}

?>

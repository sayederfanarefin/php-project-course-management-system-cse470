<?php
    
//existing_courses_show_bla: $('#existing_courses_show_bla


include 'db_connection.php';


 //current semester
       date_default_timezone_set("Asia/Dhaka");
     $today_date =  date("Y-m-d");
     $current_semester ;
     $query_current_semester = "SELECT Semester_name FROM semesters WHERE Semester_date_start <= '".$today_date."' AND Semester_date_stop >= '".$today_date."'";
     $result_current_semester = mysqli_query($conn, $query_current_semester);
     $row = $result_current_semester->fetch_assoc();
      $current_semester = $row["Semester_name"];
      //end of detecting current semester



$existing_courses_show_bla = $_POST["existing_courses_show_bla"];
$section = $_POST["section"];
$add_teacher_email = $_POST["add_teacher_email"];
$secret_code = $_POST["secret_code"];


$query = "INSERT INTO teacher_courses VALUE('".$add_teacher_email."','".$existing_courses_show_bla."','".$section."','".$secret_code."','".$current_semester."')";
$result = mysqli_query($conn, $query);



if($result){
    echo "0";
}else{
    echo "1";
}

?>


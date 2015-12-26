<?php
    

 session_start();
    $teacher_email;
    
    include 'db_connection.php';

    $errorpafelocation = 'Location: /error_page.php?err_msg=';
    if (isset($_SESSION['user']) && $_SESSION['user_type'] == "Teacher") {
        // logged in
        $teacher_email = $_SESSION['user'];
      
    } else {
        // not logged in
        //header ('Location : /index.php');
        header($errorpafelocation."You are not siggned in. Please sign in/sign up.&err_bttn=Sign up / Sign in&err_bttn_link=/index.php" );
     }


$course_id = $_POST["course_id"];


   //current semester
       date_default_timezone_set("Asia/Dhaka");
     $today_date =  date("Y-m-d");
     $current_semester ;
     $query_current_semester = "SELECT Semester_name FROM semesters WHERE Semester_date_start <= '".$today_date."' AND Semester_date_stop >= '".$today_date."'";
     $result_current_semester = mysqli_query($conn, $query_current_semester);
     $row = $result_current_semester->fetch_assoc();
      $current_semester = $row["Semester_name"];
      //end of detecting current semester

      $query= "SELECT Section FROM teacher_courses WHERE Course_id='".$course_id."' AND semester = '".$current_semester."' AND Email='".$teacher_email."'";
$result = mysqli_query($conn, $query);


$bullshit = array();
$i = 0;
while($row = $result->fetch_assoc()){
    
    $bullshit[$i] = $row["Section"];
    $i++;
}

$row_array = json_encode($bullshit);

echo $row_array ;

?>

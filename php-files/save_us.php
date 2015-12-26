<?php
    
echo 'sf';
    include 'db_connection.php';
    $teacher_email = $_POST["teacher_email"];
    $selected_crs_id = $POST["selectedcourse"];
    $crs_sec = $_POST["section"];
    
    $type = $POST["type"];
       
    echo $teacher_email;
    echo $selected_crs_id;
    echo $crs_sec;
    echo $type;
$query = "SELECT Id FROM student_courses WHERE course_ID='".$selected_crs_id."' AND section='".$crs_sec."'";
$resultk = mysqli_query($conn,$query);


         while ($row = $resultk->fetch_assoc()) { 
                                $student_Id3 = $row["Id"];
                                $markss = $_POST[$student_Id3];
                                echo $markss;
                                $query_xtrm = "INSERT INTO result VALUE('".$teacher_email."','".$selected_crs_id."','".$crs_sec."','".$type."',".$markss.",".$student_Id3.")";
                                mysqli_query($conn, $query_xtrm);
         }

?>


<?php
    
$errorpafelocation = 'Location: /error_page.php?err_msg=';
include 'db_connection.php';

$emailorid = $_POST["emailorid"]; 
$pass = $_POST["password"]; 
$user_type = $_POST["user_type"];

session_start();

if($user_type == "Student"){
     $query = "SELECT Id FROM Student_table WHERE Id ='".$emailorid."'";

     if(mysqli_num_rows(mysqli_query($conn, $query)) == 0){
         
         header($errorpafelocation."This Id dosen't exists! Please Signup.&err_bttn=Sign up&err_bttn_link=/index.php#signup" );
     }else{

         $query2 = "SELECT Verified FROM Student_table WHERE Id ='".$emailorid."' AND Password = '".$pass."'";
        $verified = mysqli_query($conn, $query2);
         if(mysqli_num_rows($verified) == 0){
             //mismatch
             header($errorpafelocation."Account Id and Password dosen't match!&err_bttn=Try signing in again&err_bttn_link=/index.php" );
         }else{
              $veri = $verified->fetch_row()[0];
             if($veri == 0){
                 //pending approval
                 header($errorpafelocation."Sorry! The account has not been approved yet!" );
             }else if ($veri ==1){
                 //approved
                 $_SESSION['user'] = $emailorid;
                 $_SESSION['user_type'] = $user_type;
                 header ('Location : /dashboard_student.php');
                 //header ('Location : /dashboard_student.php?user='.$emailorid);
             }else if ($veri ==2){
                 //denied
                 header($errorpafelocation."Sorry! The account request was rejected for some reasons." );
             }
             else{
                 //do nothing
             }
             
         }
     }
    
} else if ($user_type == "Teacher") {

     $query = "SELECT Email FROM Teacher_table WHERE Email ='".$emailorid."'";

     if(mysqli_num_rows(mysqli_query($conn, $query)) == 0){
         
         header($errorpafelocation."This Id dosen't exists! Please Signup.&err_bttn=Sign up&err_bttn_link=/index.php#signup" );
     }else{

         $query2 = "SELECT Verified FROM Teacher_table WHERE Email ='".$emailorid."' AND Password = '".$pass."'";
        $verified = mysqli_query($conn, $query2);
         if(mysqli_num_rows($verified) == 0){
             //mismatch
             header($errorpafelocation."Account Id and Password dosen't match!&err_bttn=Try signing in again&err_bttn_link=/index.php" );
         }else{
              $veri = $verified->fetch_row()[0];
             if($veri == 0){
                 //pending approval
                 header($errorpafelocation."Sorry! The account has not been approved yet!" );
             }else if ($veri ==1){
                 //approved
                  $_SESSION['user'] = $emailorid;
                  $_SESSION['user_type'] = $user_type;
                 header ('Location : /dashboard_teacher.php');
                 //header ('Location : /dashboard_teacher.php');
             }else if ($veri ==2){
                 //denied
                 header($errorpafelocation."Sorry! The account request was rejected for some reasons." );
             }
             else{
                 //do nothing
             }
             
         }
     }
    
}else if ($user_type == "Admin") {
    $query2 = "SELECT * FROM Admin WHERE Email ='".$emailorid."' AND Password = '".$pass."'";
        $verified = mysqli_query($conn, $query2);
         if(mysqli_num_rows($verified) == 0){
             //mismatch
             header($errorpafelocation."Account Id and Password dosen't match!&err_bttn=Try signing in again&err_bttn_link=/index.php" );
         }else{
             $_SESSION['user'] = $emailorid;
             $_SESSION['user_type'] = $user_type;
             header ('Location : /dashboard_admin.php');
             //header ('Location : /dashboard_admin.php?user='.$emailorid);
         }
    
}else {
    //do nothing
}
mysqli_close($conn);
exit;

?>

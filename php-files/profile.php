<?php
    session_start();
    $student_id;
    $user_name_studet;
    $errorpafelocation = 'Location: /error_page.php?err_msg=';
    include '/php-files/db_connection.php';

    if (isset($_SESSION['user']) && $_SESSION['user_type'] == "Student") {
        // logged in
        $student_id = $_SESSION['user'];

         $query2 = 'SELECT Name FROM student_table WHERE Id='.$student_id;
        $result2 = mysqli_query($conn,$query2);
        

        if($result2 == NULL){
             $user_name_studet = $student_id;
        }else{
           $row2 = $result2->fetch_assoc();
            $user_name_studet = $row2["Name"];
        }


    } else {
        // not logged in
        //header ('Location : /index.php');
        header($errorpafelocation."You are not siggned in. Please sign in/sign up.&err_bttn=Sign up / Sign in&err_bttn_link=/index.php" );
     }
?>
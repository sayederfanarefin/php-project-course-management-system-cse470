<?php
   $sucesspagelocation  = 'Location: /sucess_page.html';
   $errorpafelocation = 'Location: /error_page.php?err_msg=';
    include 'db_connection.php';

$name = $_POST["name"];
$password = $_POST["passwd"];
$user_type = $_POST["user_type"];
$emailorid = $_POST["emailorid"];
$dept = $_POST["department"];
$init = $_POST["inits"];

if($user_type == "Student"){
    $query = 'INSERT INTO Student_table (Id,Name,Password,Dept) VALUES ('.$emailorid.',"'.$name.'","'.$password.'","'.$dept.'")';

    if (mysqli_query($conn, $query)) {
        header($sucesspagelocation);
        exit;

    } else {
        $error_number = mysqli_errno($conn);
        if($error_number == 1062){
            header($errorpafelocation."You already have an account. Please login.&err_bttn=Log in&err_bttn_link=/index.html" );
        }else {
            header($errorpafelocation."Something went wrong please try again later." );
        }
        exit;
}


} else if ($user_type == "Teacher") {
     $query2 = 'INSERT INTO Teacher_Table (Email,Name,Password, Initials)
                    VALUES ("'.$emailorid.'","'.$name.'","'.$password.'","'.$init.'")';
     

if (mysqli_query($conn, $query2)) {
      header($sucesspagelocation);
     exit;
} else {
   $error_number = mysqli_errno($conn);
        if($error_number == 1062){
            header($errorpafelocation."You already have an account. Please login.&err_bttn=Log in&err_bttn_link=/index.html" );
        }else {
            header($errorpafelocation."Something went wrong please try again later." );
        }
        exit;
}
                     
}else {
    //do nothing
   header($errorpafelocation);
    exit;
}


?>

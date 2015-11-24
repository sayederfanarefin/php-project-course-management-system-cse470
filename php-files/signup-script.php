<?php
   $sucesspagelocation  = 'Location: /470/sucess_page.html';
   $errorpafelocation = 'Location: /470/error_page.html';
    include 'db_connection.php';

$name = $_POST["name"];
$password = $_POST["passwd"];
$user_type = $_POST["user_type"];
$emailorid = $_POST["emailorid"];

if($user_type == "Student"){
    $query = 'INSERT INTO Student_table (Id,Name,Password) VALUES ('.$emailorid.',"'.$name.'","'.$password.'")';

if (mysqli_query($conn, $query)) {
    header($sucesspagelocation);
    exit;

} else {
    header($errorpafelocation);
    exit;
}


} else if ($user_type == "Teacher") {
     $query2 = 'INSERT INTO Teacher_Table (Email,Name,Password)
                    VALUES ("'.$emailorid.'","'.$name.'","'.$password.'")';
if (mysqli_query($conn, $query2)) {
      header($sucesspagelocation);
     exit;
} else {
    header($errorpafelocation);
    exit;
}
                     
}else {
    //do nothing
   header($errorpafelocation);
    exit;
}


?>

<?php
include 'db_connection.php';
$emailorid = $_POST['emailorid'];
$user_type = $_POST['user_type'];

if( $user_type == "Teacher"){
    $query = "UPDATE `teacher_table` SET `Verified`=1 WHERE `Email`='".$emailorid."'";
    $query2 = 'INSERT INTO Teacher_consultation (teacher_email)
                    VALUES ("'.$emailorid.'")';//heya

                    


                    $query5 = 'INSERT INTO materials (teacher_email)
                    VALUES ("'.$emailorid.'")';//heya
                    

                    $current = getcwd();
 $path = $current.'\fileStorage\courseMaterials\\'.$emailorid ; 
            mkdir($path, 7);


}else if ($user_type == "Student") {
   $query = "UPDATE student_table SET Verified=1 WHERE Id='".$emailorid."'";
}else{
    
}



$result = mysqli_query($conn, $query);
if($result){
    mysqli_query($conn, $query2);
    
    mysqli_query($conn, $query5);

    if( $user_type == "Teacher"){
        
      
   }
   echo "0";
}else{
    echo "1";
}

?>
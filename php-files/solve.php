<?php
   
include 'db_connection.php';
$emailorid = $_POST['emailorid'];
$complain_text = $_POST['complain_text'];
$complain_tag = $_POST['complain_tag'];
$complain_reply = $_POST['complain_reply'];
$complain_reply = "<h6>Your sent message: </h6><p>". $complain_text. "</p><h6> Reply from admin: </h6><p>".$complain_reply."</p>";
$admin_email = $_POST['admin_email'];


    $query = "UPDATE `complains` SET `Solved`=1 WHERE `Tag`='".$complain_tag."'";


if( mysqli_query($conn, $query)){

     if($complain_reply != ""){
          $query2 = 'INSERT INTO messages (User_type_from, User_from, Message, User_to)
                    VALUES ("Admin","'.$admin_email.'","'.$complain_reply.'", "'.$emailorid.'")';//heya
                    $result2 = mysqli_query($conn, $query2);
    }
    
}

if($result2){
   echo "0";
}else{
    echo "1";
}
?>
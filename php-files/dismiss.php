<?php
   
include 'db_connection.php';
$emailorid = $_POST['emailorid'];
$complain_text = $_POST['complain_text'];
$complain_tag = $_POST['complain_tag'];
$complain_reply = $_POST['complain_reply'];
$complain_reply = "Your sent message: ". $complain_text. "<br> Reply from admin: ".$complain_reply;
$admin_email = $_POST['admin_email'];


    $query = "UPDATE `complains` SET `Solved`=2 WHERE `Tag`='".$complain_tag."'";


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
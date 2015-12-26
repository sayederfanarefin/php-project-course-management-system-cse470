<?php
    session_start();
   
    $errorpafelocation = 'Location: /error_page.php?err_msg=';
    include '/php-files/db_connection.php';
    $emailorid = $_SESSION['user'];
    
    $query = 'SELECT * FROM messages WHERE User_to='.$emailorid.' seen=0';
    $result_messages = mysqli_query($conn,$query);
        
?>
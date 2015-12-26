<?php
session_start();
$errorpafelocation = 'Location: /error_page.php?err_msg=';
if(session_destroy()) // Destroying All Sessions
{
    header("Location: /index.php"); // Redirecting To Home Page
}else{
    header($errorpafelocation."We could not sign you out. Please go back and try again." );

}
?>
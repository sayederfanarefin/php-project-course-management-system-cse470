<?php
    session_start();
    $teacher_email;
     $user_name;
    $errorpafelocation = 'Location: /error_page.php?err_msg=';
    include '/php-files/db_connection.php';
    include '/php-files/new_messages_retrive.php';
    if (isset($_SESSION['user']) && $_SESSION['user_type'] == "Teacher") {
        // logged in
        $teacher_email = $_SESSION['user'];
        $query2 = 'SELECT Name FROM teacher_table WHERE Email="'.$teacher_email.'"';
        $result2 = mysqli_query($conn,$query2);
        

        if($result2 == NULL){
             $user_name = $teacher_email;
        }else{
           $row2 = $result2->fetch_assoc();
            $user_name = $row2["Name"];
        }
    } else {
        // not logged in
        //header ('Location : /index.php');
        header($errorpafelocation."You are not siggned in. Please sign in/sign up.&err_bttn=Sign up / Sign in&err_bttn_link=/index.php" );
     }

    
if (isset($_POST['submit'])) {
     $day = $_POST["day"];
     $start_time = $_POST["start_time"];
     $end_time = $_POST["end_time"];

    $sql = "INSERT INTO teacher_consultation_queue (teacher_email, cons_time_start, cons_time_end, cons_day)
    VALUES ('{$teacher_email}', '{$start_time}','{$end_time}','{$day}')";
    
    $result = mysqli_query($conn,$sql);
    
}
     //current semester
       date_default_timezone_set("Asia/Dhaka");
     $today_date =  date("Y-m-d");
     $current_semester ;
     $query_current_semester = "SELECT Semester_name FROM semesters WHERE Semester_date_start <= '".$today_date."' AND Semester_date_stop >= '".$today_date."'";
     $result_current_semester = mysqli_query($conn, $query_current_semester);
     $row = $result_current_semester->fetch_assoc();
      $current_semester = $row["Semester_name"];
      
      //end of detecting current semester
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="/fileStorage/bracu_logo.ico" />
    <title>Teacher Settings | BRACU CMS</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">BRACU CMS</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                        <?php
                           
    
    $query7 = 'SELECT * FROM messages WHERE User_to="'.$student_id.'" AND seen=0';
    $result_messages = mysqli_query($conn,$query7);
    $num_row = mysqli_num_rows($result_messages);
    ?>

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo "(".$num_row.")  "?><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">

<?php    if($result_messages != NULL){
        $counter = 0;
        while( $rowww = $result_messages->fetch_assoc() ){
                                $message_sender_name = $rowww["User_from"];
                                $message_body = $rowww["Message"];
                                $message_time = $rowww["time_stamp"];
                                
                                $str_size = 100;
                                if(strlen($message_body) >$str_size){
                                    $message_body = substr($message_body,0,$str_size) . " . . .";
                                }
                                 echo "
                            <li class=\"message-preview\">
                            <a href=\"#\">
                                <div class=\"media\">
                                    <div class=\"media-body\">
                                        <h5 class=\"media-heading\"><strong>From:</strong> ".$message_sender_name."</h5>
                                        <p class=\"small text-muted\"><i class=\"fa fa-clock-o\"></i>".$message_time."</p>
                                        ".$message_body."
                                    </div>
                                </div>
                            </a>
                        </li>";
                            }
    }else{
          echo "
                            <li class=\"message-preview\">
                            <a href=\"#\">
                                <div class=\"media\">
                                    <div class=\"media-body\">
                                        <h5 class=\"media-heading\"><strong>No new messages</strong></h5>
                                        
                                    </div>
                                </div>
                            </a>
                        </li>";
    }
                            
                           
                        ?>
                        
                        <li class="message-footer">
                            <a href="/php-files/all_messages.php">Read All Messages</a>
                        </li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_name;?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/php-files/Profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        
                        <li>
                            <a href="/Teacher_settings.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="/php-files/signout.php"><i class="fa fa-fw fa-power-off"></i> Sign Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="/dashboard_teacher.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                   
                    <li>
                        <a href="/complain.php"><i class="fa fa-fw fa-edit"></i>Post Complain</a>
                    </li>
                    
                     <li>
                        <a href="/notice.php"><i class="fa fa-fw fa-edit"></i> Write Notice</a>
                    </li>
                    <li>
                        <a href="/Consulatation_queue.php"><i class="fa fa-fw fa-sitemap"></i>Consultation Queue</a>
                    </li>
                    <li>
                        <a href="/upload_materials.php"><i class="fa fa-fw fa-file"></i>Upload Materials</a>
                    </li>
                    
                    <li>
                        <a href="/consultaion.php"><i class="fa fa-fw fa-desktop"></i>Change Availability</a>
                    </li>
                     <li class="active">
                        <a href="/Teacher_settings.php"><i class="fa fa-fw fa-wrench"></i> Settings</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Settings: <small>  <?php
                    echo $current_semester
                ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard_student.php">Dashboard</a>
                            </li>
                             
                            <li class="active">
                                <i class="fa fa-wrench"></i> Settings
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               

                
                <div class="row">
                    <div class="col-lg-4">

                        <form role="form" action="Teacher_settings.php" method="post" >
                            <div class="form-group">
                                <label>Select Day</label>
                                <select multiple class="form-control" name="day" size="4">
                                    <option>SUN</option>
                                    <option>MON</option>
                                    <option>TUE</option>
                                    <option>WED</option>
                                    <option>THU</option>
                                </select>
                            </div>
                                
                                <label>Start time: </label>
                                <br></br>
                                 <input type="time" name="start_time">
                                 
                                <br></br>
                                <label>End time: </label>
                                <br></br>
                                 <input type="time" name="end_time">
                                <br></br>

                            <button type="submit" name="submit" class="btn btn-default">Submit Button</button>
                            
                        </form>

                    </div>
                    </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>

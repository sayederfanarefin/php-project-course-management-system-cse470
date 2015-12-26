<?php
    session_start();
    $user;
    $user_name;
    $errorpafelocation = 'Location: /error_page.php?err_msg=';
    
    if (isset($_SESSION['user']) && $_SESSION['user_type'] == "Admin") {
        // logged in
        $user = $_SESSION['user'];
        $query2 = 'SELECT * FROM admin WHERE Email="'.$user.'"';
        $result2 = mysqli_query($conn,$query2);
        if($result2 == NULL){
            $user_name = $user;
            
        }else{
            $row2 = $result2->fetch_assoc();
            $user_name = $row2["Name"];
        }
    } else {
        // not logged in
        header($errorpafelocation."You are not siggned in. Please sign in/sign up.&err_bttn=Sign up / Sign in&err_bttn_link=/index.php" );
     }
     include '/php-files/db_connection.php';
     $number_complains;
     $number_teacher_req;
     $number_student_req;
     
     $query = "Select * FROM complains WHERE Solved=0";
     $result = mysqli_query($conn, $query);
     $number_complains = mysqli_num_rows($result);
     
     $query = "Select * FROM teacher_table WHERE Verified=0";
     $result = mysqli_query($conn, $query);
     $number_teacher_req = mysqli_num_rows($result);

     $query = "Select * FROM student_table WHERE Verified=0";
     $result = mysqli_query($conn, $query);
     $number_student_req = mysqli_num_rows($result);
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
    <meta name="author" content="Erfan Heya Mim">
    <link rel="shortcut icon" type="image/x-icon" href="/fileStorage/bracu_logo.ico" />
    <title>Admin | BRACU CMS</title>

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
                <a class="navbar-brand" href="/php-files/Profile.php">Admin | BRACU CMS</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
              
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_name; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/php-files/Profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                       
                        <li>
                            <a href="/admin_settings.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
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
                    <li class="active">
                        <a href="dashboard_admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="admin_complains.php"><i class="fa fa-comments"></i> Complains</a>
                    </li>
                    <li>
                        <a href="admin_accountreq_manage.php?id=Teacher"><i class="fa fa-fw fa-table"></i>Teacher account requests</a>
                    </li>
                    <li>
                        <a href="admin_accountreq_manage.php?id=Student"><i class="fa fa-fw fa-table"></i>Student account requests</a>
                    </li>
                    <li>
                        <a href="admin_sem_routine.php"><i class="fa fa-fw fa-desktop"></i>Semester Overview</a>
                    </li>
                    
                    <li>
                        <a href="admin_settings.php"><i class="fa fa-fw fa-wrench"></i>Settings</a>
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
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                

                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $number_complains; ?></div>
                                        <div>Complains</div>
                                    </div>
                                </div>
                            </div>
                            <a href="admin_complains.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $number_teacher_req; ?></div>
                                        <div>Teacher Account Requests</div>
                                    </div>
                                </div>
                            </div>
                            <a href="admin_accountreq_manage.php?id=Teacher">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $number_student_req; ?></div>
                                        <div>Student Account Requests</div>
                                    </div>
                                </div>
                            </div>
                            <a href="admin_accountreq_manage.php?id=Student">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

              


                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-fw fa-desktop fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $current_semester; ?></div>
                                        <div>Current Semester</div>
                                    </div>
                                </div>
                            </div>
                            <a href="admin_sem_routine.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <br><br><br><br><br><br><br>
                <!-- /.row -->

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

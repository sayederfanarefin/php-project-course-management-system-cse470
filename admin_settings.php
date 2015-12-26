
<?php
    $for_user = $_GET['id'];
    session_start();
    $user;
    $errorpafelocation = 'Location: /error_page.php?err_msg=';
    include '/php-files/db_connection.php';
    if (isset($_SESSION['user']) && $_SESSION['user_type'] == "Admin") {
        // logged in
        $user = $_SESSION['user'];
    } else {
        // not logged in
        header($errorpafelocation."You are not siggned in. Please sign in/sign up.&err_bttn=Sign up / Sign in&err_bttn_link=/index.php" );
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user; ?> <b class="caret"></b></a>
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
                    <li>
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
                    
                    <li class="active">
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
                            Settings <small>customize your profile</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-fw fa-legal"></i> Define Semester:
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-6">

                        <form role="form" id="add_semester_form" action="/php-files/addsemester.php" method="post">

                            <div class="form-group">
                                <label>Enter semester name</label>
                                <input class="form-control" id="Semester_name" name = "Semester_name" placeholder="Enter semester name" >
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" class="form-control" id="Semester_date_start" name='from'  /> 
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" class="form-control" id="Semester_date_stop" name='from'  /> 
                            </div>
                            <button type="submit" class="btn btn-sm btn-success btn-block" onclick="">Save</button>
                       </form>
                  </div>
                    <div class="col-lg-6">
                        <label>Existing Semesters</label>
                                <select multiple class="form-control" size="11" id="semester_show_list">
                                    <?php 

                                    $query = "SELECT * FROM semesters"; 
                                    $result = mysqli_query($conn, $query);
                                    while( $row = $result->fetch_assoc()){
                                        $semester_name = $row["Semester_name"];
                                        echo "<option>".$semester_name."</option>";
                                    }
                                    ?>
                                    
                                   
                                </select>
                        
                        <!--<button type="button" class="btn btn-sm btn-warning btn-block" onclick="">Edit</button>-->
                        </div>
                    
                </div>
                <!-- /.row -->
                </br>
                 <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-fw fa-legal"></i> Define Courses:
                            </li>
                        </ol>
                    </div>

                      <div class="col-lg-6">

                        <form role="form" id="add_course_form" action="/php-files/addcourse.php" method="post">
                            
                            <div class="form-group">
                                <label>Course Title </label>
                                <input class="form-control" placeholder="Course Title" id="crs_title" name="crs_title">
                            </div>
                            <div class="form-group">
                                <label>Enter Course Id</label>
                                <input class="form-control" placeholder="Course Id" id="course_Id" name="course_Id">
                            </div>
                            
                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" id="Dept" name="Dept">
                                   <?php 

                                    $query = "SELECT * FROM departments_table"; 
                                    $result = mysqli_query($conn, $query);
                                    while( $row = $result->fetch_assoc()){
                                        $semester_name = $row["Department"];
                                        echo "<option>".$semester_name."</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Semester</label>
                                <select class="form-control" id="semester_show_list_2" name="semester_show_list_2">
                                   <?php 

                                    $query = "SELECT * FROM semesters"; 
                                    $result = mysqli_query($conn, $query);
                                    while( $row = $result->fetch_assoc()){
                                        $semester_name = $row["Semester_name"];
                                        echo "<option>".$semester_name."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                             <button type="submit" class="btn btn-sm btn-success btn-block" onclick="">Save</button>
                            </form>

                  </div>
                    <div class="col-lg-6">
                        <label>Existing Courses</label>
                                <select multiple class="form-control" size="15" id="existing_courses_show">
                                        <?php 

                                    $query = "SELECT * FROM dept_crs WHERE Semester='".$current_semester."'"; 
                                    $result = mysqli_query($conn, $query);
                                    while( $row = $result->fetch_assoc()){
                                        $course_id = $row["course_Id"];
                                        echo "<option>".$course_id."</option>";
                                    }
                                    ?>
                                    
                                </select>
                        
                        <!--<button type="button" class="btn btn-sm btn-warning btn-block" onclick="">Edit</button>-->
                        </div>


                     </div>
                <div class="row">
                    <div class="col-lg-12">
                       
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
    <script>

        $("#add_semester_form").submit(function (event)
        {

            /* stop form from submitting normally */
            event.preventDefault();

            /* get some values from elements on the page: */
            var $form = $(this),
              url = $form.attr('action');

            /* Send the data using post */
            var posting = $.post(url, { Semester: $('#Semester_name').val(), Semester_date_start: $('#Semester_date_start').val(), Semester_date_stop: $('#Semester_date_stop').val() });

            /* Alerts the results */
            posting.done(function (data)
            {
                if (data == "0")
                {
                    $("#semester_show_list").append("<option>" + $('#Semester_name').val() + "</option>");
                    $("#semester_show_list_2").append("<option>" + $('#Semester_name').val() + "</option>");

                } else if (data == "1")
                {
                    alert('Sorry, we couldn\'t complete that, please try again later.');
                } else
                {

                }

            });
        });

    </script>

    <script>
        $("#add_course_form").submit(function (event)
        {

            /* stop form from submitting normally */
            event.preventDefault();

            /* get some values from elements on the page: */
            var $form = $(this),
              url = $form.attr('action');

            /* Send the data using post */
            var posting = $.post(url, { course_Id: $('#course_Id').val(), Dept: $('#Dept').val(), semester_show_list_2: $('#semester_show_list_2').val(), crs_title: $('#crs_title').val() });

            /* Alerts the results */
            posting.done(function (data)
            {
                if (data == 0)
                {
                   $("#existing_courses_show").append("<option>" + $('#course_Id').val() + "</option>");

                } else if (data == 1)
                {
                    alert('Sorry, we couldn\'t complete that, please try again later.');
                } else
                {
                    alert(data);
                }

            });
        });

    </script>
</body>

</html>

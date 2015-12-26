

<?php
    //signned-in or not check
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
     //end of sign in stuff

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
                    <li class="active">
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
                        <h2>Sections management for <?php echo $current_semester;?> semester</h2>

                        <br><br>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-fw fa-legal"></i> Add new section for  <?php echo $current_semester;?> semester
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               
                <div class="row">
                   <form role="form" id="assign_teacher_form_666" action="/php-files/assign_teacher_semester.php" method="post">
                    <div class="col-lg-4">
                        <div class="form-group">
                    <label>Select Available courses</label>
                 <select class="form-control"  id="existing_courses_show_bla" name="existing_courses_show_bla" required>
                                        <?php 

                                    $query = "SELECT * FROM dept_crs WHERE Semester='".$current_semester."' AND Dept='Computer Science And Engineering'"; 
                                    $result = mysqli_query($conn, $query);
                                    while( $row = $result->fetch_assoc()){
                                        $course_id = $row["course_Id"];
                                        echo "<option>".$course_id."</option>";
                                    }
                                    ?>
                                    
                                </select></div>
                         <div class="form-group">
                                <label>Select Department</label>
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
                </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                                <label>Enter Teacher email</label>
                                <input class="form-control" type="email" placeholder="Teacher email" id="add_teacher_email" name="add_teacher_email" data-error="invalid email" required>
                            </div>

                        <div class="col-md-6">
                         <div class="form-group">
                                <label>Enter Section</label>
                                <input class="form-control" placeholder="Section" id="section" name="section" required>
                            </div>
                        </div>
                       <div class="col-md-6">
                         <div class="form-group">
                                <label>Enter Secret Code</label>
                                <input class="form-control" placeholder="Secret code" id="secret_code" name="secret_code" required>
                            </div>
                        </div>

                        
                        

                    </div>
                      <div class="col-md-12"><button type="submit" class="btn btn-sm btn-success btn-block" onclick="">Add</button></div>
                            </form>
                    </div>
                <br><br>
                    <div class="row">
                        <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-fw fa-legal"></i> Available sections, courses in this semester (<?php echo $current_semester;?>)
                            </li>
                        </ol>

                  </div>
                <div class="col-lg-4">
                    <h5>Available courses in this semester</h5>
                    <select multiple class="form-control" size="15" id="existing_courses_show_current_semester_1">
                      <?php 

                                    $query = "SELECT * FROM dept_crs WHERE semester='".$current_semester."' ORDER BY course_Id ASC"; 
                                    $result = mysqli_query($conn, $query);
                                    while( $row = $result->fetch_assoc()){
                                        $course_id = $row["course_Id"];
                                        echo "<option>".$course_id."</option>";
                                    }
                       ?>
                                    
                                </select>
                </div>
                    <div class="col-lg-8">
                    <h5>Available sections, with respective teacher initials:</h5>
                         <select multiple class="form-control" size="15" id="existing_courses_show_current_semester_with_section_fac">
                          <?php 
                                    $query = "SELECT * FROM teacher_courses,teacher_table WHERE teacher_courses.Email = teacher_table.Email AND teacher_courses.semester='".$current_semester."' ORDER BY teacher_courses.Course_id ASC, teacher_courses.Section ASC"; 
                                    $result = mysqli_query($conn, $query);
                                    while( $row = $result->fetch_assoc()){
                                        $course_id = $row["Course_id"];
                                        $section = $row["Section"];
                                        $teacher = $row["Email"];
                                        echo "<option>".$course_id." - ".$section." - ".$teacher."</option>";
                                    }
                          ?>
                                    
                        </select>
                </div>
                    
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
        <script>

            $('#Dept').on('change', function () {
                var e = document.getElementById("Dept");
                var Dept_val = e.options[e.selectedIndex].value;

                $.ajax({
                    url: "/php-files/get_courses_by_dept.php",
                    type: "POST",
                    data: { 'Dept': Dept_val },
                    success: function (dataa) {
                        $('#existing_courses_show_bla').html('');
                        data = JSON.parse(dataa);
                        lengtio = data.length;
                        for (i = 0; i < lengtio; i++) { 
                        $('#existing_courses_show_bla').append('<option>'+data[i]+'</option>');
                            
                        }
                        

                        /*
                        if (dataa == 0) {
                        alert("Sorry something went wrong, please try again!");
                        } else {
                        $('#existing_courses_show_bla').html('');
                        $('#existing_courses_show_bla').append('<option value="19">19</option>');
                        }
                        */
                    },
                    error: function () {
                        alert("Sorry something went wrong, please try again!");
                    }
                });




            });

            </script>
    <script>

        $("#assign_teacher_form_666").submit(function (event) {

            /* stop form from submitting normally */
            event.preventDefault();

            /* get some values from elements on the page: */
            var $form = $(this),
              url = $form.attr('action');

            
            /* Send the data using post */
            var posting = $.post(url, { existing_courses_show_bla: $('#existing_courses_show_bla').val(), section: $('#section').val(), add_teacher_email: $('#add_teacher_email').val(), secret_code: $('#secret_code').val() });

            

            /* Alerts the results */
            posting.done(function (data) {
                if (data == 0) {
                    $('#existing_courses_show_current_semester_with_section_fac').append('<option>'+$('#existing_courses_show_bla').val()+' - '+ $('#section').val() +' - ' + $('#add_teacher_email').val()+'</option>');
                    
                    alert('Teacher was assigned successfully!');

                } else if (data == 1) {
                    alert('Sorry, we couldn\'t complete that, please try again later.');
                } else {
                    alert(data);
                }

            });
        });


    </script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>



</body>

</html>

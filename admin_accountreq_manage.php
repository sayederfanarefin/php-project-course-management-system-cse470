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
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Erfan Heya Mim">

    <title>Admin | BRACU CMS</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="/fileStorage/bracu_logo.ico" />
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

                    <li <?php if($for_user == "Teacher"){ echo "class=\"active\"";}?>>
                        <a href="admin_accountreq_manage.php?id=Teacher"><i class="fa fa-fw fa-table"></i>Teacher account requests</a>
                    </li>
                    <li <?php if($for_user == "Student"){ echo "class=\"active\"";}?>>
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
                            <?php echo $for_user ;?> Account <small>Requests</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-fw fa-table"></i> Requests for <?php echo $for_user ;?> accounts
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Pending requests</h3>
                                
                            </div>
                            <div class="panel-body">
                                <?php 

                                    if ($for_user == "Teacher"){
                                        $query = "SELECT * FROM teacher_table WHERE Verified=0";
                                        $result = mysqli_query($conn,$query);
                                    }else if ($for_user == "Student"){
                                          $query = "SELECT * FROM student_table WHERE Verified=0";
                                          $result = mysqli_query($conn,$query);
                                    }else{}
                                    
                                    while($row = $result->fetch_assoc()){
                                    $name = $row["Name"];
                                    $emailorid;
                                    if ($for_user == "Teacher"){
                                        $emailorid = $row["Email"];
                                    }else if ($for_user == "Student"){
                                          $emailorid = $row["Id"];
                                    }else{}
                                    
                                    echo "<div class=\"alert alert-info alert\" id=\"".$emailorid."\">
                                    <div class=\"row\">
                                    <div class=\"col-lg-7\">
                                    <h5> Name: "
                                    .$name.
                                    "</h5>
                                    </div>
                                    <div class=\"col-lg-5\">
                                    <h5>";
                                    if ($for_user == "Teacher"){
                                        echo "Email: ".$emailorid ;
                                    }else if ($for_user == "Student"){
                                         echo "Id: ".$emailorid ;
                                    }else{}
                                    echo "</h5>
                                    </div></div>"; 
                                    //approve reject buttons here
                                    echo "<div class=\"row\">
                                    <div class=\"col-lg-6\"><button type=\"button\" class=\"btn btn-sm btn-success btn-block\" onclick=\"approve('".$emailorid."','".$for_user."')\">Approve</button> </div> 
                                    <div class=\"col-lg-6\"><button type=\"button\" class=\"btn btn-sm btn-danger btn-block\" onclick=\"reject('".$emailorid."','".$for_user."')\">Reject</button> </div>";
                                    echo"</div></div>";
                                    }
                                ?>
                            </div>
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

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>


   <script>
       function approve(emailorid, user_type) {

           $.ajax({
               url: "/php-files/approve.php",
               type: "POST",
               data: { 'emailorid': emailorid, 'user_type': user_type },
               success: function (dataa) {

                   if (dataa == 0) {
                       var element = document.getElementById(emailorid);
                       element.parentNode.removeChild(element);
                       alert("Approved!");
                   } else { 
                   alert("Sorry something went wrong, please try again!");
                   }

               },
               error: function () {
                   alert("Sorry something went wrong, please try again!");
               }
           });
       }


       function reject(emailorid, user_type) {

           $.ajax({
               url: "/php-files/reject.php",
               type: "POST",
               data: { 'emailorid': emailorid, 'user_type': user_type },
               success: function (dataa) {

                   if (dataa == 0) {
                       var element = document.getElementById(emailorid);
                       element.parentNode.removeChild(element);
                       alert("Rejected!");
                   } else {
                       alert("Sorry something went wrong, please try again!");
                   }

               },
               error: function () {
                   alert("Sorry something went wrong, please try again!");
               }
           });
       }
</script>

</body>

</html>

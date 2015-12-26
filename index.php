   <?php
        include '/php-files/db_connection.php';
        $quer = "SELECT Department_initials FROM Departments_table";
        $query_result = mysqli_query($conn,$quer);
   ?>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>User login | BRACU CMS</title>
        <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="/fileStorage/bracu_logo.ico" />

    </head>
    <body>
        <div class="container">    
            <div class="row">
                <br><br>
                <div class="col-md-5">
                </div>
                <div class="col-md-2">

                    <img src="/fileStorage/bracu_logo.png" alt="BRACU Icon" style="width:136px;height:120px;">
                </div>
                <div class="col-md-5">
                </div>
            </div>
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <!--<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>-->
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" action="php-files/login-script.php" method="post">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="emailorid" value="" placeholder="Student Id/ Teacher email/ Admin email" required>                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="Password" required>
                                    </div>
                                    

                                
                            <div class="input-group">
                                    <label for="icode" class="col-md-4 control-label">User Type</label>
                                    <div class="col-md-8">
                                        <input type="radio" name="user_type" value="Student" checked>Student
 
  <input type="radio" name="user_type" value="Teacher">Teacher
    <br>
  <input type="radio" name="user_type" value="Admin">Admin                                    
                                            
                                    </div>
                                </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                  <br>
                                    <br>

                                    <div class="span9 btn-block">
    <button id="btn-signin" type="submit" class="btn btn-info btn-block"><i class="icon-hand-right"></i> &nbsp Sign In</button>
</div>


                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form" action="php-files/signup-script.php" method="post">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                
                                  
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Teacher Email / Strudent Id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="emailorid" placeholder="Student Id/ Teacher email" required>
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="passwd" placeholder="Password" required>
                                    </div>
                                </div>
                                    
                                <div class="form-group" style = "display:none;" id="initials_teacher">
                                    <label for="password" class="col-md-3 control-label">Initials</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="inits" placeholder="Initials" >
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="icode" class="col-md-3 control-label">User Type</label>
                                    <div class="col-md-9">
                                        <input type="radio" name="user_type" value="Student" onclick="bulala2()" checked required>Student
 <br>
  <input type="radio" name="user_type" value="Teacher" onclick="bulala()" required>Teacher
                                        
                                            
                                    </div>
                                </div>
                                


 <div class="form-group">
                                    <label for="icode" class="col-md-3 control-label">Department (only for students)</label>
                                    <div class="col-md-9">

                                     
                                            <?php
                                                 while ($row = $query_result->fetch_assoc()) {
                                                     $dept = $row["Department_initials"];
       echo "<input type=\"radio\" name=\"department\" value=\"".$dept."\" required >".$dept."<br>";
                                                  }
                                                  
                                        ?>
                                        
                                        
                                            
                                    </div>
                                </div>


















                                <div class="form-group">
                                    <!-- Button -->  
                                    
                                     <br>
                                    <br>

                                    <div class="span9 btn-block">
    <button id="btn-signup" type="submit" class="btn btn-info btn-block"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
</div>


                                </div>
                                </div>
                                
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div> 
    </div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
        <script>
            function bulala() {
                document.getElementById("initials_teacher").style.display="inline";
            }

             function bulala2() {
                document.getElementById("initials_teacher").style.display="none";
            }
            </script>
    </body>
</html>

<?php
    if($_GET['err_msg'] != NULL){
        $msg = $_GET['err_msg'];
    }
    if($_GET['err_bttn'] != NULL){
        $button_string = $_GET['err_bttn'];

        if($_GET['err_bttn_link'] != NULL){
        $button_link = $_GET['err_bttn_link'];
    }
    }
    
   
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="refresh" content="IE=edge,url=sucess_page.html">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="/fileStorage/bracu_logo.ico" />
    <title>Error :(</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

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



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <center>
                        <h1 class="page-header">
                           Something went wrong :(
                           
                        </h1>
                        <br> <br>
                        
                       <h3><?php echo $msg ?> </h3> </center>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
                <br><br>
                <?php  if($button_string != NULL){
        ?>
                <div class="row">
                    <div class="span9 btn-block">
    <button class="btn btn-large btn-block btn-primary" type="button" onclick= "location.href = '<?php echo $button_link ?>';" ><?php echo $button_string?></button>
</div>
                </div>
<?php
    }
    ?>
                
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

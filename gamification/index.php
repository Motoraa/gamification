<?php
include "conectare.php";
session_start();
error_reporting(0); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>QuestQuest</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome2.css" rel="stylesheet" />
    <link href="assets/css/style1.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
<?php include('includes/header.php');?>
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">USER DASHBOARD</h4>
                
            </div>

        </div>
             
             <div class="row">



            
                 <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-info back-widget-set text-center">
                            <i class="fa fa-bars fa-5x"></i>
							
<?php 
$user_id=$_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT points FROM users WHERE id='$user_id'");
$nr=mysqli_fetch_array($result);
?>

                            <h3><?php echo "$nr[points]"?> </h3>
                             Total puncte </a>
                        </div>
                    </div>
             
			 <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-warning back-widget-set text-center">
                            <i class="fa fa-book fa-5x"></i>
<?php 
$result = mysqli_query($conn, "SELECT * FROM completedquests WHERE user_id='$user_id'");
$nr1=mysqli_num_rows($result);
?>

                            <h3><?php echo htmlentities($nr1);?></h3>
                          
							<a href="" style="color:#996633">Quest-uri rezolvate </a>
                        </div>
                    </div>
			 
               <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-success back-widget-set text-center">
                            <i class="fa fa-recycle fa-5x"></i>
<?php 
$user_id=$_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT badges FROM users WHERE id='$user_id'");
$nr1=mysqli_fetch_array($result);
?>

                            <h3><?php echo "$nr1[badges]"?> </h3>
                             Badge-ul obtinut </a>
                        </div>
                    </div>
					
					
	
        </div>
    </div>
    </div>
<?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>	
</body>
</html>
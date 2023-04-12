<?php
include "conectare.php";
 ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>QuestQuest</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style1.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
<?php include('includes/header.php');?>
  <div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Profilul meu</h4>
            </div>
        </div>
		
        <div class="row">
			<div class="col-md-9 col-md-offset-1">
               <div class="panel panel-danger">
                        <div class="panel-heading">
                           Profilul meu
                        </div>
                        <div class="panel-body">
                              <form name="signup" method="post" action="changepassword.php">
							  
							  <?php 
										$user_id=$_SESSION['user_id'];
										$result = mysqli_query($conn, "SELECT * from  users where id='$user_id' ");
										$row=mysqli_fetch_array($result);
										$nr=mysqli_num_rows($result);
										
										if($nr> 0)
										{
										               ?>  
										<div class="form-group">
										<label>Id angajat : </label>
										<?php echo htmlentities($row['id']);?>
										</div>

										<div class="form-group">
										<label>Numele si prenumele : </label>
										<?php echo htmlentities($row['name']);?>
										</div>
									
										<div class="form-group">
										<label>Email : </label>
										<?php echo htmlentities($row['email']);?>
										</div>
										
										<div class="form-group">
										<label>Points : </label>
										<?php echo htmlentities($row['points']);?>
										</div>
										


						
										<div class="form-group">
										<label>Badge : </label>
										<?php echo htmlentities($row['badges']);?>
										</div>
										
						
		
										<button type="submit" name="change" class="btn btn-primary">Schimba parola</button>
										<?php } ?>

							  </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
   </div>
<?php include('includes/footer.php');?>
</body>
</html>
			<?php
			include "conectare.php";
			session_start();
			if(isset($_POST['login']))
			{
			$user = $_POST['user']; 
			$_SESSION['id'] = $user;
			
			$password =($_POST['password']);
			$result = mysqli_query($conn, "SELECT * FROM admin WHERE user='$user' and password='$password'");
			$row=mysqli_fetch_array($result);
			$nr=mysqli_num_rows($result);
			echo $nr;
			$_SESSION['adminlogin']=$user;
			if($nr > 0)
				{
					
				echo "<script type='text/javascript'> document.location ='index.php'; </script>";
				} else{
				echo "<center>
					<div class='alert alert-danger mt-4' role='alert'>User-ul sau parola incorecte!
						<p><a href='login.php'><strong>Incearca din nou!</strong></a></p>
					</div>";
				}
			}
			?>
<html lang="en">
  <head>
    <title>QuestQuest-Admin</title>
	
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/login.css">
  </head>

  <body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">		
					<div class="card">
						<div class="loginBox">
							<img src="images/book.jpg" class="img-responsive" alt="PHP MySQL logos">
							<h2>Login</h2>

							<form method="post">                           	
								<div class="form-group">									
									<input type="text" class="form-control input-lg" name="user" placeholder="Username" required>        
								</div>							
								<div class="form-group">        
									<input type="password" class="form-control input-lg" name="password" placeholder="Parola" required>       
								</div>								    
									<button type="submit" class="btn btn-success btn-block" name="login">Login</button>
									<a href="../login.php"> Inapoi la logarea pentru Elevi
							</form>																	
						</div><!-- /.loginBox -->	
					</div><!-- /.card -->
				</div><!-- /.col -->
			</div><!--/.row-->
		</div><!-- /.container -->
	</body>
</html>	
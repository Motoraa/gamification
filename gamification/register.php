	<?php
session_start();
require_once('conectare.php');


// Check if the user submitted the registration form
if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Check if the email is already registered
  $query = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    $error = "Emailul deja este inregistrat";
  } else {
    // Insert the new user into the database
    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    mysqli_query($conn, $query);
    $user_id = mysqli_insert_id($conn);
    $_SESSION['user_id'] = $user_id;
    echo "<center>
						<div class='alert alert-success mt-4' role='alert'><strong>Bine ai venit!</strong>			
							<p><a href='login.php'>Mergi catre login</a></p>
			
						</div> 
					  </center>";
  }
}

?>
<html lang="en">
  <head>
    <title>QuestQuest</title>
	
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
							<h2>Inregistrare</h2>


							  <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
							  <form method="post">
							  
							  <input type="text" class="form-control input-lg" name="name" placeholder="Numele si prenumele"  required>       
							  <input type="text" class="form-control input-lg" name="email" placeholder="Email"  required>       
							  <input type="text" class="form-control input-lg" name="password" placeholder="Password" required>
						
			
								<button type="submit" class="btn btn-success btn-block" name="register" >Inregistreaza-te</button>
								
	
							  </form>
														
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>	
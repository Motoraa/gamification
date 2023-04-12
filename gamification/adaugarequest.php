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
						<h4 class="header-line">Adaugare quest</h4>
               
				
				
				<?php
				// Check if the user is logged in
				if (!isset($_SESSION['user_id'])) {
				  header('Location: login.php');
				  exit;
				}

				// Check if the user submitted the quest form
				if (isset($_POST['add_quest'])) {
					$title = $_POST['title'];
					$description = $_POST['description'];
					$points_required = $_POST['points_required'];
					$points_rewarded = $_POST['points_rewarded'];

					// Get user's current points from the database
					$user_id = $_SESSION['user_id'];
					$query = "SELECT points FROM users WHERE id = '$user_id'";
					$result = mysqli_query($conn, $query);
					$row = mysqli_fetch_assoc($result);
					$user_points = $row['points'];

					// Check if user has enough points to add the quest
					if ($user_points >= $points_required) {
						// Insert the new quest into the database
						$query = "INSERT INTO quests (title, description, points_required, points_rewarded) VALUES ('$title', '$description', '$points_required', '$points_rewarded')";
						mysqli_query($conn, $query);
						$quest_id = mysqli_insert_id($conn);

						// Deduct points from user's account
						$new_user_points = $user_points - $points_required;
						$query = "UPDATE users SET points = '$new_user_points' WHERE id = '$user_id'";
						mysqli_query($conn, $query);

						header('Location: index.php');
						exit;
					} else {
						// Display error message if user does not have enough points
						echo "Error: Nu ai destule puncte pentru a adauga acest quest. Rezolva questuri pentru a aduna puncte.";
					}
				} ?>
				<!DOCTYPE html>
				<html>
				<head>
				  <title>Add Quest</title>
				</head>
				<body>
				  <h1>Add Quest</h1>
				  <form method="post">
					<label>Title:</label>
					<input type="text" name="title" required><br>
					<label>Description:</label>
					<input type="text" name="description" required><br>
					<label>Points Required:</label>
					<input type="number" name="points_required" required><br>
					<label>Points Rewarded:</label>
					<input type="number" name="points_rewarded" required><br>
					<input type="submit" name="add_quest" value="Add Quest">
				  </form>
				</body>
				</html>
				

				
					
    </div>
		</div>
	</div>
<?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>	
</body>
</html>
<?php
include "conectare.php";
session_start();
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
						<h4 class="header-line">Rezolvare quest</h4>
                
				
									<?php
									if(isset($_POST['submit1']))
									{		
								
							
										$quest_id = $_POST['selected_quest_id'];
										$sql=mysqli_query($conn,"select * FROM quests WHERE id='$quest_id'");
										$row=mysqli_fetch_array($sql);
							
										$user_id=$_SESSION['user_id'];
										$sql = "SELECT id, title, description, points_rewarded FROM Quests WHERE id = $quest_id";
										$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										$row = $result->fetch_assoc();
										$questId = $quest_id;
										$questTitle = $row['title'];
										$questDescription = $row['description'];
										$questPoints = $row['points_rewarded'];
									} else {
										
										header("Location: toatequesturile.php");
										exit();
									}
								} else {
									// Redirecționare către pagina toatequesturile.php dacă ID-ul quest-ului nu este transmis
									header("Location: toatequesturile.php");
									exit();
								}
	?>
					</div>
				</div>
				
				<div class="container">
				
        <h2><?php echo  $questTitle; ?></h2>
        <p><?php echo $questDescription; ?></p>
        <p>Puncte: <?php echo $questPoints; ?></p>
       <form method="post" action="processrezolvare.php">
			<input type="hidden" name="quest_id" value="<?php echo ($questId); ?>">
			<input type="hidden" name="userId" value="<?php echo $_SESSION['user_id']; ?>">
            <div class="form-group">
                <label for="raspunsTextarea">Raspuns</label>
                 <textarea class="form-control" id="raspunsTextarea" name="raspuns" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Trimite</button>
            <a href="toatequesturile.php" class="btn btn-secondary">Anulare</a>
        </form>
    </div>
		</div>
	</div>
<?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>	
</body>
</html>
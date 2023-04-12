<?php
include "conectare.php";
session_start();
error_reporting(0);
?>
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
                <h4 class="header-line">Lista quest-uri</h4>
    </div>


        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Alege-ti un quest bifand casuta din dreapta tabelului
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
								<form method="post" action="rezolvarereward.php">
                               <table class="table table-striped table-bordered table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Nr.</th>
											<th>Titlu</th>
											<th>Descriere</th>
											<th>Cost</th>
											<th>Stoc</th>
											<th>Actiunea</th>
                                        </tr>
                                    </thead>
                                    <tbody>
				<?php

				 $query = "SELECT * FROM rewards";
						$result = mysqli_query($conn, $query);
						while ($row = mysqli_fetch_array($result)) {
							$id_rewards = $row['id'];
							$title = $row['title'];
							$description = $row['description'];
							$cost = $row['cost'];
							$stoc = $row['stoc'];
						?>





								<tr>
									<td><?php echo $id_rewards; ?></td>
									<td><?php echo $title; ?></td>
									<td><?php echo $description; ?></td>
									<td><?php echo $cost; ?></td>
									<td><?php echo $stoc; ?></td>
									<td>
										<input type="radio" name="selected_rewards_id" value="<?php echo $id_rewards; ?>" />
									</td>
								</tr>
							<?php

	


							}
									?>
								</table>
								<center>
								<br>
			
								<input type="submit" name="submit1" value="Cumpara reward" />
								<br> <br>
								<?php
									echo "<a href=index.php>Inapoi</a>";
									?>
									</center>
							</form>






              
                                    </tbody>
                  
                            </div>
			
									
									
							
                        </div>
                    </div>
                </div>
            </div>


            
  </div>
    </div>
<?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
	<script src="assets/js/tabel/tabel1.js"> </script>
	<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"> </script>
	<script> $(document).ready(function() {
    $('#myTable').DataTable( {
        "lengthMenu": [10] //cate valori se afiseaza pe pagina.
    } );
} );
</script>
</body>
</html>
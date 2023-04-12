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
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style1.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
</head>
<body>
<?php include('includes/header.php');?>
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Administreaza quest-urile</h4>
    </div>
     


        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Quest-uri
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                 <table class="table table-striped table-bordered table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Nume si prenume</th>
                                            <th>Titlu</th>
                                            <th>Descriere</th>
                                            <th>Puncte primite</th>
                                            <th>Raspuns</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php

$result = mysqli_query($conn, "SELECT users.id, users.name, users.points, completedquests.completion_date, completedquests.raspuns, quests.title, quests.description, quests.points_rewarded, quests.id as id1
                                FROM users 
                                INNER JOIN completedquests ON users.id = completedquests.user_id 
                                INNER JOIN quests ON quests.id = completedquests.quest_id and completedquests.validare='0' ");
$nrc = mysqli_num_rows($result);

if ($nrc > 0) {
    foreach ($result as $rows) {
        $userId = $rows['id'];
        $questId = $rows['id1'];
        $raspuns = $rows['raspuns'];
        $points = $rows['points_rewarded'];
?>
        <tr class="header">
            <td class="center"><?php echo htmlentities($rows['name']); ?></td>
            <td class="center"><?php echo htmlentities($rows['title']); ?></td>
            <td class="center"><?php echo htmlentities($rows['description']); ?></td>
            <td class="center"><?php echo htmlentities($rows['points_rewarded']); ?></td>
            <td class="center"><?php echo htmlentities($rows['raspuns']); ?></td>
            <td class="center">
                <form method="post">
                    <input type="hidden" name="userId" value="<?php echo $userId; ?>">
					<input type="hidden" name="questId" value="<?php echo $questId; ?>">
                    <input type="hidden" name="points" value="<?php echo $points; ?>">
                    <button type="submit" class="btn btn-primary" name="approve"><i class="fa fa-approve"></i> Aprobă</button>
                    <button type="submit" class="btn btn-danger" name="delete"><i class="fa fa-pencil"></i> Șterge</button>
                </form>
            </td>
        </tr>
<?php
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['approve'])) {
        $userId = $_POST['userId'];
        $questId = $_POST['questId'];
        $points = $_POST['points'];
          // Actualizare completare quest
        mysqli_query($conn, "UPDATE completedquests SET validare='1' WHERE user_id='$userId' AND quest_id='$questId'");
        
        // Redirectare către pagina curentă pentru a actualiza tabelul
        header("Location: allquest.php");
        exit();
    }
	 //$questId = $_POST['questId'];
	 //echo $questId;
    if (isset($_POST['delete'])) {
        $userId = $_POST['userId'];
        $questId = $_POST['questId'];
        $points = $_POST['points'];
		

        // Actualizare completare quest
        mysqli_query($conn, "UPDATE completedquests SET validare='1' WHERE user_id='$userId' AND quest_id='$questId'");
        
        // Scădere puncte quest din tabela users
        mysqli_query($conn, "UPDATE users SET points=points-'$points' WHERE id='$userId'");
        
        // Redirectare către pagina curentă pentru a actualiza tabelul
        header("Location: allquest.php");
        exit();
    }
}
?>	
                                    </tbody>
                                </table>
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
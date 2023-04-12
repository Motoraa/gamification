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
    <link href="assets/css/font-awesome12.css" rel="stylesheet" />
    <link href="assets/css/style1.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
</head>
<body>
<?php include('includes/header.php');?>
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Clasament</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <?php
                            $query = "SELECT users.id, users.name, users.points, users.badges, COUNT(completedquests.id) AS numar_questuri
                                      FROM users
                                      LEFT JOIN completedquests ON users.id = completedquests.user_id
                                      GROUP BY users.id
                                      ORDER BY numar_questuri DESC";

                            $result = mysqli_query($conn, $query);

                            // Verifică dacă există rezultate
                            if (mysqli_num_rows($result) > 0) {
                                ?>
                                <table class="table table-striped table-bordered table-hover" id="myTable">
                                    <thead>
                                    <tr>
                                        <th>Loc</th>
                                        <th>Nume si prenume</th>
                                        <th>Puncte</th>
                                        <th>Badge</th>
                                        <th>Număr Questuri Rezolvate</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['points']; ?></td>
                                            <td><?php echo $row['badges'];?></td>
                                            <td><?php echo $row['numar_questuri']; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                echo "Nu există utilizatori sau questuri finalizate.";
                           
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
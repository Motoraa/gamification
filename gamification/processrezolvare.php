<?php
session_start();
// Alte prelucrări ale formularului
// ...
$conn = mysqli_connect("localhost", "root", "", "gamification");

// Verificarea conexiunii
if (!$conn) {
    die("Conexiune esuata: " . mysqli_connect_error());
}

if (isset($_SESSION['user_id'])) {
    // Obținerea valorilor din formular
    $user_id = $_SESSION['user_id'];
    $quest_id = $_POST["quest_id"];
    $raspuns = $_POST["raspuns"]; // Adăugăm preluarea valorii din câmpul "raspuns" din formular
    // Verificare dacă utilizatorul a completat deja acest quest
    $query = "SELECT * FROM CompletedQuests WHERE user_id = '$user_id' AND quest_id = '$quest_id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        // Afișăm un mesaj de eroare
        echo "Questul a fost deja completat de același utilizator!";
        ?> <br> <br> <?php
        echo "<button onclick=\"window.location.href='toatequesturile.php'\">Toate Questurile</button>";
        // Poți folosi JS pentru a redirecționa utilizatorul la pagina de toate questurile
        // echo "<script>window.location.href='toatequesturile.php';</script>";
        exit; // Terminăm execuția scriptului
    } else {
        // Inserarea în tabela CompletedQuests, incluzând și textul din formular
        $query = "INSERT INTO CompletedQuests (user_id, quest_id, raspuns) VALUES ('$user_id', '$quest_id', '$raspuns')";
        if (mysqli_query($conn, $query)) {
            echo "Quest completat cu succes!";
            // Actualizarea punctajului utilizatorului în tabela Users
            $query = "SELECT points_rewarded FROM quests WHERE id = '$quest_id'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $questPoints = $row["points_rewarded"];
            $query = "UPDATE Users SET points = points + '$questPoints'  WHERE id = '$user_id'";
            mysqli_query($conn, $query);

           // Verificare și acordare badge în funcție de numărul de quest-uri completate de utilizator
$query = "SELECT COUNT(*) as numar_questuri FROM CompletedQuests WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$num_completed_quests = $row["numar_questuri"]; // Obținerea numărului de questuri rezolvate de către utilizator
// Definirea intervalului de badge-uri și imaginilor asociate
$badge_intervals = array(
    1 => 'I', // imaginea pentru 1 quest rezolvat
    5 => 'V', // imaginea pentru 5 quest rezolvat
    10 => 'X', // imaginea pentru 10 questuri rezolvate
    50 => 'L', // imaginea pentru 50 questuri rezolvate
    100 => 'C', // imaginea pentru 100 questuri rezolvate
    500 => 'D', // imaginea pentru 500 questuri rezolvate
    1000 => 'M' // imaginea pentru 1000 questuri rezolvate
);

// Parcurgem intervalul de badge-uri de la cel mai mare la cel mai mic
// pentru a asigura actualizarea corectă a badge-urilor
$updated_badge = '';
foreach ($badge_intervals as $num_quests => $badge_value) {
    if ($num_completed_quests >= $num_quests) {
        $updated_badge = $badge_value;
    } else {
        break; // Oprire la prima valoare de badge care nu este îndeplinită
    }
}

// Actualizăm badge-ul utilizatorului doar dacă este nevoie
if ($updated_badge !== '') {
    $query = "UPDATE Users SET badges = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $updated_badge, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
					?> <br> <br> <?php
					echo "<button onclick=\"window.location.href='toatequesturile.php'\">Toate Questurile</button>";
					
					} else {
						echo "Eroare la completarea questului: " . mysqli_error($conn);
					}
    }
}
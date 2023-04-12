<?php
include "conectare.php";
session_start();
error_reporting(0);

if(isset($_POST['submit1'])) {
    // Verificăm dacă s-a selectat un reward
    if(isset($_POST['selected_rewards_id'])) {
        $selected_reward_id = $_POST['selected_rewards_id'];

        // Obținem detalii despre reward din baza de date
        $query = "SELECT * FROM rewards WHERE id = '$selected_reward_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $title = $row['title'];
        $description = $row['description'];
        $cost = $row['cost'];
        $stoc = $row['stoc'];
        // Verificăm dacă user-ul are suficiente puncte și stocul este disponibil
        if($_SESSION['points'] >= $cost && $stoc > 0) {
            // Actualizăm stocul și punctele user-ului în baza de date
            $new_stoc = $stoc - 1;
			$id_user=$_SESSION['user_id'];
            $new_points = $_SESSION['points'] - $cost;
            $update_query = "UPDATE rewards SET stoc = '$new_stoc' WHERE id = '$selected_reward_id'";
            mysqli_query($conn, $update_query);
            $update_query = "UPDATE users SET points = points-'$cost' WHERE id = '$id_user'";
            mysqli_query($conn, $update_query);
            // Actualizăm și punctele în sesiune
            $_SESSION['points'] = $new_points;
            echo "Ai cumparat cu succes reward-ul $title!";
            echo "<br><br>";
            echo "<button onclick=\"window.location.href='rewards.php'\">Toate Rewardurile</button>";
        } elseif($_SESSION['points'] < $cost) {
            // Afișăm mesajul de eroare pentru puncte insuficiente
            echo "Puncte insuficiente! Rezolva mai multe quest-uri pentru a putea cumpara acest reward!";
            echo "<br><br>";
            echo "<button onclick=\"window.location.href='rewards.php'\">Toate Rewardurile</button>";
        } else {
            // Afișăm mesajul de eroare pentru stoc insuficient
            echo "Stocul pentru reward-ul $title este insuficient!";
            echo "<br><br>";
            echo "<button onclick=\"window.location.href='rewards.php'\">Toate Rewardurile</button>";
        }
    } else {
        // Afișăm mesajul de eroare pentru niciun reward selectat
        echo "Selecteaza un reward!";
        echo "<br><br>";
        echo "<button onclick=\"window.location.href='rewards.php'\">Toate Rewardurile</button>";
    }
}
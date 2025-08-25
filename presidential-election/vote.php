<?php
include "db.php";

if(isset($_POST['leader_id'])){
    $leader_id = $_POST['leader_id'];

    // Increase leader votes
    $conn->query("UPDATE leaders SET votes = votes + 1 WHERE id = $leader_id");

    // Insert into votes history
    $conn->query("INSERT INTO votes (leader_id, votes_count) VALUES ($leader_id, 1)");
}

header("Location: index.php");
?>

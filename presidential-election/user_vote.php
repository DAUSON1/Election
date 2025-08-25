<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit;
}
include "db.php";

if(isset($_POST['leader_id'])){
    $leader_id = $_POST['leader_id'];
    $user_id = $_SESSION['user_id'];

    // Check if user already voted for this leader
    $check = $conn->query("SELECT * FROM votes WHERE user_id=$user_id AND leader_id=$leader_id");
    if($check->num_rows == 0){
        // Insert vote
        $conn->query("INSERT INTO votes (leader_id,user_id) VALUES ($leader_id,$user_id)");
        // Increase leader vote count
        $conn->query("UPDATE leaders SET votes=votes+1 WHERE id=$leader_id");
    }
}

header("Location: user_dashboard.php");
?>

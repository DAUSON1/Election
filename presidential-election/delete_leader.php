<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
include "db.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn->query("DELETE FROM leaders WHERE id=$id");
    header("Location: admin_dashboard.php");
}
?>

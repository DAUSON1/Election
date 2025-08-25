<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
include "db.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $leader = $conn->query("SELECT * FROM leaders WHERE id=$id")->fetch_assoc();
}

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $party = $_POST['party'];
    $conn->query("UPDATE leaders SET name='$name', party='$party' WHERE id=$id");
    header("Location: admin_dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Leader</title>
<style>
body{font-family: Arial; background:#f4f4f4; padding:20px;}
form{background:#fff; padding:20px; width:400px; margin:auto; border-radius:5px;}
input[type=text]{width:100%; padding:10px; margin:5px 0;}
input[type=submit]{padding:10px 15px; background:#007bff; color:#fff; border:none; cursor:pointer;}
input[type=submit]:hover{background:#0056b3;}
h1{text-align:center;}
</style>
</head>
<body>
<h1>Edit Leader</h1>
<form method="post">
    <label>Name:</label>
    <input type="text" name="name" value="<?= $leader['name'] ?>" required>
    <label>Party:</label>
    <input type="text" name="party" value="<?= $leader['party'] ?>" required>
    <input type="submit" name="update" value="Update Leader">
</form>
<p style="text-align:center;"><a href="admin_dashboard.php">Back to Dashboard</a></p>
</body>
</html>

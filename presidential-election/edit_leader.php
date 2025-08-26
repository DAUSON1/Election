<?php
session_start();
include "db.php";
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM leaders WHERE id=$id");
$leader = $result->fetch_assoc();

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $party = $_POST['party'];
    $conn->query("UPDATE leaders SET name='$name', party='$party' WHERE id=$id");
    header("Location: admin_manage_leaders.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Leader</title>
</head>
<body>
<h2 style="text-align:center;">Edit Leader</h2>
<form method="post" style="width:300px;margin:auto;">
    <input type="text" name="name" value="<?= $leader['name'] ?>" required><br><br>
    <input type="text" name="party" value="<?= $leader['party'] ?>" required><br><br>
    <button type="submit" name="update">Update</button>
</form>
<p style="text-align:center;"><a href="admin_manage_leaders.php">⬅ Back</a></p>
</body>
</html>

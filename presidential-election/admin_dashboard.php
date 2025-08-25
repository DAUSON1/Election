<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
include "db.php";

$result = $conn->query("SELECT * FROM leaders");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<style>
body{font-family: Arial; background:#f4f4f4; margin:0; padding:0;}
table{width:80%; margin:20px auto; border-collapse: collapse; background:#fff;}
th, td{padding:10px; border:1px solid #ddd; text-align:center;}
th{background:#333; color:#fff;}
a{color:#007bff; text-decoration:none;}
a:hover{color:#0056b3;}
h1{text-align:center;}
.logout{position:absolute; top:10px; right:20px;}
</style>
</head>
<body>
<h1>Admin Dashboard</h1>
<p class="logout"><a href="logout.php">Logout</a></p>

<p style="text-align:center;"><a href="add_leader.php">Add New Leader</a></p>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Party</th>
<th>Votes</th>
<th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['party'] ?></td>
<td><?= $row['votes'] ?></td>
<td>
    <a href="edit_leader.php?id=<?= $row['id'] ?>">Edit</a> | 
    <a href="delete_leader.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>

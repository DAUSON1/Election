<?php
session_start();
include "db.php";
if(!isset($_SESSION['admin'])){
    header("Location: admin_dashboard.php");
    exit;
}

// delete leader
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM leaders WHERE id=$id");
    header("Location: admin_manage_leaders.php");
}

// fetch leaders
$result = $conn->query("SELECT * FROM leaders");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Leaders</title>
    <style>
        body{font-family:Arial;background:#f4f4f4;}
        table{width:80%;margin:20px auto;border-collapse:collapse;background:#fff;}
        th,td{padding:10px;border:1px solid #ddd;text-align:center;}
        th{background:#333;color:#fff;}
        a.btn{padding:5px 10px;background:#28a745;color:#fff;text-decoration:none;border-radius:3px;}
        a.btn:hover{background:#218838;}
        a.del{background:#dc3545;}
        a.del:hover{background:#c82333;}
    </style>
</head>
<body>
<h1 style="text-align:center;">Manage Leaders</h1>
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
        <a class="btn" href="edit_leader.php?id=<?= $row['id'] ?>">Edit</a>
        <a class="btn del" href="admin_manage_leaders.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this leader?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
<p style="text-align:center;"><a href="add_leader.php" class="btn">+ Add New Leader</a></p>
<p style="text-align:center;"><a href="admin_dashboard.php">⬅ Back to Dashboard</a></p>
</body>
</html>

<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit;
}
include "db.php";
$user_id = $_SESSION['user_id'];

// Fetch leaders
$result = $conn->query("SELECT * FROM leaders");

// Check which leader user has voted for
$voted = [];
$res = $conn->query("SELECT leader_id FROM votes WHERE user_id=$user_id");
while($row = $res->fetch_assoc()) $voted[] = $row['leader_id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>
<style>
body{font-family: Arial; background:#f4f4f4; margin:0; padding:0;}
table{width:80%; margin:20px auto; border-collapse: collapse; background:#fff;}
th, td{padding:10px; border:1px solid #ddd; text-align:center;}
th{background:#333; color:#fff;}
h1{text-align:center;}
.vote-btn{padding:5px 10px; background:#28a745; color:#fff; border:none; cursor:pointer;}
.vote-btn:hover{background:#218838;}
.logout{position:absolute; top:10px; right:20px;}
</style>
</head>
<body>
<h1>Welcome, <?= $_SESSION['username'] ?></h1>
<p class="logout"><a href="user_logout.php">Logout</a></p>

<table>
<tr>
<th>Name</th>
<th>Party</th>
<th>Votes</th>
<th>Vote</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['name'] ?></td>
<td><?= $row['party'] ?></td>
<td><?= $row['votes'] ?></td>
<td>
<?php if(in_array($row['id'],$voted)): ?>
<span>Voted</span>
<?php else: ?>
<form method="post" action="user_vote.php">
<input type="hidden" name="leader_id" value="<?= $row['id'] ?>">
<button class="vote-btn" type="submit">Vote</button>
</form>
<?php endif; ?>
</td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>

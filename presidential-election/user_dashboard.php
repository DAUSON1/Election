<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit;
}
include "db.php";
$user_id = $_SESSION['user_id'];

// Fetch all leaders
$result = $conn->query("SELECT * FROM leaders");

// Check if user has voted already
$votedLeader = null;
$res = $conn->query("SELECT leader_id FROM votes WHERE user_id=$user_id LIMIT 1");
if($res->num_rows > 0){
    $rowV = $res->fetch_assoc();
    $votedLeader = $rowV['leader_id'];
}

// Leaderboard (top candidates by votes)
$leaders = $conn->query("SELECT * FROM leaders ORDER BY votes DESC");
$totalVotes = $conn->query("SELECT SUM(votes) as total FROM leaders")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Dashboard</title>
<style>
body {
    margin:0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f4f4;
}
header {
    background: #007bff;
    color: #fff;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}
header h1 { margin:0; font-size:20px; }
header a.logout-btn {
    background:#ff4d4d; color:#fff; padding:8px 15px; border-radius:6px;
    text-decoration:none; font-weight:bold; transition:0.3s;
}
header a.logout-btn:hover { background:#e60000; }
table{
    width:85%;
    margin:20px auto;
    border-collapse: collapse;
    background:#fff;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}
th, td{padding:12px; border:1px solid #ddd; text-align:center;}
th{background:#333; color:#fff;}
.vote-btn{padding:6px 12px; background:#28a745; color:#fff; border:none; cursor:pointer; border-radius:4px;}
.vote-btn:disabled{background:#999; cursor:not-allowed;}
.vote-btn:hover:not(:disabled){background:#218838;}

/* Slider */
.slider {
  width: 450px;
  height: 350px;
  margin:40px auto;
  overflow: hidden;
  border-radius:10px;
  background:#fff;
  box-shadow:0 4px 12px rgba(0,0,0,0.2);
}
.slides {
  display: flex;
  transition: transform 1s ease-in-out;
}
.slide {
  min-width:100%;
  padding:20px;
  text-align:center;
  box-sizing:border-box;
}
.slide img {
  width:120px;
  height:120px;
  border-radius:50%;
  border:3px solid #333;
  margin-bottom:15px;
}
.first-place { background: gold; border-radius:10px; }
.slide h3 { margin:5px 0; }
.slide p { margin:4px 0; }
</style>
</head>
<body>

<header>
    <h1>Welcome, <?= $_SESSION['username'] ?></h1>
    <a href="user_logout.php" class="logout-btn">Logout</a>
</header>

<table>
<tr>
<th>Photo</th>
<th>Name</th>
<th>Party</th>
<th>Votes</th>
<th>Vote</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><img src="<?= $row['image'] ?>" alt="<?= $row['name'] ?>" width="60" height="60"></td>
<td><?= $row['name'] ?></td>
<td><?= $row['party'] ?></td>
<td><?= $row['votes'] ?></td>
<td>
<?php if($votedLeader): ?>
    <?php if($votedLeader == $row['id']): ?>
        <span>✅ Your Vote</span>
    <?php else: ?>
        <button class="vote-btn" disabled>Vote</button>
    <?php endif; ?>
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

<!-- Leaderboard -->
<h2 style="text-align:center; margin-top:50px;">🏆 Live Leaderboard</h2>
<div class="slider">
    <div class="slides">
        <?php 
        $rank=1;
        $leaders->data_seek(0); // reset pointer
        while($l = $leaders->fetch_assoc()): 
            $percent = $totalVotes > 0 ? round(($l['votes']/$totalVotes)*100,1) : 0;
        ?>
        <div class="slide <?= $rank==1 ? 'first-place' : '' ?>">
            <img src="<?= $l['image'] ?>" alt="<?= $l['name'] ?>">
            <h3>#<?= $rank ?> <?= $l['name'] ?></h3>
            <p><strong>Party:</strong> <?= $l['party'] ?></p>
            <p><strong>Votes:</strong> <?= $l['votes'] ?> (<span><?= $percent ?>%</span>)</p>
        </div>
        <?php $rank++; endwhile; ?>
    </div>
</div>

<script>
let currentIndex = 0;
const slides = document.querySelector(".slides");
const totalSlides = document.querySelectorAll(".slide").length;

function showSlide(index){
  slides.style.transform = `translateX(${-index * 100}%)`;
}

setInterval(()=>{
  currentIndex = (currentIndex + 1) % totalSlides;
  showSlide(currentIndex);
},5000);
</script>

</body>
</html>

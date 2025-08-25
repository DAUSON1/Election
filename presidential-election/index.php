<?php
include "db.php";

// Fetch leaders
$result = $conn->query("SELECT * FROM leaders");
$total_votes = $conn->query("SELECT SUM(votes) as total FROM leaders")->fetch_assoc()['total'];

// Prepare data for charts
$leader_names = [];
$leader_votes = [];
$result->data_seek(0);
while($row = $result->fetch_assoc()){
    $leader_names[] = $row['name'];
    $leader_votes[] = $row['votes'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Presidential Election Dashboard</title>
    <style>
        body{font-family: Arial; background:#f4f4f4; margin:0; padding:0;}
        table{width:80%; margin:20px auto; border-collapse: collapse; background:#fff;}
        th, td{padding:10px; border:1px solid #ddd; text-align:center;}
        th{background:#333; color:#fff;}
        h1{text-align:center;}
        .vote-btn{padding:5px 10px; background:#28a745; color:#fff; border:none; cursor:pointer;}
        .vote-btn:hover{background:#218838;}
        #chart-container{width:80%; margin:30px auto; background:#fff; padding:20px; border-radius:5px;}
        .charts{display:flex; justify-content: space-around; flex-wrap: wrap;}
        canvas{background:#fff; padding:10px; border-radius:5px;}
    </style>
</head>
<body>
<h1>Presidential Election Simulation</h1>

<table>
<tr>
    <th>Name</th>
    <th>Party</th>
    <th>Votes</th>
    <th>Percentage</th>
    <th>Vote</th>
</tr>

<?php
$result->data_seek(0);
while($row = $result->fetch_assoc()):
?>
<tr>
    <td><?= $row['name'] ?></td>
    <td><?= $row['party'] ?></td>
    <td><?= $row['votes'] ?></td>
    <td><?= $total_votes ? round(($row['votes']/$total_votes)*100,2)."%" : "0%" ?></td>
    <td>
        <form method="post" action="vote.php">
            <input type="hidden" name="leader_id" value="<?= $row['id'] ?>">
            <button class="vote-btn" type="submit">Vote</button>
        </form>
    </td>
</tr>
<?php endwhile; ?>
</table>

<p style="text-align:center;"><a href="add_leader.php">Add New Leader</a></p>

<div id="chart-container" class="charts">
    <canvas id="barChart" width="400" height="250"></canvas>
    <canvas id="pieChart" width="400" height="250"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const leaderNames = <?= json_encode($leader_names) ?>;
const leaderVotes = <?= json_encode($leader_votes) ?>;

// Bar Chart
const ctxBar = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: leaderNames,
        datasets: [{
            label: 'Votes',
            data: leaderVotes,
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: { y: {beginAtZero:true, precision:0} }
    }
});

// Pie Chart
const ctxPie = document.getElementById('pieChart').getContext('2d');
const pieChart = new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: leaderNames,
        datasets: [{
            label: 'Vote Percentage',
            data: leaderVotes,
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)'
            ],
            borderColor: 'rgba(255,255,255,1)',
            borderWidth:1
        }]
    },
    options: { responsive:true }
});
</script>

</body>
</html>

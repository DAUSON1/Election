<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .header {
            background: #2c3e50;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .sidebar {
            width: 220px;
            background: #34495e;
            position: fixed;
            top: 0;
            bottom: 0;
            padding-top: 20px;
        }
        .sidebar a {
            display: block;
            color: #ecf0f1;
            padding: 12px 20px;
            text-decoration: none;
            margin: 5px 0;
        }
        .sidebar a:hover {
            background: #1abc9c;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
        }
        h2 {
            margin-top: 0;
        }
        .logout {
            background: #e74c3c !important;
            color: white !important;
        }
        .logout:hover {
            background: #c0392b !important;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>🗳️ Admin Dashboard</h1>
        <p>Welcome, <?= $_SESSION['admin'] ?>!</p>
    </div>

    <div class="sidebar">
        <a href="admin_dashboard.php">🏠 Dashboard</a>
        <a href="admin_manage_leaders.php">👔 Manage Leaders</a>
        <a href="add_leader.php">➕ Add Leader</a>
        <a href="index.php">📊 View Public Results</a>
        <a class="logout" href="logout.php">🚪 Logout</a>
    </div>

    <div class="content">
        <div class="card">
            <h2>Quick Overview</h2>
            <p>✔ Manage presidential candidates (leaders)</p>
            <p>✔ Monitor real-time votes and results</p>
            <p>✔ Add, Edit or Delete candidates</p>
        </div>

        <div class="card">
            <h2>Next Steps</h2>
            <ul>
                <li>Go to <b>Manage Leaders</b> to update candidates.</li>
                <li>Use <b>View Public Results</b> to see voting trends.</li>
                <li>Remember to <b>Logout</b> after finishing your session.</li>
            </ul>
        </div>
    </div>

</body>
</html>

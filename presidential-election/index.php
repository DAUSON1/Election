<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Presidential Election Simulation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
        }
        /* Topbar */
        .topbar {
            background: #2c3e50;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar h2 {
            margin: 0;
        }
        .topbar .menu a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }
        .topbar .menu a:hover {
            color: #1abc9c;
        }
        /* Content */
        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
            text-align: center;
        }
        .content h1 {
            font-size: 40px;
            color: #2c3e50;
        }
        .content p {
            font-size: 18px;
            color: #555;
        }
        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .footer a {
            color: #1abc9c;
            margin: 0 10px;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Topbar -->
    <div class="topbar">
        <h2>🗳️ Presidential Election Simulation</h2>
        <div class="menu">
            <a href="user_login.php">Login</a>
            <a href="user_register.php">Sign Up</a>
            <a href="admin_login.php">Manager</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div>
            <h1>Welcome to the Presidential Election Simulation System</h1>
            <p>Track leaders, simulate voting, and view results in real-time.</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <a href="#">About Us</a> | 
        <a href="#">Contact Us</a> | 
        <a href="#">Help</a>
    </div>

</body>
</html>

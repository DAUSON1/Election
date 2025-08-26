<?php
session_start();
include "db.php";

$error = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $result = $conn->query("SELECT * FROM admins WHERE username='$username' AND password='$password'");
    if($result->num_rows > 0){
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body{font-family:Arial;background:#f4f4f4;}
        .login-box{width:300px;margin:100px auto;padding:20px;background:#fff;border-radius:5px;box-shadow:0 0 10px #aaa;}
        h2{text-align:center;}
        input[type=text],input[type=password]{width:100%;padding:10px;margin:5px 0;}
        button{padding:10px;width:100%;background:#333;color:#fff;border:none;}
        button:hover{background:#555;}
        .error{color:red;text-align:center;}
    </style>
</head>
<body>
<div class="login-box">
    <h2>Admin Login</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
    <p class="error"><?= $error ?></p>
</div>
</body>
</html>

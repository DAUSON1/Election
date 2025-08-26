<?php
include "db.php";
$error = "";
if(isset($_POST['register'])){
    $username = trim($_POST['username']);
    $password = md5($_POST['password']); // simple hash

    $check = $conn->query("SELECT * FROM users WHERE username='$username'");
    if($check->num_rows > 0){
        $error = "⚠️ Username already exists!";
    } else {
        $conn->query("INSERT INTO users (username,password) VALUES ('$username','$password')");
        header("Location: user_login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Registration</title>
<style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: linear-gradient(135deg, #007bff, #6c63ff);
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }
    .register-container {
        background: #fff;
        padding: 30px 25px;
        width: 350px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        text-align: center;
        animation: fadeIn 0.8s ease-in-out;
    }
    h1 {
        margin-bottom: 20px;
        color: #333;
        font-size: 24px;
    }
    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
    }
    input[type=submit] {
        width: 100%;
        padding: 12px;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        transition: 0.3s;
    }
    input[type=submit]:hover {
        background: #0056b3;
    }
    .error {
        color: red;
        margin-bottom: 10px;
        font-size: 14px;
    }
    p {
        margin-top: 15px;
        font-size: 14px;
    }
    a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }
    a:hover {
        text-decoration: underline;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>
<body>
    <div class="register-container">
        <h1>Create Account</h1>
        <?php if($error) echo "<p class='error'>$error</p>"; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Choose a Username" required>
            <input type="password" name="password" placeholder="Choose a Password" required>
            <input type="submit" name="register" value="Register">
        </form>
        <p>Already have an account? <a href="user_login.php">Login</a></p>
    </div>
</body>
</html>

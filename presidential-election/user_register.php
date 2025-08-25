<?php
include "db.php";
$error = "";
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']); // simple hash
    
    $check = $conn->query("SELECT * FROM users WHERE username='$username'");
    if($check->num_rows > 0){
        $error = "Username already exists!";
    } else {
        $conn->query("INSERT INTO users (username,password) VALUES ('$username','$password')");
        header("Location: user_login.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Registration</title>
<style>
body{font-family: Arial; background:#f4f4f4; padding:20px;}
form{background:#fff; padding:20px; width:300px; margin:auto; border-radius:5px;}
input[type=text], input[type=password]{width:100%; padding:10px; margin:5px 0;}
input[type=submit]{padding:10px 15px; background:#007bff; color:#fff; border:none; cursor:pointer;}
input[type=submit]:hover{background:#0056b3;}
h1{text-align:center;}
.error{color:red; text-align:center;}
</style>
</head>
<body>
<h1>User Registration</h1>
<?php if($error) echo "<p class='error'>$error</p>"; ?>
<form method="post">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<input type="submit" name="register" value="Register">
</form>
<p style="text-align:center;"><a href="user_login.php">Login</a></p>
</body>
</html>

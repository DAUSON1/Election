<?php
include "db.php";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $party = $_POST['party'];
    
    // Handle image upload
    $image = $_FILES['image']['name'];
    $target = "images/".basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    
    $conn->query("INSERT INTO leaders (name, party, image) VALUES ('$name', '$party', '$target')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Leader</title>
    <style>
        body{font-family: Arial; background:#f4f4f4; padding:20px;}
        form{background:#fff; padding:20px; width:400px; margin:auto; border-radius:5px;}
        input[type=text], input[type=file]{width:100%; padding:10px; margin:5px 0;}
        input[type=submit]{padding:10px 15px; background:#007bff; color:#fff; border:none; cursor:pointer;}
        input[type=submit]:hover{background:#0056b3;}
        h1{text-align:center;}
    </style>
</head>
<body>
<h1>Add New Leader</h1>
<form method="post" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="name" required>
    
    <label>Party:</label>
    <input type="text" name="party" required>
    
    <label>Image:</label>
    <input type="file" name="image">
    
    <input type="submit" name="submit" value="Add Leader">
</form>
<p style="text-align:center;"><a href="index.php">Back to Dashboard</a></p>
</body>
</html>

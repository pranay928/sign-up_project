<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: login_page.php");
    exit();
}

// Retrieve user data from the database
$username = $_SESSION['username'];
$query = "SELECT * FROM usermgmt WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $name = $user['name'];
    $email = $user['email'];
    $tag = $user['tag'];
    $username = $user['username'];
    $pass = $user['pass'];
} else {
    echo "User not found.";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
         body{
            background-color:rgb(242, 242, 243);
        }
        .container {
            background-color: #B7B1F2;            
            color: white;
            font-size: 20px;
            font-weight: bold;
            font-family:  sans-serif;
            border: 10px shadow black;
            box-shadow: 0px 0px 10px 10px rgba(218, 208, 208, 0.5); 
            width: 50%;
            margin: 10% 25%;
            padding: 20px 50px;
            border-radius: 10px;


        }
    </style>
    <title>Profile</title>
</head>
<body>
    <div class="container">
        <h1>Profile </h1>
        <div>
        <p>Username: <?php echo $username ?> </p>
        <p>name:  <?php echo $name ?></p>
        <p>email:  <?php echo $email ?></p>
        <p>tagline:  <?php echo $tag ?></p>
        </div>
        <div>
            <a href="logout_page.php">Logout</a>
        </div>
                
    </div>
    
</body>
</html>

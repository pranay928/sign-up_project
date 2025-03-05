<?php
session_start();
include 'connection.php';

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //chake if user 
  
    $usernameErr = $passwordErr = "";
    $validate = true;
    if(empty($username)){
        $usernameErr = "Username is required";
        $validate = false;
    }
    if(empty($password)){
        $passwordErr = "Password is required";
        $validate = false;
    }
    if($validate){
        // Modified query execution and checking 
        $sql = "SELECT username, pass FROM usermgmt WHERE username = '$username' AND pass = '$password'";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0){
            $_SESSION['username'] = $username;
            echo "Login successful";
            header("Location: profile.php");
            exit();
        } else {
            $loginError = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In</title>
    <style>
        body{
            background-color:rgb(242, 242, 243);
        }
        .container {
            background-color: #B7B1F2;           
            color: black;
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
        h1 {
            color: white;
            font-size: 30px;
            font-weight: bold;
            font-family: sans-serif;
            margin: 10px;
        }
        input[type="text"] {
            padding: 5px;
            margin: 5px;
            border-radius: 6px;
        }
        input[type="password"] {
            padding: 5px;
            margin: 5px;
            border-radius: 6px;
        }
        input[type="submit"] {
            text-decoration: none;
            font-size : 18px;
            font-weight: bold;
            color: white;
            background-color:rgb(73, 224, 98);
            border: 1px solid #ccc;
            border-radius: 7px;
            font-family: sans-serif;
            padding: 5px 10px;
        }
        .buttons {
            display: flex;
            justify-content: space-between;

        }
        input[type="submit"]:hover {
            color: green;
        }
        a {
            text-decoration: none;
            color: white;
            background-color:rgb(73, 224, 98);
            border: 1px solid #ccc;
            border-radius: 7px;
            font-family: sans-serif;
            padding: 5px 10px;
        }
        a:hover {
            color: green;
        }
        .error {
            color: red;
            font-size: 14px;
            
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Log-In</h1>
        <?php if(isset($loginError)) echo "<p class='error'>$loginError</p>"; ?>
        <Form action="" method="POST">
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username" placeholder="Enter your username">
            <?php if(isset($usernameErr)) echo "<span class='error'>$usernameErr</span>"; ?><br>
            
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" placeholder="Enter your password">
            <?php if(isset($passwordErr)) echo "<span class='error'>$passwordErr</span>"; ?><br>
         <div class="buttons">
            <input type="submit" name="submit" value="Log-In">
            <a href="register_page.php">Sign-Up</a>
         </div>
        </Form>    
    </div>
</body>
</html>

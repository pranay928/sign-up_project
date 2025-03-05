<?php
include 'connection.php';
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tag = $_POST['tag'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    // check if user exists
    $sql = "SELECT * FROM usermgmt WHERE username = '$username'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo "User already exists";
        exit();
    }
    //validation of form
    $nameErr = $emailErr = $tagErr = $usernameErr = $passErr = "";
    $validate = true;
    if(empty($name)){
        $nameErr = "Name is required";
        $validate = false;        
    }
    if(empty($email)){
        $emailErr = "Email is required";
        $validate = false;        
    }   
    if(empty($username)){
        $usernameErr = "Username is required";
        $validate = false;        
    }
    if(empty($pass)){
        $passErr = "Password is required";
        $validate = false;        
    }
    if($validate){
        $sql = "INSERT INTO usermgmt (name , email , tag , username , pass ) VALUES ('$name' , '$email' , '$tag' , '$username' , '$pass')";
        if($conn->query($sql) === TRUE){  
            echo "Record added successfully"; 
            $success = true;
            header("Location: login_page.php");    
            
            exit();
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
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
            display: flex;
            flex-direction: column;
            
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
            color: white;
            font-size : 18px;
            font-weight: bold;
            background-color:rgb(73, 224, 98);
            border: 1px solid #ccc;
            border-radius: 7px;
            font-family: sans-serif;
            padding: 5px 10px;
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

    </style>

</head>
<body>
    <div class="container">
        <div class="form">
        <h1>Sign-Up</h1>
        <?php if(isset($nameErr) || isset($emailErr) || isset($tagErr) || isset($usernameErr) || isset($passErr)){ ?>
            <p style="color:red">Please fill all the fields</p>
        <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <leable for="name">Name</leable><br>

        <input type="text" name="name" id="name" <?php echo isset($nameErr) ? $nameErr : ''; ?>><br>

        <leable for="email">Email</leable><br>

        <input type="text" name="email" id="email" <?php echo isset($emailErr) ? $emailErr : ''; ?>><br>

        <leable for="tag">tagline</leable ><br>

        <input type="text" name="tag" id="tag" <?php echo isset($tagErr) ? $tagErr : ''; ?>><br>

        <leable for="username">UserName</leable><br>

        <input type="text" name="username" id="username" <?php echo isset($usernameErr) ? $usernameErr : ''; ?>><br>

        <leable for="pass">Password</leable><br>

        <input type="password" name="pass" id="pass" <?php echo isset($passErr) ? $passErr : ''; ?>><br>

        <input type="submit" value="sign-up" name="submit" id="submit"><br>
    </form>
        </div>
        <div class="login">
            <p>Already have an account?</p>
            <a href="login_page.php"> Login</a>
        </div>

        <?php if(isset($success)){ ?>
            <p style="color:green">You have successfully registered</p>
        <?php } ?>
   
    </div>
    
</body>
</html>
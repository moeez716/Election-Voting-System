<?php
include "connection.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){   
     if($_POST["action"]=="login"){
        $adminid=$_POST["adminid"];
        $pass=$_POST["password"];
        $selection="SELECT * FROM `admin` WHERE AdminID='$adminid' AND Password='$pass'";
$result=mysqli_query($conn,$selection);
if(mysqli_num_rows($result)>0){

$row=mysqli_fetch_assoc($result);
echo "<form id='redirectForm' action='adminpage.php' method='POST'>
<input type='hidden' name='adminid' value='$adminid'>
</form>";
echo "<script>document.getElementById('redirectForm').submit();</script>";
exit();


    
}
else{
    echo "<script>alert('Invalid Username or Password!');</script>";
}
}

}


    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polling System</title>
    <link rel="stylesheet" href="indexstyle.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:whitesmoke;
        }
        .navbar {
            background-color:#0056b3;
            color: white;
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }
        .navbar img {
            height: 40px;
            margin-right: 10px;
        }
        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }
        .container1 {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            display: none;
        }
        .container1.active {
            display: block;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        .buttons button {
            margin: 5px;
            padding: 10px 20px;
            border: none;
            background: #6e9b9c; /* Muted Teal */
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        .buttons button:hover {
            background: #478484;
        }
        .error{
            color: red;
        }
    </style>
</head>
<body>
<header>
    <div class="container header-container">
      <h1>Election Voting System</h1>
      <nav>
        <ul class="nav-links">
          <li><a href="index.html">Home</a></li>
          <li><a href="vote.php">Vote Now</a></li>
          <li><a href="count.php">Result</a></li>
        </ul>
        <button class="menu-toggle" id="menuToggle">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </nav>
    </div>
  </header>

  <main>
    

    <div class="container1 active" id="loginForm">
        <h2>Login</h2>
        <form action="adminlogin.php" method="post">
            <div class="form-group" >
                <input type="hidden" name="action" value="login">
                <label for="adminid">AdminID:</label>
                <input type="text" id="adminid" name="adminid" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="buttons">
                <button type="submit">Log In</button>
               
            </div>
        </form>
    </div>

   

    
</body>
</html>

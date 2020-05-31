<?php
  session_start();
  error_reporting(1);
  $user = $_SESSION['Username'];
  if(isset($user))
  {
     header("Location:addpa.php");
  }
?>
<html>
  <head>
<link href="style.css" rel="stylesheet" id="bootstrap-css">
 <?php include 'Header.php';?>
</head>
<body id="LoginForm">
<div class="container">
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Admin Login</h2>
   <p>Please enter your username and password</p>
   </div>
    <form id="Login" action="put2.php" method="POST">
        <div class="form-group">
            <input type="text" class="form-control1" name="uname" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control1" name="pass" placeholder="Password">
        </div>
        <br>
        <button type="submit" class="btn btn-primary" name="submit">Login</button>
    </form>
    </div>
</div></div></div>

</body>
</html>

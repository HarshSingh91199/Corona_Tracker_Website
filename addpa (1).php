<?php
  session_start();
  $user = $_SESSION['Username'];
  if(!isset($user))
  {
     header("Location:login.php");
  }
?>
<html>
  <head>
    <style>
      iframe{
      margin: 0 auto;
      display:block;
    }
    </style>
<link href="style.css" rel="stylesheet" id="bootstrap-css">
 <?php include 'Header.php';?>
</head>
<body id="LoginForm">
<div class="container">
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Add Patient</h2>
   <p>Please enter the detail</p>
   </div>
    <form id="Login" action="put.php" method="GET">
        <div class="form-group">
            <input type="text" class="form-control1" name="name" placeholder="Name">
        </div>
        <div class="form-group">
            <textarea name="add" class="form-control1" placeholder="Address" required="" style="width: 100%; height: 80px;"></textarea>
        </div>
        <div class="form-group">
            <input type="text" class="form-control1" name="lat" placeholder="Latitute">
        </div>
        <div class="form-group">
            <input type="text" class="form-control1" name="lng" placeholder="Longitute">
        </div>
        <div class="form-group">
            <input type="text" class="form-control1" name="count" placeholder="Cases">
        </div>
        <br>
            <button type="submit" class="btn btn-primary" name="submit">Add</button>
    </form>
    </div>
</div></div>
 <iframe src="https://www.latlong.net/" title ="Ckeck Co-orndinates below" width="80%" height="600px" align="center" ></iframe>
</body>
</html>


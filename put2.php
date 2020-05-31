<?php
include_once 'dbConfig.php';
session_start();
if(isset($_POST['submit'])){
	$uname =$_POST['uname'];
	$pass = $_POST['pass']; 
	$query = "SELECT * FROM login WHERE uname='$uname' AND pass='$pass';";
	$result =mysqli_query($db, $query);
	$check = mysqli_num_rows($result);
	if($check <=0)
	{
		echo "Your not a vaild user";
	}
	else{

		$row = mysqli_fetch_assoc($result);
		echo "Welcome  ".$row['uname']."<br>";
  		$_SESSION['Username'] = $uname;
  		$_SESSION['success'] = "You are now logged in";
		header("Location:addpa.php");
	}
}
?>

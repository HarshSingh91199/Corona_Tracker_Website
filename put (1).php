
<?php
include_once 'dbConfig.php';
$name = mysqli_real_escape_string($db, $_GET['name']);
$addr = mysqli_real_escape_string($db, $_GET['add']);
$lat = mysqli_real_escape_string($db, $_GET['lat']);
$lng = mysqli_real_escape_string($db, $_GET['lng']);
$count = mysqli_real_escape_string($db, $_GET['count']);
$sql = "INSERT INTO `locations` ( `latitude`, `longitude`, `name`, `Address`, `count`) VALUES ( ?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($db);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		echo "Error";
	}
	else{
		mysqli_stmt_bind_param($stmt, "ddssi", $lat, $lng, $name, $addr, $count);
		mysqli_stmt_execute($stmt);
		header("Location:addpa.php?put=success");
	}

?>

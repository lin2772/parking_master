<?php
	$username = $_POST["username"];
	$password = $_POST["password"];
	//echo $SSN;
	$con = mysqli_connect('localhost','phpuser','phpwd','wa7');
	If(!$con)
	{die('Could not connect'.mysqli_connect_error());
	}
	$sql="select Username, Password from Users where Username = '$username' and Password = '$password'";
	$result=mysqli_query($con, $sql) or die(mysqli_error($con));
	if($row = mysqli_fetch_array($result))
	{
		echo "Welcome ",$row['Username'];
	}
	else{
		echo"Invalid password";
	}
?>
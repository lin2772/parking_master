<?php
	$SSN = $_POST["ssn"];
	$con = mysqli_connect('localhost','phpuser','phpwd','company');
	If (!$con)
	{ die('Could not connect'.mysqli_connect_error());
	}
	$sql="select Dno from EMPLOYEE where Ssn = '$SSN'";
	$result=mysqli_query($con, $sql) or die(mysqli_error($con));
	While ( $row = mysqli_fetch_array($result))
	{
		echo "Dno of ", $SSN, " is ", $row['Dno'];
	}
?>

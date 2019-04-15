<?php
	session_start();
	$USERNAME = $_SESSION["login"];

	$GARAGENAME = $_POST["GarageName"];
	//$LEVELNUM = $_POST["LevelNumber"];
	$NEWVIPSPACES = $_POST["NewVipSpaces"];
	

	if(empty($GARAGENAME) || empty($NEWVIPSPACES))
	{
		echo "Missing information!";
	}

	$con = mysqli_connect('localhost', 'phpuser', 'phpwd', 'parkingmaster');
	IF(!$con)
	{
		die('Could not connect'.mysqli_connect_error());
	}

    $sql_garageid = "SELECT garageid from GARAGE where garagename='$GARAGENAME'";
    $result_garageid = mysqli_query($con, $sql_garageid) or die(mysqli_error($con));
    While($row = mysqli_fetch_array($result_garageid))
    {
    	$GARAGEID = $row['garageid'];
    }

	$sql_update = "UPDATE GARAGE_LEVEL SET VIPSPACES = $NEWVIPSPACES
	WHERE garageid = '$GARAGEID'";

	if(mysqli_query($con,$sql_update))
	{
		echo "VIP Spaces updated successfully";
	}else{
		echo "ERROR: Space Edits Fail";
	}

	
?>	
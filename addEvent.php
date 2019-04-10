<?php
	session_start();
	$USERNAME = $_SESSION["login"];

	$NAME = $_POST["EventName"];
	//$VENUENAME = $_POST["VenueName"];
	$DATE = $_POST["EventDate"];
	//$DATERESERVED = date('Y-m-d');
	//$EVENTPRICE = $_POST["EventPrice"];
	//$GARAGENAME = $_POST["GarageName"];
	//$LEVELNUM = $_POST["LevelNum"];
	$NEWDATE = $_POST["NewOldDate"];

	if(empty($NAME))
	{
		echo "Missing information!";
	}

	$con = mysqli_connect('localhost', 'phpuser', 'phpwd', 'parkingmaster');
	IF(!$con)
	{
		die('Could not connect'.mysqli_connect_error());
	}

	if(empty($NEWDATE))
	{
		$sql_insert = "INSERT into EVENT(
			Name, Date) values 
			( '$Name', '$Date')";
			if(mysqli_query($con,$sql_insert))
			{
				echo "Event added successfully";
			}else{
				echo "ERROR";
			}
	}else
	{
		$sql_update = "UPDATE EVENT SET Date = '$NEWDATE' WHERE Name = '$Name'";
			if(mysqli_query($con,$sql_update))
			{
				echo "Event updated successfully";
			}else{
				echo "ERROR";
			}
	}

	

	
?>	
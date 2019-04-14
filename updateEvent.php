<?php
	session_start();
	$USERNAME = $_SESSION["login"];
	$EVENTNAME = $_POST["OldEventName"];
	$NEWEVENTDATE = $_POST["NewEventDate"];

	if(empty($EVENTNAME) || empty($NEWEVENTDATE))
	{
		echo "Missing information!";
	}

	$con = mysqli_connect('localhost', 'phpuser', 'phpwd', 'parkingmaster');
	IF(!$con)
	{
		die('Could not connect'.mysqli_connect_error());
	}

	$EVENTID = "SELECT eventid FROM event where eventname = '$EVENTNAME'";

	$sql_update = "UPDATE EVENT_DATE set date = '$NEWEVENTDATE'
	where eventid = $EVENTID";

	if(mysqli_query($con, $sql_update))
	{
		echo "Event update successfully";
	}else{
		echo "ERROR: Event Update Fail";
	}
<?php
	session_start();
	$USERNAME = $_SESSION["login"];
	$EVENTNAME = $_POST["OldEventName"];
	$NEWEVENTDATE = $_POST["NewEventDate"];
	$EVENTID=-1;

	if(empty($EVENTNAME) || empty($NEWEVENTDATE))
	{
		echo "Missing information!";
	}

	$con = mysqli_connect('localhost', 'phpuser', 'phpwd', 'parkingmaster');
	IF(!$con)
	{
		die('Could not connect'.mysqli_connect_error());
	}

	$sql_eventid = "select Eventid FROM event where Eventname = '$EVENTNAME'";
	$result_eventid=mysqli_query($con, $sql_eventid) or die( mysqli_error($con));
	while($row = mysqli_fetch_array($result_eventid)){
		$EVENTID=$row['Eventid'];
	}

	$sql_update =  "update event_date set Date='$NEWEVENTDATE' where Eventid = $EVENTID";
	$sql_result = mysqli_query($con, $sql_update) or die(mysqli_error($con));
	echo $EVENTNAME.'<br>';
	echo $EVENTID.'<br>';
	echo $NEWEVENTDATE.'<br>';
/*	if(mysqli_query($con, $sql_update))
	{
		echo "Event update successfully";
	}else{
		echo "ERROR: Event Update Fail";
	}*/

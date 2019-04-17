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

	$sql_eventid = "SELECT eventid FROM event where eventname = '$EVENTNAME'";
	$result_eventid=mysqli_query($con, $sql_eventid) or die( mysqli_error($con));
	while($row = mysqli_fetch_array($result_eventid)){
		$EVENTID=$row['eventid'];
	}

	$sql_update = "UPDATE EVENT_DATE set date = '$NEWEVENTDATE'
	where eventid = '$EVENTID'";
	echo $EVENTNAME;
	echo $EVENTID;
	echo $NEWEVENTDATE;
	if(mysqli_query($con, $sql_update))
	{
		echo "Event update successfully";
	}else{
		echo "ERROR: Event Update Fail";
	}

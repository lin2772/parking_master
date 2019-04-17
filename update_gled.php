<?php
	session_start();
	$USERNAME = $_SESSION["login"];

	$GARAGENAME = $_POST["GarageName"];
	$LEVELNUM = $_POST["LevelNum"];
	$EVENTNAME = $_POST["EventID"];
	$DATE = $_POST["Date"];
	$CAPACITY = $_POST["Capacity"];
	$PRICE = $_POST["Price"];
	$GARAGEID;
	$EVENTID;

	if(empty($GARAGENAME) || empty($LEVELNUM) || empty($EVENTNAME) || empty($DATE) || empty($CAPACITY) || empty($PRICE))
	{
		echo "Missing information!";
	}

	$con = mysqli_connect('localhost', 'phpuser', 'phpwd', 'parkingmaster');
	IF(!$con)
	{
		die('Could not connect'.mysqli_connect_error());
	}

    $sql_garageid = "SELECT garageid from garage where garagename ='$GARAGENAME'";
    $result_garageid = mysqli_query($con, $sql_garageid) or die(mysqli_error($con));
	While($row = mysqli_fetch_array($result_garageid))
    {
    	$GARAGEID = $row['garageid'];
    }

    $sql_eventid = "SELECT eventid from event natural join event_date where (eventname ='$EVENTNAME' and date = '$DATE')";
    $result_eventid = mysqli_query($con, $sql_eventid) or die(mysqli_error($con));
	While($row = mysqli_fetch_array($result_eventid))
    {
    	$EVENTID = $row['eventid'];
    }

    $sql_insert = "INSERT into garage_level_event_date values ($GARAGEID, $LEVELNUM, $EVENTID, '$DATE', $CAPACITY, $PRICE)";
    if(mysqli_query($con, $sql_insert)){
    	echo "Success";
    }else{
    	echo "Fail";
    }

?>
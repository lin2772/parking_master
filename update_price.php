
<?php
	session_start();
	$USERNAME = $_SESSION["login"];

	$GARAGENAME = $_POST["GarageName"];
	$LEVELNUM = $_POST["LevelNum"];
	$EVENTNAME = $_POST["EventID"];
	$DATE = $_POST["Date"];

	$PRICE = $_POST["Price"];
	$GARAGEID;
	$EVENTID;

	if(empty($GARAGENAME) || empty($LEVELNUM) || empty($EVENTNAME) || empty($DATE) || empty($PRICE))
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

	$sql_update_price = "UPDATE garage_level_event_date SET price = $PRICE where (garageid = $GARAGEID AND levelnum = $LEVELNUM AND eventid = $EVENTID AND date = $DATE)";
	$result_eventid = mysqli_query($con, $sql_eventid) or die(mysqli_error($con));
	if(mysqli_query($con, $sql_update_price)){
		echo "Price updated successful";
	}else{
		echo "Price update fail";
	}

?>
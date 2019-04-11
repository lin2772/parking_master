<?php
	session_start();
	$USERNAME = $_SESSION["login"];

	$EVENTNAME = $_POST["EventName"];
	$VENUENAME = $_POST["VenueName"];
	$EVENTATE = $_POST["EventDate"];
	
	$OLDEVENTNAME = $_POST["OldEventName"];
	$NEWEVENTDATE = $_POST["NewEventDate"];

	if(empty($EVENTNAME) && empty($OLDEVENTNAME))
	{
		echo "Missing information!";
	}

	$con = mysqli_connect('localhost', 'phpuser', 'phpwd', 'parkingmaster');
	IF(!$con)
	{
		die('Could not connect'.mysqli_connect_error());
	}

	if(empty($NEWEVENTDATE))
	{
		for($x=0;$x<=88888888;$x++){
	       $sql_eventid="select eventid from EVENT where eventid=$x";
	       $result_cid=mysqli_query($con, $sql_cid) or die( mysqli_error($con));
	       if(mysqli_num_rows($result_cid)==0){
	         $CUSTOMERID= $x;
	        break;
	        }
	     }
		$sql_insert = "INSERT into EVENT(
			eventid, eventname, venueid) values 
			( '$EVENTNAME', '$VENUENAME')";
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
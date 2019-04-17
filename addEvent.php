

<?php
	session_start();
	$USERNAME = $_SESSION["login"];

	$EVENTNAME = $_POST["EventName"];
	$VENUENAME = $_POST["VenueName"];
	$EVENTDATE = $_POST["EventDate"];
	$CAPACITY = $_POST["Capacity"];
	$PRICE = $_POST["Price"];
	$VENUEID = -1;
	$result_count = -1;
	$sql_old_id = -1;

	if(empty($EVENTNAME) || empty($EVENTDATE) || empty($VENUENAME))
	{
		echo "Missing information!";
	}

	$con = mysqli_connect('localhost', 'phpuser', 'phpwd', 'parkingmaster');
	IF(!$con)
	{
		die('Could not connect'.mysqli_connect_error());
	}




	for($x=0;$x<=88888888;$x++){
       $sql_eventid="select eventid from EVENT where eventid=$x";
       $result_eventid=mysqli_query($con, $sql_eventid) or die( mysqli_error($con));
       if(mysqli_num_rows($result_eventid)==0){
         $EVENTID= $x;
        break;
        }
     }
    $sql_venueid = "SELECT venueid from VENUE where venuename='$VENUENAME'";
    $result_venueid = mysqli_query($con, $sql_venueid) or die(mysqli_error($con));
    While($row = mysqli_fetch_array($result_venueid))
    {
    	$VENUEID = $row['venueid'];
    }

	$sql_event_existed = "SELECT EXISTS (SELECT * from EVENT where eventname = '$EVENTNAME')";
	$result_event_existed = mysqli_query($con, $sql_event_existed) or die(mysqli_error($con));

    While($row = mysqli_fetch_array($result_venueid))
	{
		$result_count = $row[ 'exists (select * from event_date where eventid = 1)'];
	}	

	if($result_count == 0){
		$sql_insert = "INSERT into EVENT(
			eventid, eventname, venueid) values 
			( '$EVENTID', '$EVENTNAME', '$VENUEID')";
		if(mysqli_query($con,$sql_insert))
		{
			echo "Event added successfully";
			echo "</br>";
		}else{
			echo "ERROR: Event Added";
			echo "</br>";
		}

		$sql_edate_insert = "INSERT into EVENT_DATE(
			eventid, date) values 
			('$EVENTID', '$EVENTDATE')";
		if(mysqli_query($con, $sql_edate_insert))
		{
			echo "Event date added successfuly";
			echo "</br>";
		}else{
			echo "ERROR: Event Date Added";
			echo "</br>";
		}
	}else{
		$sql_old_id = "SELECT eventid from EVENT where eventname = '$EVENTNAME'";
		$result_sql_old_id = mysqli_query($con, $sql_old_id) or die (mysqli_error($con));

	    While($row = mysqli_fetch_array($result_sql_old_id))
		{
			$result_old_id = $row[ 'eventid'];
		}	

		$sql_edate_insert = "INSERT into EVENT_DATE(
			eventid, date) values 
			($result_old_id, '$EVENTDATE')";
		if(mysqli_query($con, $sql_edate_insert))
		{
			echo "Event date added successfuly";
			echo "</br>";
		}else{
			echo "ERROR: Event Date Added";
			echo "</br>";
		}
	}

	


	
?>	


<?php
	session_start();

	$con = mysqli_connect('localhost', 'phpuser', 'phpwd', 'parkingmaster');
	IF(!$con)
	{
		die('Could not connect'.mysqli_connect_error());
	}

	$sql_event = "select * from EVENT NATURAL JOIN EVENT_DATE";
	$result_event = mysqli_query($con, $sql_event) or die (mysqli_error($con));
	echo "EventID";
	echo "\t";
	echo "EventName";
	echo "\t";
	echo "VenueID";
	echo "\t";
	echo "Date";
	echo "<br>";
	While ($row = mysqli_fetch_array($result_event))
	{
		echo $row['eventid'];
		echo "\t";
		echo $row['eventname'];
		echo "\t";
		echo $row['venueid'];
		echo "\t";
		echo $row['date'];
		echo "<br>";

	}





?>






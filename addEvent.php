

<?php
	session_start();
	$USERNAME = $_SESSION["login"];

	$EVENTNAME = $_POST["EventName"];
	$VENUENAME = $_POST["VenueName"];
	$EVENTDATE = $_POST["EventDate"];
//	$EVENTID=-1;
//	$CAPACITY = $_POST["Capacity"];
//	$PRICE = $_POST["Price"];
	$VENUEID = -1;
	//$result_count = -1;
//	$sql_old_id = -1;
	$gled = array();

	if(empty($EVENTNAME) || empty($EVENTDATE) || empty($VENUENAME))
	{
		echo "Missing information!";
	}

	$con = mysqli_connect('localhost', 'phpuser', 'phpwd', 'parkingmaster');
	if(!$con)
	{
		die('Could not connect'.mysqli_connect_error());
	}

	//if event already exists
	$sql_event="select Eventname from EVENT where Eventname = '$EVENTNAME'";
	$result_event=mysqli_query($con, $sql_event) or die(mysqli_error($con));
  if(mysqli_num_rows($result_event)>0){
		$sql_eventid = "select Eventid from EVENT where Eventname = '$EVENTNAME'";
		$result_eventid=mysqli_query($con, $sql_eventid) or die( mysqli_error($con));
		while($row = mysqli_fetch_array($result_eventid)){
			$EVENTID=$row['Eventid'];
		}
	}
	else{
		//EVENTID
		for($x=0;$x<=88888888;$x++){
	       $sql_eventid="select eventid from EVENT where eventid=$x";
	       $result_eventid=mysqli_query($con, $sql_eventid) or die( mysqli_error($con));
	       if(mysqli_num_rows($result_eventid)==0){
	         $EVENTID= $x;
	        break;
	      }
	 	}
		$sql_venueid = "select Venueid from VENUE where venuename='$VENUENAME'";
		$result_venueid=mysqli_query($con, $sql_venueid) or die( mysqli_error($con));
		while($row = mysqli_fetch_array($result_venueid)){
			$VENUEID=$row['Venueid'];
		}
		$sql_insert_event="insert into EVENT values ('$EVENTID','$EVENTNAME','$VENUEID')";
		if(mysqli_query($con,$sql_insert_event)){

	  }else{
	    echo "Error in adding event. <br>";
	  }

	}
//	echo $EVENTID;
//	echo $EVENTDATE;
	$sql_insert = "insert into EVENT_DATE values ('$EVENTID','$EVENTDATE')";
	if(mysqli_query($con,$sql_insert)){
    $sql_gl="select Garageid,Levelnum,Eventid,Date from GARAGE_LEVEL,EVENT_DATE where Eventid = '$EVENTID' and Date = '$EVENTDATE'";
		$result_gl=mysqli_query($con, $sql_gl) or die( mysqli_error($con));

		$index = 0;
		while($row = mysqli_fetch_array($result_gl)){
			$key=array(
				'GarageID' => $row['Garageid'],
				'Levelnum' => $row['Levelnum'],
				'EventID' => $row['Eventid'],
				'Date'=>$row['Date']
			);
			//trim($key);
			$gled[$index]=$row;
			$index++;
		}
		//var_dump($key);
  }else{
    echo "Error in adding event date. <br>";
  }
	$_SESSION['GLED']=$gled;
?>

<html>
<head>
<title>Event</title>
<style>
table, th, td {
 border: 1px solid black;
}
</style>
</head>

<body>
	<br>
	<p> Add New Event - Step 2
		<form action="addGled.php" method="post">
			<table>
				<tr>
					<td>GarageID</td>
					<td>Levelnum</td>
					<td>EventID</td>
					<td>Date</td>
					<td>CapacityAllocated</td>
					<td>Price</td>
				</tr>
				<?php
					$x=0;
					foreach($gled as $tuple){
						echo '<tr>';
						echo '<td>'.$tuple['Garageid'].'</td>';
						echo '<td>'.$tuple['Levelnum'].'</td>';
						echo '<td>'.$tuple['Eventid'].'</td>';
						echo '<td>'.$tuple['Date'].'</td>';
						echo "<td><input name='CapacityAllocated".$x."' type='text'></td>";
						echo "<td><input name='Price".$x."' type='text'></td>";
						echo '</tr>';
						$x++;
					}
				?>
		</table>
			<br>
			<input type="submit" value="Continue"><br>
		</form>
	</p>
</body>


</html>

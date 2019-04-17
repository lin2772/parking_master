<?php

  session_start();
  $gled=$_SESSION['GLED'];
  //var_dump($_SESSION);
  //var_dump($_POST);
  $con = mysqli_connect('localhost', 'phpuser', 'phpwd', 'parkingmaster');
  if(!$con)
  {
    die('Could not connect'.mysqli_connect_error());
  }
  for($index = 0;$index < count($gled);$index++){
    $tuple = $gled[$index];
    $CapacityAllocated = 'CapacityAllocated'.$index;
    $Price = 'Price'.$index;
    array_push($tuple,$_POST[$CapacityAllocated],$_POST[$Price]);
    $gled[$index]=$tuple;
    //var_dump($tuple);
    $GARAGEID=$tuple['Garageid'];
    $LEVELNUM=$tuple['Levelnum'];
    $EVENTID=$tuple['Eventid'];
    $DATE=$tuple['Date'];
    $CapacityAllocated=$tuple[4];
    $PRICE=$tuple[5];
    $sql_insert = "insert into GARAGE_LEVEL_EVENT_DATE values ('$GARAGEID','$LEVELNUM','$EVENTID','$DATE','$CapacityAllocated','$PRICE')";
  	if(!mysqli_query($con,$sql_insert)){
      echo "Error in adding record for garageid, levelnum, eventid, date.";
    }
  }


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
						echo '<td>'.$tuple[4].'</td>';
            echo '<td>'.$tuple[5].'</td>';
						echo '</tr>';
						$x++;
					}
				?>
		</table>
		</form>
	</p>
</body>


</html>

<?php
  session_start();
  $LEVELNUM=$_POST['Levelnum'];
  $CUSTOMERID=$_SESSION['CustomerID'];
  $EVENTID=$_SESSION['EventID'];
  $DATE=$_SESSION['Date'];
  $GARAGEID=$_SESSION['GarageID'];
  $STATUS='Reserved';
  $DATERESERVED=date('Y-m-d');
  $RESERVATIONID=0;
  $con = mysqli_connect('localhost','phpuser','phpwd','parkingmaster');
	If (!$con)
	{
    die('Could not connect'.mysqli_connect_error());
	}

  //ReservationID
  for($x=0;$x<=88888888;$x++){
    $sql_cid="select ReservationID from RESERVATION where ReservationID=$x";
    $result_cid=mysqli_query($con, $sql_cid) or die(mysqli_error($con));
    if(mysqli_num_rows($result_cid)==0){
      $RESERVATIONID= $x;
      break;
    }
  }
  $sql_update_space="update GARAGE_LEVEL_EVENT_DATE set CapacityAllocated = CapacityAllocated + 1 where Garageid='$GARAGEID' and Levelnum='$LEVELNUM' and Eventid='$EVENTID' and Date='$DATE'";
  if(mysqli_query($con,$sql_update_space)){
    echo "available parking space - 1. <br>";
  }else{
    echo "Error in updating available parking spaces. <br>";
  }
  //insert
  $sql_insert="insert into RESERVATION(reservationid,cid,garageid,levelnum,eventid,date,dateReserved,dateCancelled,status) values ('$RESERVATIONID','$CUSTOMERID','$GARAGEID',$LEVELNUM,'$EVENTID','$DATE','$DATERESERVED',NULL,'$STATUS')";
	if(mysqli_query($con,$sql_insert)){
    echo "Reserved parking space successfully. The reservation number is: ".$RESERVATIONID.'<br>';
    echo "You can use this reservation number to track your reseservation. <br>";
  }else{
    echo "Error in reserving parking space. <br>";
  }
 ?>
 <html>
 <head>
 <title>Reservation Submit!</title>
 </head>
 <body>
   <p>
   <form action="customerPage.php">
     <br><input type="submit" value="Back to Homepage"></br>
   </form>
 </body>
 </html>

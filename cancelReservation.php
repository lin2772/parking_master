
<?php

  session_start();
  $USERNAME = $_SESSION["login"];
  $RESERVATIONID = 0;
  $CUSTOMERID=0;
  $con = mysqli_connect('localhost','phpuser','phpwd','parkingmaster');
	If (!$con)
	{
    die('Could not connect'.mysqli_connect_error());
	}
  $sql_cid="select CID from CUSTOMER where Login ='$USERNAME'";
  $result_cid=mysqli_query($con, $sql_cid) or die(mysqli_error($con));
  While ($row = mysqli_fetch_array($result_cid))
  {
    $CUSTOMERID=$row['CID'];
  }
  $sql_rid="select reservationid from reservation where cid ='$CUSTOMERID' and status ='active'";
  $result_rid=mysqli_query($con, $sql_rid) or die(mysqli_error($con));
  While ($row = mysqli_fetch_array($result_rid))
  {
    $RESERVATIONID=$row['reservationid'];
  }

  echo nl2br("The following are your reservation IDs: \n");
  echo $RESERVATIONID;
  echo nl2br("\n 0 means you do not have any active reservations.");

 ?>

<html>
<head>
<title>Cancel your reservation</title>
</head>
<body>
  <p>
  <form action="cancelReservationInfo.php" method="post">
    <br>Reservation ID to be cancelled (enter one ID at a time): <input name = "ReservationIDCancel" type="text"></br>

    <br><input type="submit" value="Submit to cancel"></br>
  </form>
  </p>
</body>
</html>

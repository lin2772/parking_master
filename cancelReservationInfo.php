<?php
  //Login
  session_start();
	$USERNAME = $_SESSION["login"];

  //variables for restoring parking space
  $GARAGEID=0;
  $LEVELNUM=0;
  $EVENTID=0;
  $DATE=0;

  $CUSTOMERID=0;

  $RESERVATIONID = $_POST["ReservationIDCancel"];

  if(empty($RESERVATIONID)){
    echo "Missing information!";
    //add page to come back?
  }
  $con = mysqli_connect('localhost','phpuser','phpwd','parkingmaster');
	If (!$con)
	{
    die('Could not connect'.mysqli_connect_error());
	}

  $sql_cancelDate ="update reservation set dateCancelled=curdate(),status ='cancelled' where reservationid ='$RESERVATIONID'";
  $result_cancelDate=mysqli_query($con, $sql_cancelDate) or die(mysqli_error($con));
  If ($result_cancelDate = true)
  {
    echo 'Reservation cancelled.';
  }else{
    echo 'We can not cancel your reservation right now';
  }

  $sql_refund ="update reservation set status ='refunded' where date-dateCancelled >= 2";
  $result_refund=mysqli_query($con, $sql_refund) or die(mysqli_error($con));
  $sql_status="select status from reservation where reservationid ='$RESERVATIONID'";
  $result_status=mysqli_query($con, $sql_status) or die(mysqli_error($con));
  While ($row = mysqli_fetch_array($result_status))
  {
    $REFUND=$row['status'];
  }
  if ($REFUND == 'refunded')
  {
    echo nl2br ("\n Refund issued.");
  } else{
    echo nl2br ("\n You are not qualified for a refund.");
  }

  $sql_infoRestoreSpace="select garageid,levelnum,eventid,date from reservation where reservationid ='$RESERVATIONID'";
  $result_infoRestoreSpace=mysqli_query($con, $sql_infoRestoreSpace) or die(mysqli_error($con));
  While ($row = mysqli_fetch_array($result_infoRestoreSpace))
  {
    $GARAGEID=$row['garageid'];
    $LEVELNUM=$row['levelnum'];
    $EVENTID=$row['eventid'];
    $DATE=$row['date'];
  }

  $sql_restoreSpace ="update garage_level_event_date set capacityallocated = capacityallocated+1 where garageid ='$GARAGEID' and levelnum ='$LEVELNUM' and eventid ='$EVENTID' and date ='$DATE'";
  $result_restoreSpace=mysqli_query($con, $sql_restoreSpace) or die(mysqli_error($con));
  if ($result_restoreSpace = true)
  {
    echo nl2br ("\n Space restored.");
  } else{
    echo nl2br ("\n We can not restore the space right not.");
  }
?>

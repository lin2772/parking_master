<?php
  //Login
  session_start();
	$USERNAME = $_SESSION["login"];
//  echo "Username: ",$USERNAME,"\n";
  $CUSTOMERID=0;
  $EVENTID=0;
  $EVENTNAME = $_POST["Eventname"];
//  echo "EventNAME: ",$EVENTNAME,"\n";
  $DATE = $_POST["Date"];
//  echo "EventDATE: ",$DATE,"\n";
//  echo "EventID: ",$EVENTID,"\n";
  //$DATERESERVED=date('Y-m-d');
  if(empty($EVENTNAME)||empty($DATE)){
//    echo "Missing information!";
    //add page to come back?
  }
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
//  echo "CustomerID: ",$CUSTOMERID,"\n";
  //eventid
  $sql_eventid="select e.Eventid from EVENT as e, EVENT_DATE as ed where e.Eventid = ed.Eventid and Eventname ='$EVENTNAME' and Date='$DATE'";
  $result_eventid=mysqli_query($con, $sql_eventid) or die(mysqli_error($con));
  if(mysqli_num_rows($result_eventid)>0){
    header("location:addReservationGarage.php? CustmerID=$CUSTOMERID&EventID=$EVENTID&Date=$DATE");
  }else{
    die(header('refresh: 5; url=newReservation.php').'No records for the event or the date is not associated with the event, wait 5 seconds or just click <a href="newReservation.php">HERE</a> to make another reservation.');
  }
  While ($row = mysqli_fetch_array($result_eventid))
  {
    $EVENTID=$row['Eventid'];
  }
//  echo "EventID: ",$EVENTID,"\n";

  //event on that day
  $sql_event_date="select * from EVENT_DATE where Eventid = $EVENTID and Date='$DATE'";
  $result_event_date=mysqli_query($con, $sql_event_date) or die(mysqli_error($con));
  if(mysqli_num_rows($result_event_date)>0){
    header("location:addReservationGarage.php? CustomerID=$CUSTOMERID&EventID=$EVENTID&Date=$DATE");
  }else{
    die(header('refresh: 5; url=newReservation.php').'No records for the event or the date is not associated with the event, wait 5 seconds or just click <a href="newReservation.php">HERE</a> to make another reservation.');
  }
?>

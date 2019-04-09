<?php
  //Login
  session_start();
	$USERNAME = $_SESSION["login"];
  //echo "Username: ", $USERNAME,"\n";
  $RESERVATIONID=0;
  $CUSTOMERID=0;
  $EVENTID=0;
  $GARAGEID=0;
  //eventname
  $EVENTNAME = $_POST["Eventname"];
  //echo "Eventname: ",$EVENTNAME,"\n";
  //eventdate
  $DATE = $_POST["Date"];
  //echo "Eventdate: ",$DATE,"\n";
  //date reserved
  $DATERESERVED=date('Y-m-d');
  //echo "date reserved: ",$DATERESERVED,"\n";
  //status
  $STATUS='Reserved';
  //echo "Status: ", $STATUS,"\n";
  //Garagename
  $GARAGENAME = $_POST["Garagename"];
  //echo "Garagename: ",$GARAGENAME,"\n";
  $LEVELNUM=$_POST["Levelnum"];
  //echo "levelnum: ",$LEVELNUM,"\n";
  if(empty($EVENTNAME)||empty($DATE)||empty($GARAGENAME)||empty($LEVELNUM)){
    echo "Missing information!";
    //add page to come back?
  }
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
//  echo $RESERVATIONID;
  //customerID
  $sql_cid="select CID from CUSTOMER where Login ='$USERNAME'";
	$result_cid=mysqli_query($con, $sql_cid) or die(mysqli_error($con));
  While ($row = mysqli_fetch_array($result_cid))
  {
    $CUSTOMERID=$row['CID'];
  }
  //echo "CustomerID: ",$CUSTOMERID,"\n";
  //eventid
  $sql_eventid="select Eventid from EVENT where Eventname ='$EVENTNAME'";
  $result_eventid=mysqli_query($con, $sql_eventid) or die(mysqli_error($con));
  While ($row = mysqli_fetch_array($result_eventid))
  {
    $EVENTID=$row['Eventid'];
  }
  //echo "EventID: ",$EVENTID,"\n";

  //garageid
  $sql_garageid="select Garageid from garage where Garagename ='$GARAGENAME'";
  $result_garageid=mysqli_query($con, $sql_garageid) or die(mysqli_error($con));
  While ($row = mysqli_fetch_array($result_garageid))
  {
    $GARAGEID=$row['Garageid'];
  }
  //echo "GarageID",$GARAGEID,"\n";

  //insert

  $sql_insert="insert into RESERVATION(reservationid,cid,garageid,levelnum,eventid,date,dateReserved,dateCancelled,status) values ('$RESERVATIONID','$CUSTOMERID','$GARAGEID',$LEVELNUM,'$EVENTID','$DATE','$DATERESERVED',NULL,'$STATUS')";
	if(mysqli_query($con,$sql_insert)){
    echo "Reserved parking space successfully";
  }else{
    echo "ERROR";
  }
?>

<?php
  $EVENTID=$_GET['EventID'];
  $CUSTOMERID=$_GET['CustomerID'];
  $DATE=$_GET['Date'];

  $con = mysqli_connect('localhost','phpuser','phpwd','parkingmaster');
	If (!$con)
	{
    die('Could not connect'.mysqli_connect_error());
	}

  //available garage
  $sql="select DISTINCT gl.Garageid from GARAGE_LEVEL as gl, GARAGE_LEVEL_EVENT_DATE as gled where gled.Eventid =$EVENTID and gled.Date = '$DATE' and gl.Garageid=gled.Garageid and gl.Levelnum=gled.Levelnum and gled.CapacityAllocated < gl.Maxspaces";
	$result=mysqli_query($con, $sql) or die(mysqli_error($con));

  if (mysqli_num_rows($result)>0)
  {
      $garageid_name=array();
      $garage=array();
      while($row = mysqli_fetch_array($result)){
        $garageid=$row['Garageid'];
        $sql_garagename="select Garagename from GARAGE where garageid=$garageid";
        $result_garagename=mysqli_query($con, $sql_garagename) or die(mysqli_error($con));
        while($row = mysqli_fetch_array($result_garagename)){
          $garageid_name[$garageid]=$row['Garagename'];
        }
      }
      header("location:chooseGarage.php");
      session_start();
      $_SESSION['Garages'] = $garageid_name;
      $_SESSION['CustomerID'] = $CUSTOMERID;
      $_SESSION['EventID'] = $EVENTID;
      $_SESSION['Date'] =$DATE;

  }else{
    die(header('refresh: 5; url=newReservation.php').'No available garage now, wait 5 seconds or just click <a href="newReservation.php">HERE</a> to make another reservation.');
  }



 ?>

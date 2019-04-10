<?php
session_start();
  $GARAGES=$_SESSION['Garages'];
  $CUSTOMERID=$_SESSION['CustomerID'];
  $EVENTID=$_SESSION['EventID'];
  $DATE=$_SESSION['Date'];
  $GARAGEID=$_POST['Garage'];
  $_SESSION['GarageID'] = $GARAGEID;
  $_SESSION['CustomerID'] = $CUSTOMERID;
  $_SESSION['EventID'] = $EVENTID;
  $_SESSION['Date'] =$DATE;
  $con = mysqli_connect('localhost','phpuser','phpwd','parkingmaster');
  If (!$con)
  {
    die('Could not connect'.mysqli_connect_error());
  }
  $sql_level="select gled.levelnum,Price from GARAGE_LEVEL as gl, GARAGE_LEVEL_EVENT_DATE as gled where gl.Garageid=$GARAGEID and gled.Eventid =$EVENTID and gled.Date = '$DATE' and gl.Garageid=gled.Garageid and gl.Levelnum=gled.Levelnum and gled.CapacityAllocated < gl.Maxspaces";
  $result_level=mysqli_query($con, $sql_level) or die(mysqli_error($con));
  $level_price=array();
  while($row=mysqli_fetch_array($result_level)){
    $level_price[$row['levelnum']]=$row['Price'];
  }
?>
<html>
<head>
<title>Step 2 - Choosing Level</title>
</head>
<body>
  <br> Please choose a level of the garage <?php echo $GARAGES[$GARAGEID]?> you prefer: </br>
  <p>
  <form action="updateReservation.php" method="post">
    <select name = "Levelnum">
      <?php
        foreach ($level_price as $level => $price) {
          echo '<option value ="'.$level.'">Level: '.$level.' Price: '.$price.'</option>';
        }

      ?>
    </select>
    <br><input type="submit" value="Submit"></br>
  </form>
  </p>
</body>
</html>

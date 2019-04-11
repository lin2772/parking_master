<?php
session_start();
  $GARAGES=$_SESSION['Garages'];
  $CUSTOMERID=$_SESSION['CustomerID'];
  $EVENTID=$_SESSION['EventID'];
  $DATE=$_SESSION['Date'];
  echo "Garages with available parking spaces are: ","<br>";
  foreach($GARAGES as $garageid=>$garagename){
    echo $garagename.'('.$garageid.')'."<br>";
  }

  $_SESSION['Garages'] = $GARAGES;
  $_SESSION['CustomerID'] = $CUSTOMERID;
  $_SESSION['EventID'] = $EVENTID;
  $_SESSION['Date'] =$DATE;
?>

<html>
<head>
<title>Step 2 - Choosing Garage</title>
</head>
<body>
  <br> Please choose a garage you prefer: </br>
  <p>
  <form action="chooseLevel.php" method="post">
    <select name= "Garage">
      <?php
        foreach ($GARAGES as $garageid=>$garagename) {
          echo '<option value ="'.$garageid.'">'.$garagename.'('.$garageid.')'.'</option>';
      }
      ?>
    </select>
    <br><input type="submit" value="Continue"></br>
  </form>
  </p>
</body>
</html>

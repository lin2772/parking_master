<?php


  //var_dump($_GET);

  session_start();
  $username = $_SESSION['Username'] ;
  $firstname=$_SESSION['Firstname'];
  $_SESSION['login']=$username;
  //  echo $username;
  //echo $firstname;
  echo "Welcome, ",$firstname;


 ?>
<html>
<head>
<title>Welcome to Your Homepage</title>
</head>
<body>
  <p>
  <form action="newReservation.php" method="post">

    <br><input type="submit" value="Make a reservation"></br>
  </form>
  </p>
  <p>
    <form action="cancelReservation.php" method="post">
      <br><input type="submit" value="Cancel a reservation"></br>
    </form>
  </p>
  <p>
    <form action="viewReservations.php" method="post">
      <br><input type="submit" value="View reservations"></br>
    </form>
  </p>
</body>
</html>

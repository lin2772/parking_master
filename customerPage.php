<?php


  //var_dump($_GET);
  $username = $_GET['Username'];
  $firstname=$_GET['Firstname'];
  session_start();
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
    <form action="register.php" method="post">
      <br><input type="submit" value="Cancel a reservation"></br>
    </form>
  </p>
</body>
</html>

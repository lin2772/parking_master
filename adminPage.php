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
<title>Welcome to Your Homepage admin</title>
</head>
<body>
  <p>
  need to be fixed
  </p>
</body>
</html>

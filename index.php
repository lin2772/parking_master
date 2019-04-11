<html>
<head>
<title>Welcome to ParkingMaster</title>
</head>
<body>
  <br> Welcome to Parking Master!</br>
  <p>
  <form action="login.php" method="post">
    <br>Username: <input name = "Username" type="text" value="
    <?php if($_GET){echo $_GET['user'];}?>"></br>
    <br>Password: <input name="Password" type="text"></br>
    <br> <input name="Admin" type="checkbox"> Admin login</br>
    <br><input type="submit" value="Sign in"></br>
  </form>
  </p>
  <p>
    <br>New to the page? Sign up here:</br>
    <form action="register.php" method="post">
      <br><input type="submit" value="Sign up"></br>
    </form>
  </p>
</body>
</html>

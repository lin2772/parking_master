<?php

  session_start();
  $username = $_SESSION['Username'];
  $firstname=$_SESSION['Firstname'];
  $_SESSION['login']=$username;
  //  echo $username;
  //echo $firstname;
  echo "Welcome, ",$firstname;
  $con = mysqli_connect('localhost','phpuser','phpwd','parkingmaster');
  If (!$con)
  {
    die('Could not connect'.mysqli_connect_error());
  }
  $sql_event="select * from event";
  $all_event=array();
  $result_event= mysqli_query($con, $sql_event) or die(mysqli_error($con));


 ?>
<html>
<head>
<title>Welcome to Your Homepage admin</title>
</head>
<body>
  <div>
    <table id="event_bar">
      <tr>
        <td>
          <form action="newEvent.php" method="post">
            <input type="submit" value="create new event"><br>
          </form>
        </td>

        <td>
          <form action="updateEventPage.php" method="post">
          <form action="" method="post">
            <input type="submit" value="update event"><br>
          </form>
        </td>

        <td>
          <form action="showEvent.php" method="post">
            <input type="submit" value="current event"><br>
          </form>
        </td>

        <td>
          <form action="removeEventInput.php" method="post">
            <input type="submit" value="remove event"><br>
          </form>
        </td>
      </tr>
    </table>
    <br><br>
  </div>
  <div>
    <table id= "garage_bar">
      <tr>
        <td>
          <form action="editSpacePage.php" method="post">
            <input type="submit" value="edit_space">
          </form>
        </td>
      </tr>
    </table>
    <br><br>
  </div>

    <div>
    <table id= "garage_level_event_date_info">
      <tr>
        <td>
          <form action="update_price_page.php" method="post">
            <input type="submit" value="Update Price">
          </form>
        </td>
      </tr>
    </table>
    <br><br>
  </div

  <div >
    <table id="sumup_bar"></table>
    <tr>
      <th>Reservation Sum Up</th>
      <th>
        <form action="ReservationSum.php" method="post">
            <input type="date" name="startdate">
            <input type="date" name="enddate">
            <select name="event">
              <option></option>
              <?php
                  if(mysqli_num_rows($result_event)>0){

                      while ($row=mysqli_fetch_array($result_event)) {
                            echo "<option value={$row['eventid']}>{$row['eventname']}</option>";
                           }
                    }
                ?>
            </select>
            <input type="submit" value="Submit">
        </form>
      </th>
    </tr>

  </div>

  <p>
  <form action="adminReservationSearch.php" method="post">
    <br> Search for the reservations of a customer:</br>
    Customer ID: <input name="Cid" type="text"></br>
    <input type="submit" value="Submit"></br>
  </form>
  </p>

</body>
</html>

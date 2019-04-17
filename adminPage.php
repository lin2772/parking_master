<?php


  //var_dump($_GET);
  $username = $_GET['Username'];
  $firstname=$_GET['Firstname'];
  session_start();
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
<<<<<<< HEAD
          <form action="newEvent.php" method="post">
=======
            <input type="submit" value="create new event">
          </form>
        </td>

        <td>
<<<<<<< HEAD
          <form action="updateEventPage.php" method="post">
=======
          <form action="" method="post">
            <input type="submit" value="update event">
          </form>
        </td>

        <td>
<<<<<<< HEAD
          <form action="showEvent.php" method="post">
=======
            <input type="submit" value="current event">
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
    <table id= "garage_level_event_date">
      <tr>
        <td>
          <form action="update_gled_page.php" method="post">
            <input type="submit" value="Add Garage Info">
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


</body>
</html>

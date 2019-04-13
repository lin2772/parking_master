<?php
  $EVENTNAME = $_POST['Eventname'];
  $DATE = $_POST['Date'];
  $con = mysqli_connect('localhost','phpuser','phpwd','parkingmaster');
	If (!$con)
	{
    die('Could not connect'.mysqli_connect_error());
	}
  if(empty($EVENTNAME)&&empty($DATE)){
    die(header('refresh: 5; url=index.php').'Either event name or event date should be filled out, wait 5 seconds or just click <a href="index.php">HERE</a> to go back.');
  }else if(empty($DATE)){
    $sql_selectname = "select * from EVENT where Eventname ='$EVENTNAME'";
    $result_selectname=mysqli_query($con, $sql_selectname) or die(mysqli_error($con));
    if(mysqli_num_rows($result_selectname)>0){
      $sql_deletename="delete from EVENT where Eventname ='$EVENTNAME'";
      if(mysqli_query($con,$sql_deletename)){
        echo 'events deleted successfully';
      }
    }else{
      die(header('refresh: 5; url=index.php').'The event name you entered does not exist, wait 5 seconds or just click <a href="index.php">HERE</a> to go back.');
    }

  }else if(empty($EVENTNAME)){
    $sql_selectdate = "select * from EVENT_DATE where Date = '$DATE'";
    $result_selectdate=mysqli_query($con, $sql_selectdate) or die(mysqli_error($con));
    if(mysqli_num_rows($result_selectdate)>0){
      $sql_eventid = "select Eventid from EVENT_DATE where Date = '$DATE'";
      $result_eventid=mysqli_query($con, $sql_eventid) or die(mysqli_error($con));
      While ($row = mysqli_fetch_array($result_eventid))
      {
        $eventid = $row['Eventid'];
        $sql_deletedate="delete from EVENT where Eventid='$eventid'";
        $result_deletedate=mysqli_query($con, $sql_deletedate) or die(mysqli_error($con));
      }
      echo 'events deleted successfully';
    }else{
      die(header('refresh: 5; url=index.php').'The event date you entered does not exist, wait 5 seconds or just click <a href="index.php">HERE</a> to go back.');
    }

  }else{
    $sql_select = "select * from EVENT_DATE, EVENT where Date = '$DATE' and Eventname = '$EVENTNAME'";
    $result_select=mysqli_query($con, $sql_select) or die(mysqli_error($con));
    if(mysqli_num_rows($result_select)>0){
      $sql_eventid = "select Eventid from EVENT_DATE where Date = '$DATE'";
      $result_eventid=mysqli_query($con, $sql_eventid) or die(mysqli_error($con));
      While ($row = mysqli_fetch_array($result_eventid))
      {
        $eventid = $row['Eventid'];
        $sql_deletedate="delete from EVENT where Eventid='$eventid' and Eventname = '$EVENTNAME'";
        $result_deletedate=mysqli_query($con, $sql_deletedate) or die(mysqli_error($con));
      }
      echo 'events deleted successfully';
    }else{
      die(header('refresh: 5; url=index.php').'The event name and date combination you entered does not exist, wait 5 seconds or just click <a href="index.php">HERE</a> to go back.');
    }
  }
 ?>

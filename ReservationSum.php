<?php
  $START=$_POST['startdate'];
  $END=$_POST['enddate'];
  $EVENT = $_POST['event'];
  $con = mysqli_connect('localhost','phpuser','phpwd','parkingmaster');
  If (!$con)
  {
    die('Could not connect'.mysqli_connect_error());
  }
  if(empty($EVENT)){
    $sql_a = "  select garagename,t1.garageid, total_reservation, total_revenue, total_space from
    (select * from
        (select garage, SUM(revenue) AS total_revenue, SUM(reserve) as total_reservation from
        (select reservation.garageid AS garage, reservation.levelnum AS level, count(reservationid) As reserve,  sum(price) AS revenue
         from reservation join garage_level_event_date
         where reservation.garageid=garage_level_event_date.garageid
          and reservation.levelnum=garage_level_event_date.levelnum
          and dateCancelled is null
          and reservation.eventid=garage_level_event_date.eventid
          and reservation.date=garage_level_event_date.date
          and reservation.date<='$END'
          and reservation.date>='$START'
          GROUP BY garage, level) AS layer1
          Group BY garage) as a1
          right join
          (select garageid, SUM(maxspaces) As total_space
          from garage_level
          group by garageid) as a2
          on a1.garage = a2.garageid) as t1
          join garage as t2
          on t1.garageid=t2.garageid";
  }
  else{
    $sql_a= " select garagename,t1.garageid, total_reservation, total_revenue, total_space from
    (select * from
        (select garage, SUM(revenue) AS total_revenue, SUM(reserve) as total_reservation from
        (select reservation.garageid AS garage, reservation.levelnum AS level, count(reservationid) As reserve, sum(price) AS revenue
         from reservation join garage_level_event_date
         where reservation.garageid=garage_level_event_date.garageid
          and reservation.levelnum=garage_level_event_date.levelnum
          and dateCancelled is null
          and reservation.eventid=garage_level_event_date.eventid
          and reservation.eventid = '$EVENT'
          and reservation.date=garage_level_event_date.date
          and reservation.date<='$END'
          and reservation.date>='$START'
          GROUP BY garage, level) AS layer1
          Group BY garage) as a1
          right join
          (select garageid, SUM(maxspaces) As total_space
          from garage_level
          group by garageid) as a2
          on a1.garage = a2.garageid) as t1
          join garage as t2
          on t1.garageid=t2.garageid";
  }
  $sql_e = "select * from event where eventid='$EVENT'";
  $EventName= mysqli_query($con, $sql_e) or die(mysql_error($con));
  $result = mysqli_query($con, $sql_a) or die(mysql_error($con));
?>

<html>
<head>
<title>Reservation sum up</title>
</head>
<body>
    <h2>Reservation Sum up</h2>
    <h3>Time Period <?php echo $START, " to ", $END?></h3>
    <div>
      <table border="1px" >
        <?php
          if(!empty($EventName)){
            while ($namerow=mysqli_fetch_array($EventName)) {
             echo "<h3>EVENT : {$namerow['eventname']}</h3>";
            }

          }
          echo "<tr><th>Garage</th> <th>Total reservation</th><th>Max capacity</th><th>Total revenue</th></tr>";
          if(mysqli_num_rows($result)>0){
                while ($row=mysqli_fetch_array($result)) {
                  $revervation = is_null($row['total_reservation'])? 0:$row['total_reservation'];
                  $revenue = is_null($row['total_revenue'])? 0:$row['total_revenue'];
                  echo "<tr><td>{$row['garagename']}</td><td>$revervation</td><td>{$row['total_space']}</td><td>$revenue</td></tr>";
                }
          }


        ?>
      </table>
    </div>
</body>
</html>

<!--
select garagename,t1.garageid, total_reservation, total_revenue, total_space from
    (select * from
        (select garage, SUM(revenue) AS total_revenue, SUM(reserve) as total_reservation from
        (select reservation.garageid AS garage, reservation.levelnum AS level, count(reservationid) As reserve, sum(price) AS revenue
         from reservation join garage_level_event_date
         where reservation.garageid=garage_level_event_date.garageid
          and reservation.levelnum=garage_level_event_date.levelnum
          and dateCancelled is null
          and reservation.eventid=garage_level_event_date.eventid
          and reservation.date=garage_level_event_date.date
          and reservation.date<='2019-05-11'
          and reservation.date>='2019-05-10'
          GROUP BY garage, level) AS layer1
          Group BY garage) as a1
          right join
          (select garageid, SUM(maxspaces) As total_space
          from garage_level
          group by garageid) as a2
          on a1.garage = a2.garageid) as t1
          join garage as t2
          on t1.garageid=t2.garageid



          -->

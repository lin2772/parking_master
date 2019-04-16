<?php
  session_start();
  $USERNAME = $_SESSION["login"];
  $CUSTOMERID=0;
  $con = mysqli_connect('localhost','phpuser','phpwd','parkingmaster');
	If (!$con)
	{
    die('Could not connect'.mysqli_connect_error());
	}
  $sql_cid="select CID from CUSTOMER where Login ='$USERNAME'";
	$result_cid=mysqli_query($con, $sql_cid) or die(mysqli_error($con));
  While ($row = mysqli_fetch_array($result_cid))
  {
    $CUSTOMERID=$row['CID'];
  }
  $sql_reservation="select Reservationid,Garageid,Levelnum,Eventid,Date,Datereserved,Datecancelled,Status from Reservation where Cid = '$CUSTOMERID'";
  $result_reservation=mysqli_query($con, $sql_reservation) or die(mysqli_error($con));
  $reservations=array();
  if(mysqli_num_rows($result_reservation)>0){
    //var_dump($result_reservation);
    while($row =mysqli_fetch_array($result_reservation)){
    //  var_dump($row);
      $reservations[$row['Reservationid']]=array(
        'CustomerID'=>$CUSTOMERID,
        'GarageID'=>$row['Garageid'],
        'Levelnum'=>$row['Levelnum'],
        'EventID'=>$row['Eventid'],
        'Date'=>$row['Date'],
        'DateReserved'=>$row['Datereserved'],
        'DateCancelled'=>$row['Datecancelled'],
        'Status'=>$row['Status']
      );
    }
  }
?>


 <html>
 <head>
 <title>Your reservations</title>
 <style>
table, th, td {
  border: 1px solid black;
}
</style>
 </head>
 <body>
   <br> Reservation Records</br>
   <p>
     <table style="width:100%">
    <tr>
      <th>ReservationID</th>
      <th>CustomerID</th>
      <th>GarageID</th>
      <th>Levelnum</th>
      <th>EventID</th>
      <th>Date</th>
      <th>DateReserved</th>
      <th>DateCancelled</th>
      <th>Status</th>
    </tr>
    <?php
      foreach ($reservations as $reservationid =>$reservation) {
        echo '<tr>';
        echo '<td>'.$reservationid.'</td>';
        foreach ($reservation as $key => $value) {
          echo '<td>'.$value.'</td>';
        }
        echo '</tr>';
      }
    ?>
  </table>
   </p>
 </body>
 </html>

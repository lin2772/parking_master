<?php
  $CUSTOMERID = 0;
  if(isset($_POST['submit'])){
    $SELECTED_TYPE=$_POST['type'];
  }
  $FIRSTNAME=$_POST["Firstname"];
  $MIDDLENAME=$_POST["Middlename"];
  $LASTNAME=$_POST["Lastname"];
	$USERNAME = $_POST["Username"];
  $PASSWORD = $_POST["Password"];
  $PHONE=$_POST["Phone"];
  
  if(empty($FIRSTNAME)||empty($LASTNAME)||empty($USERNAME)||empty($PASSWORD)){
    echo "Missing information!";
    //add page to come back?
  }
  if(empty($MIDDLENAME)){
    $MIDDLENAME="NULL";
  }
  if(empty($PHONE)){
    $PHONE="NULL";
  }
	$con = mysqli_connect('localhost','phpuser','phpwd','parkingmaster');
	If (!$con)
	{
    die('Could not connect'.mysqli_connect_error());
	}
  for($x=0;$x<=88888888;$x++){
    $sql_cid="select Cid from CUSTOMER where Cid=$x";
    $result_cid=mysqli_query($con, $sql_cid) or die(mysqli_error($con));
    if(mysqli_num_rows($result_cid)==0){
      $CUSTOMERID= $x;
      break;
    }
  }

  $sql_insert="insert into CUSTOMER(cid,fname,minit,lname,login,password,phone) values ('$CUSTOMERID','$FIRSTNAME','$MIDDLENAME','$LASTNAME','$USERNAME','$PASSWORD',$PHONE)";
	if(mysqli_query($con,$sql_insert)){
    echo "Rigistered successfully";
  }else{
    echo "ERROR";
  }

?>

<?php
	$USERNAME = trim($_POST["Username"]);
 	$PASSWORD = $_POST["Password"];
  	$ADMIN = (isset($_POST["Admin"]))? 1:0;
	$con = mysqli_connect('localhost','phpuser','phpwd','parkingmaster');
	If (!$con)
	{ die('Could not connect'.mysqli_connect_error());
	}
		$type= ($ADMIN)? "ADMIN":"CUSTOMER";

		$sql_username="select Login from $type where Login ='$USERNAME' and '$USERNAME'!=''";
		$result_username=mysqli_query($con, $sql_username) or die(mysqli_error($con));

		if(mysqli_num_rows($result_username)>0){
			//While ( $row = mysqli_fetch_array($result_username))	{
			//	if($row['Login'] == $USERNAME){
					$sql_password="select Password from $type where Login = '$USERNAME'";
					$result_password=mysqli_query($con, $sql_password) or die(mysqli_error($con));
					While ( $row = mysqli_fetch_array($result_password))
					{
				    //echo $row['Password'],"\n";
				    if($row['Password'] == $PASSWORD){
						$sql_firstname = "select Fname from $type where Login = '$USERNAME' and Password = '$PASSWORD'";
						$result_firstname=mysqli_query($con, $sql_firstname) or die(mysqli_error($con));
						While ( $row = mysqli_fetch_array($result_firstname)){
							//echo $row['Fname'];
							$FIRSTNAME = $row['Fname'];
							session_start();
						  $_SESSION['Username'] = $USERNAME;
						  $_SESSION['Firstname'] = $FIRSTNAME;
							if(!($ADMIN)){
								header("location:customerPage.php");
							}
							else{
								header("location:adminPage.php");
							}
						}
			      //echo "Welcome ",$USERNAME;

				    }else{
			      echo "Invalid password";
			   	 		}
					}
			}
	//	}
//	}
			else{
			//echo "No records of this user";
			// create user?
					die(header('refresh: 3; url=index.php').'Invalid Input, wait 3 seconds or just click <a href="index.php">HERE</a> to login again.');
				}

?>

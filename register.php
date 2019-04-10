<html>
<head>
<title>Customer Registration</title>
<style>
  p.Admincode{
    display: none;
  }
  .error {color: #FF0000;}
</style>
</head>
<body>

<?php
  $CUSTOMERID = 0;
  $admin_key="key";
  $FIRSTNAME=$MIDDLENAME=$LASTNAME=$USERNAME=$PASSWORD=$PHONE="";
  $ADMINCODEERR=$FIRSTNAMEERR=$MIDDLENAMEERR=$LASTNAMEERR=$USERNAMEERR=$PASSWORDERR=$PHONEERR= "";
  $SELECTED_TYPE= "general customer";
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['submit'])){
      $SELECTED_TYPE=$_POST['type'];
      if($SELECTED_TYPE=="admin"){
        if(empty($_POST["Admin_code"])){
           $ADMINCODEERR="Admincode is required";
        }else if($_POST["Admin_code"]!=$admin_key){
          $ADMINCODEERR="Incorrect Admin code";
          echo "Invalid Admin code";
        }
      }
    }

    if(empty($_POST["Firstname"])){
      $FIRSTNAMEERR="Firstname is required";
    }else{
      $FIRSTNAME=$_POST["Firstname"];
      if (!preg_match("/^[a-zA-Z]*$/",$FIRSTNAME)) {
          $FIRSTNAMEERR = "Only letters allowed"; 
      }
    }
    if(empty($_POST["Middlename"])){
      $MIDDLENAME="";
    }else{
      $MIDDLENAME=$_POST["Middlename"];
      if (!preg_match("/^[a-zA-Z]*$/",$MIDDLENAME)) {
          $MIDDLENAMEERR = "Only letters allowed"; 
      }
    }
    if(empty($_POST["Lastname"])){
      $LASTNAMEERR="Lastname is required";
    }else{
      $LASTNAME=$_POST["Lastname"];
      if (!preg_match("/^[a-zA-Z]*$/",$LASTNAME)) {
          $LASTNAMEERR = "Only letters allowed"; 
      }
    }

    if(empty($_POST["Username"])){
      $USERNAMEERR="Username is required";
    }else{
      $USERNAME = $_POST["Username"];
    }
    if(empty($_POST["Password"])){
      $PASSWORDERR="Password is required";
    }else{
      $PASSWORD = $_POST["Password"];
    }
    if(empty($_POST["Phone"])){
      $PHONEERR="Phone is required";
    }else{
      $PHONE=$_POST["Phone"];
      if (!preg_match("/^[0-9]*$/",$PHONE)) {
          $PHONEERR = "Only numbers allowed"; 
      }
    } 
  }
if(empty($FIRSTNAMEERR)&&empty($MIDDLENAMEERR)&&empty($LASTNAMEERR)&&empty($USERNAMEERR)&&empty($PASSWORDERR)&&empty($PHONEERR)&&empty($ADMINCODEERR)){
  $con = mysqli_connect('localhost','phpuser','phpwd','parkingmaster');
  If (!$con){
      die('Could not connect'.mysqli_connect_error());
  }
   for($x=0;$x<=88888888;$x++){
       $sql_cid="select Cid from CUSTOMER where Cid=$x";
       $result_cid=mysqli_query($con, $sql_cid) or die( mysqli_error($con));
       if(mysqli_num_rows($result_cid)==0){
         $CUSTOMERID= $x;
        break;
        }
      }

      if($SELECTED_TYPE=="general customer"){
        $sql_insert="insert into CUSTOMER(cid,Fname,Minit,Lname,Login,Password,Phone, vipflag) values ('$CUSTOMERID','$FIRSTNAME','$MIDDLENAME','$LASTNAME','$USERNAME','$PASSWORD',$PHONE, false)";
      }
      else if($SELECTED_TYPE=="vip"){
          $sql_insert="insert into CUSTOMER(cid,Fname,Minit,Lname,Login,Password,Phone, vipflag) values ('$CUSTOMERID','$FIRSTNAME','$MIDDLENAME','$LASTNAME','$USERNAME','$PASSWORD',$PHONE, true)";
        }
      else{
          for($x=0;$x<=88888888;$x++){
            $sql_aid="select Adminid from admin where Adminid=$x";
            $result_aid=mysqli_query($con, $sql_cid) or die( mysqli_error($con));
            if(mysqli_num_rows($result_aid)==0){
              $ADMINID= $x;
              break;
            }
          }
          $sql_insert="insert into ADMIN(Adminid,Fname,Minit,Lname,Login,Password,Phone, AdminCode) values ('$ADMINID','$FIRSTNAME','$MIDDLENAME','$LASTNAME','$USERNAME','$PASSWORD',$PHONE, '$admin_key')";
       }
    if(mysqli_query($con,$sql_insert)){
      //echo "Rigistered successfully";
      
      echo $USERNAME;
      //header("location:index.php?user=".$USERNAME);
    }else{
      echo "ERROR To Add Data";
    }
  
}


?>




  <h1>Register</h1>
  <p><span class="error">* required field</span></p>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
  
  <select name="type", id="type">
    <option value="general customer" >General Customer</option>
    <option value="vip" >VIP</option>
    <option value="admin" >Administer</option>
  </select>

<script type="text/javascript">
   document.getElementById("type").addEventListener('change',function(){
    var e =document.getElementById("type");
    var evalue = e.options[e.selectedIndex].value;
    if(evalue=='admin'){
      document.getElementById("Admin_code").style.display= "block";
       
    }
    else{
      document.getElementById("Admin_code").style.display= "none";
      }
   })
</script>

    <br><br>
    <p class="Admincode" id="Admin_code">
      Admin code: <input name = "Admin_code" type="text" >
      <span class="error">* <?php echo $ADMINCODEERR;?></span>
     </p>
    <br><br>
    Firstname: <input name = "Firstname" type="text">
    <span class="error">* <?php echo $FIRSTNAMEERR;?></span>
    <br><br>
    Middlename: <input name = "Middlename" type="text">
    <span class="error"> <?php echo $MIDDLENAMEERR;?></span>
    <br><br>
    Lastname: <input name = "Lastname" type="text">
    <span class="error">* <?php echo $LASTNAMEERR;?></span>
    <br><br>
    Username: <input name = "Username" type="text">
    <span class="error">* <?php echo $USERNAMEERR;?></span>
    <br><br>
    Password: <input name="Password" type="text">
    <span class="error">* <?php echo $PASSWORDERR;?></span>
    <br><br>
    Phone: <input name="Phone" type="text">
    <span class="error">* <?php echo $PHONEERR;?></span>
    <br><br>
    <input type="submit" value="Sign up">
  </form>




</body>
</html>
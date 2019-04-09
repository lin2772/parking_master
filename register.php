<html>
<head>
<title>Customer Registration</title>
<style>
	p.Admincode{
		display: none;
	}
</style>
</head>
<body>
	<h1>Register</h1>
<form action="addPerson.php" method="post">
	<br><select name="type", id="type">
		<option value="general customer" >General Customer</option>
		<option value="vip" >VIP</option>
		<option value="admin" >Administer</option>
	</select>
	</br>
  <br>
  <script type="text/javascript">
   document.getElementById("type").addEventListener('change',function(){
   	var e =document.getElementById("type");
   	if(e.options[e.selectedIndex].value=='admin'){
   		document.getElementById("Admin_code").style.display= "block";
   	}
   })

    </script>
  	<p class="Admincode" id="Admin_code">
  		Admin code: <input name = "Admin_code" type="text" >
	</p>
	</br>
  <br>Firstname: <input name = "Firstname" type="text"></br>
  <br>Middlename: <input name = "Middlename" type="text"></br>
  <br>Lastname: <input name = "Lastname" type="text"></br>
  <br>Username: <input name = "Username" type="text"></br>
  <br>Password: <input name="Password" type="text"></br>
  <br>Phone: <input name="Phone" type="text"></br>
  <br><input type="submit" value="Sign up"></br>
</form>
</body>
</html>

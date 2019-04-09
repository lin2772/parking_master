<html>
<head>
<title>Event</title>
</head>

<body>
	<p> Add New Event 
		<form action="addEvent.php" method="post">

			Name?<input name="EventName" type="text"><br>
			Date?<input name="EventDate" type="date"><br>
			<input type="submit" value="Add"><br>

		</form>
	</p>

	<p> Update Event
		<form action="addEvent.php" method="post">
			Name?<input name="EventName" type="text"><br>
			New Date?<input name="NewEventDate" type="date"><br>
			<input type="submit" value="update"><br>
		</form>
	</p>
</body>


</html>

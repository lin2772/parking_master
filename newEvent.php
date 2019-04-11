<html>
<head>
<title>Event</title>
</head>

<body>
	<br>
	<p> Add New Event 
		<form action="addEvent.php" method="post">

			Event Name<input name="EventName" type="text"><br>
			Event Date<input name="EventDate" type="date"><br>
			Venue Name<input name="VenueName" type="text"><br>
			<input type="submit" value="Add"><br>

		</form>
	</p>

	<br>
	<p> Update Event
		<form action="addEvent.php" method="post">
			Event Name    <input name="OldEventName" type="text"><br>
			Event New Date<input name="NewEventDate" type="date"><br>
			<input type="submit" value="update"><br>
		</form>
	</p>
</body>


</html>

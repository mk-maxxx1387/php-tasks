<html>
<head>
	<title>%TITLE%</title>
</head>
<body>
	<div><h2>Contact Form</h2></div>
	<div style="color: #FF0000; font-size: 15px;"><strong>%ERRORS%</strong></div>
	<div style="color: green; font-size: 15px;"><strong>%IS_SENT%</strong></div>
	<form method='post' name='feedback-form' action='index.php'>
		<label for='full-name'>Name:</label>
		<input type='text' name='full-name' value='%NAME%'><br>
		<label for='email'>Email:</label>
		<input type='email' name='email' value='%EMAIL%'><br>
		<label for='subject'>Subject:</label>
		<select name='subject'>
			<option disabled selected> --Select elements-- </option>
			%OPTIONS%
		</select><br>
		<label for='message'>Message:</label>
		<textarea name='message'></textarea><br>
		<input type='submit' name='submit' value='send'>
	</form>
</body>
</html>

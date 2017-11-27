<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
require 'includes/config.php';
$id=$_GET['id'];
$dni = $db->query("SELECT * FROM dni WHERE Id='$id'");
$dzien = $dni->num_rows;
$dzien=$dni->fetch_assoc();
?>
<div id="container">
	<div id="menu"><img src="logo.gif"><img id="napis" width="500px" src="logo.png"><a href="index.php">Powrót</a></div>
	<div id="content">
		<fieldset>
			<legend>Edycja</legend>
			<form method="post" action="edit2.php">
				<label for="Dzien">Dzień:</label>
				<input maxlength="32" type="date" name="Dzien1" id="Dzien1" value="<?php echo $dzien['Dzien'] ?>" required>
				<br><br>
				<label for="Od">Od:</label>
				<input type="time" name="Od1" id="Od1" size="2px" value="<?php echo $dzien['Od'] ?>" required>
				<br><br>
				<label for="Do">Do:</label>
				<input type="time" name="Do1" id="Do1" size="2px" value="<?php echo $dzien['Do'] ?>" required>
				<br><br>
				<label for="Opis">Opis wykonanych czynności:</label>
				<br>
				<textarea rows="4" cols="50" name="Opis1" id="Opis1" required><?php echo $dzien['Opis'] ?></textarea>
				<br><br>
				<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
				<input type="submit" value="Wyślij">
			</form>
		</fieldset>
</div>
</body>
</html>
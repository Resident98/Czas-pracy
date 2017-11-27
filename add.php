<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
require 'includes/config.php';
$userData = $user->data();
$id = $userData['id'];
@$dzien = $_POST['Dzien'];
@$od = $_POST['Od'];
@$do = $_POST['Do'];
@$opis = $_POST['Opis'];
if ($_POST)
{
	$result = $db->query("INSERT INTO dni (Id_osoby, Dzien, Od, Do, Opis) VALUES('$id', '$dzien', '$od', '$do', '$opis')");
	header ('Location: index.php');
}
?>
<div id="container">
	<div id="menu"><img src="logo.gif"><img id="napis" width="500px" src="logo.png"><a href="index.php">Powrót</a></div>
	<div id="content">
		<fieldset>
			<legend>Dodaj do bazy</legend>
			<form method="post" action="add.php">
				<label for="Dzien">Dzień:</label>
				<input maxlength="32" type="date" name="Dzien" id="Dzien" value="<?php echo date("Y-m-d") ?>" required>
				<br><br>
				<label for="Od">Od:</label>
				<input type="time" name="Od" id="Od" size="2px" value="<?php echo date("H:i", strtotime('-8 hours')) ?>" required>
				<br><br>
				<label for="Do">Do:</label>
				<input type="time" name="Do" id="Do" size="2px" value="<?php echo date("H:i") ?>" required>
				<br><br>
				<label for="Opis">Opis wykonanych czynności:</label>
				<br>
				<textarea rows="4" cols="50" name="Opis" id="Opis" required></textarea>
				<br><br>
				<input type="submit" value="Wyślij">
			</form>
		</fieldset>
	</div>
</body>
</html>
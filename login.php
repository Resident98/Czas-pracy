<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="container">
	<div id="menu"><img src="logo.gif"><img id="napis" width="500px" src="logo.png"><a href="index.php">Powrót</a></div>
	<div id="content">
		<fieldset>
			<legend>Logowanie</legend>
			<form method="post" action="login.php">
				<label for="login">Login</label>
				<br>
				<input type="text" name="login" maxlength="32" id="login" placeholder="Login" required>
				<br><br>
				<label for="password">Hasło</label>
				<br>
				<input type="password" name="password" id="password" placeholder="Hasło" required><br>
				<br>
				<input type="submit" value="Zaloguj">
			</form>
		</fieldset>
	</div>
	<?php
	require 'includes/config.php';
	// Zabezpiecz zmienne odebrane z formularza, przed atakami SQL Injection
	@$login = $db->real_escape_string(htmlspecialchars(trim($_POST['login'])));
	@$password = $_POST['password'];

	if ($_POST) {
		// Podstawowa walidacja formularza
		$errors = array();

		if (empty($login) || empty($password)) {
			$errors[] = 'Wypełnij wszystkie pola';
		}

		$auth = $user->auth($login, $password);
		if (!$auth) {
			$errors[] = 'Użytkownik o podanym loginie i haśle nie istnieje';
		}
		
		if (empty($errors)) {
			// Jeżeli nie ma błędów to przechodzimy dalej
			// Zapisujemy ID użytkownika do sesji i tym samym oznaczamy go jako zalogowanego
			$_SESSION['user_id'] = $auth;

			header('Location: index.php');
		} else {
			foreach ($errors as $error) {
				echo '<p style="color: white;" class="error">'.$error.'</p>';
			}
		}
	}
	?>
</div>
</body>
</html>
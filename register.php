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
			<legend>Rejestracja</legend>
			<form method="post" action="register.php">
				<label for="imie">Imię:</label>
				<input maxlength="20" type="text" name="imie" id="imie" required>
				<br><br>
				<label for="nazwisko">Nazwisko:</label>
				<input maxlength="20" type="text" name="nazwisko" id="nazwisko" required>
				<br><br>
				<label for="login">Login:</label>
				<input maxlength="32" type="text" name="login" id="login" required>
				<br><br>
				<label for="password">Hasło:</label>
				<input type="password" name="password" id="password" required>
				<br><br>
				<label for="password_v">Hasło (ponownie):</label>
				<input type="password" name="password_v" id="password_v" required>
				<br><br>
				<label for="email">Email:</label>
				<input type="email" name="email" maxlength="255" id="email" required>
				<br><br>
				<label for="email_v">Email (ponownie):</label>
				<input type="email" name="email_v" maxlength="255" id="email_v" required>
				<br><br>
				<input type="submit" value="Zarejestruj">
			</form>
		</fieldset>
	</div>
<?php
require 'includes/config.php';
if ($_POST) {
    // Zabezpiecz dane z formularza przed kodem HTML i ewentualnymi atakami SQL Injection
    // Nie ma konieczności filtrowania haseł, bo one i tak zostaną zahashowane przed wstawieniem
    // do bazy danych
	$imie = $db->real_escape_string(htmlspecialchars(trim($_POST['imie'])));
	$nazwisko = $db->real_escape_string(htmlspecialchars(trim($_POST['nazwisko'])));
    $login = $db->real_escape_string(htmlspecialchars(trim($_POST['login'])));
    $password = $_POST['password'];
    $passwordVerify = $_POST['password_v'];
    $email = $db->real_escape_string(htmlspecialchars(trim($_POST['email'])));
    $emailVerify = $db->real_escape_string(htmlspecialchars(trim($_POST['email_v'])));
	$admin = '0';

    // Sprawdź czy podane przez użytkownika email lub login nie są zajęte
    $checkLogin = $db->query("SELECT COUNT(*) FROM users WHERE login = '$login'")->fetch_row();
    $checkEmail = $db->query("SELECT COUNT(*) FROM users WHERE email = '$email'")->fetch_row();

    // Podstawowa walidacja formularza
    $errors = array();

    if (empty($login) || empty($email) || empty($emailVerify) || empty($password) || empty($passwordVerify)) {
        $errors[] = 'Proszę wypełnić wszystkie pola';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Podany adres e-mail jest niepoprawny';
    }

    if ($checkLogin[0] > 0) {
        $errors[] = 'Ten login jest już zajęty';
    }
    if ($checkEmail[0] > 0) {
        $errors[] = 'Ten e-mail jest już używany';
    }

    if ($password != $passwordVerify) {
        $errors[] = 'Podane hasła się nie zgadzają';
    }
    if ($email != $emailVerify) {
        $errors[] = 'Podane adresy e-mail się nie zgadzają';
    }

    // Jeśli wystąpiły jakieś błędy, to je pokaż
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<p style="color: white;" class="error">'.$error.'</p>';
        }
    } else {
        // Blędów nie ma, możemy kontynuować rejestrację

        $password = password_hash($password, PASSWORD_BCRYPT); // hashowanie hasła

        // Zapisz dane do bazy
        $result = $db->query("INSERT INTO users (imie, nazwisko, login, email, password, admin) VALUES('$imie', '$nazwisko', '$login', '$email', '$password', '$admin')");

        if (!$result) {
            echo '<p style="color: white;" class="error">Wystąpił błąd przy rejestrowaniu użytkownika.<br>'.$db->error.'</p>';
        } else {
            header('Location: index.php');
        }
    }
}
?>
</div>
</body>
</html>
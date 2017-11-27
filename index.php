<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
require 'includes/config.php';
if ($user->check()) { // Tylko dla użytkowników zalogowanych
    // Pobierz dane o użytkowniku i zapisz je do zmiennej $userData
    $userData = $user->data();
	if($userData['admin']==1)
	{
		echo '<div id="container">'; 
		echo '<div id="menu"><img src="logo.gif"><img id="napis" width="500px" src="logo.png"><a href="logout.php">Wyloguj</a><a href="add.php">Dodaj czas pracy</a><a href="empty.php">Wyczyść bazę</a>';
		echo '</div>';
		echo '<div id="content"><center><h1>Witaj '.$userData['imie'].' '.$userData['nazwisko'].'!'.'</h1></center>';
		echo '<h2>Pracownicy:</h2>';
		$wynik = $db->query("SELECT * FROM users");
		$liczba = $wynik->num_rows;
		if($liczba > 0) { 
			while($liczba=$wynik->fetch_assoc()) {
				echo "<h4>".$liczba["imie"]." ". $liczba["nazwisko"]. " " . "<b>E-mail:</b> " . $liczba["email"]."&nbsp;&nbsp;&nbsp;"."<a href='info.php?id=".$liczba["id"]."'><button type='button' id='button'>Zobacz pracownika</button></a>"."<br>"."</h4>";
			}		
		}
		echo '</div>';
	}else if($userData['admin']!=1){
		echo '<div id="container">'; 
		echo '<div id="menu"><img src="logo.gif"><img id="napis" width="500px" src="logo.png"><a href="logout.php">Wyloguj</a><a href="add.php">Dodaj czas pracy</a>';
		echo '</div>';
		echo '<div id="content"><center><h1>Witaj '.$userData['imie'].' '.$userData['nazwisko'].'!'.'</h1></center>';
		$wynik = $db->query("SELECT * FROM dni WHERE Id_osoby='$userData[id]' ORDER BY Dzien DESC, Od DESC");
		$liczba = $wynik->num_rows;
		if($liczba == 0)
		{
			echo '<p style="font-size:25px">Brak wpisów.</p>';
		}else if($liczba > 0) { 
			$nazwa_miesiaca = array('Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień');
			$miesiac[11]= array();
			for($i=0;$i<12;$i++)
			{
				$miesiac[$i]=0;
			}
			echo "<table>";
			echo "<tr><th>Dzień</th><th>Czas</th><th>Ilość godzin</th><th>Opis wykonanych czynności</th></tr>";
			while($liczba=$wynik->fetch_assoc()) {
				$godziny1=0;
				$liczba1=strtotime($liczba["Od"])/ 3600;
				$liczba2=strtotime($liczba["Do"])/ 3600;
				if($liczba1 > $liczba2)
				{
					$godziny = 24-round(($liczba1 - $liczba2));
				}else $godziny = round($liczba1 - $liczba2);
				$godziny = abs($godziny);
				$m=date("n",strtotime($liczba["Dzien"]));
				$miesiac[$m-1]=$miesiac[$m-1]+$godziny;
				echo "<tr>";
				echo "<td>".$liczba["Dzien"]."</td>"."<td>" . $liczba["Od"]. " - " . $liczba["Do"]."</td>"."<td>"."<center>".$godziny."</center>"."</td>"."<td>". $liczba["Opis"]."</td>"."<td class='brak'><a href='edit.php?id=".$liczba["Id"]."'><button type='button' id='przycisk'>Edytuj</button></a></td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "<table>";
			echo "<tr><th>Miesiąc</th><th>Łącznie godzin</th></tr>";
			for($i=0; $i<12;$i++)
			{
				if($miesiac[$i]>0)
				{
					echo "<tr><td>".$nazwa_miesiaca[$i]."</td><td>"."<center>".$miesiac[$i]."</center>"."</td></tr>";
				}
			}
			echo "</table>";
		}
		echo '</div>';
	}

} else {
    // Widok dla użytkownika niezalogowanego
    echo '<div id="container">'; 
	echo '<div id="menu"><img src="logo.gif"><img id="napis" width="500px" src="logo.png"><a href="register.php">Zarejestruj</a><a href="login.php">Zaloguj</a>';
	echo '</div>';
	echo '<div id="content"><h1>Witaj użytkowniku! Stwórz konto lub zaloguj się do już istniejącego.</h1>';
	echo '</div>';
	echo '</div>';
}
?>
</body>
</html>
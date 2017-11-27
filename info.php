<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
require 'includes/config.php';
$user=$user->data();
$id=$_GET['id'];
$osoba = $db->query("SELECT * FROM users WHERE id='$id'");
$dane = $osoba->num_rows;
$wynik = $db->query("SELECT * FROM dni WHERE Id_osoby='$id' ORDER BY Dzien DESC, Od DESC");
$liczba = $wynik->num_rows;
echo '<div id="container">'; 
	echo '<div id="menu"><img src="logo.gif"><img id="napis" width="500px" src="logo.png"><a href="logout.php">Wyloguj</a><a href="index.php">Powrót</a>';
	echo '</div>';
	echo '<div id="content">';
	if($dane > 0) { 
		while($dane=$osoba->fetch_assoc()) {
			echo "<h1>".$dane["imie"]." ". $dane["nazwisko"]."</h1>";
		}
	}
	//Wypisywanie dat i czasu z bazy
	if($liczba > 0) { 
		echo '<p style="font-size:25px">Pracował:</p>';
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
			echo "<td>".$liczba["Dzien"]."</td>"."<td>" . $liczba["Od"]. " - " . $liczba["Do"]."</td>"."<td>"."<center>".$godziny."</center>"."</td>"."<td>". $liczba["Opis"]."</td>";
			if($user["id"]==$liczba["Id_osoby"])
			{
				echo "<td class='brak'><a href='edit.php?id=".$liczba["Id"]."'><button type='button' id='przycisk'>Edytuj</button></a></td>";
			}
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
	}else echo '<p style="font-size:25px">Brak wpisów.</p>';
	echo '</div>';
?>
</body>
</html>
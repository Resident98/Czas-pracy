<?php
require 'includes/config.php';
$id=$_POST['id'];
@$dzien1=$_POST['Dzien1'];
@$od1=$_POST['Od1'];
@$do1=$_POST['Do1'];
@$opis1=$_POST['Opis1'];
if ($_POST)
{
	$result = $db->query("UPDATE dni SET Dzien='$dzien1', Od='$od1', Do='$do1', Opis='$opis1' WHERE Id='$id'");
	header ('Location: index.php');
}
?>

<?php
require 'includes/config.php';
	$db->query("TRUNCATE TABLE dni");
	header('Location: index.php');
?>
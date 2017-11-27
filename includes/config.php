<?php
$config['db_host'] = 'localhost';
$config['db_user'] = 'root';
$config['db_pass'] = '';
$config['db_name'] = 'praca';

$db = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

if ($db->errno) {
    die ('<p class="error">Nie udało się połączyć z bazą danych.</p>');
}

session_start();

require 'password.php';
require 'User.php';

$user = new User($db);
?>
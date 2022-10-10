<?php

$host = '144.22.244.104';
$port = 3306;
$user = 'Bravo4Fun';
$pass = 'Bravo4Fun';
$base = 'Bravo4Fun';

$dsn = 'mysql:host=' . $host . ';dbname=' . $base . ';port=' . $port;

$pdo = new PDO($dsn, $user, $pass);

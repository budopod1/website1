<?php
#Connection file
$host = "localhost";
$username = "budopod";
$pass = "SethBlingRedstone";
$dbname = "puffio";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);
$connection = new PDO($dsn, $username, $pass, $options);

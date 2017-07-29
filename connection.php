<?php

require "config.php";

$servername = $configDB['servername'];
$dbName = $configDB['baseName'];
$username = $configDB['username'];
$pass = $configDB['password'];


$conn = new PDO("mysql:host=$servername;dbname=$dbName", "$username", "$pass");
// Sprawdzamy czy połączcenie się udało
if (!$conn) {
    die("Polaczenie nieudane.");
}

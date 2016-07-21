<?php
$serveurname ="localhost";
$username = "root";
$password = "****";

try {
	$bdd = new PDO("mysql:host=$serveurname;dbname=epitech_tp", $username, $password);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?> 
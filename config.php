<?php 

$database = "mysql:dbname=agenda_medica;host=localhost";
$user = "root";
$password = "";

try{
	$pdo = new PDO($database, $user, $password);

} catch(PDOException $e) {

	echo "Falhou: ".$e->getMessage();
}

 ?>
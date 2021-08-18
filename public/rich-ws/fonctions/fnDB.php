<?php
//fn de connexion Base de données
function getPDO(){
	
	$pdo = new PDO('mysql:host=localhost;dbname=bgtu3341_dipcommerce_db','bgtu3341_dip','uISGA7pXjrRx3rI9');
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	
	return $pdo;
}
?>
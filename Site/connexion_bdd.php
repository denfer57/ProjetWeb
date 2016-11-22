<?php
//Connexion propre a votre bdd, pour l'instant
try{
	$connexion = new PDO(
		"mysql:host=localhost;dbname=projet_web",
		"root",
		""
	);
}
catch(PDOException $e){
	echo $e->getMessage();
}
?>
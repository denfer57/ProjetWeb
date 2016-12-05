<?php
	$html = "";
	$html .= '<!DOCTYPE html>
	<html>
	<head>
		<title>Accueil</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="detail_serie.css" />
	</head>
	<body>';
	//Modèle de base, revoir le design ainsi que les fonctionnalités
	//Arnaud tu dois t'en charger
	
	include("banniere.php");
	include("connexion_bdd.php");
	
	//1ere requête : plus populaire
	$queryvarserie = "SELECT popularity,poster_path, name, id 
		FROM `series` 
		ORDER BY `series`.`popularity` DESC";
	$statement = $connexion->prepare($queryvarserie);
	$statement->execute();
	$rowvar = $statement->fetch();
	$popularity = $rowvar[0];
	$imgserie = $rowvar[1];
	$nameserie = $rowvar[2];
	$idserie = $rowvar[3];
	
	$querytop10 = "SELECT * FROM `series` 
	ORDER BY `series`.`popularity` 
	DESC LIMIT 10";
	$statement = $connexion->prepare($querytop10);
	$statement->execute();
	
	$html .= '<div id="slider">
		<h1>Faire le slider</h1>
	</div>
	<div id="milieu"><div class="gaucheserie">
		<p>Le plus populaire : '.$popularity.'</p>
		<a href="http://localhost/Site/Projetweb/Site/detail_serie.php?idserie='.$idserie.'"><img src="https://image.tmdb.org/t/p/w185'.$imgserie.'" alt="'.$nameserie.'" id="imgserie"/></a>
	</div>
	<div class="droiteserie">
			<!-- <p>HIMYM : Les secrets du tournage</p>
			<img src="images/How-I-Met-Your-Mother.jpg" alt="HIMYM" class="img"/>
			<div>
				<p>Le tournage : </p>
				<p style="text-align:justify;">Blablablablablabla.</p>				
			</div> -->
	</div></div>
	<!-- A voir, pas sur de mettre des liens, vers quoi ? -->
	
	<?php include("footer.php"); ?>
    
	</body>
	</html>';
	
	echo $html;
?>
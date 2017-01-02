<!DOCTYPE html>
	<html>
	<head>
		<title>Accueil</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="global.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	</head>
	<body>
		<?php
		$html = "";
	session_start();
	//On regarde si l'utilisateur est connecté
	if($_SESSION) {
		include("banniereco.php"); // bannière d'utilisateur connecté
	}
	else {
		include("banniere.php"); // bannière d'utilisateur non connecté
	}

	include("connexion_bdd.php");
	
	//1ere requête : La plus populaire
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

	// 2ème requête : Nouvelle série
	$queryproc = "SELECT first_air_date, poster_path, name, id 
		FROM `series` 
		ORDER BY `series`.`first_air_date` DESC 
		LIMIT 3";
	$statement = $connexion->prepare($queryproc);
	$statement->execute();
	$rowvar = $statement->fetch();
	$datesortie = $rowvar[0];
	$imgserie2 = $rowvar[1];
	$nameserie2 = $rowvar[2];
	$idserie2 = $rowvar[3];

	/*$querytop10 = "SELECT first_air_date, poster_path, name, id FROM `series` 
	ORDER BY `series`.`popularity` 
	DESC LIMIT 3";
	$statement = $connexion->prepare($querytop10);
	for($i=0;$i<3;$i++){
		$statement->execute();
		$rowvar = $statement->fetch();
		$datesortie[$i] = $rowvar[0];
		$imgserie2[$i] = $rowvar[1];
		$nameserie2[$i] = $rowvar[2];
		$idserie2[$i] = $rowvar[3];
	}*/

	$html .= '<section id="slider">
    	<h1>Make the slider</h1>
	</section>
	<div id="milieu">
		<div class="gaucheserie">
			<p>The most popular : '.$popularity.', '.$nameserie.'</p>
			<a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie.'"><img src="https://image.tmdb.org/t/p/w185'.$imgserie.'" alt="'.$nameserie.'" class="imgserie"/></a>
		</div>
		<div class="droiteserie">
		New serie : ';
				$html .= '<p>'.$nameserie2.', sortie le '.$datesortie.'</p>
				<a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie2.'">';
				if ($imgserie2!=NULL) $html .= '<img src="https://image.tmdb.org/t/p/w185'.$imgserie2.'" alt="'.$nameserie2.'" class="imgserie"/>';
				else $html .= '<img src="http://localhost/Projetweb/Site/images/photo_manquante.jpg" alt="Pas d\'image"/>';
		$html .= '</a></div>
	</div>
	</body>
	</html>';
	echo $html;
	
?>
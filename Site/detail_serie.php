<?php 
	include("connexion_bdd.php");
	session_start();
	//On regarde si l'utilisateur est connecté
	if($_SESSION) {
		include("banniereco.php");
	}
	else {
		include("banniere.php");
	}

	$idserie = $_GET['idserie']; //donnée récupérée au clic pour le détail d'une série avec le $_GET['serie'];
	
	//partie requête
	
	//1ere requête : nombre de saisons/épisodes de la série, img, résumé, nom de la série, popularité, lien
	$queryvarserie = "SELECT number_of_seasons, number_of_episodes, poster_path, overview, name, popularity, homepage, id
		FROM series
		WHERE id = :id";
	$statement = $connexion->prepare($queryvarserie);
	$statement->bindValue(":id", $idserie, PDO::PARAM_STR);
	$statement->execute();
	$rowvar = $statement->fetch();
	$nbsaisons = $rowvar[0];
	$nbepisodes = $rowvar[1];
	$imgserie = $rowvar[2];
	$resume = $rowvar[3];
	$nom_serie = $rowvar[4];
	$popularity = $rowvar[5];
	$lien = $rowvar[6];
	$id = $rowvar[7];
	
	//2eme requête : récupération des id de la saison de la série
	$querysaisons = "SELECT season_id
		FROM seriesseasons
		WHERE series_id = :id";
	$statement = $connexion->prepare($querysaisons);
	$statement->bindValue(":id", $id, PDO::PARAM_STR);
	$statement->execute();
	// on récupère les résultats de la 1ère colonne
	$numsaisons = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
	
	//3eme requête : récupération des noms de la saison de la série
	$querynamesaisons = "SELECT name, air_date, poster_path
		FROM seasons
		WHERE id = :numsaisons";
	$statement = $connexion->prepare($querynamesaisons);
	for($i=0;$i<count($numsaisons);$i++){
		$statement->bindValue(":numsaisons", $numsaisons[$i], PDO::PARAM_STR);
		$statement->execute();
		$rows = $statement->fetch();
		$namesaison[$i] = $rows[0];
		$datesaison[$i] = $rows[1];
		$imgseriesaison[$i] = $rows[2];
	}
		
	//html de la page
	$html = "";
	$html.= '		
	<html>
	<head>
	<title>Detail d\'une série</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="detail_serie.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
	</head>
	<body>
	
	<div>
		<div class="gaucheserie">
				<p>'.$nom_serie.'</p>';
				if ($imgserie!=NULL) $html .= '<img src="https://image.tmdb.org/t/p/w185'.$imgserie.'" alt="'.$nom_serie.'" id="imgseriesaison"/>';
					else $html .= '<img src="http://localhost/Projetweb/Site/images/photo_manquante.jpg" alt="Pas d\'image"/>';	
				$html .= '<div>
					<p>Abstract of the series : '.$resume.'</p>
					<p style="text-align:justify;"></p>
				</div>
				<div>
					<div>Popularity :
							<p style="color:red;">'.$popularity.'</p>
					</div>
					<div> More details about the series : 
						<p><a href="'.$lien.'" target="_blank">Click here</a></p>
					</div>
				</div>
				<form>
					<input type="button" value="Retour" onclick="history.go(-1)">
				</form>
		</div>
		<div class="droiteserie">
			<p>There is : '.$nbsaisons.' season(s) and '.$nbepisodes.' episode(s).</p>';
			for($i=0;$i<count($numsaisons);$i++){
				$html .= '<a href="http://localhost/Projetweb/Site/detail_saison.php?numsaisons='.$numsaisons[$i].'"><p>'.$namesaison[$i].', date : '.$datesaison[$i].'</p></a>
				<p>
					<a href="http://localhost/Projetweb/Site/detail_saison.php?numsaisons='.$numsaisons[$i].'">';
					if ($imgseriesaison[$i]!=NULL)	$html .= '<img src="https://image.tmdb.org/t/p/w185'.$imgseriesaison[$i].'" alt="'.$namesaison[$i].'" id="imgseriesaison"/>';
					else $html .= '<img src="http://localhost/Projetweb/Site/images/photo_manquante.jpg" alt="Pas d\'image"/>';	
			}
			$html .='</a>
				</p>
			</div>
		</div>
	</div>';
	echo $html;
    //include("footer.php");
	
?>
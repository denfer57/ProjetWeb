<?php
	include("banniere.php"); 
	include("connexion_bdd.php");	
	$numsaisons = $_GET["numsaisons"];
	
	$queryepisodes = "SELECT episode_id
		FROM seasonsepisodes
		WHERE season_id = :numsaisons";
	$statement = $connexion->prepare($queryepisodes);
	$statement->bindValue(":numsaisons", $numsaisons, PDO::PARAM_STR);
	$statement->execute();
	$idepisode = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
	
	$querynameepisodes = "SELECT name, air_date, number, still_path
		FROM episodes
		WHERE id = :idepisode
		ORDER BY number";
	$statement = $connexion->prepare($querynameepisodes);
	for($i=0;$i<count($idepisode);$i++){
		$statement->bindValue(":idepisode", $idepisode[$i], PDO::PARAM_STR);
		$statement->execute();
		$rowep = $statement->fetch();
		$nomepisode[$i] = $rowep[0];
		$dateepisode[$i] = $rowep[1];
		$numepisode[$i] = $rowep[2];
		$imgepisode[$i] = $rowep[3];
	}
	
	$html = "";
	$html.= '		
	<html>
	<head>
	<title>Detail d\'une série</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="detail_serie.css" />
	</head>
	<body><p>';
	
	for($i=0;$i<count($idepisode);$i++){
		$html .='
		<form method="post" name="ajoutepisode" id="ajoutepisode" action="ajoutepisode.php">
		<img src="https://image.tmdb.org/t/p/w185'.$imgepisode[$i].'" alt="'.$nomepisode[$i].'" id="imgseriesaison"/>
		Episode '.$numepisode[$i].' : '.$nomepisode[$i].', date : '.$dateepisode[$i].'<input name="Episode[]" value="'.$i.'" type="checkbox">';
	}
	$html .='</p><input value="Add this episode(s) on my views" type="submit">
		</form>
		<form>
			<input type="button" value="Retour" onclick="history.go(-1)">
		</form>
		</div>
		</div>
	</div>
    
	</body>
	</html>';
	
	echo $html;
?>
<!DOCTYPE html>		
	<html>
	<head>
	<title>Detail d'une saison</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="global.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
	</head>
	<body>
		
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
	$numsaisons = $_GET["numsaisons"];
	
	$queryepisodes = "SELECT episode_id
		FROM seasonsepisodes
		WHERE season_id = :numsaisons
		ORDER BY episode_id ASC";
	$statement = $connexion->prepare($queryepisodes);
	$statement->bindValue(":numsaisons", $numsaisons, PDO::PARAM_STR);
	$statement->execute();
	$idepisode = $statement->fetchAll(PDO::FETCH_COLUMN, 0);

	$querynameepisodes = "SELECT name, air_date, number, still_path
		FROM episodes
		WHERE id = :idepisode";
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
	
	for($i=0;$i<count($idepisode);$i++){
		$html .='
		<div class="container">
        <div class="row">
        	<div class="col-lg-10">
            	<form method="post" name="ajoutepisode" id="ajoutepisode" action="ajoutepisodes.php">
            	Episode '.$numepisode[$i].' : '.$nomepisode[$i].', date : '.$dateepisode[$i].'<input name="Episode[]" value="'.$idepisode[$i].'" type="checkbox">
            </div>
            <div class="col-lg-10">';
  				if ($imgepisode[$i]!=NULL) $html .= '<img src="https://image.tmdb.org/t/p/w185'.$imgepisode[$i].'" alt="'.$nomepisode[$i].'" id="imgseriesaison"/></div>
        </div>
   	 	</div>';
				else $html .= '<img src="http://localhost/Projetweb/Site/images/photo_manquante.jpg" alt="Pas d\'image"/></div>
        </div>
    	</div>';
	}
	$html .=' 
	<div class="container">
	<div class="row">
		<div class="col-lg-10">
			<input value="Add this episode(s) on my views" type="submit">
			</form>
			<form>
				<input type="button" value="Back" onclick="history.go(-1)">
			</form>
		</div>
	</div>
	</div>
		</body>
	</html>';
	echo $html;
    //include("footer.php");
?>
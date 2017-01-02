<?php
	$html = "";
	$html.= '<!DOCTYPE html>
	<head>
		<meta charset=\"UTF-8\" />
		<title>Profil</title>
		<link rel="stylesheet" type="text/css" href="detail_serie.css" />
    	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
    	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	</head>
	<body>';
	session_start();
	//L'utilisateur est obligatoirement connecté pour voir son profil.
	include("banniereco.php"); // bannière d'utilisateur connecté
	include("connexion_bdd.php");
	
	$id = $_SESSION['id'];
	$query = "SELECT episode_id
	FROM usersepisodes
	WHERE user_id = :iduser";
	$statement = $connexion->prepare($query);

	$statement->bindValue(":iduser", $id, PDO::PARAM_STR);		
	$statement->execute();
	$idepisode = $statement->fetchAll(PDO::FETCH_COLUMN, 0);

	if(count($idepisode)>0) $html.= '<p> Vos épisodes vus sont :</p>';
	else $html.= '<p> Vous n\'avez pas enregistrés d\'épisodes que vous avez vus.</p>';

	$queryepisode = "SELECT name, still_path
	FROM episodes
	WHERE id = :idepisode";
	$statement = $connexion->prepare($queryepisode);

	for($i=0;$i<count($idepisode);$i++){
		$statement->bindValue(":idepisode", $idepisode[$i], PDO::PARAM_STR);
		$statement->execute();
		$rowep = $statement->fetch();
		$name[$i] = $rowep[0];
		$imgepisode[$i] = $rowep[1];
		$html .= '<p>'.$idepisode[$i].', '.$name[$i].'</p>';
  				if ($imgepisode[$i]!=NULL) $html .= '<img src="https://image.tmdb.org/t/p/w185'.$imgepisode[$i].'" alt="'.$name[$i].'" id="imgseriesaison"/>';
				else $html .= '<img src="http://localhost/Projetweb/Site/images/photo_manquante.jpg" alt="Pas d\'image"/>';
	}

	/*Changer de mot de passe ?
	$html.= '<form action="http://localhost/Projetweb/Site/changermdp.php" method="post">
		<div><label for="mdp">Nouveau mot de passe : </label><input type="password" name="mdp" id="mdp" required=""/></div>
		<input name="submit" type="submit" value="Changer" />
	</form>*/
	$html .= '</body>
	</html>';
	
	echo $html;
?>
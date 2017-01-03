<!DOCTYPE html>
	<head>
		<meta charset="UTF-8" />
		<title>Profil</title>
		<link rel="stylesheet" type="text/css" href="global.css" />
    	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
    	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	</head>
	<body>
		
	<?php
	$html = "";
	session_start();
	//L'utilisateur est obligatoirement connecté pour voir son profil.
	include("banniereco.php"); // bannière d'utilisateur connecté
	include("connexion_bdd.php");
	
	//On recupère l'id de l'utilisateur
	$id = $_SESSION['id'];
	//On recupère l'id des épisodes que l'utilsateur a vus.
	$query = "SELECT episode_id
	FROM usersepisodes
	WHERE user_id = :iduser";
	$statement = $connexion->prepare($query);

	$statement->bindValue(":iduser", $id, PDO::PARAM_STR);		
	$statement->execute();
	$idepisode = $statement->fetchAll(PDO::FETCH_COLUMN, 0);

	if(count($idepisode)>0) $html.= '<div>
        <div class="col-lg-3">
		<p style="font-weight: bold">Your episodes you have seen are :</p>';
	else $html.= '<p style="font-weight: bold"> Vous n\'avez pas enregistrés d\'épisodes que vous avez vus.</p>';

	//On recupère le nom des épisodes ainsi que leurs images.
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
	}

	//On recupère les id des saisons
	$queryseason = "SELECT season_id 
	FROM `seasonsepisodes`
	WHERE episode_id = :idepisode";
	$statement = $connexion->prepare($queryseason);

	for($i=0;$i<count($idepisode);$i++){
		$statement->bindValue(":idepisode", $idepisode[$i], PDO::PARAM_STR);
		$statement->execute();
		$rowep = $statement->fetch();
		$idseason[$i] = $rowep[0];
	}

	//On recupère les id des séries
	$queryserie = "SELECT series_id 
	FROM `seriesseasons`
	WHERE season_id = :idseason";
	$statement = $connexion->prepare($queryserie);

	for($i=0;$i<count($idepisode);$i++){
		$statement->bindValue(":idseason", $idseason[$i], PDO::PARAM_STR);
		$statement->execute();
		$rowsea = $statement->fetch();
		$idserie[$i] = $rowsea[0];
	}

	//On recupère le nom des séries
	$queryseriename = "SELECT name 
	FROM `series`
	WHERE id = :idserie";
	$statement = $connexion->prepare($queryseriename);
	for($i=0;$i<count($idepisode);$i++){
		$statement->bindValue(":idserie", $idserie[$i], PDO::PARAM_STR);
		$statement->execute();
		$rowse = $statement->fetch();
		$nameserie[$i] = $rowse[0];
	}

	//On affiche en fonction du nombre d'épisodes vus (boucle)
	for($i=0;$i<count($idepisode);$i++){
		$html .= '<p>Name of the episode : '.$name[$i].' </p>
		<p>Serie : '.$nameserie[$i].'</p>';
  		if ($imgepisode[$i]!=NULL) $html .= '<img src="https://image.tmdb.org/t/p/w185'.$imgepisode[$i].'" alt="'.$name[$i].'" id="imgseriesaison"/>';
		else $html .= '<img src="http://localhost/Projetweb/Site/images/photo_manquante.jpg" alt="Pas d\'image"/>';
	}

	//On recupere l'id genre des séries visionnés par l'utilisateur
	$querygenre = "SELECT genre_id
	FROM seriesgenres
	WHERE series_id = :idserie";
	$statement = $connexion->prepare($querygenre);
	for($i=0;$i<count($idepisode);$i++){
		$statement->bindValue(":idserie", $idserie[$i], PDO::PARAM_STR);
		$statement->execute();
		$rowgen = $statement->fetch();
		$idgenre[$i] = $rowgen[0];
	}

	//1 ère recommandation : des séries choisies au hasard parmi les séries dont l’une des thématiques correspond à la thématique la plus fréquente de l’utilisateur
	//On regarde 5 séries similaires au hasard du même genre pour l'utilisateur
	//Si on a des épisodes enregistrés, on fait les requetes de recommandation.
	if(count($idepisode)>0){
		$querygenre = "SELECT series_id
		FROM seriesgenres
		WHERE genre_id = :idgenre
		ORDER BY RAND()
		LIMIT 5";
		$statement = $connexion->prepare($querygenre);

		//On associe un genre aléatoire parmi les genres des épisodes de l'utilisateur
		$randgenre = rand(0, count($idepisode)-1);
		$statement->bindValue(":idgenre", $idgenre[$randgenre] , PDO::PARAM_STR);
		$statement->execute();
		$rowgen = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
		for($i=0;$i<5;$i++){
			$seriesimi[$i] = $rowgen[$i];
		}

		//On recupere les infos des séries aléatoires
		$queryseriealea = "SELECT name, poster_path
		FROM series
		WHERE id = :seriesimi";
		$statement = $connexion->prepare($queryseriealea);

		for($i=0;$i<5;$i++){
			$statement->bindValue(":seriesimi", $seriesimi[$i], PDO::PARAM_STR);
			$statement->execute();
			$rowseasonalea = $statement->fetch();
			$nameserie[$i] = $rowseasonalea[0];
			$imgserie[$i] = $rowseasonalea[1];
		}

		//On recupere le nom du genre
		$querynamegenre = "SELECT name
		FROM genres";
		$statement = $connexion->prepare($querynamegenre);
		for($i=0;$i<count($idepisode);$i++){
			$statement->bindValue(":idgenre", $idgenre[$randgenre], PDO::PARAM_STR);
			$statement->execute();
			$rowgen = $statement->fetch();
			$namegenre = $rowgen[0];
		}

		$html .= '<p><a href = "http://localhost/Projetweb/Site/deleteepisodes.php" class="btn btn-warning"><span class="glyphicon glyphicon"></span> Delete the episodes</a></p>
		</div>
		<div class="col-lg-3">
		<p style="font-weight: bold">Your recommandations for the genre '.$namegenre.', five similaries series :</p>';

		for($i=0;$i<5;$i++){
			$html .= '<p>Serie : '.$nameserie[$i].'</p>';
	  		if ($imgserie[$i]!=NULL) $html .= '<a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$seriesimi[$i].'">
	  			<img src="https://image.tmdb.org/t/p/w185'.$imgserie[$i].'" alt="'.$nameserie[$i].'" id="imgseriesaison"/></a>';
			else $html .= '<a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$seriesimi[$i].'">
				<img src="http://localhost/Projetweb/Site/images/photo_manquante.jpg" alt="Pas d\'image"/></a>';
		}

		//2ème recommandation : des séries choisies au hasard parmi les séries du même réalisateur que la série actuellement visualisée sur le site.
		//On recupere l'id du réalisateur
		$querynamegenre = "SELECT creator_id
		FROM seriescreators
		WHERE series_id = :idserie";
		$statement = $connexion->prepare($querynamegenre);
		for($i=0;$i<count($idepisode);$i++){
			$statement->bindValue(":idserie", $idserie[$randgenre], PDO::PARAM_STR);
			$statement->execute();
			$rowgen = $statement->fetch();
			$idcreator = $rowgen[0];
		}

		//On recupère les infos des réalisateurs
		$querygenre = "SELECT series_id
		FROM seriescreators
		WHERE creator_id = :idcreator
		ORDER BY RAND()
		LIMIT 2";
		$statement = $connexion->prepare($querygenre);

		//On associe des séries aléatoires avec un realisateur similaire a la serie visionnée
		$statement->bindValue(":idcreator", $idcreator , PDO::PARAM_STR);
		$statement->execute();
		$rowgen2 = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
		$seriesimi2 = $rowgen2[0];

		//On recupere les infos des séries aléatoires
		$queryseriealea = "SELECT name, poster_path
		FROM series
		WHERE id = :seriesimi2";
		$statement = $connexion->prepare($queryseriealea);

		for($i=0;$i<5;$i++){
			$statement->bindValue(":seriesimi2", $seriesimi2, PDO::PARAM_STR);
			$statement->execute();
			$rowseasonalea = $statement->fetch();
			$nameserie2 = $rowseasonalea[0];
			$imgserie2 = $rowseasonalea[1];
		}

		$html .= '</div><div class="col-lg-3">
		<p style="font-weight: bold">Serie with the same creator :</p>';

		$html .= '<p>Serie : '.$nameserie2.'</p>';
	  	if ($imgserie!=NULL) $html .= '<a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$seriesimi2.'">
	  		<img src="https://image.tmdb.org/t/p/w185'.$imgserie2.'" alt="'.$nameserie2.'" id="imgseriesaison"/></a>';
		else $html .= '<a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$seriesimi2.'">
			<img src="http://localhost/Projetweb/Site/images/photo_manquante.jpg" alt="Pas d\'image"/></a>';
	}
	/*Changer de mot de passe ?
	$html.= '<form action="http://localhost/Projetweb/Site/changermdp.php" method="post">
		<div><label for="mdp">Nouveau mot de passe : </label><input type="password" name="mdp" id="mdp" required=""/></div>
		<input name="submit" type="submit" value="Changer" />
	</form>*/
	$html .= '</div></div>
	</body>
	</html>';
	
	echo $html;
?>
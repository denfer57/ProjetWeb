<script type="text/javascript">
// Affiche ou masque les épisodes de la saison
function AfficherMasquer()		
{
	divInfo = document.getElementById('divacacher');
	if (divInfo.style.display == 'none')
		divInfo.style.display = 'block';
	else
		divInfo.style.display = 'none';
}
</script>
<?php 
	include("banniere.php"); 
	include("connexion_bdd.php");
	//include("footer.php");
	
	$nameserie = $_GET['nameserie']; //donnée récupérée au clic pour le détail d'une série avec le $_GET['serie'];
	
	//partie requête
	
	//1ere requête : nombre de saisons/épisodes de la série, img, résumé, nom de la série, popularité, lien
	$queryvarserie = "SELECT number_of_seasons, number_of_episodes, poster_path, overview, name, popularity, homepage, id
		FROM series
		WHERE name = :name";
	$statement = $connexion->prepare($queryvarserie);
	$statement->bindValue(":name", $nameserie, PDO::PARAM_STR);
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
	// on récupère les résultats de la 1ère ligne
	$numsaisons = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
	/*for($i=0;$i++;i<$querysaisons->rowCount())
		$numsaisons[i] = $row[i];*/
	
	//3eme requête : récupération des noms de la saison de la série
	$querynamesaisons = "SELECT name, air_date
		FROM seasons
		WHERE id = :numsaisons";
	$statement = $connexion->prepare($querynamesaisons);
	$statement->bindValue(":numsaisons", $numsaisons[0], PDO::PARAM_STR);
	$statement->execute();
	$rows = $statement->fetch();
	$numsaison = $rows[0];
	$datesaison = $rows[1];
	
	//4eme requête : récupération des id des épisodes de la saison de la série
	$queryepisodes = "SELECT episode_id
		FROM seasonsepisodes
		WHERE season_id = :numsaison";
	$statement = $connexion->prepare($queryepisodes);
	$statement->bindValue(":numsaison", $numsaisons[0], PDO::PARAM_STR);
	$statement->execute();
	// on récupère les résultats de la 1ère ligne
	$idepisode = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
	
	//5eme requête : récupération des noms des épisodes de la saison de la série
	$querynameepisodes = "SELECT name, air_date, number
		FROM episodes
		WHERE id = :idepisode";
	$statement = $connexion->prepare($querynameepisodes);
	$statement->bindValue(":idepisode", $idepisode[0], PDO::PARAM_STR);
	$statement->execute();
	$rowep = $statement->fetch();
	$nomepisode = $rowep[0];
	$dateepisode = $rowep[1];
	$numepisode = $rowep[2];

	//html de la page
	$html = "";
	$html.= '		
	<html>
	<head>
	<title>Detail d\'une série</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="detail_serie.css" />
	</head>
	<body>
	
	<div>
		<div class="gaucheserie">
				<p>'.$nom_serie.'</p>
				<img src="https://image.tmdb.org/t/p/w185'.$imgserie.'" alt="'.$nom_serie.'" id="imgserie"/>
				<div>
					<p>Abstract of the series : '.$resume.'</p>
					<p style="text-align:justify;"></p>
				</div>
		</div>
		<div class="droiteserie">
			<p>There is : '.$nbsaisons.' season(s) and '.$nbepisodes.' episode(s).</p>
			<p><input id="fleche" src="images/fleche.jpg" alt="masquer ou afficher" type="image" onclick="AfficherMasquer()">'.$numsaison.', date : '.$datesaison.'</p>
			<div id="divacacher" style="display:none;">
				<form method="post" name="ajoutepisode" id="ajoutepisode" action="ajoutepisode.php">
					<p>Episode '.$numepisode.' : '.$nomepisode.', date : '.$dateepisode.'<input name="Choix[]" value="1" type="checkbox"></p>
					<input value="Add this episode(s) on my views" type="submit">
				</form>
			</div>
			<div>
				<div>Popularity :
					<p style="color:red;">'.$popularity.'</p>
				</div>
				<div> More details about the series : 
					<p><a href="'.$lien.'" target="_blank">Click here</a></p>
				</div>
			</div>
		</div>
	</div>
    
	</body>
	</html>';

	echo $html;
?>
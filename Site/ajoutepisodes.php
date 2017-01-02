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
	$html = "";
	$html.= '		
	<html>
	<head>
	<title>Ajout</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="detail_serie.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
	</head>
	<body>';

	function addUserEpisodes($episodes,$name){
		include("connexion_bdd.php");
		$queryepisodes = "INSERT INTO usersepisodes(user_id, episode_id)
			VALUES (:id,:episodes)";
		$statement = $connexion->prepare($queryepisodes);
		for($i=0;$i<count($episodes);$i++){
			$statement->bindValue(":id", $_SESSION['id'], PDO::PARAM_STR);
			$statement->bindValue(":episodes", $episodes[$i], PDO::PARAM_STR);
			$statement->execute();
		}
	}

	if($_SESSION)
	{
		$ndc = $_SESSION['name'];
        if(isset($_POST["Episode"])) {
        	addUserEpisodes($_POST["Episode"],$ndc);
       		$html.= "L'ajout d'épisode(s) a été effectué !"; 
        }
        else $html.= "Vous n'avez pas sélectionner d'épisode(s) !"; 
    }
     else
	{
		$html.= "Veuilez vous connecter !";
	}
	

	$html.= "</body>
	</html>";

	echo $html;
	//include("footer.php");
?>
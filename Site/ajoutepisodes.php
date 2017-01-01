<?php 
	include("banniere.php"); 
	include("connexion_bdd.php");
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
	$idepisodes = $_GET["idepisodes"];

	if(isset($_SESSION['name']))
	{
    	require 'connexion.php';
    	$donnees = mysql_query("SELECT * FROM users WHERE name='" . $_SESSION['name'] . "'");
    	$reponse = mysql_fetch_assoc($donnees);
    	mysql_close();
    	if ($reponse !== FALSE)
    	{
       		if($reponse['id'] == $_SESSION['id'])
        	{
        		$html.= "L'ajout de ces épisodes a été effectué !";
            	$connect = 1;
        	}
        }
        else
        {
        	$html.= "Veuilez vous connecter !";
            $connect = 0;
        }    
    }
	else
	{
		$html.= "Veuilez vous connecter !";
   		$connect = 0;
	}

	if($connect=1){
		$queryepisodes = "INSERT INTO usersepisodes(user_id, episode_id)
			VALUES (:id,:idepisode)";
		$statement = $connexion->prepare($queryepisodes);
		for($i=0;$i<count($idepisode);$i++){
			$statement->bindValue(":id", $_SESSION['id'], PDO::PARAM_STR);
			$statement->bindValue(":idepisode", $idepisode[$i], PDO::PARAM_STR);
			$statement->execute();
		}
	}
	$html.= "</body>
	</html>";

	echo $html;
	//include("footer.php");
	echo $html;
?>
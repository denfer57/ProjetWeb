<?php
	include("connexion_bdd.php");	
	session_start();
	//On recupere l'id de l'utilisateur
	$id = $_SESSION['id'];

	//On supprime ses épisodes
	$querynamegenre = "DELETE FROM `usersepisodes` 
	WHERE user_id = :id";
	$statement = $connexion->prepare($querynamegenre);
	$statement->bindValue(":id", $id, PDO::PARAM_STR);
	$statement->execute();

	$html = "";
	$html .= '<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8" />
	        <title>Delete</title>
			<meta name="viewport" content="width=max-device-width, initial-scale=1" />
			<meta http-equiv="refresh" content="2; url=profile.php"/>
		</head>
		<body>
			<div style="text-align: center;">
				<h2 style="color:red">Vous avez supprimé vos/votre épisode(s)</h2>
				<p><a href="http://localhost/Projetweb/Site/profile.php">Cliquez ici si vous n\'êtes pas redirigé automatiquement dans <span id="Message">2</span> secondes.</a></p>
			</div>
		</body>
	</html>';

	echo $html;
?>
<script>
		var i = 2;
		function chrono()
		{
			document.getElementById("Message").innerHTML = i;
			compte=setTimeout('chrono()', 1000);
			i--;
		}
		chrono();
</script>
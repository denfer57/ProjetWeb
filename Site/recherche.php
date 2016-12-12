<?php 
	include("banniere.php");
	include("connexion_bdd.php");	
    $recherche=$_POST['recherche'];
	$html = "";
    $html .= '<html>
	<head>
	<title>Accueil</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="detail_serie.css" />
	</head>
	<body>
	<div id=\'milieu\'>
        <h2>Résultats correspondants à votre recherche '.$recherche.' :</h2>';
      
    //Requète        
	$queryvarserie = "SELECT poster_path, name, original_name, id 
		FROM `series` WHERE name OR original_name LIKE $recherche ORDER BY `series`.`name` DESC";
	$statement = $connexion->prepare($queryvarserie);
	$statement->execute();
	$rowvar = $statement->fetch();
	$popularity = $rowvar[0];
	$imgserie = $rowvar[1];
	$nameserie = $rowvar[2];
	$idserie = $rowvar[3];
	
    $html .= 
        '<div class="gaucheserie">
		<a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie.'"><img src="https://image.tmdb.org/t/p/w185'.$imgserie.'" alt="'.$nameserie.'" id="imgserie"/></a>
	</div>
	</body>
	</html>';
	
	echo $html;
?>
    

<!DOCTYPE html>
	<html>
	<head>
		<title>Accueil</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="global.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	</head>
	<body>
		<?php
		$html = "";
	session_start();
	//On regarde si l'utilisateur est connecté
	if($_SESSION) {
		include("banniereco.php"); // bannière d'utilisateur connecté
	}
	else {
		include("banniere.php"); // bannière d'utilisateur non connecté
	}

	include("connexion_bdd.php");
	
	//1ere requête : La plus populaire
	$queryvarserie = "SELECT popularity,poster_path, name, id 
		FROM `series` 
		ORDER BY `series`.`popularity` DESC";
	$statement = $connexion->prepare($queryvarserie);
	$statement->execute();
	$rowvar = $statement->fetch();
	$popularity = $rowvar[0];
	$imgserie = $rowvar[1];
	$nameserie = $rowvar[2];
	$idserie = $rowvar[3];

	// 2ème requête : Nouvelle série
	$queryproc = "SELECT first_air_date, poster_path, name, id 
		FROM `series` 
		ORDER BY `series`.`first_air_date` DESC";
	$statement = $connexion->prepare($queryproc);
	$statement->execute();
	$rowvar = $statement->fetch();
	$datesortie = $rowvar[0];
	$imgserie2 = $rowvar[1];
	$nameserie2 = $rowvar[2];
	$idserie2 = $rowvar[3];

	// Top 10 des plus populaires
	$querytop10 = "SELECT *
	FROM `series` 
	WHERE 1
	ORDER BY `series`.`popularity` DESC
	LIMIT 10";
	$statement = $connexion->prepare($querytop10);
	$statement->execute();
	
	$i=0;
	while($rowvar2 = $statement->fetch(PDO::FETCH_OBJ)){
		$datesortie3[$i] = $rowvar2->first_air_date;
		$imgserie3[$i] = $rowvar2->poster_path;
		$nameserie3[$i] = $rowvar2->name;
		$idserie3[$i] = $rowvar2->id;
		$i++;
	}

	/*
	<div class="container">
            <section class="row">
                        <div class="col-lg-12">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">

                                    <div class="item active">';
                                        if ($imgserie2!=NULL) $html .= '<a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie3[0].'">
                                        	<img src="https://image.tmdb.org/t/p/w185'.$imgserie3[0].'" alt="'.$nameserie3[0].'" width="460" height="345"/></a>';
                                        else $html .= '<a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie3[0].'">
                                        <img src="http://localhost/Projetweb/Site/images/photo_manquante.jpg" alt="Pas d\'image"/>';
                                        $html .= '<div class="carousel-caption">
                                            <h3>'.$nameserie3[0].'</h3>
                                            <p>Welcome to our slider </p>
                                        </div>
                                    </div>

                                    <div class="item">';
                                        if ($imgserie2!=NULL) $html .= '<a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie3[1].'">
                                        <img src="https://image.tmdb.org/t/p/w185'.$imgserie3[1].'" alt="'.$nameserie3[1].'" width="460" height="345"/>';
                                        else $html .= '<a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie3[1].'">
                                        <img src="http://localhost/Projetweb/Site/images/photo_manquante.jpg" alt="Pas d\'image"/>';
                                        $html .= '<div class="carousel-caption">
                                            <h3>'.$nameserie3[1].'</h3>
                                            <p>Welcome to our slider</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
            </section>
    </div>
    */
    $html .= '
	<div id="milieu">
		<div class="gaucheserie">
			<p>The most popular : '.$popularity.', '.$nameserie.'</p>
			<a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie.'"><img src="https://image.tmdb.org/t/p/w185'.$imgserie.'" alt="'.$nameserie.'" class="imgserie"/></a>
		</div>
		<div class="droiteserie">
		New serie : ';
				$html .= '<p>'.$nameserie2.', sortie le '.$datesortie.'</p>
				<a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie2.'">';
				if ($imgserie2!=NULL) $html .= '<img src="https://image.tmdb.org/t/p/w185'.$imgserie2.'" alt="'.$nameserie2.'" class="imgserie"/>';
				else $html .= '<img src="http://localhost/Projetweb/Site/images/photo_manquante.jpg" alt="Pas d\'image"/>';
		$html .= '</a></div>
	</div>
	</body>
	</html>';
	echo $html;
	
?>
<html>
<head>
	<title>Accueil</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="detail_serie.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
</head>
<body>
    
	<?php
    $recherche=$_POST['recherche'];
    $html="";
    include("banniere.php");
    include("connexion_bdd.php");
    $recherche=$_POST['recherche'];
    $html .="<div id='milieu'>
        <h2>Résultats correspondants à votre recherche ".$recherche." :</h2>";
      
    //Requète récupération séries semblables à la recherche        
	$querych = "SELECT poster_path, name, id 
		FROM `series`
        WHERE name LIKE '%$recherche%' ORDER BY `series`.`name`";
	$statement = $connexion->query($querych);
    $compt=0;
    while ($rowch=$statement->fetch()){
        $imgserie[$compt]=$rowch[0];
        $nameserie[$compt]=$rowch[1];
        $idserie[$compt]=$rowch[2];
        $compt++;
    } //S'il n'y a pas de serie a afficher
    if ($compt==0){
        
		$html .=
        '<div class="affichageserie">
        <p>Pas de résultat</p>';
    }
    else { //Sinon
    for($i=0;$i<$compt;$i++){
		$html .=
        '<div class="affichageserie">
		<p>
            <a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie[$i].'"<p style="font-size:30px;">'.$nameserie[$i].'</p></a>
            <a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie[$i].'"><img src="https://image.tmdb.org/t/p/w185'.$imgserie[$i].'" alt="'.$nameserie[$i].'" id="imgserie"></a>
        </p>';
	}}
    $html .='</div>;';
    
    //Requete récupéraction acteurs

    $html .='</div>';
    
    echo($html);
    
    ?>
    
    
</body>
</html>
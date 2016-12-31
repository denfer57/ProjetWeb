<html>
    <head>
        <title>Actor</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="detail_serie.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
    </head>
    <body>
        <?php
        include("banniere.php"); 
        include("connexion_bdd.php");
        //variables	
        $idactor = $_GET["idactor"];
        $html="";

        //requete rechercher l'acteur souhaité
        $queryact = "SELECT name, profile_path FROM actors WHERE id = :idact";
        $statement = $connexion->prepare($queryact);
        $statement->bindValue(":idact", $idactor, PDO::PARAM_STR);
        $statement->execute();
        $rowact = $statement->fetch();
        $nameact = $rowact[0];
        $imgact = $rowact[1];

        $html .='
        <div class="row">
        <div class="col-lg-offset-1 col-lg-10">
            <h2>'.$nameact.'</h2></br>
        </div>
        </div>';

        //requete épisodes dans lesquels l'acteur apparait
        $compte=0;
        $querye = "SELECT episode_id
        FROM episodesactors
         WHERE actor_id = :idact"; 
        $statement = $connexion->prepare($querye);
        $statement->bindValue(":idact", $idactor, PDO::PARAM_STR);
        $statement->execute();
        while ($rowe=$statement->fetch()){
            $ep_id[$compte]=$rowe[0];
            $compte++;
        }

        //requete série
        $querych = "SELECT poster_path, name, id
		FROM `series`
        WHERE id = (SELECT series_id
        FROM seriesseasons
        WHERE season_id= (SELECT season_id
        FROM seasonsepisodes
        WHERE episode_id= :idepisode))
        ORDER BY `series`.`id`";
        $statement = $connexion->prepare($querych);
        for($i=0;$i<$compte;$i++){
            $statement->bindValue(":idepisode", $ep_id[$i], PDO::PARAM_STR);
            $statement->execute();
            $rows=$statement->fetch();
            $imgserie[$i]=$rows[0];
            $nameserie[$i]=$rows[1];
            $idserie[$i]=$rows[2];
        }


        //afficher acteurs et series
        $compts=count($idserie);
        if ($compts==0){      //S'il n'y a ni serie a afficher

            $html .=
                '<div class="affichageserie">
        <div class="row">
        <div class="col-lg-offset-1 col-lg-10">
        <p>No results found</p></div></div>';
        }
        else {
            $previousid="";
            $html .='
        <div class="row">
        <div class="col-lg-offset-1 col-lg-10">
        <h3>Appears in</h3>';
            for($i=0;$i<$compts;$i++){
                if ($idserie[$i]!=$previousid){
                    $html .=
                        '<div class="serie">
            <div class="col-lg-3">
            <a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie[$i].'"<p style="font-size:20px;">'.$nameserie[$i].'</p></a>
            <a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie[$i].'"><img src="https://image.tmdb.org/t/p/w185'.$imgserie[$i].'" alt="'.$nameserie[$i].'" id="imgserie"></a>
            </div>
        </div>';
                    $previousid=$idserie[$i];
                }}$html .='</div></div>';
        }        

        echo($html);

        ?>
    </body>
</html>
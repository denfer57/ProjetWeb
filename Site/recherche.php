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
        $html .="<div class='row'>
        <div class='col-lg-offset-1 col-lg-10'>
        <h2>Résultats correspondants à votre recherche ".$recherche." :</h2></div></div>";

        //Requète récupération séries semblables à la recherche        
        $querych = "SELECT poster_path, name, id, popularity
		FROM `series`
        WHERE name LIKE '%$recherche%' ORDER BY `series`.`popularity` DESC";
        $statement = $connexion->query($querych);
        $compts=0;
        while ($rows=$statement->fetch()){
            $imgserie[$compts]=$rows[0];
            $nameserie[$compts]=$rows[1];
            $idserie[$compts]=$rows[2];
            $compts++;}

        //Requete récupéraction acteurs                         
        $querych = "SELECT profile_path, name, id 
		FROM `actors`
        WHERE name LIKE '%$recherche%' ORDER BY `actors`.`name`";
        $statement = $connexion->query($querych);
        $compta=0;
        while ($rowa=$statement->fetch()){
            $imgactor[$compta]=$rowa[0];
            $nameactor[$compta]=$rowa[1];
            $idactor[$compta]=$rowa[2];
            $compta++;    

        } 

        if ($compts==0 AND $compta==0){      //S'il n'y a ni serie ni acteur a afficher

            $html .=
                '<div class="affichageserie">
        <div class="row">
        <div class="col-lg-offset-1 col-lg-10">
        <p>No results found</p></div></div>';
        }
        else {

            if($compts!=0) {                //S'il y a des séries a afficher

                $html .='
        <div class="row">
        <div class="col-lg-offset-1 col-lg-10">
        <h3>Series</h3>';
                for($i=0;$i<$compts;$i++){
                    $html .=
                        '<div class="serie">
            <div class="col-lg-3">
            <a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie[$i].'"<p style="font-size:20px;">'.$nameserie[$i].'</p></a>
            <a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie[$i].'"><img src="https://image.tmdb.org/t/p/w185'.$imgserie[$i].'" alt="'.$nameserie[$i].'" id="imgserie"></a>
            </div>
        </div>';
                }$html .='</div></div>';
            }

            if($compta!=0) {                      //S'il y a des acteurs a afficher

                $html .='
        <div class="row">
        <div class="col-lg-offset-1 col-lg-10">
        <h3>Actors</h3>';
                for($i=0;$i<$compts;$i++){
                    $html .=
                        '<div class="serie">
            <div class="col-lg-3">
            <a href="http://localhost/Projetweb/Site/detail_actor.php?idactor='.$idactor[$i].'"<p style="font-size:20px;">'.$nameactor[$i].'</p></a>';
                    if ($imgactor[$i]!=NULL){       //On vérifie qu'une image est disponible
                        $html .='<a href="http://localhost/Projetweb/Site/detail_actor.php?idactor   ='.$idactor[$i].'"><img src="https://image.tmdb.org/t/p/w185'.$imgactor[$i].'" alt="'.$nameactor[$i].'" id="imgactor"></a>
            </div>
        </div>';}
                    else{
                        $html .='<a href="http://localhost/Projetweb/Site/detail_actor.php?idactor   ='.$idactor[$i].'"><img src="images/portrait-manquant.jpg" alt="'.$nameactor[$i].'" id="imgactor"></a>
            </div>
        </div>';
                    }
                }$html .='</div></div>';    
            }
        }


        echo($html);

        ?>

    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <title>Catalogue</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="global.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
    </head>
    <body>

        <?php
        include("banniere.php");
        include("connexion_bdd.php");
        $html="";
        //requète des genres
        $querygenre="SELECT name, id FROM  genres";
        $statement = $connexion->prepare($querygenre);
        $statement->execute();
        $comptg=0;
        while($rowg=$statement->fetch()){
            $genre_name[$comptg]=$rowg[0];
            $genre_id[$comptg]=$rowg[1];
            $comptg++;
        }
        //placement des bouttons
        $html .='
        <div class="row">
        <div class="col-lg-offset-1 col-lg-10">
        <h2>Catalogue</h2>
        <h3>Genres :</h3>
        <div class="bouttongenres">';
        for($i=0;$i<$comptg;$i++){
            $html .= '<a href="http://localhost/Projetweb/Site/catalogue.php?genre='.$genre_id[$i].'" class="btn btn-primary btn-danger">'.$genre_name[$i].'</a>';
        }$html.="</div>";
        
        //requetes de série
        if (isset($_GET['genre']) AND in_array($_GET['genre'],$genre_id)){ //S'il y a un genre en url et qu'il existe bien on cherche les séries correspondantes
            $genre=$_GET['genre'];
            $querycat="SELECT poster_path, name, id, popularity
            FROM series
            WHERE id IN (SELECT series_id 
            FROM seriesgenres
            WHERE genre_id=:genre)";
            $statement = $connexion->prepare($querycat);
            $statement->bindValue(":genre", $genre, PDO::PARAM_STR);
            $statement->execute();
            $compts=0;
            while($rows=$statement->fetch()){
                $imgserie[$compts]=$rows[0];
                $nameserie[$compts]=$rows[1];
                $idserie[$compts]=$rows[2];
                $compts++;
        }
            //Affichage du nom du genre
            $html.="<div class='row'>
                <div class='col-lg-10'>
                <h3>".$genre_name[array_search($genre,$genre_id)]." series</h3></div></div>";
            
        } else {                                                    //Sinon on affichera tout le catalogue
            $querycat="SELECT poster_path, name, id, popularity
			 FROM series ORDER BY `series`.`popularity` DESC";
            $statement->execute();
            $statement = $connexion->query($querycat);
            $compts=0;
            while($rows=$statement->fetch()){
                $imgserie[$compts]=$rows[0];
                $nameserie[$compts]=$rows[1];
                $idserie[$compts]=$rows[2];
                $compts++;
        }}
            
            $html.="<div class='row'>";
            for($i=0;$i<$compts;$i++){
                    if(strlen($nameserie[$i])>=17){                             //On raccourcie les chaines trop longues
                        $nameserie[$i]=substr($nameserie[$i],0,17)."...";
                    }
                    $html .=
            '<div class="col-lg-3 col-md-4">
                <div class="serie">
                    <a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie[$i].'"><p style="font-size:20px;">'.$nameserie[$i].'</p></a>
                    <a href="http://localhost/Projetweb/Site/detail_serie.php?idserie='.$idserie[$i].'"><img src="https://image.tmdb.org/t/p/w185'.$imgserie[$i].'" alt="'.$nameserie[$i].'"></a>
                </div>
            </div>';
                }
            $html.="</div></div></div>";
        
    
        echo($html);
            
        ?>
        
</body>
</html>

<html>
<head>
	<title>Detail d'une série</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="detail_serie.css" />
</head>
<body>
	
	<?php include("banniere.php"); ?>
    
	<div>
		<div class="gaucheserie">
			<p>How I Meet Your Mother</p>
				<img src="images/How-I-Met-Your-Mother.jpg" alt="HIMYM" id="imgHIMYM"/>
				<div>
					<p>Résumé de la série : </p>
					<p style="text-align:justify;">La série débute en 2030, lorsque Ted Mosby raconte à ses deux enfants comment il a rencontré leur mère. Il se remémore ses jeunes années, et le pilote fait place aux souvenirs de Ted en 2005, où il apprend que son meilleur ami Marshall Eriksen va demander à Lily Aldrin de l’épouser. Ted se demande quand il rencontrera sa future épouse. C’est alors qu’il rencontre Robin Scherbatsky lors de sa dernière sortie au bar où il a l’habitude d’aller, le MacLaren's Pub, où un de ses amis, Barney Stinson, l’aide à faire des rencontres.
					Et c'est ainsi que commence l'incroyable et très longue histoire de Ted, jusqu'à sa rencontre avec la fameuse mère de ses enfants.</p>
				</div>
		</div>
		<div class="droiteserie">
			<input id="fleche" src="images/fleche.jpg" alt="masquer ou afficher" type="image" onclick="AfficherMasquer()">
			<p>Saison 1:</p>
			<div id="divacacher" style="display:none;">
				<form method="post" name="ajoutepisode" id="ajoutepisode" action="ajoutepisode.php">
					<p>Épisode 1 : Un signe<input name="Choix[]" value="1" type="checkbox"></p>
					<p>Épisode 2 : Je te présente Ted<input name="Choix[]" value="2" type="checkbox"></p>
					<p>Épisode 3 : Un goût de liberté<input name="Choix[]" value="3" type="checkbox"></p>
					<p>Épisode 4 : Retour de flamme<input name="Choix[]" value="4" type="checkbox"></p>
					<p>Épisode 5 : La soirée dégustation<input name="Choix[]" value="5" type="checkbox"></p>
					<p>Épisode 6 : Halloween<input name="Choix[]" value="6" type="checkbox"></p>
					<p>Épisode 7 : L'élue<input name="Choix[]" value="7" type="checkbox"></p>
					<p>Épisode 8 : Le duel<input name="Choix[]" value="8" type="checkbox"></p>
					<p>Épisode 9 : Charité bien ordonnée<input name="Choix[]" value="9" type="checkbox"></p>
					<p>Épisode 10 : L'affaire de l’Ananas<input name="Choix[]" value="10" type="checkbox"></p>
					<p>Épisode 11 : Bonne année<input name="Choix[]" value="11" type="checkbox"></p>
					<p>Épisode 12 : Seul ou accompagné<input name="Choix[]" value="12" type="checkbox"></p>
					<p>Épisode 13 : L'inconnue<input name="Choix[]" value="13" type="checkbox"></p>
					<p>Épisode 14 : La bataille navale<input name="Choix[]" value="14" type="checkbox"></p>
					<p>Épisode 15 : Révélations<input name="Choix[]" value="15" type="checkbox"></p>
					<p>Épisode 16 : Amour et pâtisserie<input name="Choix[]" value="16" type="checkbox"></p>
					<p>Épisode 17 : La vie parmi les gorilles<input name="Choix[]" value="17" type="checkbox"></p>
					<p>Épisode 18 : C'est plus l'heure<input name="Choix[]" value="18" type="checkbox"></p>
					<p>Épisode 19 : La jalousie a un prix<input name="Choix[]" value="19" type="checkbox"></p>
					<p>Épisode 20 : C'est mon dernier bal<input name="Choix[]" value="20" type="checkbox"></p>
					<p>Épisode 21 : Arrière-goût<input name="Choix[]" value="21" type="checkbox"></p>
					<p>Épisode 22 : La danse de la pluie<input name="Choix[]" value="22" type="checkbox"></p>
					<input value="Ajouter ce/ces épisodes à mes vues" type="submit">
				</form>
			</div>
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
			<div>
			<!-- Revoir le système des étoiles en fonction de la BDD & fonction JS qui affiche automatiquement les étoiles en fonction de la note --> 
			<!-- Système de notation plutôt ? --> 
				<div>Presse :
					<p>4,5</p><img src="images/etoile_pleine.png" alt="etoile" class="etoile"/><img src="images/etoile_pleine.png" alt="etoile" class="etoile"/><img src="images/etoile_pleine.png" alt="etoile" class="etoile"/><img src="images/etoile_pleine.png" alt="etoile" class="etoile"/><img src="images/etoile_moitie_vide.png" alt="etoile moitié vide" class="etoile"/>
				</div>
				<div>Spectateur :
					<p>3</p><img src="images/etoile_pleine.png" alt="etoile" class="etoile"/><img src="images/etoile_pleine.png" alt="etoile" class="etoile"/><img src="images/etoile_pleine.png" alt="etoile" class="etoile"/>
				</div>
			</div>
		</div>
	</div>
    
	<?php include("footer.php"); ?>
    
</body>
</html>
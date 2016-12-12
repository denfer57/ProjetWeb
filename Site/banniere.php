<div id="banniere">
			<div class="gauche">
				<form action="recherche.php" method="post">
					<input type="text" name="recherche" id="recherche" placeholder="Rechercher série, acteur..." required="true"/>
					<input src="images/recherche.png" alt="Recherche" type="image"/>
				</form>
			</div>
			<div class="droite">
				<form action="http://localhost/Projetweb/Site/connexion.php" method="post">
					<p><label for="ndcco">Nom d'utilisateur : </label><input type="text" name="ndcco" id="ndcco"/></p>
					<p><label for="mdpco">Mot de passe : </label><input type="password" name="mdpco" id="mdpco"/></p>
					<input type="submit" value="Connexion" />
				</form>
				<form action="http://localhost/Projetweb/Site/inscription.html" method="post">
					<input type="submit" value="S'incrire" />
				</form>
			</div>
			<h1>Le site de malade</h1>
</div>
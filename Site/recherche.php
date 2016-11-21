<html>
<head>
	<title>Accueil</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="detail_serie.css" />
</head>
<body>
	<!-- Modèle de base, revoir le design ainsi que les fonctionnalités
	Arnaud tu dois t'en charger -->
	<div id="baniere">
			<div class="gauche">
				<form action="recherche.php" method="post">
					<input type="text" name="recherche" id="recherche" value="Research"/>
					<input src="images/recherche.png" alt="Recherche" type="image"/>
				</form>
			</div>
			<div class="droite">
				<p>User Name<p>
				<p>Connected/Disconnected</p>
			</div>
			<h1>Le site de malade</h1>
	</div>
	
	<div id="milieu"><div class="gaucheserie">
        <p>Bonjour !</p>

        <p>Vous avez recerché : <?php echo $_POST['recherche']; ?> !</p>
	</div>
        
	<div id="footer">
		<a href="http://www.google.com"><img src="images/google.png" alt="Google" class="icone"/></a>
		<a href="http://www.instagramm.com"><img src="images/insta.png" alt="Instagramm" class="icone"/></a>
		<a href="http://www.twitter.com"><img src="images/twitter.png" alt="Twitter" class="icone"/></a>
		<a href="http://www.facebook.com"><img src="images/fb.png" alt="Facebook" class="icone"/></a>
	</div>
</body>
</html>
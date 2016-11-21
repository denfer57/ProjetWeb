<html>
<head>
	<title>Accueil</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="detail_serie.css" />
</head>
<body>
	<?php include("banniere.php"); ?>
	
	<div id="milieu">
        <h1>Vous avez recherché : <?php echo $_POST['recherche']; ?> !</h1>
	</div>
        
	<?php include("footer.php"); ?>
</body>
</html>
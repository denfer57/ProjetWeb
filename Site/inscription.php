<?php 
	include("banniere.php");
 	include("footer.php");
	function checkUserName($username){
		include("connexion_bdd.php");
		$query = "SELECT COUNT(*) nb
		FROM users
		WHERE name = :name";
		$statement = $connexion->prepare($query);
		$statement->bindValue(":name", $username, PDO::PARAM_STR);
		$statement->execute();
		
		$row = $statement->fetch();

		//Si le resultat de la requete vaut 1, on retourne vrai
		//Autrement dit, s' il y a deux fois le même nom, on renvoie vrai
		if($row['nb']==1) return true;
		else return false;
	}
	
	function addUser(){
		include("connexion_bdd.php");
		$name = trim($_POST["ndc"]);
		$mdp = trim($_POST["mdp"]);
		$mail = trim($_POST["mail"]);
		
		$query = "INSERT INTO users (name, password, email) VALUES (:name, :mdp, :mail)";
		$statement = $connexion->prepare($query);
		$statement->bindValue(":name", $name, PDO::PARAM_STR);
		$statement->bindValue(":mdp", hash('sha256',$mdp), PDO::PARAM_STR); // 64 caractères maximums pour le mot de passe => sha 256
		$statement->bindValue(":mail", $mail, PDO::PARAM_STR);
		$statement->execute();
	}
	
	$html = "";
	$html.= '<!DOCTYPE html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="detail_serie.css" />
		<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
		<title>Inscription</title>
	</head>
	<body>
	<div style="text-align:center;">
		<h1>Inscription</h1>
		<form action="http://localhost/Projetweb/Site/inscription.php" method="post">
				<div><label for="ndc">Nom d\'utilisateur : </label><input type="text" name="ndc" id="ndc" required=""/></div>
				<div><label for="mdp">Mot de passe : </label><input type="password" name="mdp" id="mdp" required=""/></div>
				<div><label for="mdpconf">Confirmation du mot de passe : </label><input type="password" name="passwordconf" id="passwordconf" required=""/></div>
				<label for="mail">Adresse email : </label><input type="text" name="mail" id="mail" required=""/>
				<input name="submit" type="submit" value="Valider" />
		</form>
	</div>';
	
 	if ( isset ( $_POST['submit'] ) ){
		$champOk = true;
		$ndc = ($_POST["ndc"]);

		if(strlen($ndc)>=4) {
			if(checkUserName($ndc)==true) {
				$html.='<p style="color:red"> Le nom d\'utilisateur est déjà pris</p>'; 
				$champOk = false;
			}
			else $html.='<p style="color:green"> Le nom d\'utilisateur n\'est pas pris</p>'; 
		}
		else {
				$html.='<p style="color:red"> Le nom d\'utilisateur est erroné</p>';
				$champOk = false;
		}
		if(strlen($_POST["mdp"])>=8) $html.='<p style="color:green"> Le mot de passe est ok</p>';
		else { 
				$html.='<p style="color:red"> Le mot de passe est erroné</p>';
				$champOk = false;
		}
		if(strcmp($_POST["passwordconf"],$_POST["mdp"])==0)  $html.='<p style="color:green"> La confirmation de mot de passe est ok</p>';
		else {
				$html.='<p style="color:red"> La confirmation de mot de passe est erronée</p>';
				$champOk = false;
		}
		if(strstr($_POST["mail"],'@')) $html.='<p style="color:green"> L\'adresse mail est ok</p>';
		else {
			$html.='<p style="color:red"> L\'adresse mail est erronée</p>';
			$champOk = false;
		}
			
		if($champOk == true) {
			$html.='<p style="color:blue">Les champs ont été validés par le serveur.</p>
			<p style="color:blue">L\'utilisateur '.$ndc.' a été enregistré.</p>
			<p> Vous pouvez vous connecter dès à présent !</p>';
			addUser(); // on ajoute l'utilisateur si tout a été validé
		}
		else $html.='<p style="color:green">Veuillez corriger les champs.</p>';
	}
	$html.= '
	</body>
	</html>';

	echo $html;
?>
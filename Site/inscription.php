<?php 
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
		$statement->bindValue(":mdp", hash('sha384',$mdp), PDO::PARAM_STR);
		$statement->bindValue(":mail", $mail, PDO::PARAM_STR);
		$statement->execute();
	}
	
	$html = "";
	$html.= '<!DOCTYPE html>
	<head>
		<meta charset=\"UTF-8\" />
		<meta http-equiv="refresh" content="5; URL=http://localhost/Projetweb/Site/">
		<title>Verification</title>
	</head>
	<body>';
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
		<p style="color:blue">L\'utilisateur '.$ndc.' a été enregistré.</p>';
		addUser(); // on ajoute l'utilisateur si tout a été validé
		$html.= '<p style="text-align: center;">Redirection vers la page d\'accueil dans <span id="Message">5</span> seconde(s).</p>';
	}
	$html.= '
		<footer>
			Fait par Jordan Fromeyer
		</footer>
	</body>
	</html>';

	echo $html;
?>
<script>
		var i = 5;
		function chrono()
		{
			document.getElementById("Message").innerHTML = i;
			compte=setTimeout('chrono()', 1000);
			i--;
		}
		chrono();
</script>
<?php
	$html = "";
	$html.= '<!DOCTYPE html>
	<html>
	<head>
		<meta charset=\"UTF-8\" />
		<meta http-equiv="refresh" content="5; URL=http://localhost/Projetweb/Site/">
		<title>Verification connexion</title>
	</head>
	<body>';
	
	function verifUser($username){
		include("connexion_bdd.php");
		
		$query = "SELECT password FROM users WHERE name = '$username'";
		$statement = $connexion->prepare($query);
		$statement->execute();
		$row = $statement->fetch();
		$password = $row[0];
		$passwordco = hash('sha256',trim($_POST["mdpco"]));
		if(strcmp($password, $passwordco)==0) return true;
		else return false;
	}
	
	if(isset($_POST["ndcco"])) {
		$username = trim($_POST["ndcco"]);
		if(verifUser($username)==true) {
			$html.='<p style="color:green"> La connexion a fonctionnée.</p>
			<p>Redirection vers la page d\'accueil dans <span id="Message">5</span> seconde(s).</p>';
		}
		else $html.='<p style="color:red"> Le nom d\'utilisateur ou le mot de passe est incorrect</p>
			<p>Redirection vers la page d\'accueil dans <span id="Message">5</span> seconde(s).</p>';
		
	}
	
	$html.= "</body>
	</html>";

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

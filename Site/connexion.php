<!DOCTYPE html>
	<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="refresh" content="5; URL=http://localhost/Projetweb/Site/">
		<title>Verification connexion</title>
	</head>
	<body>
<?php
	$html = "";
	session_start();
	function verifUser($username){
		include("connexion_bdd.php");
		
		$query = "SELECT password, id FROM users WHERE name = '$username'";
		$statement = $connexion->prepare($query);
		$statement->execute();
		$row = $statement->fetch();
		$password = $row[0];
		$id = $row[1];
		$passwordco = hash('sha256',trim($_POST["mdpco"]));
		if(strcmp($password, $passwordco)==0) {
			$_SESSION["name"] = $username;
			$_SESSION["id"] = $id;
			return true;
		}
		else return false;
	}
	
	if(isset($_POST["ndcco"])) {
		$username = trim($_POST["ndcco"]);
		if(verifUser($username)==true) {
			$html.='<div style="text-align: center;">
			<h2 style="color:green"> La connexion a fonctionnée.</h2>
			<p>Redirection vers la page d\'accueil dans <span id="Message">5</span> seconde(s).</p>
			</div>';
		}
		else $html.='<div style="text-align: center;">
			<h2 style="color:red"> Le nom d\'utilisateur ou le mot de passe est incorrect</h2>
			<p>Redirection vers la page d\'accueil dans <span id="Message">5</span> seconde(s).</p>
			</div>';
		
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

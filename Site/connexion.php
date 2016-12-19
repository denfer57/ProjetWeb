<?php
	$html = "";
	$html.= '<!DOCTYPE html>
	<head>
		<meta charset=\"UTF-8\" />
		<meta http-equiv="refresh" content="5; URL=http://localhost/Projetweb/Site/">
		<title>Verification connexion</title>
	</head>
	<body>';
	if(isset($_POST["ndcco"])) $username = trim($_POST["ndcco"]);
	
	function verifUser($username){
		include("connexion_bdd.php");
		
		$query = "SELECT password FROM users WHERE name = '$username'";
		$statement = $connexion->prepare($query);
		$statement->execute();
		//if we have a result, the username is right
		if($row = $statement->fetch()){
			// Compare the two password, if true, the connexion is available
			$password = $row[0];
			$passwordco = hash('sha384',trim($_POST["mdpco"]));
			if(strcmp($password, $passwordco)==0) return true;
		}
		else return false;
	}
	
	if(isset($_POST["ndcco"])) {
		if(verifUser($username)==true) {
		include("connexion_bdd.php");
		$html.='<p style="color:green"> Tout est ok.</p>';
		}
		else $html.='<p style="color:red"> Le nom d\'utilisateur ou le mot de passe est incorrect</p>
		<p style="text-align: center;">Redirection vers la page d\'accueil dans <span id="Message">5</span> seconde(s).</p>';
	}
	
	echo $html;
    include("footer.php");
	
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
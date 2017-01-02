<?php
	session_start();
	session_unset();
	session_destroy();
	$html = "";
	$html .= '<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8" />
	        <title>Déconnexion</title>
			<meta name="viewport" content="width=max-device-width, initial-scale=1" />
			<meta http-equiv="refresh" content="5;index.php"/>
		</head>
		<body>
			<div style="text-align: center;">
				<h2 style="color:red">Vous avez été déconnecté(e)</h2>
				<p><a class="Lien" href="http://localhost/Projetweb/Site/index.php">Cliquez ici si vous n\'êtes pas redirigé automatiquement dans <span id="Message">5</span> secondes.</a></p>
			</div>
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
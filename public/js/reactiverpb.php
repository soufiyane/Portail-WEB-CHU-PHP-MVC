<?php
// On active les sessions :
require_once('includes/verification.php'); 
// On inclus les donn�es de connexion :
require_once('includes/connexion.php'); 
require_once('includes/verification.php'); 
require_once('includes/alias_tables.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title> R�activer un probl�me </title>
		<script src="html5shiv/dist/html5shiv.js">
		</script>
		<script>
			function redirige(adresse)
			{
				location.href = adresse;
			}
		</script>
	</head>
	<body>		
		<?php
		// On repasse le statut � 1 (1 pour r�current, 0 pour autre et 2 pour d�sactiv�)
		//mysql_select_db($database_db,$db)   or die('Erreur de selection '.mysqli_error($db)); 		
		$sql="UPDATE $tableincidents SET statut = 1 WHERE id=".$_GET['id']."";
		mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
		//Puis on informe l'utilisateur et on redirige vers la page de gestion des incidents r�currents.
		?>
		<table width="100%" align="center">
			<tr>
				<td>
					<h2> R�activation enregistr�e. </h2>
				</td>
			</tr>
			<tr>
				<td>
					<h3> <i> Actualisation des probl�mes </i> <img src="img/img/loading1.gif" /> </h3>
				</td>
			</tr>
		</table>
		<script>
			redirige('<?php echo $_SESSION['racine']?>incidents/gestion_incidents_recurrents');
		</script>
	</body>
</html>

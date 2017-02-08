<?php
// On active les sessions :
require_once('includes/verification.php'); 
// On inclus les données de connexion :
require_once('includes/connexion.php'); 
require_once('includes/verification.php'); 
require_once('includes/alias_tables.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Réactiver un problème </title>
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
		// On repasse le statut à 1 (1 pour récurrent, 0 pour autre et 2 pour désactivé)
		//mysql_select_db($database_db,$db)   or die('Erreur de selection '.mysqli_error($db)); 		
		$sql="UPDATE $tableincidents SET statut = 1 WHERE id=".$_GET['id']."";
		mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
		//Puis on informe l'utilisateur et on redirige vers la page de gestion des incidents récurrents.
		?>
		<table width="100%" align="center">
			<tr>
				<td>
					<h2> Réactivation enregistrée. </h2>
				</td>
			</tr>
			<tr>
				<td>
					<h3> <i> Actualisation des problèmes </i> <img src="img/img/loading1.gif" /> </h3>
				</td>
			</tr>
		</table>
		<script>
			redirige('<?php echo $_SESSION['racine']?>incidents/gestion_incidents_recurrents');
		</script>
	</body>
</html>

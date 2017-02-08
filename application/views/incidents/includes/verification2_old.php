<?php
// On active les sessions :
session_start();
 
// On teste la pr�sence des sessions d'identification :
if((isset($_SESSION['identifiant'])) && (isset($_SESSION['mot_de_passe'])))
{
	// Si celles-ci existent, on inclus les donn�es de connexion :
	include('./includes/connexion.php');
 
	// On teste les donn�es des sessions avec celles du fichier :
	if(($_SESSION['identifiant'] != $Identifiant)
	|| ($_SESSION['mot_de_passe'] != $Mot_de_passe))
	{
		// Si elles ne correspondent pas, on redirige le visiteur :
		?>
		<script>
			alert('Vous devez vous connectez.');
			location.href='index.php';
		</script>
		<?php
		exit();
	}
}
else
{
	// Si les sessions n'existent pas, on redirige � la page d'authentification :
	?>
	<script>
			alert('Vous devez vous connectez.');
			location.href='index.php';
		</script>
	<?php
	exit();
}
?>
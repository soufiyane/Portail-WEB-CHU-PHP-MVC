<?php
//require_once("../crawlprotect/include/cppf.php");
session_start();
if(empty($_SESSION['identifiant']))
{
$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
// Si inexistante ou nulle, on redirige vers le formulaire de login
$_SESSION['url'] = $monUrl;
//header('Location: http://webformation/espace_etudiants/index.php');
?>
<script>
alert('Votre session a expirée, veuillez vous reconnecter.');
window.location = "../index.php";
//window.location = "http://cfm-hop-tlse.fr/index.php";
</script>
<?php
exit();
}
function securite_bdd($string)
	{
		// On regarde si le type de string est un nombre entier (int)
		if(ctype_digit($string))
		{
			$string = intval($string);
		}
		// Pour tous les autres types
		else
		{
			//$string = mysqli_real_escape_string($db,$string);
			$string = addslashes($string);
		}
		
		return $string;
	}
?>
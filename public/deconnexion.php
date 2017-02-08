<?php
// On active les sessions :
	session_start();
 
// On detruit les sessions :
	unset($_SESSION['identifiant'], $_SESSION['mot_de_passe'],$_SESSION['url'],$_SESSION['statut'],$_SESSION['id_ecole']) ;
 
// On redirige le visiteur vers la page désirée :
	header('Location: ../index.php');
	exit();
?>
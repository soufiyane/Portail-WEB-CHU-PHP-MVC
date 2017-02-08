<?php
// On active les sessions :
session_start();
require_once('includes/connexion.php');
require_once('includes/verification.php');
require_once('includes/alias_tables.php');
error_reporting(0);	
switch($_SESSION['statut']){ 
		//case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		//case 1: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 2: break;
                default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Associer un probl�me </title>
		<script src="html5shiv/dist/html5shiv.js">
		</script>
		<script language=javascript>
		function redirige(adresse)
		{
			location.href = adresse;
		}
		</script> 
	</head>
	<body>
		<?php 
		require("class.phpmailer.php"); // class DE PHPMailler qui marche avec le class class.smtp.php
		$mail = new PHPMailer();
		include('includes/configmail.php');
                if(isset($_POST['idusers'])){               
                //echo 'test'.$_POST['idusers'];
                $sql="SELECT mail FROM $tablesalles,$tableincidusers WHERE $tableincidusers.id = '".$_POST['idusers']."' AND $tablesalles.identifiant=$tableincidusers.id_users";
                mysqli_query($db,$sql);
		        $reqtest=mysqli_query($db,$sql);
                if(mysqli_num_rows($reqtest)=="0"){
                $sql="SELECT mail FROM $tableetud,$tableincidusers WHERE $tableincidusers.id = '".$_POST['idusers']."' AND $tableetud.matricule=$tableincidusers.id_users";
                //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                mysqli_query($db,$sql);
                //echo $sql;
		        $req=mysqli_query($db,$sql);
                if(mysqli_num_rows($req)=="0"){
                $sql="SELECT email as mail FROM $tableagent,$tableincidusers WHERE $tableincidusers.id = '".$_POST['idusers']."' AND $tableagent.matricule=$tableincidusers.id_users";
                mysqli_query($db,$sql) or die('Erreur SQL2 !');
                $req=mysqli_query($db,$sql);
                }
		$donnees=mysqli_fetch_array($req);
		$adrmail = $donnees['mail'];
 
		$sql="SELECT libelle FROM $tablepla, $tableincidents WHERE $tableincidents.id_plateforme=$tablepla.id AND $tableincidents.id = '".$_POST['idpb']."'";
                //echo $sql;
		//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                mysqli_query($db,$sql) or die('Erreur SQL4 !');
		$req=mysqli_query($db,$sql);
		$donnees=mysqli_fetch_array($req);
		$plateforme = $donnees[0];
                if(isset($_POST['idusers'])){
		$sql="SELECT probleme FROM $tableincidents, $tableincidusers WHERE $tableincidusers.id_incidents=$tableincidents.id AND $tableincidusers.id=".$_POST['idusers']."";
		//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                mysqli_query($db,$sql) or die('Erreur SQL5 !');
		$req=mysqli_query($db,$sql);
		$donnees=mysqli_fetch_array($req);
		$probleme = $donnees[0];
                }
		$idusers = $_POST['idusers'];
		$mess = "Bonjour,<br />vous avez indiqu� avoir un probl�me sur <b>$plateforme :</b> <i>\"$probleme\"</i><br />Ce probl�me a d�j� �t� r�f�renc� sur la plateforme de support, aussi nous l'avons associ� � votre probl�me afin que vous puissiez voir les solutions propos�es.<br />Nous vous invitons donc � vous y connecter � l'adresse suivante: http://cfm-hop-tlse.fr<br /><br />Cordialement,<br />Equipe technique,<br />Centre de Formation Multim�dia";
		$mail->From = "support_new-incident".$domaine;
		$mail->FromName   = "Information Nouvel Incident";
		$mail->Subject = "Solution � votre probl�me n�$idusers";
		//FIndes param�trages pour l'envois de mail et envois de ce dernier si le cota n'est pas atteint
		$mail->WordWrap = 50;
		// Ici on r�cup�re l'adresse de l'�tudiant concern� pour lui envoyer le mail [IMPORTANT: A FAIRE]
		$mail->AddAddress($adrmail); 
		$mail->MsgHTML($mess);
		if($mail->Send()){ ?> <script> alert('Mail envoy� � l\'utilisateur');</script> <?php }
		
		$sql="UPDATE $tableincidusers SET id_incidents = '".$_POST['idpb']."', id_incid_ori=id_incidents WHERE id =".$_POST['idusers']."";
                //echo $sql;
                mysqli_query($db,$sql) or die('Erreur SQL9 !');
}else
{
$sql="UPDATE $tableincidusers SET id_incid_ori=id_incidents, id_incidents = '".$_POST['idpb']."' WHERE id =".$_POST['idusers']."";
                //echo $sql;
                mysqli_query($db,$sql) or die('Erreur SQL9 !');	
}
}
		?>
		<script>
			alert('Le probl�me est maintenant associ�.');
			<?php
			if ($_POST['retour'] == 'gestion')
			{
				?>
				redirige("gestion_incidents_non_recurrents.php");
				<?php
			}
			else
			{
				if ($_POST['retour'] == 'popup')
				{
					?> 
					window.close();
					<?php
				}
				?>
				redirige("admin_detail.php?id=<?php echo $_POST['idusers']; ?>&solution=1");
				<?php
			}
			?>
		</script>
	</body>
</html>
<?php
// On active les sessions :
require_once('includes/verification.php'); 
error_reporting(0);
// On inclus les donn�es de connexion :
require_once('includes/connexion.php');
require_once('includes/alias_tables.php');
require_once('includes/verification.php');

?>
<!DOCTYPE html>
<html>
	<head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Nouvel incident utilisateur</title>
		<script src="html5shiv/dist/html5shiv.js">
		</script>
		<script language="javascript">
			function mapopup(page)
			{
				window.open(page,'mapopup','height=450,width=1070,top=50,left=50,resizable=no, scrollbars=yes');
			}
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
		$my_t=getdate(date("U"));
		// On r�cup�re les infos utilisateur
                if($_SESSION['statut']==1){
		$identifiant=$_SESSION['identifiant'];   
                }else{
		$sql="SELECT matricule, nom, prenom, classe FROM $tableetud WHERE matricule = '".$_SESSION['identifiant']."'";
		//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                mysqli_query($db,$sql) or die('Erreur SQL !');
		$req=mysqli_query($db,$sql);
		$donnees=mysqli_fetch_array($req);
		$identifiant=$donnees['matricule'];
                }
        if(isset($_POST['pla']))
		//if ($_POST['choix']=='1' OR $_POST['choix']=='2' OR $_POST['choix']=='3')
		{
                        $plateforme = $_POST['pla'];
                        $message=  $_POST['autretexte'];
						$message=str_replace("'", "", $message);
                        $message=  htmlentities($message);
			$sql="INSERT INTO $tableincidents (id_plateforme,probleme,statut)VALUES ('".$plateforme."', '".$message."', 0)";
                        mysqli_query($db,$sql) or die('Erreur SQL1 !');
                        $lincidents=mysqli_insert_id($db);
			$sql="INSERT INTO $tableincidusers (id_incidents,id_users,id_etat,date,commentaire,new,createur,cfps) VALUES ('".$lincidents."', '".$identifiant."', 1, '".$my_t[year].'-'.$my_t[mon].'-'.$my_t[mday].' '.$my_t[hours].':'.$my_t[minutes].':'.$my_t[seconds]."', 'En cours, nombre d\'intervention: 0', 1,'Utilisateur',".$_SESSION['statut'].")";
                        mysqli_query($db,$sql) or die('Erreur SQL2 !'); 
                        $id=mysqli_insert_id($db);
			$sql="SELECT $tablepla.libelle, $tableincidents.probleme FROM $tablepla, $tableincidents WHERE $tableincidents.id_plateforme = $tablepla.id AND $tableincidents.id = '".$lincidents."'";
                        mysqli_query($db,$sql) or die('Erreur SQL3 !'); 
			$req=mysqli_query($db,$sql);
			$donnees=mysqli_fetch_array($req);
			$plateforme=$donnees['libelle'];
			$probleme=$donnees['probleme'];
                        if($_SESSION['statut']==1){
                        $sql="SELECT $tableagent.matricule,$tableagent.matricule, $tableagent.nom, $tableagent.prenom, $tableagent.email FROM $tableincidusers, $tableagent WHERE $tableincidusers.id_users=$tableagent.matricule AND $tableincidusers.id='".$id."'";
                        mysqli_query($db,$sql) or die('Erreur SQL4 !'); 
			$req=mysqli_query($db,$sql);
			$donnees=mysqli_fetch_array($req); 
                        $mat=$donnees['matricule'];
                        $idetud=$donnees['matricule'];
			$nom=$donnees['nom'];
			$prenom=$donnees['prenom'];
                        $adrmail=$donnees['email'];
			$ladate=getdate();
                        $id_incidents_to_users=$id;
                        }else{
			$sql="SELECT $tableetud.matricule,$tableetud.date_naissance,$tableetud.nom, $tableetud.prenom, $tableecole.libelle,$tableetud.annee, $tableetud.mail,$tableetud.tel FROM $tableincidusers, $tableetud,$tableecole WHERE $tableecole.id=$tableetud.id_ecole AND $tableincidusers.id_users=$tableetud.matricule AND $tableincidusers.id='".$id."'";
                        //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sql) or die('Erreur SQL5 !'); 
			$req=mysqli_query($db,$sql);
			$donnees=mysqli_fetch_array($req);
                        $idetud=$donnees['matricule'];
                        $dtnaiss=$donnees['date_naissance'];
			$nom=$donnees['nom'];
			$prenom=$donnees['prenom'];
                        $annee=$donnees['annee'];
                        $lecole=$donnees['libelle'];
                        $tel=$donnees['tel'];
                        if($tel==""){
                            $tel="n.c.";
                        }
			$ladate=getdate();                        
			$id_incidents_to_users=$id;
			$adrmail=$donnees['mail'];
                        }
			require("class.phpmailer.php"); // class DE PHPMailler qui marche avec le class class.smtp.php
			//  le chemin o� se trouve votre class (exemple : ("nom_dossier/class.phpmailer.php");)
			$mail = new PHPMailer();
                        $joursem=date('w');
                        //echo $joursem;
                        //$joursem= 1;
                        switch ($joursem){
                            case 0: $nmtech='CB';break;
                            case 1: $nmtech='RP';break;
                            case 2: $nmtech='SC';break;
                            case 3: $nmtech='JaE';break;
                            case 4: $nmtech='PDA';break;
                            case 5: $nmtech='TD';break;
                            case 6: $nmtech='CB';break;
                        }
                        $titre='Nouvel incident technique - '.$plateforme;
			include('includes/configmail.php');
                        // L'adresse exp�diteur
                        $mail->From = "gestion_incidents".$domaine;
                        // L'objet du mail
                        if($_SESSION['statut']!="1"){
                        $mail->Subject = "Nouvel Incident sur $plateforme - ($lecole - $annee) - $nmtech";
                        $debutmess='L\'élève '.$nom.' '.$prenom.' ('.$idetud.')';
                        }else{
                         $mail->Subject = "Nouvel Incident sur $plateforme - CFPS - $nmtech";
                         $debutmess='L\'agent '.$nom.' '.$prenom.' (01'.$mat.')';
                        }
                        $messcont = '<p>'.$debutmess.' a indiqué avoir rencontré un problème sur la plateforme '.$plateforme.':</p><p>
                                "<i>'.$probleme.'</i>"
                                </p>
                                 <p>Incident n° '.$id_incidents_to_users.', vous pouvez le retrouver <a href="'.$_SESSION['racine'].'/incidents/incidents_attente_cfm&focus='.$id_incidents_to_users.'#'.$id_incidents_to_users.'"> ici </a>.</p><br/>
                                <div style="font-size:15;">
                                Identifiant: <b>'.$idetud.'</b><br />
                                Mdp: <b>'.$dtnaiss.'</b><br />
                                Mail de contact: <b>'.$adrmail.'</b><br />
                                Tèl de contact: <b>'.$tel.'</b>
                                ';
                        //$mess = "<h1>Nouvel incident technique</h1><h2>$plateforme</h2><p>L'�l�ve $nom $prenom ($idetud) a indiqu� avoir rencontr� un probl�me sur la plateforme $plateforme:</p><p>\"<i>$probleme</i>\"</p><p>Incident n� $id_incidents_to_users, vous pouvez le retrouver <a href=\"$racine/support/admin.php?ordre=id&sens=ASC&focus=$id_incidents_to_users#$id_incidents_to_users\"> ici </a>.</p><br/>Identifiant: <b>$idetud</b><br />Mdp: <b>$dtnaiss</b><br />Mail de contact: <b>$adrmail</b><br />T�l de contact: <b>$tel</b>";
			//FIndes param�trages pour l'envois de mail et envois de ce dernier si le cota n'est pas atteint
                        $mail->FromName   = "Gestion des incidents";
			$mail->WordWrap = 50;
			$mail->AddAddress($mailtech); //
                        $mess=$headmess.$messcont.$footmess;
			$mail->MsgHTML($mess);
			if($mail->Send())
			{
				?>
				<script>
					alert('Votre problème va être traité, il vient d\'être envoyé par mail. Un technicien vous contactera trés prochainement.\nSi ce n\'est pas le cas, vous pouvez joindre le Centre de Formation Multimédia au 05.61.32.40.48.\nLe CFM est ouvert du Lundi au Vendredi, de 8h30 à 16h30.');
					
                                       opener.location.href=("<?php echo $_SESSION['racine']?>incidents/mes_problemes");
					window.close();
				</script>
				<?php 
			}
			else
			{
                                //echo $mail->ErrorInfo;
				$sql="UPDATE $tableincidusers SET id_etat=2 WHERE id='".$_GET['id']."'";
				//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                                mysqli_query($db,$sql) or die('Erreur SQL !');  
				?>
				<script>
					alert('ATTENTION: L\'envoi du mail pour prévenir les techniciens a echoué. Veuillez réessayer dans quelques instants. Si ce problème persiste, vous pouvez appelez directement le Centre de Formation Multimédia au 05.61.32.40.48.\nLe CFM est ouvert du Lundi au Vendredi, de 8h00 à 17h00.');
					opener.location.reload();
					window.close();
				</script>
				<?php			
			}
			exit();
		}
		else
		{
			if ($_POST['choix']=='')
			{
				?>
				<script>
					alert("Vous n'avez pas sélectionné de problème");
					window.close();
				</script>
				<?php
				exit();
			}else{
                        $sql="INSERT INTO $tableincidusers VALUES ('' , '".$_POST['choix']."', '".$identifiant."', '2', '".$my_t[year].'-'.$my_t[mon].'-'.$my_t[mday].' '.$my_t[hours].':'.$my_t[minutes].':'.$my_t[seconds]."', 'Utilisateur n\'a pas essayé', 1,NULL,'Utilisateur',".$_SESSION['statut'].")";
			//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sql) or die('Erreur SQL !'); 
//			$sql="SELECT id FROM $tableincidusers where id_users='".$donnees['identifiant']."' order by id DESC";
//			//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
//                        mysqli_query($db,$sql) or die('Erreur SQL !'); 
//			$req=mysqli_query($db,$sql);
//			$donnees=mysqli_fetch_array($req);
//			$id = $donnees['id'];
                        $id=mysqli_insert_id($db);
			?>
			<script language="javascript">
                                //mapopup("solution.php?choix=<?php echo$_POST['choix'];?>&id=<?php echo $id;?>&solution=1")
				redirige("<?php echo $_SESSION['racine']?>incidents/mes_problemes");				
			</script>
			<?php
                        }
		}
		exit();
		?>
	</body>
</html>
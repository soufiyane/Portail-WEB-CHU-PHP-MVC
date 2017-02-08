<?php
// On active les sessions :
require_once('includes/verification.php'); 
error_reporting(0);
// On inclus les donn�es de connexion :
require_once('includes/connexion.php');
require_once('includes/alias_tables.php');
//require_once('includes/verification.php');************ A VOIR APRES **************

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
		echo $_SESSION['racine'].'incidents/nouvel_incident_salle';
	//	echo $_SESSION['racine'];
		$my_t=getdate(date("U"));
                if(isset($_POST['salle'])){
                $id_salle= $_POST['salle'];   
                }else{
                $id_salle=$_SESSION['identifiant'];//************* a enlever ca en cas luser connecté est une sale
                }
		$sql="SELECT nom FROM $tablesalles WHERE identifiant = '".$id_salle."'";
		//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                mysqli_query($db,$sql) or die('Erreur SQL !');
		$req=mysqli_query($db,$sql);
		$donnees=mysqli_fetch_array($req);
		$nom=$donnees['nom'];

                        $plateforme = 7;
                        $pb=$_POST['pbsalle'];
                        if(isset($_POST['datepb'])&&$_POST['datepb']!=""){
                            $datepb=$_POST['datepb'];
                        }else{
							$datepb=date('Y-m-d H:i:s');
                        }
						if(isset($_POST['technicien'])){
							 $sql = "SELECT prenom, nom FROM $tabletech WHERE id='" . $_POST['technicien'] . "'";
                            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
                            mysqli_query($db,$sql) or die('Erreur SQL6!');
                            $req = mysqli_query($db,$sql);
                            $donnees = mysqli_fetch_array($req);
							$user = $donnees[0]." ".$donnees[1];
						}else{
						$user="Utilisateur";
						}
						
                        if($pb!='autre'){// si l'incidents existe c'est pas la peine d'inserer dans la table incidents( ds la table incidents ce qui ns intersse c non d'incident)
                        $sql="INSERT INTO $tableincidusers (id_incidents,id_users,id_etat,date,commentaire,new,createur,cfps) VALUES ('".$pb."', '".$id_salle."', 1, '".$datepb."', 'En cours, nombre d\'intervention: 0', 1,'".$user."',0)";    
                        mysqli_query($db,$sql) or die('Erreur SQL0 !');
                        $inciduser=mysqli_insert_id($db);
                        }else{
                        $message=  $_POST['autrepb'];
						$sql="INSERT INTO $tableincidents (id_plateforme,probleme,statut)VALUES ('".$plateforme."', '".addslashes($message)."', 0)";  
                        mysqli_query($db,$sql) or die('Erreur SQL1 !');
                        $pb=mysqli_insert_id($db);
                        $sql="INSERT INTO $tableincidusers (id_incidents,id_users,id_etat,date,commentaire,new,createur,cfps) VALUES ('".$pb."', '".$id_salle."', 1, '".$datepb."', 'En cours, nombre d\'intervention: 0', 1,'".$user."',0)";
                        mysqli_query($db,$sql) or die('Erreur SQL2 !');
                        $inciduser=mysqli_insert_id($db);
                        }
                        //SI DEPANAGE ON L'INSERE
                        if($_POST['mode']!=""){
                        $sql = "INSERT INTO $tabledepa (id_tech,id_incidents_to_users,date,detail,mode,duree)VALUE('" . $_POST['technicien'] . "', '" . $inciduser . "', '" . $datepb . "', '" . addslashes($_POST['detail']) . "','" . $_POST['mode'] . "','" . $_POST['duree'] . "')";
                            //mysqli_query($db,$sql) or die ('ErreSur SQL!'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sql) or die('Erreur SQL3!');

                        $sql = "SELECT COUNT(id) FROM $tabledepa WHERE id_incidents_to_users=" . $inciduser . "";
                        //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sql) or die('Erreur SQL4!');
                        $req = mysqli_query($db,$sql);
                        $donnees = mysqli_fetch_array($req);
                        $nombre = $donnees[0];
                        $sql = "UPDATE $tableincidusers SET commentaire='En cours, nombre d\'intervention: " . $nombre . ".' WHERE id=" . $inciduser . "";
                        //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sql) or die('Erreur SQL5!');
                        if ($_POST['resolve'] == 'resolve') {
                            $sql = "SELECT prenom FROM $tabletech WHERE id='" . $_POST['technicien'] . "'";//************* A VOIR PReNOM !!!!!!
                            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
                            mysqli_query($db,$sql) or die('Erreur SQL6!');
                            $req = mysqli_query($db,$sql);
                            $donnees = mysqli_fetch_array($req);
                            $technicien_prenom = $donnees[0];
							$datecom = date_format(date_create($datepb), 'd/m/Y');
                            $sql = "UPDATE $tableincidusers SET commentaire='Résolu le " . $datecom . " par " . $technicien_prenom . "' WHERE id=" . $inciduser . "";
                            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
                            mysqli_query($db,$sql) or die('Erreur SQL7!');
                            $sql = "UPDATE $tableincidusers SET id_etat=3 WHERE id=" . $inciduser . "";//****** modifie id_etat=3 --> résolu
                            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
                            mysqli_query($db,$sql) or die('Erreur SQL8!');
                        }
                        }
						if(!isset($_POST['technicien'])){
                        $sql="SELECT $tableincidents.probleme FROM $tablepla, $tableincidents WHERE $tableincidents.id = '".$pb."'";
			//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sql) or die('Erreur SQL9 !'); 
			$req=mysqli_query($db,$sql);
			$donnees=mysqli_fetch_array($req);
			$probleme=$donnees['probleme'];
                        
			require("class.phpmailer.php"); // class DE PHPMailler qui marche avec le class class.smtp.php
			//  le chemin o� se trouve votre class (exemple : ("nom_dossier/class.phpmailer.php");)
			$mail = new PHPMailer();

                        $titre="Nouvel incident technique salle $nom";
			include('includes/configmail.php');
                        // L'adresse exp�diteur
                        $mail->From = "gestion_incidents_salles".$domaine;
                        // L'objet du mail
                        $mail->Subject = "Nouvel incident technique salle $nom";

                        $messcont = '<p>Un nouvel incident vient d\'être déclaré dans la salle '.$nom.':</p><p>
                                "<i>'.$probleme.'</i>"
                                </p>
                                 <p>Incident n° '.$id_incidents_to_users.', vous pouvez le retrouver <a href="'.$_SESSION['racine'].'/incidents/incidents_attente_cfm&focus='.$id_incidents_to_users.'#'.$id_incidents_to_users.'"> ici </a>.</p><br/>
                                <div style="font-size:15;">';


                              

                                //&focus='.$id_incidents_to_users.'#'.$id_incidents_to_users.'"> ici </a>.</p><br/> /*************************************
                                //<div style="font-size:15;">/********************************************************* A VOIR FOCUSE
                                
                        //$mess = "<h1>Nouvel incident technique</h1><h2>$plateforme</h2><p>L'�l�ve $nom $prenom ($idetud) a indiqu� avoir rencontr� un probl�me sur la plateforme $plateforme:</p><p>\"<i>$probleme</i>\"</p><p>Incident n� $id_incidents_to_users, vous pouvez le retrouver <a href=\"$racine/support/admin.php?ordre=id&sens=ASC&focus=$id_incidents_to_users#$id_incidents_to_users\"> ici </a>.</p><br/>Identifiant: <b>$idetud</b><br />Mdp: <b>$dtnaiss</b><br />Mail de contact: <b>$adrmail</b><br />T�l de contact: <b>$tel</b>";
			//FIndes param�trages pour l'envois de mail et envois de ce dernier si le cota n'est pas atteint
                        $mail->FromName   = "Gestion des incidents des salles";
			$mail->WordWrap = 50;
			$mail->AddAddress($mailtech); //
                        $mess=$headmess.$messcont.$footmess;
			$mail->MsgHTML($mess);
			if($mail->Send())
			{
				?>
				<script>
					alert('Votre problème va être traité, il vient d\'être envoyé aux techniciens. \nEn cas de trop longue attente, un appel téléphonique direct peut être fait via la touche F1 du téléphone de la salle.');
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
					alert('ATTENTION: L\'envoi du mail pour prévenir les techniciens a échoué. Merci de bien vouloir les prévenir via la touche F1 du téléphone présent dans la salle.');
					opener.location.reload();
					window.close();
				</script>
				<?php			
			}
						}else{
						?>
				<script>
					alert('Le problème a bien été ajouté.');
                   opener.location.href=("<?php echo $_SESSION['racine']?>incidents/mes_problemes");
					window.close();
				</script>
				<?php 	
						}
			?>
			<script language="javascript">
				<?php
				if(isset($_POST['technicien'])){
				//echo 'jkbjkhjhjkhjhj';	
				?>
				redirige('<?php echo $_SESSION['racine']?>incidents/nouvel_incident_salle');
				<?php
				}else{
				?>	
				redirige("<?php echo $_SESSION['racine']?>incidents/mes_problemes");
				<?php
				}
				?>
			</script>
			<?php
		exit();
		?>
	</body>
</html>
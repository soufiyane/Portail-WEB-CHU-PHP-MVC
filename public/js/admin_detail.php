<?php
// On inclus les donn�es de connexion :
require_once('includes/connexion.php');
//--*************************** verification de session a ajouter apres
require_once('includes/verification.php');
require_once('includes/alias_tables.php');
error_reporting(0);
switch($_SESSION['statut']){ 
		case 2: break;
        default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: ../index.php');  exit(); break;
	}
$id_tech=$_SESSION['id_tech'];
?>
<!DOCTYPE html>
<html>
	<head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Admin - Details Incident</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap/dist/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="html5shiv/dist/html5shiv.js">
		</script>
		<link rel="stylesheet" type="text/css" href="css/monCss.css" /> 
		<script>
		function clossparent()
             {
                 parent.$("#popupModal").hide();
             }
			function visibilite(thingId)
			{
				var targetElement;
				targetElement = document.getElementById(thingId) ;
				if (targetElement.style.display == "none")
				{
					targetElement.style.display = "" ;
				} 
				else
				{
					targetElement.style.display = "none" ;
				}
			}
		</script>
		<script>
		 function clossparent()
             {
             	alert('i am here');
                 parent.$("#popupModal").hide();
             }
			function quitter()
			{
				var quitter = 'quit';
				return quitter;
			}
		</script>
		<script>
		function cacher(thingId)
		{	
			document.getElementById(thingId).style.display = "none";
		}
		</script>
		<script language=javascript>
			function redirige(adresse)
			{
				location.href = adresse;
			}
		</script> 
		<script>
			function mapopup(page)
			{
				window.open(page,'mapopup','height=450,width=1000,top=50,left=50,resizable=no, scrollbars=yes');
			}
//                        function valider_formulaire(){
//                        if(document.getElementById("technicien").selectedIndex==0||document.getElementById("technicien").selectedIndex==1){
//                        alert("Veuillez choisir un technicien.");
//                        return false;
//                        }
//                        }
		</script>
	</head>
	<body>
		<section>
		<div align="center">
    	<input align ="left" type="button" class="btn btn-info" value="Voir informations utilisateur" onclick='visibilite("info_util");'/>
    	</div>
				
			<div id="info_util" style=display:none>
				<?php 
				//mysql_select_db($database_db,$db)   or die('Erreur de selection '.mysqli_error($db));  
				// On r�cup�re les infos utilisateur
				$sql="UPDATE $tableincidusers SET new=0 WHERE id=".$_GET['id']."";
				//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                                mysqli_query($db,$sql) or die('Erreur SQL !');
				$sql="SELECT id_users FROM $tableincidusers WHERE id = ".$_GET['id']."";
				//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                                mysqli_query($db,$sql) or die('Erreur SQL !');
				$req=mysqli_query($db,$sql);
				$donnees=mysqli_fetch_array($req);
				$etudiant=$donnees['id_users'];
                  $result = mysqli_query($db,"SELECT nom,prenom,date_naissance,email as mail,tel,version_office,matricule as identifiant FROM $tableagent WHERE matricule = '".$etudiant."'");
                  if(mysqli_num_rows($result) != 0) {        
                  $req=mysqli_query($db,"SELECT nom,prenom,date_naissance,email as mail,tel,version_office,matricule as identifiant FROM $tableagent WHERE matricule = '".$etudiant."'");
                                }else{
                                $req=mysqli_query($db,"SELECT * FROM $tableetud WHERE matricule = '".$etudiant."'");   
                                }
				$donnees=mysqli_fetch_array($req);
				?>
                            <br><br>


									<table class="table table-condensed">
										<thead>
										<tr>
											<th>Nom</th>
											<th>Prénom</th>
											<th>Date naissance</th>
											<th>Mail</th>
											<th>Téléphone</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td><?php echo $donnees['nom']; ?></td>
											<td><?php echo $donnees['prenom']; ?></td>
											<td><?php
												$dt=$donnees['date_naissance'];
												echo substr($dt, 0, 2)."/".substr($dt, 2, 2)."/".substr($dt,-4);
												?>
											</td>
											<td><?php echo $donnees['mail']; ?></td>
											<td><?php echo $donnees['tel']; ?></td>
										</tr>
										</tbody>
									</table>
									<table class="table table-condensed">
										<thead>
										<tr>
											<th>Version Office</th>
											<th>Matricule</th>
											<th>Groupe</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td><?php echo $donnees['version_office']; ?></td>
											<td><?php echo $donnees['matricule']; ?></td>
											                    <?php
                                                                if($_SESSION['statut']!=1){
                                                                    ?>
											<td><?php echo $donnees['groupe']; ?></td>
											                    <?php
                                                                }
                                                                ?>
										</tr>
										</tbody>
									</table>
									<?php if ($donnees['cloud'] == 1) { ?>
                                            <td style="border:1px solid black">
                                                <table >
                                                        <tr>
                                                        <td>  
                                                        <img src='../img/images/cloud.png' width=85px height=50px>  
                                                        </td>
                                                        </tr>
                                                </table>
                                            </td>
                                            <?php } ?>

				
			</div>
                        <br><br>
			<?php					
			$sql="SELECT * FROM $tableincidusers WHERE id = '".$_GET['id']."'";
			//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sql) or die('Erreur SQL !');
			$req=mysqli_query($db,$sql);
			$donnees=mysqli_fetch_array($req);
			$incidents=$donnees['id_incidents'];
			$sql="SELECT probleme, id_plateforme, statut FROM $tableincidents WHERE id = ".$donnees['id_incidents']."";
			//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sql) or die('Erreur SQL !');
			$req=mysqli_query($db,$sql);
			$donnees2=mysqli_fetch_array($req);
			$probleme=$donnees2['probleme'];
			$idpla=$donnees2['id_plateforme'];
			$statut=$donnees2['statut'];
                        $sqlpla="SELECT libelle FROM $tablepla WHERE id = ".$idpla."";
                        //mysqli_query($db,$sqlpla) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sqlpla) or die('Erreur SQL !');
			$reqpla=mysqli_query($db,$sqlpla);
			$donnees3=mysqli_fetch_array($reqpla);
                        $plateforme=$donnees3['libelle'];
			?>
			<div id="contenu">
				<table align="center" border="1px solid" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center" width="15%">
							<h2 align="center"> 
                                                        <?php 
                                                        echo 'N° '.$_GET['id'].'<br>';
                                                        echo $plateforme.'<br />';
                                                        if($donnees['id_etat']==1)
							{
								echo '[Non résolu]';
							}
							if ($donnees['id_etat']==3)
							{
								echo '[Résolu]';
							}?>
                                                        </h2>
                                                        
						<td align="center"  width="70%">
							<h2 align="center">   <?php echo $probleme; ?>  </h2>
						</td>
						<td align="center" width="15%">
							<?php
							if ($donnees['id_etat']==2)
							{
								echo '[Solution non testée par l\'utilisateur]';
							}
							$letat=$donnees['id_etat'];
							$annee = substr($donnees['date'], 0, 4);
							$mois = substr($donnees['date'], 5, 2);
							$jour = substr($donnees['date'], 8, 2);
							$heure = substr($donnees['date'], 11, 2);
							$minute = substr($donnees['date'], 14, 2);
							if (($heure == '00') && ($minute == '00'))
							{
								$date = $jour.'/'.$mois.'/'.$annee;
							}
							else
							{
								$date = $jour.'/'.$mois.'/'.$annee.' à '.$heure.':'.$minute;
							}
							?>
							<?php echo 'Créé le '.$date; ?>
						</td>
					</tr>
					<tr>
						<td COLSPAN="3">
							<?php
//							$sql="SELECT num_solution FROM $tablesolu WHERE id_incidents = ".$incidents." ORDER BY num_solution DESC";
//							//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
//                                                        mysqli_query($db,$sql) or die('Erreur SQL !');
//							$req=mysqli_query($db,$sql);
//							$donnees=mysqli_fetch_array($req);
//							$maxsolut=$donnees['num_solution'];
//							$sql="SELECT * FROM $tablesolu WHERE id_incidents = ".$incidents." ORDER BY num_solution ASC";
//							//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
//                                                        mysqli_query($db,$sql) or die('Erreur SQL !');
//							$req=mysqli_query($db,$sql);
                                                        $sql="SELECT $tablesolu.*,num_solu as num_solution
                                                        FROM $tablesolu,$tablesoltoincid,$tableincidents
                                                        WHERE $tablesolu.id=$tablesoltoincid.id_solu
                                                        AND $tablesoltoincid.id_incid=$tableincidents.id
                                                        AND $tableincidents.id = ".$incidents."
                                                        ORDER BY num_solu";
                                                        //echo $sql3;
							//mysqli_query($db,$sql3) or die('Erreur SQL !'.$sql3.'<br />'.mysqli_error($db));
                                                        mysqli_query($db,$sql) or die('Erreur SQL !');
							$req=mysqli_query($db,$sql);
                                                        $maxsolut=mysqli_num_rows($req);
							?>
							<table align="center" BGCOLOR="#DFE9E8" width="100%">
								<?php
								while ($donnees=mysqli_fetch_array($req))
								{
									?>									
									<tr style=display:none id="<?php echo $donnees['num_solution']; ?>">
										<td width="25px">
                                                                                <?php
                                                                                if ($donnees['num_solution']!=1)
                                                                                {
                                                                                ?>
                                                                                <INPUT border=0 src="img/fleche_gauche.png" type="image" Value="submit" align="middle"  onclick='document.location.href="admin_detail.php?id=<?php echo $_GET['id']; ?>&solution=<?php echo $donnees['num_solution']-1; ?>";' title="Solution précedente" />
                                                                                <?php
                                                                                }
                                                                                ?>
										</td>
										<td align="center">
                                                                                <h3> <b> <?php echo $donnees['lib']; ?> </h3>
                                                                                <?php
											if ($donnees['document'] != '')
											{
												?>
												<a href="Fichiers/<?php echo $donnees['document']; ?>.pdf" target="_blank"><h3>Voir le document</h3></a>
												<?php
											}
											?>
                                                                                <?php echo $donnees['num_solution'].' / '.$maxsolut; ?>
										</td>
										<td width="25px">
										<?php
										if ($donnees['num_solution'] < $maxsolut)
										{
										?>
										<INPUT border=0 src="img/fleche_droite.png" type="image" Value="submit" align="middle"  onclick='document.location.href="admin_detail.php?id=<?php echo $_GET['id']; ?>&solution=<?php echo $donnees['num_solution']+1; ?>";' title="Solution suivante" />													
										<?php
										}
                                                                                ?>
										</td>
									</tr>
									<?php
								}
								?>
							</table>
						</td>
					</tr>
				</table>				
				<script>
					visibilite("<?php echo $_GET['solution']; ?>")
				</script>
				<br />
				<?php
				$sql="SELECT $tabledepa.id, $tabledepa.id_tech, $tabledepa.id_incidents_to_users, $tabledepa.date, $tabledepa.detail,$tabledepa.mess_tech,$tabledepa.mess_user, $tabledepa.mode, $tabletech.nom, $tabletech.prenom 
                                FROM $tabledepa, $tabletech 
                                WHERE $tabledepa.id_tech = $tabletech.id 
                                AND id_incidents_to_users = ".$_GET['id']." 
                                ORDER BY id DESC";
				//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                                mysqli_query($db,$sql) or die('Erreur SQL !');
				$req=mysqli_query($db,$sql);
                                $dernier=mysqli_num_rows($req);
				?>
				<table align="center" border="0">
					<?php
                                        $i=1;
					while ($donnees=mysqli_fetch_array($req))
					{
						?>
						<tr>
							<td> - </td>
							<td>
								Depannage n°<?php echo $donnees['id']; ?>
								le <?php
								$annee = substr($donnees['date'], 0, 4);
								$mois = substr($donnees['date'], 5, 2);
								$jour = substr($donnees['date'], 8, 2);
								$heure = substr($donnees['date'], 11, 2);
								$minute = substr($donnees['date'], 14, 2);
								if (($heure == '00') && ($minute == '00'))
								{
									$date = $jour.'/'.$mois.'/'.$annee;
								}
								else
								{
									$date = $jour.'/'.$mois.'/'.$annee.' à '.$heure.':'.$minute;
								}
								echo $date;
								?>
								<i> par <?php echo $donnees['nom'].' '.$donnees['prenom']; ?> </i>
								( <?php echo $donnees['mode']; ?> )
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
                                                                <?php
                                                                    if($donnees['mode']=="Par mail"){
                                                                    echo "<p style='margin:0px;cursor:pointer;color:#1122CC;'onClick=visibilite('messtech".$i."');><b><u>".$donnees['detail']."</u></b></p>";
                                                                    echo "<div id='messtech".$i."' style='margin-top:10px;display:none;width:450px;'>".$donnees['mess_tech']."</div>";
                                                                    }else{
                                                                    echo '<b>'.$donnees['detail'].'</b>';
                                                                    }
                                                                    if($donnees['mess_user']!=""){
                                                                        if($i==1){
                                                                           echo "<font color='green' />";
                                                                        }
                                                                        echo "<br /><b>Réponse étudiant:</b><br />";
                                                                        echo $donnees['mess_user'];
                                                                        if($i==1){
                                                                           echo "</font>";
                                                                        }
                                                                    }
                                                        ?>
							</td>
						</tr>
						<?php
                                                    if ($i<$dernier){
                                                ?>
						<tr>
							<td></td>
							<td>
                                                            <hr width="600px"></hr>
							</td>
						</tr>
						<?php
                                                    }
                                                $i++;
					}
					?>
				</table>
				<br />
				<table align="center">
					<?php
                                        if ($letat==3)
                                        {
                                                ?>
                                                <tr>
                                                        <td>
                                                                <form action="rouvrirprobleme.php" method="get">
                                                                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
                                                                        <input type="submit" class="btn btn-default" value="Rouvrir le problème"/>
                                                                </form>
                                                        </td>
                                                </tr>
                                                <?php 
                                        }else{
					$sql="SELECT COUNT(id) FROM $tabledepa WHERE id_incidents_to_users=".$_GET['id']."";
					//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                                        mysqli_query($db,$sql) or die('Erreur SQL !');
					$req=mysqli_query($db,$sql);
					$donnees=mysqli_fetch_array($req);
					$nbdep=$donnees[0];
					if ($nbdep==0)
					{
						?>
						<tr>
							<td align="center" COLSPAN="2"> <i> Il faut au moins un dépannage. </i> </td>
						</tr>
						<tr>
							<td align="center">
								<input type="submit" class="btn btn-success" value="Resolu" disabled="disabled"/>
							
								<input type="submit" class="btn btn-default" value="Ajouter un depannage" onclick="redirige('admin_newdepannage.php?id=<?php echo $_GET['id']; ?>');" />
							</td>
						</tr>
						<?php
						if ($statut != 1)
						{
							?>
							<tr>
								<td colspan="2">
									<input type="button" class="btn btn-default" value="Associer à un problème existant" onclick='visibilite("pbassoc");'/>
								</td>
							</tr>
							<?php
						}
						?>
						<?php
					}
					else
					{
							?>
							<form action="updateincidentstousersyes.php" method="POST" >
<!--								<tr>
									<td>
										<select name="technicien" id="technicien">
                                                                                        <option value="none">Choisir un technicien</option>
                                                                                        <option value="none">--------------</option>
                                                                                        <?php
//                                                                                        $sql="SELECT id, nom, prenom FROM $tabletech";
//                                                                                        //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
//                                                                                        mysqli_query($db,$sql) or die('Erreur SQL !');
//                                                                                        $req=mysqli_query($db,$sql);
//                                                                                        while ($donnees=mysqli_fetch_array($req))
//                                                                                        {
//                                                                                                ?>
                                                                                                <option value="//<?php //echo $donnees['id'].'"';if($donnees['id']==$id_tech){echo "selected='selected'";} ?>"><?php //echo $donnees['nom'].' '.$donnees['prenom']; ?></option>
                                                                                                //<?php
//                                                                                        }
                                                                                        ?>
                                                                                </select>
									</td>
								</tr>-->
								<tr>
									<td align="center">
										<input type="hidden" value="1" name="admin"/>
										<input type="hidden" value="<?php echo $_GET['id']; ?>" name="id" />
                                                                                <input type="hidden" value="<?php echo $id_tech; ?>" name="technicien" />
										<input class="btn btn-success" type="submit" value="Resolu" />
							</form>
									
										<input type="button" class="btn btn-default" value="Ajouter un depannage" onclick='redirige("admin_newdepannage.php?id=<?php echo $_GET['id']; ?>")'/>
									</td>
								</tr>
								<?php
								if ($statut != 1)
								{
									?>
									<tr>
										<td colspan="2" align="center">
											<input type="button" class="btn btn-default" value="Associer à un problème existant" onclick='visibilite("pbassoc");'/>
										</td>
									</tr>
									<?php
								}
					}
                                        }
					?>
						
				</table>
				<div id="pbassoc" style=display:none align="center">
					<form action="associerpb.php" method="POST">
						<select name="idpb">
							<?php
							$sql="SELECT id, probleme FROM $tableincidents WHERE id_plateforme=".$idpla." AND (statut = 1 OR statut = 2)";
							//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                                                        mysqli_query($db,$sql) or die('Erreur SQL !');
							$req=mysqli_query($db,$sql);
							while ($donnees=mysqli_fetch_array($req))
							{
								?>
								<option value="<?php echo $donnees['id']; ?>" ><?php echo $donnees['probleme']; ?></option>
								<?php
							}
							?>
						</select>
						<br />
						<input type="hidden" name="idusers" value = "<?php echo $_GET['id']; ?>" />
						<input type="hidden" name="retour" value = "detail" />
						<input type="submit" class="btn btn-primary" value="Envoyer" />
					</form>
				</div>
				<br /><br /><br />			
			</div>
			
		</section>
	</body>
</html>
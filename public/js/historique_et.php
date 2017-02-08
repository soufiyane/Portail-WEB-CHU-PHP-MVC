<?php
// PAGE AUTHORISEE QUE TECH ET ADMIN STATUT 2

require_once('connexion.php'); 
//require_once('includes/verification.php'); 
include ('fonctions.php');
require_once('alias_tables.php');
	
error_reporting(0);

        if (isset($_GET['rech'])) 
        {
        $var=$_GET['rech'];
        }
        ?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap/dist/css/bootstrap.min.css">

<script src="html5shiv/dist/html5shiv.js">
</script>
<script>
function valider_formulaire(){
if(document.getElementById("new_matricule").value==""){
                        alert("Veuillez renseigner le nouveau matricule de l'étudiant");
                        return false;
                        }
}
</script>

</head>
<body>

<header>
	<CENTER>	
	<!--<img src="images/bandeau_gestion_etudiants.jpg" width="100%"/>			-->
	</CENTER>
</header>
        
			


                        <!-- Contenu de la page (milieu)-->
<?php
if(isset($_POST['desa'])){
    $idet=$_POST['idet'];//lidentifiant de l'etudiant a archiver on le récupere depuis le formulaire
    $req_archives = mysqli_query($db,"SELECT * FROM $tablearchives WHERE matricule = '".$idet."'");
    $row_archives = mysqli_fetch_assoc($req_archives);
    if ($row_archives['tel'] != "") $tel = $row_archives['tel'];
    if ($row_archives['mail'] != "") $mail = $row_archives['mail'];
    if ($row_archives['version_office'] != "") $office = $row_archives['version_office'];
    if ($row_archives ['type_casq'] != "") $type_casque = $row_archives ['type_casq'];
    if ($row_archives ['photo'] != "") $photo = $row_archives ['photo'];
    $id_ecole=$row_archives['id_ecole'];
    $carte = $row_archives['carte'];
 
    
    $commentaire = $row_archives['scolarite']." desarchivé le ".date('d/m/Y')." - ".$row_archives['commentaire']; 
    if (isset($_POST['new_matricule'])) $matricule= $_POST['new_matricule'];
    else if($row_archives ['matricule']!= "") $matricule = $row_archives ['matricule'];
    $id_ecole=$row_archives['id_ecole'];
    $identifiant=$row_archives['matricule'];
    $annee=$row_archives['annee'];
    $nom=$row_archives['nom'];
    $prenom=$row_archives['prenom'];
    $date_naissance=$row_archives['date_naissance'];
    $identifiant_cfm=$row_archives['identifiant_cfm'];
    $classe=$row_archives['classe'];
    $groupe_buro = '' ;
    $groupe_anglais = '';
    $groupe_ecole = '';
    $id_buro = 'NULL';
    $id_ang = 'NULL';
    $id_ec = 'NULL';
    if ($row_archives['cloud'] != 0) $cloud = $row_archives['cloud'];    

    if (($office != '') AND ($groupe_buro != '') ) $groupe_buro = $groupe_buro.' - '.$version_office;    
    // ON le migre vers la table users
    $query_insert_users = mysqli_query ($db,"INSERT INTO $tableetud (matricule, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, groupe_buro, id_buro, groupe_anglais, id_ang, groupe_ecole, id_ec, type_casq, date_maj,cloud,commentaire)
             VALUES('$matricule' , '$identifiant_cfm', '$id_ecole','$annee','$classe','$nom','$prenom','$date_naissance','$tel','$mail','$carte','$photo', '$office','$groupe_buro', $id_buro, '$groupe_anglais', $id_ang,'$groupe_ecole', $id_ec, '$type_casq',curdate(),'$cloud','$commentaire')")or die("Ré-insertion dans la table users Impossible :" . mysqli_error($db));

    
// ON le supprime des archives
    $query_delete_archive = mysqli_query ($db,"DELETE FROM $tablearchives WHERE  matricule = '".$identifiant."'");
    //echo "DELETE FROM $tablearchives WHERE  identifiant = '".$identifiant."'";
    $message = "<br /><font color='green'>MAJ de l'étudiant : $prenom $nom ($identifiant). Compte supprimé de la table archive, et réinséré dans la table étudiant</font>" ;
    $arch=0;
    $sql="SELECT *,e.matricule as identifiant,num_carte_gestion FROM $tableetud e left join $tablecartes c on e.matricule=c.identifiant WHERE e.matricule = '".$identifiant."'";
}else{
    
    $idet=$_GET['id'];
    if(isset($_GET['id'])){
        $arch=0;
        $idet=$_GET['id'];
        $sql="SELECT *,e.matricule as identifiant,num_carte_gestion FROM $tableetud e left join $tablecartes c on e.matricule=c.identifiant WHERE e.matricule = '".$idet."'";
    }elseif(isset($_GET['idar'])){
        $arch=1;
    $idet=$_GET['idar'];
    $sql="SELECT *,e.matricule as identifiant,num_carte_gestion FROM $tablearchives e left join $tablecartes c on e.matricule=c.identifiant WHERE e.matricule = '".$idet."'";
    }
}

mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
$req=mysqli_query($db,$sql);
$donnees=mysqli_fetch_array($req);
?>
						
						    
					            <div class="container col-md-12">
				              	<div class="row">
				              	<div style="float:left" >
									<table class="table table-condensed">
										<thead>
										<tr>
											<th >Nom</th>
											<th >Prénom</th>
											<th >Date naissance</th>
											<th >Mail</th>
											<th >Téléphone</th>
											<th >Identifiant</th>
											
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
											<td><?php $identifiant = $donnees['identifiant'];echo $donnees['identifiant']; ?></td>
											
										</tr>
										</tbody>
									</table>
							    </div> 
						        <div style="float:right" > 
 	                            				      
                                    <img src="<?php echo $donnees['photo'] ?>" height="120" width="90" alt="image" />
								</div>
							</div>
					        </div>
				
                                <div class="container">
				              	<div class="row">
                                <div >
									<table class="table table-condensed">
										<thead>
										<tr>
											
											

											<th >Carte</th>
											<th >Classe</th>
											<th >Année</th>

									
										</tr>
										</thead>
										<tbody>
										<tr>
											
											

											<td><?php if ($donnees['carte']=='TEMP') echo $donnees['num_carte_gestion']; else 
											if ($donnees['carte']=='DEF') echo 'DEF';
											else if ($donnees['carte']=='PRO') echo 'PRO';
											?></td>
											<td><?php echo $donnees['classe']; ?></td>
											<td><?php echo $donnees['annee']; ?></td>

											
										</tr>
										</tbody>
									</table>
							    </div>
							    </div>
							    </div>
                               
						 <!-- <if $donnees['version_office']!=""; ?> -->
                           
                                <div class="container">
				              	<div class="row">
								<table bgcolor="#FCFAE1">
			                    <tr>
			                    <td> 
			                     <?php if ($donnees['cloud'] == 1) { ?> 
			                    <img src='../img/images/cloud.png' width=85px height=50px> 
			                       <?php } ?>
			                    </td>
			                    </tr>
			                    <tr>
			                    <td> <b> <font face="Arial" color="#000000"> Version Office : </font> </b> <?php echo $donnees['version_office']; ?> </td>
			                    </tr>
			                    </table>
			                    </div>
			                    </div>
			               


		<div class="container">
		<div class="row">	
		</div>
		</div>							

		<div class="container">
		<div class="row">		 		

        <div align="center">
            <?php
            if($arch==0){
            ?>
            <input type="button" class="btn btn-primary" value="Modifier" onClick="">
            <?php
            }else{
            ?>
			    <?php if(strlen($identifiant)>8){?>
                <form onSubmit="return valider_formulaire()" id='des_form' action="historique_et.php" method="POST" />
                <input type="hidden" name="idet" value="<?php echo $identifiant;?>" />
				 
				 Veuillez renseigner le nouveau matricule de l'étudiant pour pouvoir le désarchiver<br>
                <input type=text id='new_matricule' name='new_matricule'>	
                <input type="submit" value="Désarchiver" name="desa" onclick="valider_formulaire"><br />
                <font color='red'><b>Attention, penser à faire de même sur Learneos et sur l'AD !!!</b></font>
				</form>
                <?php }else{?>
				<form action="historique_et.php" method="POST" />
                <input type="hidden" name="idet" value="<?php echo $identifiant;?>" />
                <input type="submit" value="Désarchiver" name="desa"><br />
                <font color='red'><b>Attention, penser à faire de même sur Learneos et sur l'AD !!!</b></font>
				</form>
                <?php } ?>               
            <?php
            }
            echo $message;
            ?>
        </div>
        </div>
        </div>

    <table>
    <tr height="50px">
    <th > </th>				
    </tr>
    </table>

<div class="container">
<div class="row">
<table align="center" width="100%">
    <?php
    if ($donnees['commentaire'] != "")
    {
    ?>
    
    <tr bgcolor="#87CEFA" style="border:1px solid black" height="30px">
    <th colspan ="5" style="border:1px solid black"> <font face="Arial" color="#000000"> COMMENTAIRE </font> </th>				
    </tr>
    <tr style="border:1px solid black" height="30px">
    <th colspan ="5" style="border:1px solid black" align="left"> <font face="Arial" color="#000000"><?php echo $donnees['commentaire']; ?></font> </th>				
    </tr>
    
    <tr height="50px">
    <th colspan ="5"> </th>				
    </tr>
    
    <?php
    }
    ?>
</div>
</div>
<table class="table table-condensed">
    <tr >
    <th colspan ="5" class="text-center" > HISTORIQUE CASQUE  </th>				
    </tr>
    <?php
    // On récupére tous les incidents utilisateurs liés é cet étudiant et on les affiche
    if($arch==0){
    $sql="SELECT * FROM $tableetud,$tablecasq WHERE matricule = '".$identifiant."' AND type_casq != '' AND id_user = '$identifiant' GROUP BY id_casq";
    }else{
    $sql="SELECT * FROM $tablearchives,$tablecasq WHERE matricule = '".$identifiant."' AND type_casq != '' AND id_user = '$identifiant' GROUP BY id_casq";    
    }
    mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error());
    $req_user=mysqli_query($db,$sql);
    $res_user= mysqli_num_rows($req_user);
    
    if($res_user==0){
    ?>
    <tr >
    <th colspan ="5" class="text-center">Pas de casque attribué </th>				
    </tr>
    <?php
	} else {
    ?>
        
                    <tr >
						<th> Id Casque  </th>
						<th > Date attribution  </th>
						<th > Type </th>
						<th> Formation concernée  </th>
					</tr>
    
					<?php
					while ($donnees=mysqli_fetch_array($req_user))
					{
						?>
						<tr id="<?php echo $donnees['id_casq']; ?>"  onmouseover="document.getElementById(<?php echo $donnees['id']; ?>).style.background = '#F7951E';" onmouseout="document.getElementById(<?php echo $donnees['id']; ?>).style.background ='#FFFFFF';" location.reload();">
							<td >
								<?php
								echo $donnees['id_casq'];
								?>
							</td>
							<td >
								<?php
								echo $donnees['date_attribution'];							
								?>
							</td>
							<td >
								<?php
								echo $donnees['type'];		
								?>
							</td>
							<td >
								<?php
                                                                $sql = "SELECT titre FROM $tableform WHERE id_formation = ".$donnees['id_formation']."";
                                                                $req = mysqli_query($db,$sql) or die ("Erreur SQL.");
                                                                	while($row=mysqli_fetch_array($req))
                                                                        {
                                                                        echo $row[0];
                                                                        }														
								?>
							</td>
							
						</tr>
						<?php					
					}
                }        
					?>
    <tr height="50px">
    <th colspan ="5"> </th>				
    </tr>
						
	</table>	


    <table class="table table-condensed">
	  <tr >
    <th   colspan ="5" class="text-center"> HISTORIQUE DEPANNAGE  </th>				
    </tr>
    <?php
    // On récupére tous les incidents utilisateurs liés é cet étudiant et on les affiche
    $sql="SELECT * FROM incidents_to_users WHERE id_users = '".$idet."'";
    mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
    $req=mysqli_query($db,$sql);
    $resultats = mysqli_num_rows($req);
   
    if($resultats==0){
    ?>
    <tr  >
    <th colspan ="5"  class="text-center"> Aucun dépannage </th>				
    </tr>				
    <?php
    } else {
    ?>
    
                    <tr >
						<th  > Id </th>
						<th  > Etat</th>
						<th > Date </th>
						<th > Probléme </th>
						<th > Commentaire  </th>
					</tr>
    
					<?php
					while ($donnees=mysqli_fetch_array($req))
					{
						?>
						<tr id="<?php echo $donnees['id']; ?>"   onmouseover="document.getElementById(<?php echo $donnees['id']; ?>).style.background = '#F7951E';this.style.cursor='pointer';" onmouseout="document.getElementById(<?php echo $donnees['id']; ?>).style.background ='#FFFFFF';this.style.cursor='auto';" onclick='window.location.href="admin_detail.php?id=<?php echo $donnees['id']; ?>&solution=1";''>
							<td >
								<?php
								echo $donnees['id'];
								?>
							</td>
							<td >
								<?php
								if ($donnees['id_etat']==1)
								{
									echo 'Probléme en cours';
								}
								if ($donnees['id_etat']==2)
								{
									echo 'Attente de réponse';
								}
								if ($donnees['id_etat']==3)
								{
									echo 'Probléme résolu';
								}
								?>
							</td>
							<td >
								<?php
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
									$date = $jour.'/'.$mois.'/'.$annee.' é '.$heure.':'.$minute;
								}
								echo $date;
								?>
							</td>
							<td >
								<?php
								$sql2="SELECT probleme FROM incidents WHERE id = ".$donnees['id_incidents']."";
								mysqli_query($db,$sql2) or die('Erreur SQL !'.$sql2.'<br />'.mysqli_error());
								$req2=mysqli_query($db,$sql2);
								$donnees2=mysqli_fetch_array($req2);
								echo $donnees2['probleme'];						
								?>
							</td>
							<td >
								<?php
								echo $donnees['commentaire'];
								?>
							</td>
						</tr>
						<?php					
					}
                }        
					?>
				</table>				




</body>
</html>
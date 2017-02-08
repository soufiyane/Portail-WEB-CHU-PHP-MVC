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
<link rel="stylesheet" type="text/css" href="monCss.css" />
<script src="html5shiv/dist/html5shiv.js">
</script>
<script type="text/javascript">
    function mouseOver(thingId)
    {
            document.getElementById(thingId).style.backgroundImage = "url()";
    }
    function mouseOut(thingId)
    {
            document.getElementById(thingId).style.background = "url(img/fleche05.png)";
            document.getElementById(thingId).style.backgroundRepeat="no-repeat";
            document.getElementById(thingId).style.backgroundPosition="left center";
    }
    function mapopup(page)
			{
                                //alert(page);
				window.open(page,'_blank','height=450,width=1060,top=50,left=50,resizable=0,toolbar=0,scrollbars=1');
			}
 </script>
<title>INFOS HISTORIQUE ETUDIANT</title>

</head>
<body>
<section>
<header>
	<CENTER>	
	<img src="images/bandeau_gestion_etudiants.jpg" width="100%"/>			
	</CENTER>
</header>
        
			


                        <!-- Contenu de la page (milieu)-->
<?php
if(isset($_POST['desa'])){
    $idet=$_POST['idet'];
    $req_archives = mysqli_query($db,"SELECT * FROM $tablearchives WHERE identifiant = '".$idet."'");
    $row_archives = mysqli_fetch_assoc($req_archives);
    if ($row_archives['tel'] != "") $tel = $row_archives['tel'];
    if ($row_archives['mail'] != "") $mail = $row_archives['mail'];
    if ($row_archives['version_office'] != "") $office = $row_archives['version_office'];
    if ($row_archives ['type_casq'] != "") $type_casque = $row_archives ['type_casq'];
    if ($row_archives ['photo'] != "") $photo = $row_archives ['photo'];
    $id_ecole=$row_archives['id_ecole'];
    $carte = $row_archives['carte'];
 
    
    $commentaire = $row_archives['scolarite']." desarchivé le ".date('d/m/Y')." - ".$row_archives['commentaire']; 
     
    if ($row_archives ['matricule']!= "") $matricule = $row_archives ['matricule'];
    $id_ecole=$row_archives['id_ecole'];
    $identifiant=$row_archives['identifiant'];
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
    $query_insert_users = mysqli_query ($db,"INSERT INTO $tableetud (matricule,  identifiant, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, groupe_buro, id_buro, groupe_anglais, id_ang, groupe_ecole, id_ec, type_casq, date_maj,cloud,commentaire)
             VALUES('$matricule', '$identifiant', '$identifiant_cfm', '$id_ecole','$annee','$classe','$nom','$prenom','$date_naissance','$tel','$mail','$carte','$photo', '$office','$groupe_buro', $id_buro, '$groupe_anglais', $id_ang,'$groupe_ecole', $id_ec, '$type_casq',curdate(),'$cloud','$commentaire')")or die("Ré-insertion dans la table users Impossible :" . mysqli_error($db));

    
// ON le supprime des archives
    $query_delete_archive = mysqli_query ($db,"DELETE FROM $tablearchives WHERE  identifiant = '".$identifiant."'");
    //echo "DELETE FROM $tablearchives WHERE  identifiant = '".$identifiant."'";
    $message = "<br /><font color='green'>MAJ de l'étudiant : $prenom $nom ($identifiant). Compte supprimé de la table archive, et réinséré dans la table étudiant</font>" ;
    $arch=0;
    $sql="SELECT *,e.identifiant as identifiant,num_carte_gestion FROM $tableetud e left join $tablecartes c on e.matricule=c.identifiant WHERE e.identifiant = '".$identifiant."'";
}else{
    
    $idet=$_GET['id'];
    if(isset($_GET['id'])){
        $arch=0;
        $idet=$_GET['id'];
        $sql="SELECT *,e.identifiant as identifiant,num_carte_gestion FROM $tableetud e left join $tablecartes c on e.matricule=c.identifiant WHERE e.identifiant = '".$idet."'";
    }elseif(isset($_GET['idar'])){
        $arch=1;
    $idet=$_GET['idar'];
    $sql="SELECT *,e.identifiant as identifiant,num_carte_gestion FROM $tablearchives e left join $tablecartes c on e.matricule=c.identifiant WHERE e.identifiant = '".$idet."'";
    }
}

mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
$req=mysqli_query($db,$sql);
$donnees=mysqli_fetch_array($req);
?>
                        <br><br>
<table align="center" >
<tr>
    <td style="border:1px solid black">
    <img src="<?php echo $donnees['photo'];?>" height="120" width="90" alt="image" />
    </td>
    <td style="border:1px solid black">
            <table bgcolor="#FCFAE1">
                    <tr height =25px>
                            <td> <b> <font face="Arial" color="#000000"> Nom : </font> </b> <?php echo $donnees['nom']; ?> </td>
                    </tr>
                <tr height =25px>
                            <td> <b> <font face="Arial" color="#000000"> Prénom : </font> </b> <?php echo $donnees['prenom']; ?> </td>
                    </tr>
                    <tr height =25px>
                            <td> <b> <font face="Arial" color="#000000"> Mail : </font> </b> <?php echo $donnees['mail']; ?> </td>
                    </tr>
                    <tr height =25px>
                            <td> <b> <font face="Arial" color="#000000"> Tél : </font> </b> <?php echo $donnees['tel']; ?> </td>
                    </tr>
                  
                   
                </table>
    </td>
    <td style="border:1px solid black">
            <table bgcolor="#FCFAE1">
                    <tr height =25px>
                        <td> <b> <font face="Arial" color="#000000"> Identifiant : </font> </b> <?php $identifiant = $donnees['identifiant']; echo $donnees['identifiant']; ?> </td>
                    </tr>
                  <tr height =25px>
                        <td> <b> <font face="Arial" color="#000000"> Date de Naiss. : </font> </b> <?php echo $donnees['date_naissance']; ?> </td>
                    </tr>
                    <tr height =25px>
                    <td>
                            <b> <font face="Arial" color="#000000"> Classe : </font> </b>
                            <?php
                            echo $donnees['classe'];
                            ?>
                    </td>
                    <tr height =25px>  
                         <td>
                            <b> <font face="Arial" color="#000000"> Année : </font> </b>
                            <?php
                            echo $donnees['annee'];
                            ?>
                    </td>
                    </tr>
            </table>
    </td>
    <td style="border:1px solid black">
            <table bgcolor="#FCFAE1">
                     <tr height =25px>
                               <td> <b> <font face="Arial" color="#000000"> Grp Ecole : </font> </b> <?php echo $donnees['groupe_ecole']; ?> </td>
                    </tr>
                    <tr height =25px>
                            <td> <b> <font face="Arial" color="#000000"> Grp Bureautique : </font> </b> <?php echo $donnees['groupe_buro']; ?> </td>
                    </tr>
                    <tr height =25px>
                            <td> <b> <font face="Arial" color="#000000"> Grp Anglais : </font> </b> <?php echo $donnees['groupe_anglais']; ?> </td>
                    </tr>
                                    <tr>
                            <td> <b> <font face="Arial" color="#000000"> Carte : <?php echo $donnees['carte']; ?></font> </b>  n° : <?php echo $donnees['num_carte_gestion']; ?> </td>
                    </tr>
            </table>
    </td>
    
        
        <td style="border:1px solid black">
            <table bgcolor="#FCFAE1">
                    <tr>
                    <td> 
                     <?php if ($donnees['cloud'] == 1) { ?> 
                    <img src='images/cloud.png' width=85px height=50px> 
                       <?php } ?>
                    </td>
                    </tr>
                    <tr>
                    <td> <b> <font face="Arial" color="#000000"> V. Office : </font> </b> <?php echo $donnees['version_office']; ?> </td>
                    </tr>
            </table>
        </td>
      
     </tr>
    <tr>
        <td colspan="4" align="center">
            <?php
            if($arch==0){
            ?>
            <input type="button" value="Modifier" onClick="(window.location='modification_et.php?id=<?php echo $identifiant; ?>')">
            <?php
            }else{
            ?>
                <form action="historique_et.php" method="POST" />
                <input type="hidden" name="idet" value="<?php echo $identifiant;?>" />
                <input type="submit" value="Désarchiver" name="desa"><br />
                <font color='red'><b>Attention, penser à faire de même sur Learneos et sur l'AD !!!</b></font>
                </form>
            <?php
            }
            echo $message;
            ?>
        </td>
    </tr>
    </table><br><br>

            
            
            
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

    <tr bgcolor="#87CEFA" style="border:1px solid black" height="30px">
    <th colspan ="5" style="border:1px solid black"> <font face="Arial" color="#000000"> HISTORIQUE CASQUE </font> </th>				
    </tr>
    <?php
    // On récupére tous les incidents utilisateurs liés é cet étudiant et on les affiche
    if($arch==0){
    $sql="SELECT * FROM $tableetud,$tablecasq WHERE identifiant = '".$identifiant."' AND type_casq != '' AND id_user = '$identifiant' GROUP BY id_casq";
    }else{
    $sql="SELECT * FROM $tablearchives,$tablecasq WHERE identifiant = '".$identifiant."' AND type_casq != '' AND id_user = '$identifiant' GROUP BY id_casq";    
    }
    mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error());
    $req_user=mysqli_query($db,$sql);
    $res_user= mysqli_num_rows($req_user);
    
    if($res_user==0){
    ?>
    <tr style="border:1px solid black" height="30px">
    <th colspan ="5" style="border:1px solid black"> <font face="Arial" color="#000000">Pas de casque attribué</font> </th>				
    </tr>
    <?php
	} else {
    ?>
        
                                        <tr bgcolor="#87CEFA" style="border:1px solid black" height="20px">
						<th style="border:1px solid black"> <font face="Arial" color="#000000"> Id Casque </font> </th>
						<th style="border:1px solid black"> <font face="Arial" color="#000000"> Date attribution </font> </th>
						<th style="border:1px solid black"> <font face="Arial" color="#000000"> Type</font> </th>
						<th colspan ="2" style="border:1px solid black"> <font face="Arial" color="#000000"> Formation concernée </font> </th>
					</tr>
    
					<?php
					while ($donnees=mysqli_fetch_array($req_user))
					{
						?>
						<tr id="<?php echo $donnees['id_casq']; ?>" style="border:1px solid black"  onmouseover="document.getElementById(<?php echo $donnees['id']; ?>).style.background = '#F7951E';" onmouseout="document.getElementById(<?php echo $donnees['id']; ?>).style.background ='#FFFFFF';" location.reload();">
							<td style="border:1px solid black" width="6%" align="center">
								<?php
								echo $donnees['id_casq'];
								?>
							</td>
							<td style="border:1px solid black" width="14%" align="center">
								<?php
								echo $donnees['date_attribution'];							
								?>
							</td>
							<td style="border:1px solid black" width="10%" align="center">
								<?php
								echo $donnees['type'];		
								?>
							</td>
							<td style="border:1px solid black" width="35%" align="center">
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
    
    <tr bgcolor="#87CEFA" style="border:1px solid black" height="30px">
    <th colspan ="5" style="border:1px solid black"> <font face="Arial" color="#000000"> HISTORIQUE DEPANNAGE </font> </th>				
    </tr>
    <?php
    // On récupére tous les incidents utilisateurs liés é cet étudiant et on les affiche
    $sql="SELECT * FROM incidents_to_users WHERE id_users = '".$idet."'";
    mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
    $req=mysqli_query($db,$sql);
    $resultats = mysqli_num_rows($req);
   
    if($resultats==0){
    ?>
    <tr style="border:1px solid black" height="30px">
    <th colspan ="5" style="border:1px solid black"> <font face="Arial" color="#000000"> Aucun dépannage</font> </th>				
    </tr>				
    <?php
    } else {
    ?>
    
                                        <tr bgcolor="#87CEFA" style="border:1px solid black" height="20px">
						<th style="border:1px solid black"> <font face="Arial" color="#000000"> Id </font> </th>
						<th style="border:1px solid black"> <font face="Arial" color="#000000"> Etat </font> </th>
						<th style="border:1px solid black"> <font face="Arial" color="#000000"> Date </font> </th>
						<th style="border:1px solid black"> <font face="Arial" color="#000000"> Probléme </font> </th>
						<th style="border:1px solid black"> <font face="Arial" color="#000000"> Commentaire </font> </th>
					</tr>
    
					<?php
					while ($donnees=mysqli_fetch_array($req))
					{
						?>
						<tr id="<?php echo $donnees['id']; ?>" style="border:1px solid black"  onmouseover="document.getElementById(<?php echo $donnees['id']; ?>).style.background = '#F7951E';this.style.cursor='pointer';" onmouseout="document.getElementById(<?php echo $donnees['id']; ?>).style.background ='#FFFFFF';this.style.cursor='auto';" onclick='mapopup("support/admin_detail.php?id=<?php echo $donnees['id']; ?>&solution=1");'>
							<td style="border:1px solid black" width="6%" align="center">
								<?php
								echo $donnees['id'];
								?>
							</td>
							<td style="border:1px solid black" width="14%" align="center">
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
							<td style="border:1px solid black" width="10%" align="center">
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
							<td style="border:1px solid black" width="35%" align="center">
								<?php
								$sql2="SELECT probleme FROM incidents WHERE id = ".$donnees['id_incidents']."";
								mysqli_query($db,$sql2) or die('Erreur SQL !'.$sql2.'<br />'.mysqli_error());
								$req2=mysqli_query($db,$sql2);
								$donnees2=mysqli_fetch_array($req2);
								echo $donnees2['probleme'];						
								?>
							</td>
							<td style="border:1px solid black" width="35%" align="center">
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
		<!-- FIN Contenu de la page (milieu) -->					



<footer>
	<h3> 2014-2015 Centre de Formation Multimedia - CHU Purpan - Toulouse </h3>
</footer>
</section>
</body>
</html>
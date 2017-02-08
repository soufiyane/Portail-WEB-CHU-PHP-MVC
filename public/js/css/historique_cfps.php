<?php
// PAGE AUTHORISEE QUE TECH ET ADMIN STATUT 2

require_once('connexion.php'); 
require_once('alias_tables.php');
	


        if (isset($_GET['rech'])) 
        {
        $var=$_GET['rech'];
        }
        ?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="css/monCss.css" />
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
<title>INFOS HISTORIQUE AGENT</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<section>
<header>
	<CENTER>	
	<img src="images/bandeau_gestion_agents.jpg" width="100%"/>			
	</CENTER>
</header>
        
			


                        <!-- Contenu de la page (milieu)-->
<?php                        
$sql="SELECT * FROM $tableagent WHERE matricule = '".$_GET['id']."'";
mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
$req=mysqli_query($db,$sql);
$donnees=mysqli_fetch_array($req);
?>
                        <br><br>
<table align="center" >
<tr>
    <td style="border:1px solid black">
            <table bgcolor="#FCFAE1">
                    <tr>
                            <td> <b> <font face="Arial" color="#000000"> Nom : </font> </b> <?php echo $donnees['nom']; ?> </td>
                    </tr>
                    <tr>
                            <td> <b> <font face="Arial" color="#000000"> Prénom : </font> </b> <?php echo $donnees['prenom']; ?> </td>
                    </tr>
                 <tr>
                            <td> <b> <font face="Arial" color="#000000"> Identifiant : </font> </b> <?php $identifiant = $donnees['matricule']; echo $donnees['matricule']; ?> </td>
                    </tr>
                   
                </table>
    </td>
    <td style="border:1px solid black">
            <table bgcolor="#FCFAE1">
                    <tr>
                            <td> <b> <font face="Arial" color="#000000"> Pole : </font> </b> <?php echo $donnees['pole']; ?> </td>
                    </tr>
                    <tr>
                            <td> <b> <font face="Arial" color="#000000"> UA : </font> </b> <?php echo $donnees['uf']; ?> </td>
                    </tr>
                 <tr>
                            <td> </td>
                    </tr>
                   
                </table>
    </td>
    <td style="border:1px solid black">
            <table bgcolor="#FCFAE1">
                    <tr>
                            <td> <b> <font face="Arial" color="#000000"> Mail : </font> </b> <?php echo $donnees['email']; ?> </td>
                    </tr>
                    <tr>
                            <td> <b> <font face="Arial" color="#000000"> Tél : </font> </b> <?php echo $donnees['tel']; ?> </td>
                    </tr>
 <tr>
                            <td> <b> <font face="Arial" color="#000000"> V. Office : </font> </b> <?php echo $donnees['version_office']; ?> </td>
                    </tr>
            </table>
    </td>

     </tr>
    <tr>
        <td colspan="3" align="center"><input type="button" value="Modifier" onClick="(window.location='modification_cfps.php?id=<?php echo $identifiant; ?>')"></td>
    </tr>
    </table><br><br>
                        
<table align="center" width="100%">


    <tr bgcolor="#87CEFA" style="border:1px solid black" height="30px">
    <th colspan ="5" style="border:1px solid black"> <font face="Arial" color="#000000"> HISTORIQUE CASQUE </font> </th>				
    </tr>
    <?php
    // On récupére tous les incidents utilisateurs liés é cet étudiant et on les affiche
    $sql="SELECT * FROM $tableagent, $tablecasq WHERE matricule = '".$_GET['id']."' AND type_casq != '' AND id_user = '$identifiant' GROUP BY id_casq";
    mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
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
						<th style="border:1px solid black"> <font face="Arial" color="#000000"> Formation concernée </font> </th>
					</tr>
    
					<?php
					while ($donnees=mysqli_fetch_array($req_user))
					{
						?>
						<tr id="<?php echo $donnees['id_casq']; ?>" style="border:1px solid black"  onmouseover="document.getElementById(<?php echo $donnees['id']; ?>).style.background = '#F7951E';" onmouseout="document.getElementById(<?php echo $donnees['id']; ?>).style.background ='#FFFFFF';">
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
    $sql="SELECT * FROM incidents_to_users WHERE id_users = '".$_GET['id']."'";
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
								mysqli_query($db,$sql2) or die('Erreur SQL !'.$sql2.'<br />'.mysqli_error($db));
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
	<h3> 2012 Centre de Formation Multimedia - CHU Purpan - Toulouse </h3>
</footer>
</section>
</body>
</html>
<?php
// PAGE AUTHORISEE QUE TECH ET ADMIN STATUT 2

require_once('connexion.php'); 
require_once('alias_tables.php');
require_once('includes/verification.php');
	


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
<script type="text/javascript">
 function clossparent()
             {
                 parent.$("#popupModal").hide();
             }
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
	<!--<img src="images/bandeau_gestion_agents.jpg" width="100%"/>		-->	
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

                        <div class="container col-md-12">
				              	<div class="row">
				              	<div >
									<table class="table table-condensed">
										<thead>
										<tr>
											<th >Nom</th>
											<th >Prénom</th>
											<th >Identifiant</th>
											<th >Pole</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td><?php echo $donnees['nom']; ?></td>
											<td><?php echo $donnees['prenom']; ?></td>
											<td> <?php $identifiant = $donnees['matricule']; echo $donnees['matricule']; ?></td>
											<td><?php echo $donnees['pole']; ?></td>
											
										</tr>
										</tbody>

										<thead>
										<tr>
											<th >UA</th>
											<th >Mail</th>
											<th >Téléphone</th>
											<th >Version office</th>
											
											
										</tr>
										</thead>
										<tbody>
										<tr>
											<td><?php echo $donnees['uf']; ?></td>
											<td><?php echo $donnees['email']; ?></td>
											<td><?php echo $donnees['tel']; ?></td>
											<td><?php echo $donnees['version_office']; ?></td>
										</tr>
										</tbody>

									</table>
							    </div> 
						       </div>
					        </div>
				
                          

  <div class="container">
		<div class="row">	
		</div>
		</div>							
         <div align="center">
		<div class="container">
		<div class="row">	
        <input type="button" class="btn btn-primary" value="Modifier" onClick="clossparent();window.top.location='<?php echo  $_SESSION['racine']?>agents/modification_agent?id=<?php echo $identifiant; ?>';">
        </div>
        </div>
        </div>


    <table>
    <tr height="50px">
    <th > </th>				
    </tr>
    </table>
   
   
                        
<table class="table table-condensed">
    <tr >
    <th colspan ="5" class="text-center" > HISTORIQUE CASQUE  </th>				
    </tr>
   <?php
    // On récupére tous les incidents utilisateurs liés é cet étudiant et on les affiche
    $sql="SELECT * FROM $tableagent, $tablecasq WHERE matricule = '".$_GET['id']."' AND type_casq != '' AND id_user = '$identifiant' GROUP BY id_casq";
    mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
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
						<tr id="<?php if(isset($donnees['id_casq'])) {echo $donnees['id_casq'];} ?>"  onmouseover="document.getElementById(<?php echo $donnees['id']; ?>).style.background = '#F7951E';" onmouseout="document.getElementById(<?php echo $donnees['id']; ?>).style.background ='#FFFFFF';" location.reload();">
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
    $sql="SELECT * FROM incidents_to_users WHERE id_users = '".$_GET['id']."'";
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
						<tr id="<?php echo $donnees['id']; ?>"   onmouseover="document.getElementById(<?php echo $donnees['id']; ?>).style.background = '#F7951E';this.style.cursor='pointer';" onmouseout="document.getElementById(<?php echo $donnees['id']; ?>).style.background ='#FFFFFF';this.style.cursor='auto';" onclick='window.location.href="admin_detail.php?id=<?php echo $donnees['id']; ?>&solution=1";'>
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
</section>
</body>
</html>
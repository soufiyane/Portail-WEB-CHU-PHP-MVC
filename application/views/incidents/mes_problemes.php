

<?php
// On active les sessions :
//session_start(); 
error_reporting(0);	

?>

<div class="modal modal-wide" id="popupModalsol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog" style="width: 920px;height:650"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-modal-edit" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h1 class="modal-title">Solutions:</h1>
      </div>
      <div class="modal-body">
         <iframe id="iframe" src="" style="zoom:0.9" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close-modal-edit">Close</button>
        <!--<button type="button" class="btn btn-primary">Sign now!</button>-->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

			
				<h1 align="center">Mes Problèmes en cours</h1>
				<p align="center"> <img src="../public/img/img/refresh.png" height="25px" onclick='refresh();' /> </p>
				<table  id="incidents"  class="table table-striped table-bordered text-center datatable-class" align="center" border="1" cellspacing="0" cellpading="0" width="100%">
				<!-- On affiche pour chaque incidents_to_users reli�s � l'�tudiant l'id, la date, le probl�me et l'�tat -->
					<?php
					$req=requete("SELECT incidents_to_users.id, incidents_to_users.date, incidents.probleme, incidents_to_users.id_etat, incidents_to_users.id_incidents, incidents.statut, incidents_to_users.commentaire 
                                        FROM incidents_to_users, incidents 
                                        WHERE incidents_to_users.id_incidents = incidents.id 
                                        AND id_users = ",$identifiant," AND id_etat <> 3
                                        ORDER BY incidents_to_users.id DESC");

                                        $nbresult=mysqli_num_rows($req);
                                        if($nbresult>0){
                                        ?>
                    <thread>                    
                    <TR >
						<Th style="text-align:center;" >N°</Th>
						<TH style="text-align:center;" >Date</TH> 				
						<TH style="text-align:center;"" >Problème</TH>
                        <TH style="text-align:center;" >Etat solution</TH>
					</TR>
					</thread>
					<tbody>
                                        <?php
                                        }else{
                                            echo "<tr><th colspan='4'>Il n'y a actuellement aucun problèmes en cours.</th></tr>";
                                        }
					while($donnees=mysqli_fetch_array($req))
					{	
						?>
						<tr>
							<td>
                                                        <?php echo $donnees['id']; ?>
							</td>
                                                        <td align="center">
							
									<?php
									$annee = substr($donnees['date'], 0, 4);
									$mois = substr($donnees['date'], 5, 2);
									$jour = substr($donnees['date'], 8, 2);
									$heure = substr($donnees['date'], 11, 2);
									$minute = substr($donnees['date'], 14, 2);
									$seconde = substr($donnees['date'], 17, 2);
									if (($heure == '00') && ($minute == '00') && ($seconde == '00'))
									{
										$date = $jour.'/'.$mois.'/'.$annee;
									}
									else
									{
										$date = $jour.'/'.$mois.'/'.$annee.' à '.$heure.':'.$minute;
									}
									echo $date;
									 ?> 
							
							</td>	
							<td align="center">
								" <i> <?php echo $donnees['probleme']; ?> </i> "
							</td>
											
							<td align="center" >
								<b> <?php
									// Si l'�tat est � "Je ne sais pas", on propose 3 boutons: Passer en résolu ou Demander de l'aide(passer en non résolu) ou Revoir la solution
									if ($donnees['id_etat'] == 2)
									{
										?>
										Vous avez indiqué ne pas avoir testé la solution proposée.<br />
										Votre problème est-il résolu ou avez vous besoin de l'aide d'un technicien?<br />
                                                                               <br>
										<form style=" display:inline!important; margin:0px;" method="POST" action="../public/js/updateincidentstousersyes.php" target="_blank">
											<input type="hidden" name="id" value=" <?php echo $donnees['id']; ?> " />
											<input type="hidden" name="commentaire" value=" <?php echo $donnees['commentaire']; ?> " />
											<input type="hidden" name="statut" value=" <?php echo $donnees['statut']; ?> " />
											<input type="button" name="ouiperso" value="Résolu" onClick="this.form.submit();window.setTimeout('refresh()',500);"/>
										</form>
                                      	<form style=" display:inline!important; margin:0px;" method="POST" action="../public/js/updateincidentstousersno.php" target="_blank">
											<input type="hidden" name="id" value="<?php echo $donnees['id']; ?>" />
											<input type="button" name="aide" id="aide" value="Aide" onClick="this.form.submit();window.setTimeout('refresh()',500);"/>
										</form>
                                        <input type="button" value="Revoir la solution" class="lignesol" href="../public/js/solution.php?id=<?php echo $donnees['id']; ?>&choix=<?php echo $donnees['id_incidents'];?>";/>
                                        <br> <br>     
       
                                        <?php
									
                                                                                
                                                                        }
									// Si l'�tat est � "Non r�solu", on propose un bouton: Passer en r�solu
									if ($donnees['id_etat'] == 1)
									{
										?>
										Un technicien est en train d'étudier votre problème, il vous contactera trés prochainement pour le résoudre.<br />
                                                                                <br>
                                        <form style=" display:inline!important; margin:0px;" method="POST" action="../public/js/updateincidentstousersyes.php" target="_blank" >
											<input type="hidden" name="id" value="<?php echo $donnees['id']; ?>"/>
											<input type="hidden" name="statut" value="<?php echo $donnees['statut']; ?>"/>
											<input type="hidden" name="incident" value="<?php echo $donnees['id_incident']; ?>"/>
											<input type="hidden" name="comment" value="<?php echo $donnees['commentaire']; ?>"/>
											<input type="button" value="Mon problème est résolu"  onClick="this.form.submit();window.setTimeout('refresh()',500);"/>
										</form><br><br>
										<?php
									}
                                    if ($donnees['id_etat'] == 4)
									{	
										?>
                                       <font color="green">Un technicien vous a répondu, pour consulter sa réponse cliquez sur le bouton ci-dessous.</font><br />
                                                                                <br>
                                            <form style=" display:inline!important; margin:0px;" method="POST" action="../public/js/solutions.php" target="_blank" >
<!--									    <input type="hidden" name="id" value="<?php //echo $donnees['id']; ?>"/>-->
<!--										<input type="hidden" name="statut" value="<?php //echo $donnees['statut']; ?>"/>
											<input type="hidden" name="incident" value="<?php //echo $donnees['id_incident']; ?>"/>
											<input type="hidden" name="comment" value="<?php //echo $donnees['commentaire']; ?>"/>-->
<!--											<a href="solution.php?id=<?php //echo $donnees['id']; ?>" target="_blank" style="text-decoration:none;"><input type="button" value="Voir la r�ponse du technicien"  /></a>-->
                                            <input type="button" value="Voir la réponse du technicien" class=lignesol href="../public/js/solution.php?id=<?php echo $donnees['id']; ?>";/>
										</form><br><br>
										<?php
									}
									?>
								</b>
							</td>
						</tr>
						<?php									
					}
					?>
					</tbody>
				</table>
			

	</body>
</html>
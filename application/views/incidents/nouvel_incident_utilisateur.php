<div class="fw-body">
	<div class="content">

<?php error_reporting(0); ?>

    <!-- Modal -->
<div class="modal modal-wide fade" id="popupModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog" style="height:70%;width:50%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Détails Utilisateur :</h3>
      </div>
      <div class="modal-body">
         <iframe id="iframe" src="" style="zoom:0.9" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Sign now!</button>-->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

					

				
					<!-- Modal -->
					<div class="modal fade" id="fee-details" tabindex="-1" role="dialog" aria-labelledby="fee-details-label" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="fee-details-label">Details Utilisateur</h4>
								</div>
								<div class="modal-body">
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
											<td><?php echo $user['nom']; ?></td>
											<td><?php echo $user['prenom']; ?></td>
											<td><?php
												$dt=$user['date_naissance'];
												echo substr($dt, 0, 2)."/".substr($dt, 2, 2)."/".substr($dt,-4);
												?>
											</td>
											<td><?php echo $user['mail']; ?></td>
											<td><?php echo $user['tel']; ?></td>
										</tr>
										</tbody>
									</table>
									<table class="table table-condensed">
										<thead>
										<tr>
											<th>Version Office</th>
											<th>Identifiant</th>
											<th>Groupe Bureautique</th>
											<th>Groupe Anglais</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td><?php echo $user['version_office']; ?></td>
											<td><?php echo $user['identifiant']; ?></td>
											<td><?php echo $user['groupe_buro']; ?></td>
											<td><?php echo $user['groupe_anglais']; ?></td>
										</tr>
										</tbody>
									</table>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->



		
									<form role="form"  method="post" action="../public/js/admin_newincidentstousers_insert.php" onSubmit="return valider_formulaire(this);">
                                        <div class="row">
									    <div class="form-group col-sm-6" id="user">
											  <label name="detaillabel1" id="detaillabel1" for="sel1">Utilisateur:</label>
											  <input type="hidden" name="ec" value=""/>
											  <input class="form-control" type='text' autocomplete='off'  value='Taper un identifiant, un matricule, un nom ou un prénom.' style="color:grey;" name='etudiant' id='inputString' />
                                              <input type="hidden" name="choix_utilisateur" id="choix_utilisateur" value="" />
                                              <input type="hidden" name="statut_session" id="statut_session" value=<?php echo $_SESSION['statut'] ?> />
                                              <div style="position:relative;">
                                              <div class='suggestionsBox' id='suggestions' style='display: none;'>
                                              <div class='suggestionList' id='autoSuggestionsList'></div>
                                              </div>
                                              </div>
									    </div>
									    </div>
									    <div class="row">                                    
                                        <div class="form-group col-sm-6" id="pla">
											<label name="detaillabel" id="detaillabel" for="sel1">Platefrome:</label>
											<select class="form-control selectpicker" id="choixplateforme" name="choixplateforme">
												<option value="no">Selectionner une plateforme</option>
											   <?php
                                                     $i=0;
                                                     $Arrayplat = array();
                                                     $Arrayid = array();               
                                                    while ($donneespla=mysqli_fetch_array($reqpla))
                                                    {
                                                    $id=$donneespla['id'];
                                                    array_push($Arrayid,$id);
                                                    $libelle=$donneespla['libelle'];
                                                    array_push($Arrayplat,$libelle);
                                                    echo '<option data-thumbnail="../public/img/Logos/'.$libelle.'.png" id="plat'.$libelle.'"  name="plateforme" class="btpla" value="'.$id.'">'.$libelle.'</option>';
                                                    $i++;                                        
                                                    }
                                                ?>
                                            </select>
										</div>
										</div>
										  <div class="row"></div><div class="row"></div>
                                        <?php
                                $i=0;
								foreach ($newArray as $data)
								{ 
								$idd= array_shift($Arrayid);
								                                       
                                                ?>
						        <div id="choix_probleme_<?php echo array_shift($Arrayplat); ?>" class="listepla" style='display: none;'>
						        <div class="row">
						        <div class="form-group col-sm-6" id="prbse">
								<label name="detailla" id="detailla" for="sel1">Problème:</label>
								<select class="form-control" name="choix_probleme<?php echo $idd; ?>" id="choixprobleme<?php echo $idd; ?>" >
									<option value="none">Veuillez choisir un problème ou en créer un.</option>
									<option value="none">-------------------</option>
									<option value="none">Problèmes récurrents:</option>
									<option value="none">-------------------</option>
									<?php
									$statut= 1;
 									while ($donnees=mysqli_fetch_array($data))
									{
										if ($donnees['statut']!=$statut)
										{
											?>
											<option value="none">-------------------</option>
											<option value="none">Problèmes désactivés:</option>
											<option value="none">-------------------</option>
											<?php
										}
										?>
										<option title="<?php echo $donnees['probleme'];?>" value="<?php echo $donnees['id']; ?>" <?php if ($donnees['statut']==1){ echo 'style="font-weight : 700;"';} else { echo 'style="font-style:italic;"';} ?>> <?php echo $donnees['probleme'];?> </option><?php  if ($donnees['statut']==1){echo '</b>';}else {echo '</i>';} ?>
										<?php
										$statut = $donnees['statut'];
									}
									?>
								</select>
								</div></div>
                                <i  float="right"><a href="#" onclick="visibilite('probleme_non_rec');"> Créer un problème </a> </i>
                                </div>
						        <?php
						        $i++;
                                }
                                ?>

                        <input type="hidden" name="etat" value="1"/>
								<?php
								$my_t=getdate(date("U"));
								$date=$my_t[year].'-'.$my_t[mon].'-'.$my_t[mday].' '.$my_t[hours].':'.$my_t[minutes].':'.$my_t[seconds];
								?>
								<input type="hidden" name="date" value="<?php echo $date; ?>"/>
								<input type="hidden" name="commentaire" value="En cours, nombre d'intervention: 0"/>

						<div id="probleme_non_rec" style='display:none';>
						
						<div class="row">
						<div class="form-group col-sm-6" id="prb">
						<label name="detaillabe" id="detaillabe" for="sel1">Problème:</label>	
						</br>				
						<textarea class="form-control" rows="9" cols="40" name="probleme_autre" id="probleme_autre"> </textarea>
					    </div>
						</div>
                        </div>
                        </br>
						<input  style='display:none'; id="bottom" float="right" class="btn btn-default" type="submit" value="Enregistrer"/>



    
</div>
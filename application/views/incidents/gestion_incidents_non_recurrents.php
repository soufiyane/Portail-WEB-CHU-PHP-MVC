<div class="fw-body">
	<div class="content">


 <div class="modal modal-wide" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog" style="width: 920px;height:650"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-modal-edit" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="titremodal"></h4>
      </div>
      <div class="modal-body">
         <iframe id="iframe" src="" style="zoom:0.95" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close-modal-edit">Close</button>
        <!--<button type="button" class="btn btn-primary">Sign now!</button>-->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="row">
<div class="col-lg-4 col-sm-2 col-xs-2">
<h4>Choisir une plateforme:</h4>
<select class="form-control" name="choix_plateforme" id="choixpla2" onChange="choixpla2();">
                                        <?php
                                        while ($donnees=mysqli_fetch_array($reqrec1))
					                    {
                                        $id=$donnees['id'];
                                        $libelle=$donnees['libelle'];
                                        if($id==$idchoix){
                                        echo '<option value="'.$id.'" selected="selected">'.$libelle.'</option>';
                                        }else{
                                        echo '<option value="'.$id.'" >'.$libelle.'</option>';    
                                        }
                                        }
                                        ?>
				</select>
			
</div>
</div>
			<?php
			
                        while ($donneeslib=mysqli_fetch_array($reqlib1))
			            {
                             $libellepla=$donneeslib['libelle'];
                        }
			?>
			<div id="<?php echo $libellepla; ?>" >
				<?php
				$reqinc1=requete("SELECT * FROM incidents WHERE statut = 0 AND id_plateforme =",$idchoix,"");	
				//$reqinc2= &$reqinc1;
				?>
				<table align="center" width="100%">
					<tr width="100%">
						<td align="center" colspan="3" width="100%"> <img src="../public/img/img/Logos/<?php echo $libellepla; ?>.png" /> </td>
					</tr>
					<tr style="border:1px" bgcolor="#87CEFA" width="100%">
						<TH style="border:1px solid black" background="#87CEFA" width="5%"> <font face="Arial" color="#000000">ID</font></th>						
						<TH style="border:1px solid black" background="#87CEFA" width="85%"> <font face="Arial" color="#000000">Problème</font></th>
						<TH style="border:1px solid black" background="#87CEFA" width="10%"><font face="Arial" color="#000000">Action</font></th>
					</tr>					
					<?php
					$donnees=mysqli_fetch_array($reqinc1);
					if ($donnees[0] == '') 
					{ 
						?>
						<tr width="100%">
							<td align="center" colspan="3" width="100%"> VIDE </td>
						</tr> 
						<?php 
					}

					else
					{
						$reqinc2=requete("SELECT * FROM incidents WHERE statut = 0 AND id_plateforme =",$idchoix,"");
						while ($donnees=mysqli_fetch_array($reqinc2))
						{
							?>
							<tr height="25px" width="100%">	
								<td align="center" style="border:1px solid black" bgcolor="#F7951E" width="5%"> <?php echo $donnees['id']; ?> </td>
								<td align="center" style="border:1px solid black" width="85%"> <?php echo $donnees['probleme']; ?> </td>
								<td style="border:1px solid black" width="10%"> <a href="javascript:void(0)" style=text-decoration:none onclick="visibilite('solut<?php echo $donnees['id'];?>');">   Transformer  en <br /> problème récurrent </a> </td>
							</tr>
								<tr id="solut<?php echo $donnees['id']; ?>" style="display:none" width="100%">							
								<td colspan="3" width="100%">
									<?php
									$req2=requete("SELECT num_solu FROM solutions_to_incidents WHERE id_incid = ",$donnees['id']," ORDER BY num_solu DESC");
									$donnees2=mysqli_fetch_array($req2);
									$maxsolut=$donnees2['num_solution'];
									$req22=requete("SELECT id FROM incidents_to_users WHERE id_incidents =",$donnees['id'],"");
									$donnees2=mysqli_fetch_array($req2);
									$to_users=$donnees2['id'];
									if ($to_users != '')
									{
										$req2=requete("SELECT * FROM depannages WHERE id_incidents_to_users = ",$to_users," ORDER BY id DESC");//noublie pas l'espace
									}
									?>
									
									
									
									
									
									
									
									
									
									
									
									
								 
									
									<table align="center" width="100%">
										<tr width="100%">
											<td colspan="3" align="center" width="100%"> <a  href="javascript:openmodal('../public/js/ajouter_incidents_recurent.php?id_autre=<?php echo $donnees['id']; ?>');"  style=text-decoration:none onclick=""> <u> <h1> <img src='../public/img/img/fleche_recurrent.png' />Transformer en problème récurrent</h1></u></a></td>
										</tr>
										<tr style="display:none" id="add_solut_<?php echo $libellepla; ?>_<?php echo $donnees['id']; ?>" width="100%"> <!-- ???????? on peut ajouter un boutton ajouter une solution-->
											<td colspan="3" align="center" width="100%">
												<h3> Solution: </h3>
												<form action="addsolut.php" method="post">
													<input type="hidden" name="id_pb" value="<?php echo $donnees['id']; ?>" />
													<input type="hidden" name="rec" value="non" />
													<textarea class="form" rows="9" cols="42" name="solution_txt" onfocus="if (this.value=='Cette solution sera propos� aux �tudiants, sur le site.') this.value=''">Cette solution sera proposée aux étudiants, sur le site.</textarea><br />
													<input type="submit" value="Enregistrer"/>
												</form>
											</td>
										</tr>
										
										
									</table>
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									<table align="center" style="border:5px solid orange" BGCOLOR="#DFE9E8" width="100%">
										<?php
										while ($donnees2=mysqli_fetch_array($req2))
										{
											if ($to_users != '')
											{
												?>
												<tr  id="<?php echo $donnees['id'].'/'.$donnees2['num_solution']; ?>"  width="100%">
													<td colspan="3" align="center" width="100%">												
													</td>
													<td colspan="3" align="center" width="100%">
													Dernier d�pannage:
													<br /> <br />
													<font face="Arial"  size="3"> <b> <?php if ($donnees2['detail'] != '') { echo $donnees2['detail'].'<br /><br />'; } else { echo 'PAS DE DEPANNAGE'; }  ?>  </b> </font>
													</td>
													<td colspan="3" align="center" width="100%">								
													</td>
												</tr>
												<?php
											}
											else
											{
												?>
												<tr  id="<?php echo $donnees['id'].'/'.$donnees2['num_solution']; ?>"  width="100%">
													<td colspan="3" align="center" width="100%">												
													</td>
													<td colspan="3" align="center" width="100%">
														Dernier dépannage:<br /><br />
														<font face="Arial"  size="3"><b>PAS DE DEPANNAGE </b></font>
													</td>
													<td colspan="3" align="center" width="100%">
													</td>
												</tr>
												<?php
											}
										}
										?>										
									</table>
									
									
									
									
									
									
									
									
									
									
								</td>								
							</tr>
							<?php
						}
					}	
					?>
				</table>
			</div>							
			
	
	
</div>
</div>	

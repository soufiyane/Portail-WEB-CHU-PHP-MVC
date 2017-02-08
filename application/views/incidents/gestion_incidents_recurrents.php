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

<input type="hidden" id="idd" value="" />

<div class="row">
<div class="col-lg-4 col-sm-2 col-xs-2">
<h4>Choisir une plateforme:</h4>
<select class="form-control" name="choix_plateforme" id="choixpla" onChange="choixpla();">
                                        <?php
                                        while ($donnees=mysqli_fetch_array($reqrec))
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
			
                        while ($donneeslib=mysqli_fetch_array($reqlib))
			            {
                             $libellepla=$donneeslib['libelle'];
                        }
			?>
			<div id="<?php echo $libellepla; ?>" >

			<table align="center" >
					<tr>
						<td align="center" colspan="3" width="100%"><img src="../public/img/img/Logos/<?php echo $libellepla; ?>.png" /></td>
					</tr>
					<tr style="border:1px" bgcolor="#87CEFA">
						<TH style="text-align:center; border:1px solid black" background="#d9edf7" width="5%" > <font face="Arial" color="#000000"> ID </font> </th>						
						<TH style="text-align:center;border:1px solid black" background="#d9edf7" width="85%" align="center"> <font face="Arial" color="#000000"> Problème </font> </th>
						<TH style="text-align:center;border:1px solid black" background="#d9edf7" width="10%" align="center"> <font face="Arial" color="#000000"> Action </font> </th>
					</tr>
					<tr>
					<td colspan="3" align="center" width="100%"> <a  href="javascript:openmodal('../public/js/ajouter_incidents_recurent.php?plateforme=<?php echo $idchoix; ?>');"   style=text-decoration:none> <h2> <u> <img src='../public/img/img/bouton-plus.gif' /> Ajouter un problème sur <?php echo $libellepla; ?> </h2> </u> </a> </td>
					</tr>
					<?php
                                        $i=1;
					while ($donnees=mysqli_fetch_array($reqinc))
					{
						?>
						<tr height="25px" width="100%">	
							<td align="center" style="border:1px solid black" <?php if ( $donnees['statut'] == 2 ) { ?> bgcolor = "#777878" <?php } else { ?> bgcolor="#F7951E" <?php } ?> align="center" width="5%" align="center"> <?php echo $donnees['id']; ?> </td>
							<td align="center" style="border:1px solid black" <?php if ( $donnees['statut'] == 2 ) { ?> bgcolor = "#A7ABAA" <?php } ?> align="center" width="85%" align="center"> <?php if ( $donnees['statut'] == 2 ) { echo '<font face="Arial" color="#000000"> <i>'; } ?> <?php echo $donnees['probleme']; ?> <?php if ( $donnees['statut'] == 2 ) { echo '</font></i>'; } ?></td>
							<td style="border:1px solid black"  <?php if ( $donnees['statut'] == 2 ) { ?> bgcolor = "#A7ABAA" <?php } ?> align="center" width="10%" align="center"> <?php if ( $donnees['statut'] == 2 ) { ?> <input type="submit" value="Réactiver" onclick="redirige('../public/js/reactiverpb.php?id=<?php echo $donnees['id']; ?>')" /> <?php } else { ?> <a href="javascript:void(0)" style=text-decoration:none onclick="visibilite('solut<?php echo $donnees['id'];?>');">   Voir ou Ajouter des solutions / documents </a><br />  ou <br /><a href="javascript:openmodal('../public/js/edit_incidents.php?id=<?php echo $donnees['id']; ?>')" style=text-decoration:none > Editer </a> <?php } ?> </td>
						</tr>
                        
                        <tr id="solut<?php echo $donnees['id']; ?>" style="display:none" width="100%">						
							<td colspan="3" width="1140px">
							<?php
                                                               $req2=requete("SELECT solutions.*,num_solu as num_solution
                                                                FROM solutions,solutions_to_incidents,incidents
                                                                WHERE solutions.id=solutions_to_incidents.id_solu
                                                                AND solutions_to_incidents.id_incid=incidents.id
                                                                AND incidents.id =",$donnees['id']," ORDER BY num_solu");

                                                                                             
                                $maxsolut=mysqli_num_rows($req2);
								?>
                                 <table align="center">
									<tr>
										<td align="center"><a onmouseover="" style="cursor: pointer;" onclick="visibilite('add_solut_learneos_<?php echo $donnees['id']; ?>');"><u><h1><img src='../public/img/img/bouton-plus.gif' /> Ajouter une nouvelle solution à ce problème</h1></u></a></td>
									</tr>
									<tr style="display:none" id="add_solut_learneos_<?php echo $donnees['id']; ?>">
										<td  align="center" >
											<h3>Solution:</h3>
											<form action="../public/js/addsolut.php" method="post">
												<input type="hidden" name="id_pb" value="<?php echo $donnees['id']; ?>" />
												<input type="hidden" name="rec" value="oui" />
												<textarea class="form" rows="9" cols="42" name="solution_txt"></textarea><br />
												<input type="submit" value="Enregistrer"/>
											</form>
                                                                                        OU
                                                                                        <?php
                                                                                        $req3=requete("SELECT id,titre,lib FROM solutions","","");
												                                       // $req3=mysqli_query($db,$sql3);
                                                                                                while($donnees3=mysqli_fetch_array($req3))
													                                               {
                                                                                                        $id=$donnees3['id'];
                                                                                                        $texte=$donnees3['lib'];
                                                                                                        echo "<div style='display:none;height:500px;width:300px;position : fixed;bottom : 20%;right : 50px;background-color:#C4C6C6;border:2px solid black;'id='sol".$id.$i."'><h1><u>Apperçu de la solution</u></h1>".$texte."</div>";

                                                                                                          echo "<div style='display:none;height:500px;width:300px;position : fixed;bottom : 20%;right : 50px;background-color:#C4C6C6;border:2px solid black;'id='soll".$id."'><h1><u>Apperçu de la solution</u></h1>".$texte."</div>";
                                                                                                    }
                                                                                                    echo"<input type='hidden' id='anciendiv'>";
                                                                                          $req4=requete("SELECT id,titre,lib FROM solutions","","");
												?>

                                                                                  <form action="../public/js/addsolut.php" method="POST" name="formulaire" id="formulaire">
                        
                                                                                   <input type="hidden" name="id_pb" value="<?php echo $donnees['id']; ?>" />
												                                   <input type="hidden" name="rec" value="oui" />
                                    
                                              
<table>
<tr>
<td>
<div id="listesols<?php echo $i; ?>" style="height:17px;width:300px;border:1px solid grey;border-bottom:0px;">

 
<input type='text' style="width:280px" autocomplete='off'  value='tapez un indice ou cliquer sur le fleche a droite pour afficher toute les solution' style="color:grey;" name='etudiant'
 id="choixpb<?php echo $i; ?>"></input><img src="../public/img/img/fleche.png" onClick="deploy(<?php echo $i; ?>);" style="float:right;border-left:1px solid grey;cursor:pointer;" onMouseOver="this.style.background='#A9DBF6'" onMouseOut="this.style.background='#FFFFFF'"/>

<div  style="position:relative;" ><!--    les divs qui suivent sont positionné relativement par rapport a cette div -->
 <div class='suggestionsBox2' name="sugg" style='display: none;' id='suggestions<?php echo $i; ?>' >                                          
 <div  class='suggestionList' id='autoSuggestionsList<?php echo $i; ?>' ></div>     
 </div>
 </div>


        
		
		
		
               
		

  <!--div style="position:relative;">
  <div class='suggestionsBox' id='suggestions' style='display: none;'>
    <div class='suggestionList' id='autoSuggestionsList'></div>
   </div>
    </div>-->

 <div id="listesol<?php echo $i; ?>" style="height:0px;width:300px;display: block;overflow:hidden;overflow-x: hidden;overflow-y: auto;overflow : -moz-scrollbars-vertical;border-top:1px solid grey;">
                                                                                                                            <?php							
													while($donnees4=mysqli_fetch_array($req4))
													{
                                                                                                        $titre=$donnees4['titre'];
                                                                                                        $texte=$donnees4['lib'];
														?>
<!--														<option value="<?php //echo $donnees3['id']; ?>">-->
                                                                                                                <?php
                                                                                                                if ($titre!=""){
                                                                                                                ?>
 <p style="margin:0px;" onClick="reploy('<?php echo $titre; ?>',<?php echo $donnees4['id']; ?>,<?php echo $i; ?>);" onMouseOver="voirdiv(this);this.style.background = '#87CEFA';this.style.cursor='pointer'"onMouseOut="cacherdiv();this.style.background = '#FFFFFF'" id="<?php echo $donnees4['id'].$i;?>" name="<?php echo $donnees4['id']; ?>">
 <?php
 echo $titre;
}else{
$max= "30"; // on d�termine combien de caract�res maxi doit avoir le texte.
if (strlen($texte)>$max) // la longueur du texte est-elle sup�rieure � limite $max ?
{
$texte=strip_tags($texte);
$texte = substr($texte, 0, $max); // on tronque le texte avec comme limite le maximum de caract�res autoris�s.
$espace = strrpos($texte, " " ); // R�cup�ration du dernier espace pour ne pas couper un mot.
$texte = substr($texte, 0, $espace); // la phrase est reformat�e pour s'arr�ter � l'�space .
$texte = $texte."..."; // on ajoute des points de suspension
}
?>




<p style="margin:0px;" onClick="reploy('<?php echo $texte; ?>',<?php echo $donnees4['id']; ?>,<?php echo $i; ?>);" onMouseOver="voirdiv(this);this.style.background = '#87CEFA';this.style.cursor='pointer'"onMouseOut="cacherdiv();this.style.background = '#FFFFFF'" id="<?php echo $donnees4['id'].$i;?>" name="<?php echo $donnees4['id']; ?>">
<?php
echo $texte;
}
                                                                                                                ?>
                                                                                                                </p>
<!--                                                                                                                </option>-->
														<?php
													}
													?>
                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                    <td align="left" valign="top">
<!--                                                                                                                        <input type="button" value="OK" onClick="deploy();"/>-->
                                                                                                                        
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </table>
<!--												</select>-->
                                                                                                <input type="hidden" name="listesolu" id="listesolu<?php echo $i; ?>" value=""/>
                                                                                                </br>
                                                                                                <input type="submit" value="Enregistrer"/>
                                                                                            </form>
										</td>
									</tr>
								</table>
								<table align="center" style="border:5px solid orange" BGCOLOR="#DFE9E8" width="100%">
									<?php
									if ($maxsolut == '0') 
									{
										echo '<tr><td colspan="3" align="center"><font face="Arial"  size="3"><b>PAS DE SOLUTION</b></font></td></tr>'; 
									}
									while ($donnees2=mysqli_fetch_array($req2))
									{
										?>									
										<tr  id="<?php echo $donnees['id'].'/'.$donnees2['num_solution']; ?>" <?php if ($donnees2['num_solution'] != 1) {  echo 'style="display:none"'; }  ?> width="100%">
											<td width="5%">
												<?php
												if ($donnees2['num_solution']!=1)
												{
													?>
													<INPUT border=0 src="../public/img/img/fleche_gauche.png" type="image" Value="submit" align="middle"  onclick="visibilite('<?php echo $donnees['id'].'/'; echo $donnees2['num_solution'] - 1; ?>');cacher('<?php echo $donnees['id'].'/'.$donnees2['num_solution']; ?>');" title="Solution pr�cedente" />
													<?php
												}
												?>
											</td>
											<td align="center" width="90%" >
												<?php
												echo $donnees2['num_solution'].' / '.$maxsolut; 
												?>
												<br />
											<font face="Arial"  size="3"> <b> <?php if ($donnees2['lib'] != '') { echo $donnees2['lib'].'<br /><br />'; } else { echo 'PAS DE SOLUTION'; }  ?>  </b> </font>
											<?php
											if ($donnees2['document'] != '')
											{
												?>
												<a href="../public/Fichiers/<?php echo $donnees2['document']; ?>.pdf" target="_blank" style=text-decoration:none ><h3><img src='img/icone_loupe.png' />Voir le document lié à cette solution<img src='img/icone_document.png' height='40px'/> </h3> </a>
												<?php
											}
											else
											{
												?>
												<a href="javascript:void(0)"  style=text-decoration:none onclick="visibilite('add_pdf_learneos_<?php echo $donnees['id']; ?>_<?php echo $donnees2['num_solution'];?>')"><h3><img src='../public/img/img/bouton-plus.gif' />Ajouter un document à cette solution<img src='../public/img/img/icone_document.png' height='40px'/></h3></a>
												<div id="add_pdf_learneos_<?php echo $donnees['id']; ?>_<?php echo $donnees2['num_solution'];?>" style=display:none>
													<form enctype="multipart/form-data" action="../public/js/upload_pdf.php" method="post" target="_blank">
														<input type="hidden" name="id_solution" value="<?php echo $donnees2['id']; ?>" />
														<!--<input type="hidden" name="num_solution" value="<?php //echo $donnees2['num_solution']; ?>" />-->													  
														Choisir un fichier PDF<input type="file" name="monfichier" />
														<input type="submit" />
													</form>
												</div>
												<?php
											}
											?>
											</td>
											<td width="5%">
												<?php
													if ($donnees2['num_solution']<$maxsolut)
													{
														?>
														<INPUT border=0 src="../public/img/img/fleche_droite.png" type="image" Value="submit" align="middle"  onclick="visibilite('<?php echo $donnees['id'].'/'; echo $donnees2['num_solution'] + 1; ?>');cacher('<?php echo $donnees['id'].'/'.$donnees2['num_solution']; ?>');" title="Solution suivante" />													
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
						<?php
                                                $i++;
					}		
					?>
				</table>
			</div>
			</div>
                                                                                        


	</div>
</div>	


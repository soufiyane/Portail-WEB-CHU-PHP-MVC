<div class="modal modal-wide" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog" style="width: 920px;"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-modal-edit" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Rédiger incident :</h3>
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


        <?php
        $statut=$_SESSION['statut'];
        error_reporting(0);
        if($_SESSION['statut']==1){      
        $donnees=mysqli_fetch_array($reqag);
        }else{      
        $donnees=mysqli_fetch_array($reqet);   
        }
        if($donnees['mail']==""){
        ?>
        <script>
         function isEmail(myVar){
            // La 1�re �tape consiste � d�finir l'expression r�guli�re d'une adresse email
            var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i');

            return regEmail.test(myVar);
        }
         var answer=prompt("Merci de bien vouloir nous communiquer un mail valide afin d'être contacté si besoin.","");
                if (answer!=null && answer!="")
                {
                    if(!isEmail(answer)){
                    alert("Veuillez entrer un mail valide.");
                    window.location = "rediger_incident";
                    }else{
                    window.location = "rediger_incident?mail="+answer;
                    }
                } else {
                    window.location = "rediger_incident";
                }
        </script>
        <?php
        }
        ?>
	
                    	
				
			<div id="contenu">
                            <?php
                                        $nbrep=mysqli_num_rows($reqres);
                                        if($nbrep>0){
                                        echo "<p align='center'><font color='#14CE00'><b>Un technicien vous a répondu concernant un de vos problèmes, pour visualiser son message rendez vous dans la rubrique problémes en cours.</b></font></p>";
                                        }
                                        ?>

				<div id="liste" align="center">	
					<table align="center" width="100%" >
						<tr>
							<td colspan="6" align="center"> <h1 align="center"> Choisir une plateforme </h1><br> </td>
						</tr>
                                                
						<tr>

                                                <?php
                                                                while ($donneespla=mysqli_fetch_array($reqpl))
                                                                {
                                                                $id=$donneespla['id'];
                                                                $libelle=$donneespla['libelle'];
                                                                if($libelle!="Divers"){
                                                                   // echo $libelle;
                                                                echo '<td align="center" width="150px">';
                                                                echo '<img id="logo_'.$libelle.'" class="logo" style="cursor:pointer" src="../public/img/img/Logos/'.$libelle.'.png" onmouseover=\'this.src="../public/img/img/Logos/'.$libelle.'_under.png"\' onmouseout=\'this.src="../public/img/img/Logos/'.$libelle.'.png"\'/>';
                                                                echo '<img id="logo_'.$libelle.'_under" class="logo_under" src="../public/img/img/Logos/'.$libelle.'_under.png" style=\'display:none;\'/>';
                                                                echo '</td>';
                                                                }
                                                                }
                                                        ?>
						</tr>
					</table>
					<br/><br/>
                                </div>
                                <?php
                                        while ($donneespla=mysqli_fetch_array($reqpla))
					{
                                        $id=$donneespla['id'];
                                        $libelle=$donneespla['libelle'];
                                ?>
                                <div id="<?php echo $libelle; ?>" class="detailpla" style=display:none>
				<!-- Pour chaque plateforme, on affiche tous les incidents qui y sont rel�s. En bas un bouton submit ou un lien autre qui ouvre la pge contact qui est un formulaire pour envoyer un incident type non r�current-->
					<div align="left">
                    <h2><?php echo $libelle; ?></h2>
                    

                                        <?php 
                                        if($libelle=="Learneos"){
                                          if($_SESSION['statut']=="1"){
                                          echo "<h3>En cas d'urgence et <u>UNIQUEMENT LE WEEK END</u>, vous pouvez joindre directement le service technique de Learneos à l'adresse suivante: <A HREF='mailto:support@learneos.fr?subject=Incident technique agent CFPS'>support@learneos.fr</a> .</h3>";
                                          }else{
                                          echo "<h3>En cas d'urgence et <u>UNIQUEMENT LE WEEK END</u>, vous pouvez joindre directement le service technique de Learneos à l'adresse suivante: <A HREF='mailto:support@learneos.fr?subject=Incident technique etudiant $ecole - $annee'>support@learneos.fr</a> .</h3>";   
                                          } 
                                        }
                                        ?>
					<table>
              
						<form  method="post" action="../public/js/insertincidentstousers.php" target="_parent">
							<?php
                            $req=requete("SELECT i.* FROM incidents i where statut=1 and id_plateforme=",$id,"");                             
							while($donnees=mysqli_fetch_array($req))
							{
                                                            $tabid[]=$donnees['id'];
								?>
								<tr>
									<td>
										<input type="radio" name="choix" value="<?php echo $donnees['id'];?>"> <?php echo $donnees['probleme'];?>
									</td>
								</tr>
								<?php
							}
                                                    ///
                                                        ?>
							<tr>
								<td>
									<br /><br />
									<?php
									echo '                   '; 
									?>
									<input type="submit" value="Choisir" /> <i> ou </i>
                        </form>
                                     <b><button class="ligne" href="../public/js/contact.php?plateforme=<?php echo $id; ?>">Autre</button></b>
									
								</td>
                            </tr>
						
                    
                        
                        </table>
                        
					</div>				
				</div>
                                <?php
                                        }
                                ?>
			</div>
			

<div class="fw-body">
    <div class="content">
        <h1 class="page_title">Incidents en cours - en attente de l'étudiant</h1>
        <div class="info">
            <p>Ceci est un tableau récapitulatif des incidents en attente d'une réponse de l'étudiant.</p>
        </div>

        <div class="row">
        <div class="col-lg-4 col-sm-3 col-xs-4"> <!-- class="col-lg-4 col-sm-3 col-xs-4 xs = extra small screens (mobile phones) sm = small screens (tablets) md = medium screens (some desktops) lg = large screens (remaining desktops) -->
        <table class="table">
            <thead>
            <tr>
                <th>Anciens</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td  class="danger"><?php $anc=mysqli_num_rows($anciens_etud); echo $anc; ?></td>
                <td  class="active"><?php $to=mysqli_num_rows($total_etud); echo $to; ?></td>
            </tr>
            </tbody>
        </table>
        </div>
        </div>		

 <div class="modal modal-wide" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog" style="width: 920px;height:650"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-modal-edit" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"></h4>
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

				<TABLE id="incidents"  class="table table-striped table-bordered text-center datatable-class" cellspacing="0" width="100%" >
                            <thead>
				<TR>
                                        <TH>Numéro</TH>
                                        <TH width="15%">Date création</TH>
                                        <TH width="13%">Nom Prénom</TH>
                                        <TH>Identifiants</TH>
                                        <TH>Télephone</TH>
                                        <TH>Description problème</TH>
                                        <th>Statut</th>
				</TR>
                                </thead>
                                <tbody>
				<?php

                                while($donnees=mysqli_fetch_array($req_2))
				{
                                    $crea=$donnees['crea'];
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
					<tr class="ligne" titre="<?php echo $donnees['probleme'];?>" href="../public/js/admin_detail.php?id=<?php echo $donnees['id']; ?>&solution=1" id="<?php echo $donnees['id']; ?>"    onmouseover='document.getElementById(<?php echo $donnees['id']; ?>).style.background = "#d9edf7"; this.style.cursor="pointer";' 
					<?php if($donnees['new']==1) { echo  "style='font-weight:bold;background-color:#FFFFCC'" ;echo 'onmouseout=\'document.getElementById('.$donnees['id'].').style.background ="#FFFFCC";\''; } 
					else { if ($donnees['new']== '-1') { echo  "style='background-color:#E88A94'"; echo 'onmouseout=\'document.getElementById('.$donnees['id'].').style.background ="#E88A94";\''; } 
					else {echo 'onmouseout=\'document.getElementById('.$donnees['id'].').style.background ="#FFFFFF";\'';}} ?> >
						<td>
							<?php
                            if ($_GET['focus']==$donnees['id'])
                            {
                                echo '<font color="red">';
                            }
		
							echo $donnees['id'];
								if ($_GET['focus']==$donnees['id'])
                            {
                                ?>
                                </font>
                                <?php
                            }													
							?>
						</td>
                        <td >
                        <?php
                        if ($_GET['focus']==$donnees['id'])
                            {
                                echo '<font color="red">';
                            }
                        echo $date;
                        if ($_GET['focus']==$donnees['id'])
                            {
                                ?>
                                </font>
                                <?php
                            }
                        ?>
                        </td>
						<td>
							<?php
                            if ($_GET['focus']==$donnees['id'])
                            {
                                echo '<font color="red">';
                            }
							 
							echo $donnees['nom'].' '.$donnees['prenom']; 
                            if ($_GET['focus']==$donnees['id'])
                            {
                                ?>
                                </font>
                                <?php
                            }
														
							?>
						</td>
                        <td>
							<?php
                            if ($_GET['focus']==$donnees['id'])
                            {
                                echo '<font color="red">';
                            }
 
							echo '<u>ID:</u>&nbsp;'.$donnees['identifiant'].' <br /><u>Mdp:</u> '.$donnees['date_naiss'];
                            if ($_GET['focus']==$donnees['id'])
                            {
                                ?>
                                </font>
                                <?php
                            }

							?>
						</td>
                        <td>
							<?php 
                            if ($_GET['focus']==$donnees['id'])
                            {
                                echo '<font color="red">';
                            }

							echo $donnees['tel'];
                                                        if ($donnees['tel']==""){
                                                        echo "n.c.";
                                                        }
                             if ($_GET['focus']==$donnees['id'])
                            {
                                ?>
                                </font>
                                <?php
                            }

							?>
						</td>
						<td>
							<?php
                            if ($_GET['focus']==$donnees['id'])
                            {
                                echo '<font color="red">';
                            }

							echo $donnees['probleme']; 
                            if ($_GET['focus']==$donnees['id'])
                            {
                                ?>
                                </font>
                                <?php
                            }

							?>
							<BR />
							
						</td>
                        <td>
                                                        <?php 
                                                        if ($_GET['focus']==$donnees['id'])
                            {
                                echo '<font color="red">';
                            }
                                                        global $txt;
                                                        $req2=requete("SELECT detail, date FROM depannages WHERE id_incidents_to_users=",$donnees['id'],"");
                                                        while($donnees2=mysqli_fetch_array($req2)){
                                                        if ($donnees2['detail'] != '')
                                                        {
                                                                $annee = substr($donnees2[1], 0, 4);
                                                                $mois = substr($donnees2[1], 5, 2);
                                                                $jour = substr($donnees2[1], 8, 2);
                                                                $heure = substr($donnees2[1], 11, 2);
                                                                $minute = substr($donnees2[1], 14, 2);
                                                                $seconde = substr($donnees2[1], 17, 2);
                                                                if (($heure == '00') && ($minute == '00') && ($seconde == '00'))
                                                                {
                                                                        $date = $jour.'/'.$mois.'/'.$annee;
                                                                }
                                                                else
                                                                {
                                                                        $date = $jour.'/'.$mois.'/'.$annee.' à '.$heure.':'.$minute;
                                                                }
                                                                $txt= '<i>[Ajouté par '.$crea.']</i><br />Dernier dépa. le<br /><i>'.$date.'</i>';
                                                        }
                                                        else
                                                        {
                                                                
                                                                $req2=requete("SELECT commentaire FROM incidents_to_users WHERE id=",$donnees['id'],"");
                                                                $donnees2=mysqli_fetch_array($req2);
                                                                $com=$donnees2[0];
                                                                $masque = "#^\[Ajouté par Admin\]#i";
                                                                if(preg_match($masque,$com)){
                                                                $com=substr($donnees2[0], 19);
                                                                $crea= "admin";
                                                                }
                                                                if($crea==""){$crea="non renseigné";}
                                                                $txt =  "<i>[Ajouté par ".$crea."]</i><br />".$com;
                                                        }
                                                        }
                                                        echo $txt;
                                                        if ($_GET['focus']==$donnees['id'])
                                                        {
                                                        ?>
                                                        </font>
                                                        <?php
                                                        }
                                                        ?>
                                                </td>
					</tr>						
					<?php
				}
				?>
                             </tbody>
			</TABLE>

</div>
</div>            
<div class="fw-body">
	<div class="content">
		<h1 class="page_title">Incidents en cours - en attente du CFM</h1>
		<div class="info">
			<p>Ceci est un tableau récapitulatif des incidents non encore traités par les agents CFM.</p>
		</div>


			<!--Contenu de la page (milieu)-->
      
		<div class="row">
		<div class="col-lg-4 col-sm-3 col-xs-4"> <!-- class="col-lg-4 col-sm-3 col-xs-4 xs = extra small screens (mobile phones) sm = small screens (tablets) md = medium screens (some desktops) lg = large screens (remaining desktops) -->
		<table class="table">
			<thead>
			<tr>
				<th>Non lus</th>
				<th>Anciens</th>
				<th>Total</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td  class="warning"><?php  $nl=mysqli_num_rows($nonlues); echo $nl;?></td>
				<td  class="danger"><?php  $anc=mysqli_num_rows($anciens); echo $anc;?></td>
				<td  class="active"><?php  $totall=mysqli_num_rows($total); echo $totall;?></td>
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

			<TABLE id="incidents"  class="table table-striped table-bordered text-center datatable-class" cellspacing="0" width="100%">
                            <thead>
				<TR>
                                        <TH >Numéro</TH>
                                        <TH width="15%">Date création</TH>
                                        <TH width="13%">Nom Prénom</TH>
                                        <TH >Identifiants</TH>
                                        <TH >Télephone</TH>
                                        <TH >Description problème</TH>
                                        <th >Statut</th>
				</TR>
                                </thead>
                                <tbody>
		<?php

//*************** trois dimension *****************//

//$data = $req;
/*
foreach( $data as $key1 => $value1 ) 
{ 

  echo $key1 . '<br />'; 
  
  foreach( $value1 as $key2 => $value2 ) 
{ 
  echo  $key2 . ' <br />'; 
  
  foreach( $value2 as $key3 => $valeur ) 
    echo '  ' .$key3.' '. $valeur . '<br />'; 
   
  echo '<br />'; 
}


} 
*/


//************* deux dimenssion *******************//
/*
foreach( $data as $key => $values ) 
{ 

  echo $key . '<br />'; 
  

  
  foreach( $values as $key1 => $valeur1 ) 
    echo '  ' .$key1.' '. $valeur1 . '<br />'; 
    
  echo '<br />'; 


} 
 
*/


	/*	 $str = array();
      foreach($req  as $key1 => $value1) 
      {
        foreach ($value1 as $key2 => $value2) 
        {
         $str[]= $key1.$key2;

        }
      

echo implode("\r\n" , $str);*/


     /* foreach($req  as $v1) 
      {
        foreach ($v1[0] as $v2) 
        {
         echo "$v2\n";
        }
      }

        $donnee = []; 
        foreach ($req as $row) 
        {
         $donnee=array_merge($donnee, $row);           
        }*/


                                     while($donnees=mysqli_fetch_array($req))
                                     
                                     	
				{
					                $idd=$donnees['id'];
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
					<tr class="ligne" titre="<?php echo $donnees['probleme'];?>" href="../public/js/admin_detail.php?id=<?php echo $donnees['id']; ?>&solution=1"  id="<?php echo $donnees['id']; ?>"    onmouseover='document.getElementById(<?php echo $donnees['id']; ?>).style.background = "#d9edf7"; this.style.cursor="pointer";' 
					<?php if($donnees['new']==1) { echo  "style='font-weight:bold;background-color:#FFFFCC'" ;echo 'onmouseout=\'document.getElementById('.$donnees['id'].').style.background ="#FFFFCC";\''; } 
					else { if ($donnees['new']== '-1') { echo  "style='background-color:#E88A94'"; echo 'onmouseout=\'document.getElementById('.$donnees['id'].').style.background ="#E88A94";\''; } 
					else {echo 'onmouseout=\'document.getElementById('.$donnees['id'].').style.background ="#FFFFFF";\'';}} ?>
					>
						<!--class="clickable" data-toggle="collapse" id="68" data-target=".solut php echo $idd; ?>"'>-->
						<td>
							<?php
							if ($_GET['focus']==$donnees['id']) 
							{
								echo '<font color="red">';
							} 
							if ($donnees['new']==1)
							{
								echo '<b>';
							}
							echo $donnees['id'];
							if ($donnees['new']==1)
							{
								echo '</b>';
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
							if ($donnees['new']==1)
							{
								echo '<b>';
							}
							echo $donnees['nom'].' '.$donnees['prenom'];
							?>
							<br>
							<?php if ($donnees['new']==1)
							{
								echo '</b>';
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
							if ($donnees['new']==1)
							{
								echo '<b>';
							}
							echo '<u>ID:</u>&nbsp;'.$donnees['identifiant'].' <br /><u>Mdp:</u> '.$donnees['date_naiss'];
							if ($donnees['new']==1)
							{
								echo '</b>';
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
							if ($donnees['new']==1)
							{
								echo '<b>';
							}
							echo $donnees['tel'];
                                                        if ($donnees['tel']==""){
                                                        echo "n.c.";
                                                        }
							if ($donnees['new']==1)
							{
								echo '</b>';
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
							if ($donnees['new']==1)
							{
								echo '<b>';
							}
							echo $donnees['probleme'];
							if ($donnees['new']==1)
							{
								echo '</b>';
							}
							?>
							<BR />
							<?php
							if ($_GET['focus']==$donnees['id'])
							{
								?>
								</font>
								<?php
							}
							?>
						</td>
                        <td id="td1" class="colonne" req="SELECT detail, date FROM depannage WHERE id_incidents_to_users=" par="<?php echo $donnees['id'];?>" >

                                                        <?php
                                                        if ($_GET['focus']==$donnees['id']) 
							{
								echo '<font color="red">';
							} 
                                                        $req2=requete("SELECT detail, date FROM depannages WHERE id_incidents_to_users=",$donnees['id'],"");
                                                        while($donnees2=mysqli_fetch_array($req2)){
                                                        if ($donnees2[0] != '')
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
                                                                echo '<i>[Ajouté par '.$crea.']</i><br />Dernier dépa. le<br /><i>'.$date.'</i>';
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
                                                                echo "<i>[Ajouté par ".$crea."]</i><br />".$com;
                                                        }
                            }
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
			<!-- FIN Contenu de la page (milieu) -->

</div>
</div>
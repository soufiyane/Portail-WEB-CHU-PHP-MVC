<div class="fw-body">
	<div class="content">
		<h1 class="page_title">Déclaration incident salle :</h1>

     <?php
                    while ($donneespla = mysqli_fetch_array($reqplat)) {
                    $id = $donneespla['id'];
                    $libelle = $donneespla['libelle'];
                    ?>


          <form role="form" method="post" id="form" action="../public/js/insertincidentstosalles.php" target="_parent">
                                <?php
                                if ($_SESSION['statut'] == 2) {
                  $datepb=date('Y-m-d H:i:s');
                  echo "<input type='hidden' value='".$_SESSION['id_tech']."' name='technicien' id='technicien' />";
            echo '<div class="row">';
            echo '<div class="form-group col-sm-6">';

                  echo
                  '<div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">Date incident:</span>';
                    echo "<input type='text' name='datepb' value='$datepb' class='form-control'>
                  </div>";
        echo '</div>';
        echo '</div>';
                echo "<br /><br />";
           echo '<div class="row">';
           echo '<div class="form-group col-sm-6">';
                  echo '<br /><select class="form-control" name=salle id=salle><option value="-1"><b>Choisir une salle</b></option>';
                                    while ($donnees = mysqli_fetch_array($reqsalle)) {
                                        ?>
                                        <option value="<?php echo $donnees['identifiant']; ?>"><?php echo $donnees['nom']; ?></option>
                                        <?php
                                    }
                                    echo "</select><br /><br />";
                                }else{
                                    echo "<input type='hidden' value='".$_SESSION['identifiant']."' name='salle' id='salle' />";
                                }
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="form-group col-sm-6" id="user">';
                                echo '<br /><select class="form-control" name=pbsalle id=pbsalle><option value="-1"><b>Choisir un problème</b></option>';
                                while ($donnees = mysqli_fetch_array($reqincidents)) {
                                    ?>
                                    <option value="<?php echo $donnees['id']; ?>"><?php echo $donnees['probleme']; ?></option>
                                    <?php
                                }
                                echo "<option value='autre'>Autre...</option></select><br /><br />";
        echo '</div>';
        echo '</div>';
 
                                ?>
                                <div class="row">
                                <div class="form-group col-sm-6" >
                                <textarea class="form" name='autrepb' id='autrepb' cols=42 rows=10 style='display:none;'></textarea>
                                <div id="reco" style='display:none;'>
                                    <b>ATTENTION:</b> Avant de soumettre le problème, veuillez vérifier les points suivants:<br />
                                    <ul>
                                        <li>Si vous utilisez le PC fixe mis à votre disposition, assurez vous que le bouton "HDMI" du boitier mural soir bien allumé.</li>
                                        <li>Si vous utilisez un PC portable, assurez vous que le bouton "VGA" du boitier mural soir bien allumé.</li>
                                        <li>Enfin, assurez-vous de bien être en mode bureau dupliqué (touche windows + P).</li>
                                    </ul>
                                </div><br />
      
                               </div>
                               </div>
                                        
         
          
               <div class="row">
               <div class="form-group col-sm-6" >
                <select class="form-control" name="mode" id="mode">
                  <option value="none">Choisir un mode de dépannage</option>
                  <option value="Par téléphone">Par téléphone</option>
                  <option value="En salle">En salle</option>
                </select>
               </div>
               </div>
                                                            <br /><br />
           
            
                                                            <div style="display:none;" id="details">
                 <div class="row">
               <div class="form-group col-sm-6">                                               
                <textarea class = "form-control" rows="6" cols="80"  name="detail" id="detail" onfocus="if (this.value=='Détail intervention...') { this.value='' };" onKeypress="document.getElementById('bt_enregistrer').disabled=false;">Détail intervention...</textarea><br />
                </div>
                </div>
                                                                   
                                                             <div class="row">
                                                             <div class="form-group col-sm-6" >   
                                                                    <div id="listeduree">
                                                                        <br /><br />
                                                                        <select class="form-control" name="duree" id="duree">
                                                                                        <option value="none">Choisir la durée du dépannage</option>
                                                                                        <option value="0-10 min">0-10 min</option>
                                                                                        <option value="10-20 min">10-20 min</option>
                                                                                        <option value="20-30 min">20-30 min</option>
                                                                                </select>
                                                                    </div>
                                                              </div>
                                                              </div>  
                                                                   
                                                                        <br /><br />
                                                                        <label>
                                                                        <input type="checkbox" name="resolve" value="resolve"/> Problème résolu
                                                                        </label>
                                                                        <!--<input class="form-control" type="checkbox" name="resolve" value="resolve">Problème résolu</td>-->
                                                                    
                                                                </div>
             
         

                                <input id="bt_enregistrer" type="submit" class="btn btn-default" value="Valider" />
        </form>
        <?php
}?>
</div>
</div>
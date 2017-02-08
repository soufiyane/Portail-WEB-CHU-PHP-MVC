    
      
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


    <?php
 switch($res){ //verif droit
                     case "envoyé": 
?>
<font size='3' align='center'>Les informations concernant l'agent : <?php echo $identifiant;?> ont été correctement modifiées.</font><br><br>
<?php break;case "modification": ?>

<div align="left">
  <div class="row">
 <div class="form-group col-sm-6" >
 <form name="form_envoyer" id="form1" method="post" enctype="application/x-www-form-urlencoded" action="<?php echo $_SESSION['racine']?>agents/modification_agent" onSubmit="return verif_formulaire()"> 
<?php $ligne_user = mysqli_fetch_assoc($resultat1); ?>
        <br>
        <div>
      
            <div >
                    <?php 
                    switch ($casque)
                    {
                    case "Casque simple":
                    echo "<img src='../public/img/images/casque_simple.png'>";  
                    break;
                    case "Casque-micro":
                    echo "<img src='../public/img/images/casque_micro.png'>";   
                    break;
                    default;
                    break;                                                       
                    }
                    ?>     
                    </div> 
        <legend><font size='3' align='center'>INFORMATIONS AGENT : <?php echo $identifiant;?> - POLE : <?php echo $ligne_user['pole'];?> - UF : <?php echo $ligne_user['uf'];?></font></legend>



<fieldset class="form-group">
    <label for="nom">Nom :</label>
    <input  class="form-control" type="text" name="nom"  value="<?php echo $ligne_user['nom'];?>" readonly>
</fieldset> 
 
  
  <fieldset class="form-group">
<labe  for="prenom">Prenom : </label>
        <input class="form-control" type="text"  name="prenom" value="<?php echo $ligne_user['prenom'];?>" readonly >
  </fieldset>

             
      <fieldset class="form-group">
        
        <label  for="date de naissance">Date de naissance : (jjmmaaaa) </label>
        <input  type="text"  class="form-control" name="date_naissance"  maxlength="8" value="<?php echo $ligne_user['date_naissance'];?>" readonly >
         </fieldset>

         <fieldset class="form-group">

        <label  for="tel">Téléphone : </label>
        <input  type="text"  class="form-control" name="tel"  value="<?php echo $ligne_user['tel'];?>">
         </fieldset>

         <fieldset class="form-group">

        <label for="mail">Adresse Mail: </label>
        <input type="text" name="mail"  class="form-control" value="<?php echo $ligne_user['email'];?>">
          <small class="text-muted">ATTENTION PENSER A CHANGER SUR LEARNEOS !</small>
           </fieldset>
                             
                <input type="hidden" value="<?php echo $ligne_user['matricule'];?>" name="identifiant"></input>
           
               
        <br>

        <fieldset>
        </div>
        <legend>INFORMATIONS BUREAUTIQUE : <font color="red">(ATTENTION PENSER A CHANGER SUR LEARNEOS !)</font></legend>
        <fieldset class="form-group">
        <select  class="form-control" name=version_office id=version_office>
            <option value='-1'>- - Choisissez votre version du pack Office - -</option>
                        <?php   
                        //if ($ligne_user['version_office'] !='') 
                        //echo "<option value=".$ligne_user['version_office']." selected=selected>Office ".$ligne_user['version_office']."</option>";
                        ?>
                        <option value='2003' <?php if ($ligne_user['version_office'] =='2003') echo 'selected=selected' ?>>Office 2003</option>
            <option value='2007' <?php if ($ligne_user['version_office'] =='2007') echo 'selected=selected' ?>>Office 2007</option>
            <option value='2010' <?php if ($ligne_user['version_office'] =='2010') echo 'selected=selected' ?>>Office 2010</option>
            <option value='' <?php if ($ligne_user['version_office'] =='') echo 'selected=selected' ?>>Non déterminée</option>     
        </select>  
        </fieldset>  




 <div class="checkbox">
    <label>
      <input type="checkbox" name="cloud" <?php if ($ligne_user['cloud'] == 1) echo 'checked';?>> Mode Cloud
    </label>
  </div>

 
        

        <br>
          <label><input class="btn btn-default" type="submit" name="envoyer" id="envoyer" value="Envoyer"></label>
        </form> 
    
	
 <?php break; case "recherche" ?>

  <form method="post" name="form_modif" id="formulairetotal" action="#" ENCTYPE="multipart/form-data" style="margin-left:0px;width:100%;">
    

          
                <fieldset><legend>RECHERCHER UTILISATEUR : </legend>
        <!-- REQUETE POUR AFFICHAGE USERS-->
         <div class="row">
         <div class="form-group col-sm-6" id="user">
                <form action='modification_cfps.php' method='POST'>
                        <input class="form-control" type='text' autocomplete='off' size='50' value='' style='color:grey;' name='agent' id='inputString2' />
                        <input type='hidden' name='choix_utilisateur' id='choix_utilisateur2' value='' />
                        <div style='position:relative;'>
                        <div class='suggestionsBox' id='suggestions' style='display: none;'>
                        <div class='suggestionList' id='autoSuggestionsList'></div>
                        </div></div><br /><br />
                </fieldset> 

    
    <br><br>

    
    <input style=" float:left" class="btn btn-default" type="submit" name="modifier" value="Modifier"/> 

    <br><br>
    
</form>    
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php } ?>








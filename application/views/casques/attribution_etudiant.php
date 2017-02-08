<div class="fw-body">
    <div class="content">
    <div align="left">
        <h1 class="page_title">Attribution d'un casque à un étudiant :</h1>
		
			<p>Rechercher un étudiant :</p>			
			<form role="form" id="myForm" action='attribution_etudiant' method='POST'>
			<div class="row">
			<div class="form-group col-sm-6" id="user">
			<input type='text' class="form-control" autocomplete='off' size='40' value="<?php echo $et?>" name='etudiant' id='inputStringc' />
                        <input type='hidden' name='choix_utilisateur' id='choix_utilisateur'  value='<?php echo $id_et?>'/>
                        <div style='position:relative;'>
			<div class='suggestionsBox' id='suggestions' style='display: none;'>
			<div class='suggestionList' id='autoSuggestionsList'>
			</div></div></div><br />
			</div>
			</div>

            
            <p> Commentaire :</p>
			<textarea style="width:300px" class="form-control" name='commentaire'></textarea><br /><br />
			<input class="btn btn-default"  type='submit' name='attribuer_etudiant' value='Attribuer à un étudiant'>
			</form>

                       <?php echo "<br />";?>
                        <div style='height: 0px'><?php echo $message;?></div>
                      
		
			




</div>
</div>
</div>			
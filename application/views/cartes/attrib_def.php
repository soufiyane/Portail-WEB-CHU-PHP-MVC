<div class="fw-body">
    <div  class="content">
    <div align="left">
        <h1 class="page_title">Attribution d'une carte définitive à un étudiant :</h1>
		
			<p>Rechercher un utilisateur :</p>			
			<form role="form" id="myForm" action='attrib_def' method='POST'>
			<div class="row">
			<div class="form-group col-sm-6" id="user">
			<input type='text' class="form-control" autocomplete='off' size='40' value="<?php echo $et?>" name='etudiant' id='inputStringg' />
                        <input type='hidden' name='choix_utilisateur' id='choix_utilisateur'  value='<?php echo $id_et?>'/>
                        <div style='position:relative;'>
			<div class='suggestionsBox' id='suggestions' style='display: none;'>
			<div class='suggestionList' id='autoSuggestionsList'>
			</div></div></div><br />
			</div>
			</div>
                       
			<input class="btn btn-default" type='submit' name='attribuer_etudiant' value='Attribuer'>
			</form>
		
			

			<?php
			if(isset($_POST['attribuer_etudiant'])){
				
                echo "<br />".$message;

                }
                        
                        
			?>





</div>
</div>
</div>			
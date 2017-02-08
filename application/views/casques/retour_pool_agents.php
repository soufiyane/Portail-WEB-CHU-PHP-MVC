<div class="fw-body">
	<div class="content">
	<div align="left">
Rechercher un pool :
			
			<form action='retour_pool_agents' method='POST'>
			<input style="width:540px" class="form-control" type='text' autocomplete='off' size='40' value='' name='agent' id='inputStringpl' />
			<input type='hidden' name='choix_utilisateur' id='choix_utilisateurpl' value='' />	
			<div style='position:relative;' >
			<div class='suggestionsBox' id='suggestions' style='display: none;'>
			<div class='suggestionList' id='autoSuggestionsList'>
			</div></div><br /><br />			
			<input type='checkbox' name='defaillant' />&nbsp;<label for='defaillant'> Défaillant</label> <br /><br />
			<input class="btn btn-default" type='submit' name='bouton' value='Retour de casque'>
			</form>


			<?php echo '</br></br>'.$message;?>

			</div>
			</div>
			</div>
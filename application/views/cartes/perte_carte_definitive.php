<div class="fw-body">
    <div class="content">
    <div align="left">
        <h1 class="page_title">Perte cartes définitives :</h1>

<p>Rechercher un utilisateur :</p>			
			<form role="form" id="myForm" action='perte_carte_definitive' method='POST'>
			<div class="row">
			<div class="form-group col-sm-6" id="user">
			<input type='text' class="form-control" autocomplete='off' size='40' name='etudiant' id='inputStringg' />
                        <input type='hidden' name='choix_utilisateur' id='choix_utilisateur'  />
                        <div style='position:relative;'>
			<div class='suggestionsBox' id='suggestions' style='display: none;'>
			<div class='suggestionList' id='autoSuggestionsList'>
			</div></div></div><br />
			</div>
			</div>

<input class="btn btn-default" type='submit' name='bouton' value='Déclarer la perte'>
</form>
<?php echo $message;?>
</div>
</div>			
</div>
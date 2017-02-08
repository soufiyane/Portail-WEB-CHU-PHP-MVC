 <div class="fw-body">
    <div class="content">
        <h1 class="page_title">Retour casque étudiant :</h1>

 <form role="form" id="myForm" action='retour_casque_agent' method='POST'>
                        <div class="row" style='padding-top: 40px;'>
			            <div class="form-group col-sm-6" id="user">
			            <p style=" float:left">Rechercher un utilisateur :</p>
                                <input  type='text' class="form-control" autocomplete='off' size='40' value='' name='agent' id='inputStringag' />
                                <input type='hidden' name='choix_utilisateur' id='choix_utilisateurag' value='' />		                    
                                <div style='position:relative;' >
                                <div class='suggestionsBox' id='suggestions' style='display: none;'>
                                <div class='suggestionList' id='autoSuggestionsList'>
                                </div></div></div><br /><br />
                                </div>
			                    </div>
			                    <div style='padding-top: 40px;'>
                                <input style=" float:left" type='checkbox' name='defaillant' />&nbsp;<label style=" float:left" for='defaillant'>&nbsp;  Défaillante</label><br /><br />
								
                                <input style=" float:left" class="btn btn-default" type='submit' name='bouton' value='Retour de casque'>
                                </div>
                                </form>
<?php echo $message;?>

</div>
</div>                                
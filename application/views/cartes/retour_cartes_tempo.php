<div class="fw-body">
    <div class="content">
        <h1 class="page_title">Retour cartes provisoires / Attribution cartes définitives :</h1>


<table width="100%" border=0>
                <tr>
                    <td width="49%" height="100%">                        				
                        <form role="form" id="myForm" action='retour_cartes_tempo' method='POST'>
                        <div class="row" style='padding-top: 40px;'>
			            <div class="form-group col-sm-12" id="user">
			            <p style=" float:left">Rechercher un utilisateur :</p>
                                <input  type='text' class="form-control" autocomplete='off' size='40' value='' name='etudiant' id='inputStringg' />
                                <input type='hidden' name='choix_utilisateur' id='choix_utilisateur' value='' />		                    
                                <div style='position:relative;' >
                                <div class='suggestionsBox' id='suggestions' style='display: none;'>
                                <div class='suggestionList' id='autoSuggestionsList'>
                                </div></div></div><br /><br />
                                </div>
			                    </div>
			                    <div style='padding-top: 40px;'>
                                <input  style=" float:left" type='checkbox' name='defaillant' />&nbsp;<label  style=" float:left" for='defaillant'>&nbsp;  Défaillante</label><br /><br />
                                <input  style=" float:left" type='checkbox' id='perdu1' name='perdu1' onclick="c1();"/>&nbsp;<label  style=" float:left" for='perdu'> &nbsp; Perdue</label><br /><br />
                                <div style='height: 0px'>
                                <select style="  display:none;width:250px;" class="form-control" name="perdu_options1" id="perdu_options1" >
                                    <option value="Perte école">Perte étudiant</option>
                                    <option value="Perte étudiant">Perte école</option>
                                    <option value="Non rendu étudiant">Non rendu étudiant</option>
                                    <option value="Perte CFM">Perte CFM</option>
                                </select><br /><br />
                                </div><br /><br />
								<?php if ($finsco!=1){
								echo"<input  style='float:left' type='checkbox' name='cartedef' $check/>&nbsp;<label  style='float:left' for='cartedef'> &nbsp; Attribution carte définitive</label><br /><br />";
								}?>
                                <input style='float:left' class="btn btn-default" type='submit' name='bouton' value='Retour de carte'>
                                </div>
                                </form>
                        <?php echo "<br />";?>
						<?php echo "<br />";?>
                         <?php echo "<br />";?>
                        <div style='height: 0px'><?php echo $message;?></div>
                        
                    </td>
                    <td width="2%">
                    </td>
                    <td width="49%">
                        <br><br>
                        <p style=" float:left">Rechercher une carte :</p>
                        <form role="form" action='retour_cartes_tempo' method='POST' name='form_ret_carte'>
                        <div class="row">
			            <div class="form-group col-sm-12" id="user">
                                <input type='text' class="form-control" size='30' value='' name='num_carte' id='inputStringCarte'/><br />
                                <span id='infos' style='display:none;height: 0px'></span><br><br><br>
                                </div>
			                    </div>  
                                <input style=" float:left" type='checkbox' name='defaillant' />&nbsp;<label style=" float:left" for='defaillant'>  &nbsp; Défaillante</label><br /><br />
                                <input style=" float:left" type='checkbox' id='perdu2' name='perdu2' onclick="c2();" />&nbsp;<label style=" float:left" for='perdu'> &nbsp; Perdue</label><br /><br />
                                <div style='height: 0px'>
                                <select style="  display:none;width:250px;" class="form-control" name="perdu_options2" id="perdu_options2" >
                                    <option value="Perte école">Perte étudiant</option>
                                    <option value="Perte étudiant">Perte école</option>
                                    <option value="Non rendu étudiant">Non rendu étudiant</option>
                                    <option value="Perte CFM">Perte CFM</option>
                                </select><br /><br />
                                </div><br /><br />
								<?php if ($finsco!=1){
								echo"<input style='float:left' type='checkbox' name='cartedef' $check/>&nbsp;<label style='float:left' for='cartedef'>  &nbsp; Attribution carte définitive</label><br /><br />";
								}?>
								<input style='float:left' class="btn btn-default" type='submit' name='bouton2' value='Retour de carte'>
                                </form>

                        <?php echo "<br />";?>
						<?php echo "<br />";?>
						<?php echo "<br />";?>						
                        <div style='height: 0px'><?php echo $message2;?></div>

                </td>
                </tr>
            </table>




</div>
</div>			        
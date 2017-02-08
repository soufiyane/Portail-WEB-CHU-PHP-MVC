<div id="divinfo">         
                <h1 align="center"> Mes informations </h1>
                <fieldset style="width:75%;margin-left:125px;">
                    <legend><?php echo $_SESSION['identifiant']; ?></legend>
                    <form  id="my_form" name="form_envoyer" method="post" action="../public/js/updateusers.php" onsubmit="return verifierMail(this.elements['mail']);">
                        <table align="center" border="0">

<?php
if ($_SESSION['statut'] != 1) {// va etre remplacé par if session = chez pa koi
    ?>                                                
                                <tr>
                                    <!-- On formatte et on affiche la classe (pas modifiable) -->

                                    <td></td>
                                    <td> <h3>Année:</h3></td>
                                    <td> 
    <?php
    echo '<h3> '.' '.$annee.' </h3>';
    ?>
                                    </td>
                                </tr>
    <?php
}
?>
                            <tr>
                                <td align="center" width ="35%" rowspan="4">
                                    <?php
                                    switch ($casque) {
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

                                </td>	
                                <!-- On affiche nom et pr�nom (pas modifiable)-->

                                <td><h3>Nom Prénom :</h3></td>
                                <td><?php echo  '<h3> '.' '. $donnees['nom'] . '      ' . $donnees['prenom']. '</h3> '; ?></td>
                            </tr>
                            <tr>
                                <!-- On affiche nom et pr�nom (pas modifiable)-->
                                <td valign="top" nowrap><h3>Version Office :</h3></td>
                                <td>
                                    <?php
                                    if ($donnees['version_office'] == "") {
                                        ?>
										<font color="red" size="1">Aucune version choisie.</font>
   
                                        <?php
                                    } else {
                                        echo '<h3> '.' '.$donnees['version_office']. '<h3> ';
                                        if ($donnees['cloud']==1){
                                            echo " Cloud";
                                        }
										// date � tester :
										$now = date('Y-m-d');
										$debut = '2014-09-01';
										$fin = '2014-10-31';
										 
										// on formate les dates selon le format Ymd
										$now = new DateTime( $now );
										$now = $now->format('Ymd');
										$debut = new DateTime( $debut );
										$debut = $debut->format('Ymd');
										$fin = new DateTime( $fin );
										$fin = $fin->format('Ymd');
										 
										//et on test les deux dates
										if( ($now > $debut)&&($now<$fin)&&($ecole=="ERASS"||$ecole=="IADE")&&($donnees['cloud']==0) ) {
										?>
										  <select name="version_office" id="version_office">
                                            <option value='-1'>- - Changer pour la version - -</option>
                                            <option value='2010 Cloud'>Office 2010 Cloud</option>
											<input type="hidden" name="cloud" value="1" />
											<?php
										}
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <!-- On affiche le t�l�hpone qui est modifiable, le champ �tant contr�l� par le mask type n�tel -->
                                <td><h3>Tèl:</h3></td>
                                <td> <input type="text" id="tel" name="tel" value="<?php echo $donnees['tel']; ?>" size="30" alt="tel" class="{mask:'99-99-99-99-99'}"  readonly/> </td>
                            </tr>
                            <tr>
                                <!-- On affiche le mail qui est modifiable, on v�rifie que ce soit bien une adresse mail au moment o� l'on appuie sur submit (onsubmit dans le form + function de v�rification dans l'en-t�te) -->
                                <td><h3>Mail:</h3></td>
                                <td> <input type="text" name="mail" value="<?php echo $mail; ?>" size="30"  readonly/> </td>
                            </tr>
<?php if ($_SESSION['statut'] != 1) {
    ?>
                                <tr>
                                    <!-- On affiche l'adresse' qui est modifiable, on v�rifie que ce soit bien une adresse  au moment o� l'on appuie sur submit (onsubmit dans le form + function de v�rification dans l'en-t�te) -->
                                    <td></td>
                                    <?php

                                    @$ligne_adruser = mysqli_fetch_assoc($res_reqadr_user);
                                    $num_voie = $ligne_adruser['numero_voie'];
                                    $type_voie = $ligne_adruser['type_voie'];
                                    $lib_voie = $ligne_adruser['libelle_voie'];
                                    $num_apt = $ligne_adruser['apt_numero'];
                                    $num_bat = $ligne_adruser['apt_batiment']; 
                                    $type_comp = $ligne_adruser['type_complement'];
                                    $lib_comp = $ligne_adruser['libelle_complement'];
                                    ?>
                                    <td><h3>Adresse:</h3></td>
                                    <td>
                                            <table>
        <tr class="legende">
            <td>N° de voie</td>
            <td>Type de voie</td>
            <td>Libellé de voie</td>
        </tr>
        <tr>
            <td>
<input type="text" name="num_voie" size="10" maxlength="5" value="<?php echo $num_voie ?>" placeholder="N° de voie" class='adr' disabled="disabled"><b> &nbsp;</b>
            </td>
            <td>
<?php
$column_name = "type_voie";

echo "<select name=\"$column_name\" style='margin:0px;' class='adr' disabled='disabled'>";

$row = mysqli_fetch_array($result);
$enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE']) - 6))));
echo "<option value='-1'>Type de voie</option>";
foreach ($enumList as $value) {
if ($type_voie == $value) {
$selected = "SELECTED";
} else {
$selected = "";
}
echo "<option value=\"$value\" $selected>$value</option>";
}

echo "</select>";
?>
<b> &nbsp;</b>
            </td>
            <td>
<input type="text" name="lib_voie" size="25" maxlength="22" value="<?php echo $lib_voie; ?>"  placeholder="Libellé de voie" class='adr' disabled="disabled"><br />
            </td>
        </tr>
    </table><br />
<label for="num_apt" style="float:left;">Appt. / Chambre <input type="text" disabled="disabled" class='adr' name="num_apt" id="num_apt" size="5" maxlength="4" value="<?php echo $num_apt; ?>" placeholder="N°" ></label>
<label for="num_bat" style="float:left;">Bât. / Immeuble <input type="text" disabled="disabled" class='adr' name="num_bat" id="num_bat" size="9" maxlength="15" value="<?php echo $num_bat; ?>" placeholder="N°" ></label>
<div style='clear:both;'></div>
<table>
    <tr class="legende">
        <td>Complément</td>
         <td><p> &nbsp;</p> </td>
        <td>Libellé</td>
    </tr>
    <tr>
        <td>
<?php
$column_name = "type_complement";

echo "<select name=\"$column_name\" style='margin:0px;' class='adr' disabled='disabled'>";


$row = mysqli_fetch_array($result2);
$enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE']) - 6))));
echo "<option value='-1'>Complément</option>";
foreach ($enumList as $value) {
if ($type_comp == $value) {
$selected = "SELECTED";
} else {
$selected = "";
}
echo "<option value=\"$value\" $selected>$value</option>";
}
?>
        <td><p> &nbsp;</p> </td></td>
        <td>
        <input type="text" class="adr" name="lib_comp" size="30" maxlength="28" value="<?php echo $lib_comp; ?>" placeholder="Libellé" disabled="disabled" >
        </td>
    </tr>
</table>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- On affiche le mail qui est modifiable, on v�rifie que ce soit bien une adresse mail au moment o� l'on appuie sur submit (onsubmit dans le form + function de v�rification dans l'en-t�te) -->
                                    <td></td>
                                    <td><h3>Code postal</h3></td>
                                    <td><input type="text" name="cp" value="<?php echo $cp; ?>" size="5"  maxlength="5" class="adr" disabled="disabled"/>&nbsp;&nbsp;&nbsp;<a id="lienmodifadr" href="javascript:modifadr()">Modifier l'adresse</a></td>
                                </tr>
                                <tr>
                                    <!-- On affiche le mail qui est modifiable, on v�rifie que ce soit bien une adresse mail au moment o� l'on appuie sur submit (onsubmit dans le form + function de v�rification dans l'en-t�te) -->
                                    <td></td>
                                    <td><h3>Ville</h3></td>
                                    <td> <input type="text" name="ville" value="<?php echo $ville; ?>" class="adr" size="30" disabled="disabled"/><input type="hidden" id="modifadr" name="modifadr" value="0"></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr >
                                <td></td>

                                <td></td>
                                <td><br /><p> Pour modifier vos informations merci d'utiliser le portail : <a href="https://ecoles-instituts.chu-toulouse.fr/">Ecoles-Instituts PREFMS</a> et cliquer sur "Mon Compte en Ligne"</p></td>
                            </tr>
                        </table>
                    </form>	
                </fieldset>
       
            
    </div> 
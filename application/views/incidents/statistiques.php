  <div class="fw-body">
    <div class="content">   
    <div align="left">       
                <h1> Statistiques </h1><br />
                <table>
                    <tr>
                        <td align="center"><b>Début de période</b></td>
                        <td align="center"><b> </b></td>
                        <td align="center"><b>Fin de période</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="textfield" name="dtdebut" id="dtdebut" onclick="displayDatePicker(this);" class="dt"/></td>
                        <td align="center"><b> &nbsp;</b></td>
                        <td><input type="text" class="textfield" name="dtfin" id="dtfin" onclick="displayDatePicker(this);" class="dt"/></td>
                        <td align="center"><b> &nbsp;</b></td>
                        <td><img src="../public/img/img/refresh2.png" id="btrefresh"/></td>
                    </tr>
                </table><br />
                <table>
                    <tr>
                        <td align="center"><img src="../public/img/img/Logos/ecole.png" width="100px" class="logoinst" title="Ecoles" id="logoecoles"/></td>
                        <td align="center"><img src="../public/img/img/Logos/CFPS.jpg" width="80px" class="logoinst" title="CFPS" id="logocfps"/></td>
                        <td align="center"><img src="../public/img/img/Logos/ecole_cfps.png" width="200px" class="logoinst" title="CFPS" id="logoecolescfps"/></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="radio" name="institution" id="institution1" value="ecoles"></td>
                        <td align="center"><input type="radio" name="institution" id="institution2" value="cfps"></td>
                        <td align="center"><input type="radio" name="institution" id="institution3" value="all"></td>
                    </tr>
                </table>
                </BR>
                <div id="listeecoles" style="float:left;display:none;">
                    <select name="ecoles" id="ecoles">
                        <option value="-1">Choix de l'école</option>
                        <option value="0">Toutes les écoles</option>
                        <?php                        
                        while ($donnees = mysqli_fetch_array($reqecole)) {
                            $id = $donnees['id'];
                            $nm = $donnees['libelle'];
                            echo "<option value='$id'>$nm</option>";
                        }
                        ?>
                    </select>
                </div>
                <div id="listepoles" style="float:left;display:none;">
                    <select name="poles" id="poles">
                        <option value="-1">Choix du pôle</option>
                        <option value="0">Tout les pôles</option>
                        <?php                    
                        while ($donnees = mysqli_fetch_array($reqpole)) {
                            $pole = $donnees['pole'];
                            echo "<option value='$pole'>$pole</option>";
                        }
                        ?>
                    </select>
                </div>
                <div id='loader1' style='float:left;display:none;border:0px solid red;margin-left:30px;margin-top:-10px;text-align:center;'><iframe src="../public/img/img/295/preloader_JS.html" frameborder="0" SCROLLING="no" style="width: 32px;border:0px;height: 32px;margin-right:auto;margin-left:auto;overflow-x: hidden;overflow-y: hidden;"></iframe><br /><font color="grey">Chargement...</font></div>
                <div id="liste_annees" style="margin-left:20px;float:left;"></div>
                <div id="liste_uf" style="margin-left:20px;float:left;"></div>
                <div id="clear"></div>
                <div id='loader2' style='float:left;display:none;border:0px solid red;margin-left:30px;margin-top:10px;text-align:center;'><iframe src="../public/img/img/295/preloader_JS.html" frameborder="0" SCROLLING="no" style="width: 32px;border:0px;height: 32px;margin-right:auto;margin-left:auto;overflow-x: hidden;overflow-y: hidden;"></iframe><br /><font color="grey">Chargement...</font></div>
                <div id="stats" style="margin-top:20px;"></div>
</div>
</div>            
</div>
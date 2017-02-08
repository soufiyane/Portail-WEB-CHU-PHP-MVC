<div class="fw-body">
    <div class="content">
        <h1 class="page_title">Attribution a une liste d'étudiant :</h1>
<form  role="form" name="formulairetotal" id="formulairetotal" ACTION="attrib_liste_etudiants" METHOD="POST" ENCTYPE="multipart/form-data" style="margin-left:0px;width:100%;" >
   
    </br><fieldset><legend><h5>INFORMATIONS ECOLES : </h5></legend>
    <div align="left">

      
             <select   onchange='this.form.submit()' name='id_ecole' id='ecole' >
                  
              <option value='-1'>Ecole</option> 
            <?php     
            while($ligne = mysqli_fetch_assoc($result)){
                    $ecole = $ligne["libelle"];
                    $id_ecole = $ligne["id"];
                    ?>
                <option <?php if ($ecole_selected!='no-selected' && $ecole_selected == $id_ecole){ echo "selected='selected'"; };                          
                             ?> value="<?php echo $id_ecole ?>"> <?php echo $ecole ?> </option>
                        <?php
                }?>
           </select>
   
                    <?php while($ligne = mysqli_fetch_assoc($resultt)){
                   $ecole = $ligne["libelle"];
                    $id_ecole = $ligne["id"];         
               ?>
       
                <select   name='annee<?php echo $id_ecole?>'  id="ann_<?php echo $ecole?>" onchange='this.form.submit()';
                <?php if ($ann != "annee".$id_ecole){ echo "style=\"display:none\""; };?>
                >
                      
                          <option value='-1'>toutes les années</option>    
                        <?php
                        $result1=requete("SELECT cursus FROM ecoles WHERE id =" ,$id_ecole,"");
                             while($ligne = mysqli_fetch_assoc($result1)){
                            $cursus = $ligne["cursus"];                                            
                           
                                    for ($i = 1; $i<= $cursus; $i++)
                                    {
                                    ?>
                   <option  <?php if ($annee_selected == "A".$i){ echo "selected='selected'"; };
                            
                             ?> value='A<?php echo $i?>'>A<?php echo $i?></option>
                                    <?php   
                                    }
                                                           
                        }
                      echo "</select>"; 
                     ?>
                  
                     <?php
             
                 } 

                   while($ligne = mysqli_fetch_assoc($resulttt)){
                   $ecole = $ligne["libelle"];
                    $id_ecole = $ligne["id"]; 
                    $result2=requete("SELECT DISTINCT annee FROM etudiants WHERE id_ecole =" ,$id_ecole,"");
                      while($lignee = mysqli_fetch_assoc($result2)){
                      $annee = $lignee["annee"]; 
                      $result3=requete("SELECT DISTINCT groupe FROM etudiants WHERE id_ecole =" ,$id_ecole," and annee='".$annee."' order by groupe ASC");
                    ?>
                    
                    <select  <?php if ($group != "groupe".$id_ecole.$annee){ echo "style=\"display:none\""; }?> 
                    name='groupe<?php echo $id_ecole.$annee?>' id='groupe_<?php echo $ecole.$annee?>' onchange=this.form.submit();>
                    <?php                    
                    echo "<option   value='-1'>- - - Tous les groupes - - -</option>";
                   
                      while ($ligne1 = mysqli_fetch_assoc($result3)) {
                        ?>
                            <option <?php if ($groupe_selected == $ligne1['groupe']){ echo "selected='selected'"; };                          
                             ?> value="<?php echo $ligne1['groupe'] ?>"> <?php echo substr($ligne1['groupe'], -4) ?> </option>
                        <?php
                      } 
                                
                echo "</select> ";
                    
                    } 
           
             
                }

                   ?>
                 
                
                  </fieldset><br><br>
                

        <br><br>

   <input type='hidden' name='nbet' value='<?php echo $index ?>' />
     <br />
     <p align="left">Commentaire :</p>
     <textarea style="width:300px;float:left" class="form-control" name='commentaire'></textarea><br /><br />
 
 

 <?php echo "<div align='left'><br>".$string."<br></div>";?>


      <input style=" float:left" class="btn btn-default" type="submit" name='attribuer' value='Attribuer à la liste' id="sub" />    

    <br><br>
  
</form>

</div>
</div>
</div>
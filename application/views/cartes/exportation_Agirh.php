<div class="fw-body">
    <div class="content">
    <div align="left">
        <h1 class="page_title">Exportation vers Agirh :</h1>
<?php  include ('../public/js/includes/variables_annee.php');?>
<form  role="form" method="post" name="formulairetotal" id="formulairetotal" ACTION="exportation_Agirh" METHOD="POST" ENCTYPE="multipart/form-data" style="margin-left:0px;width:100%;" >
   
    </br><fieldset><legend><h5>INFORMATIONS ECOLES : </h5></legend>


   
            

        
              <select name='id_ecole' id='ecole' >
                  
              <option value='-1'>Ecole</option> 
            <?php     
            while($ligne = mysqli_fetch_assoc($result)){
                    $ecole = $ligne["libelle"];
                    $id_ecole = $ligne["id"];
                 echo "<option value=".$id_ecole.">".$ecole."</option>";
                }?>
           </select>
                    <?php while($ligne = mysqli_fetch_assoc($resultt)){
                   $ecole = $ligne["libelle"];
                    $id_ecole = $ligne["id"];         
               ?>
                <select  style="display:none" name='annee<?php echo $id_ecole?>'  id="ann_<?php echo $ecole?>" >
                      
                          <option value='-1'>Année</option>    
                        <?php
                        $result1=requete("SELECT cursus FROM ecoles WHERE id =" ,$id_ecole,"");
                             while($ligne = mysqli_fetch_assoc($result1)){
                            $cursus = $ligne["cursus"];                                            
                          /*  switch ($id_ecole) {
                                case "9"://ibode
                               
                                 echo "<option value=".$A1_IBODE.">".$A1_IBODE."</option>";
                                
                                 echo "<option value=".$A2_IBODE.">".$A2_IBODE."</option>";
                                Break;   
                                
                                case "4"://IFMK
                                
                                  echo "<option value=".$A1_IFMK.">".$A1_IFMK."</option>";
                               
                                  echo "<option value=".$A2_IFMK.">".$A2_IFMK."</option>";
                                 
                                  echo "<option value=".$A3_IFMK.">".$A3_IFMK."</option>";
                                 Break;  
                                

                                case "5"://esf
                                    
                                  echo "<option value=".$A1_ESF.">".$A1_ESF." = A1</option>";
                               
                                  echo "<option value=".$A2_ESF.">".$A2_ESF." = A2</option>";
                                
                                  echo "<option value=".$A3_ESF.">".$A3_ESF." = A3</option>";
                               
                                  echo "<option value=".$A4_ESF.">".$A4_ESF." = A4</option>";
                                Break;

                                default:*/
                                    for ($i = 1; $i<= $cursus; $i++)
                                    {
                                    if ($annee != "A".$i)    
                                      echo "<option value=A".$i.">A".$i."</option>";    
                                    }
                                //}                           
                        }
                      echo "</select>"; 
                    
                    } 
                    ?>
                  </fieldset><br><br>
                

        <br><br>
    
    <input class="btn btn-default" type="submit" name="Exporter" id="sub" value="Exporter"/>    

    <br><br>
    
</form>



<?php

				echo $mess;	
				
?>
</div>
</div>
</div>
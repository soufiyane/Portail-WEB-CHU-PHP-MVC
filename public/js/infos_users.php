 <div id="info" style="text-align        : right; width:100%;">
        <?php
        
        if($_SESSION['statut']==1){
            
              //  echo '<script type="text/javascript">alert("' . $_SESSION['identifiant'] . '"); </script>';

          
    
        $req=requete("SELECT nom, prenom,tel,email,version_office,type_casq FROM agents
 WHERE matricule =",$_SESSION['identifiant'],"");
        $donnees=mysqli_fetch_array($req);
        $mail=$donnees['email'];
        $casque=$donnees['type_casq'];
        }else{
        $req=requete("SELECT *,ecoles.libelle,type_casq FROM etudiants
,ecoles WHERE etudiants
.id_ecole=ecoles.id AND matricule =",$_SESSION['identifiant'],"");
        $donnees=mysqli_fetch_array($req);
        $id_etudiant=$donnees['id_etudiant'];
        $ecole=$donnees['libelle'];
        $mail=$donnees['mail'];
        $adresse=$donnees['adresse'];
        $cp=$donnees['code_postal'];
        $ville=$donnees['ville'];
        $casque=$donnees['type_casq'];
        }
        ?>

        
            <!-- Informations utilisateur -->
            <?php // On affiche le nom et le prénom ?>
            <b> <font size="1"> Bonjour <?php echo $donnees['prenom'].' '.$donnees['nom'].'- ' ?></font></b> 
                <b> <i>
                        <?php
                        if($_SESSION['statut']==1){
                            echo "CFPS"; 
                        }else{
                        // On affiche la classe en la formattant
                        $ladate=getdate();
                        $annee=$ladate[year];
                        $annee=$donnees['annee'];
                        //$classe=$donnees['classe'];

                        //$classe=substr(strrchr($donnees['classe'], "-"), strrchr($donnees['classe'], "-"));
                        echo $annee."-".$ecole;
                        }
                        ?>
                </i> </b>
            </font>          
</div>
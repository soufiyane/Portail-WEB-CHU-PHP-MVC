<div id="info" >
        <?php
        if($_SESSION['statut']==1){
        $sql="SELECT nom, prenom,tel,email,version_office,type_casq FROM $tableagent WHERE matricule = '".$_SESSION['identifiant']."'";
        //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
        mysqli_query($db,$sql) or die('Erreur SQL !');
        $req=mysqli_query($db,$sql);
        $donnees=mysqli_fetch_array($req);
        $mail=$donnees['email'];
        $casque=$donnees['type_casq'];
        }else{
        $sql="SELECT *,$tableecole.libelle,type_casq FROM $tableetud,$tableecole WHERE $tableetud.id_ecole=$tableecole.id AND matricule = '".$_SESSION['identifiant']."'";
        //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
        mysqli_query($db,$sql) or die('Erreur SQL !');
        $req=mysqli_query($db,$sql);
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
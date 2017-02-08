<?php
// On inclus les données de connexion :
header('Content-Type: text/html; charset=ISO-8859-1');
require_once('includes/connexion.php');
require_once('includes/alias_tables.php');

$id_ecole=$_POST['ecoles'];
//$id_ecole=10;
//NOMBRE D'ETUDIANTS QUI ONT UTILISES LE SUPPORT
$sql="SELECT DISTINCT annee from etudiants
 where id_ecole = $id_ecole ORDER BY annee ASC";
$req = mysqli_query($db,$sql);
$nb=mysqli_num_rows($req);
if($nb==0){
    echo "<script type='text/javascript'>ajaxstat ($('#ecoles').val());</script>";
}else if($nb==1){
    while ($donnees=mysqli_fetch_array($req))
    {
        $annee=$donnees['annee'];
    }
    echo "<script type='text/javascript'>ajaxstat ($('#ecoles').val(),'".$annee."',2);</script>";
}else{
?>
<select name="ecoles" id="annees">
    <option value="-1">Choix de l'année</option>
				<option value="A0">Toutes les années</option>
                                <?php
                                while ($donnees=mysqli_fetch_array($req))
                                    {
                                        $annee=$donnees['annee'];
                                        echo "<option value='$annee'>$annee</option>";
                                    }
                                ?>
			</select>
<?php
}
?>

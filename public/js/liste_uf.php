<?php
// On inclus les données de connexion :
header('Content-Type: text/html; charset=ISO-8859-1');
require_once('includes/connexion.php');
require_once('includes/alias_tables.php');

$id_pole=$_POST['pole'];
//$id_ecole=10;
//NOMBRE D'ETUDIANTS QUI ONT UTILISES LE SUPPORT
$sql="SELECT DISTINCT uf from agents
 where pole = '$id_pole' ORDER BY uf ASC";
$req = mysqli_query($db,$sql);
$nb=mysqli_num_rows($req);
if($nb==0){
    echo "<script type='text/javascript'>ajaxstat ($('#poles').val(),'',1,1);</script>";
}else if($nb==1){
    while ($donnees=mysqli_fetch_array($req))
    {
        $uf=$donnees['uf'];
    }
    echo "<script type='text/javascript'>ajaxstat ($('#pole').val(),'".$uf."',2,1);</script>";
}else{
?>
<select name="ufs" id="ufs">
    <option value="-1">Choix de l'UF</option>
				<option value="A0">Toutes les UF</option>
                                <?php
                                while ($donnees=mysqli_fetch_array($req))
                                    {
                                        $uf=$donnees['uf'];
                                        echo "<option value='$uf'>$uf</option>";
                                    }
                                ?>
			</select>
<?php
}
?>

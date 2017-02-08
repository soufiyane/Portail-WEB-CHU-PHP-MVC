<?php
require_once('includes/verification.php'); 
error_reporting(0);
?>
<script>
	function redirige(adresse)
	{
		location.href = adresse;
	}
</script>
<script>
	function mapopup(page)
	{
		window.open(page,'mapopup','height=450,width=1000,top=50,left=50,resizable=no, scrollbars=yes');
	}
</script>
<?php
require_once('includes/connexion.php');
require_once('includes/alias_tables.php');
$sql="INSERT INTO incidents values ('', ".$_POST['plateforme'].", '".addslashes($_POST['probleme'])."', 1)";
mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
$idincid= mysqli_insert_id($db);
if (($_POST['solution'] == 'ne rien renseigner si pas de solution connue') OR ($_POST['solution'] == ''))
{
}
else
{

	$sql="INSERT INTO $tablesolu VALUES ('','', '".$_POST['solution']."', '')";	
	mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));	
        $idsol= mysqli_insert_id($db);
        $sql="INSERT INTO $tablesoltoincid VALUES ('','".$idincid."', '".$idsol."', '1')";
	mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
}
if (($_POST['solution2'] !='Deuxième solution') AND ($_POST['solution2'] != ''))
{
        $sql="INSERT INTO $tablesolu VALUES ('','', '".addslashes($_POST['solution2'])."', '')";
	mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));	
        $idsol = mysqli_insert_id($db);
        $sql="INSERT INTO $tablesoltoincid VALUES ('','".$idincid."', '".$idsol."', '2')";/********* 2 aulieu de 1 a revoir*******/
	mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
}
if (($_POST['solution3'] !='Troisième solution') AND ($_POST['solution3'] != ''))
{
        $sql="INSERT INTO $tablesolu VALUES ('','', '".addslashes($_POST['solution3'])."', '')";
	mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));	
        $idsol= mysqli_insert_id($db);
        $sql="INSERT INTO $tablesoltoincid VALUES ('','".$idincid."', '".$idsol."', '3')";/************* 3 au lieu de 1 a revoir**************/
	mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
}

if ($_POST['autre_to_rec'] != '')
{
?>	<script>
	alert('ca y est j''y suit ca y est on y est');
	
</script>
<?php
	$sql="DELETE FROM $tableincidents WHERE id = ".$_POST['autre_to_rec']."";
	mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
        $sql="SELECT id FROM $tableincidusers WHERE id_incidents = ".$_POST['autre_to_rec']."";
mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
$req=mysqli_query($db,$sql);
while ($donnees=mysqli_fetch_array($req))
{
	?>
	<script>
		mapopup('associerpb.php?idusers=<?php echo $donnees['id']; ?>&idpb=<?php echo $id; ?>&retour=popup');
	</script>
	<?php
}
}

?>
<script>
	alert('Le problème a bien été ajouté à la base de données.');
	redirige('<?php echo $_SESSION['racine']?>incidents/gestion_incidents_non_recurrents');
</script>
<?php
session_start();
require_once('includes/connexion.php');
require_once('includes/alias_tables.php');
?>
<!DOCTYPE html>
<html>
	<head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Insertion incident</title>
<script>
	function mapopup(nm,page)
	{
		window.open(page,nm,'height=450,width=1000,top=50,left=50,resizable=no, scrollbars=yes');
	}
</script>
        </head>
        <body>
<?php
$id=$_SESSION['identifiant'];
$sql="SELECT nom,prenom FROM $tabletech WHERE identifiant='".$id."'";
//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
mysqli_query($db,$sql) or die ('Erreur SQL 1!');
$req=mysqli_query($db,$sql);
$donnees=mysqli_fetch_array($req);
$tech_nom=$donnees[0];
$tech_prenom=$donnees[1];
$tech=$tech_prenom." ".$tech_nom;
//mysql_select_db($database_db,$db)   or die('Erreur de selection '.mysqli_error($db));
$idpla=$_POST['choixplateforme'];
//echo $idpla;
$choix_probleme=$_POST['choix_probleme'.$idpla];
//echo $choix_probleme;
//echo 'ec:'.$_POST['ec'];


$choix_utilisateur=$_POST['choix_utilisateur'];
//echo $choix_utilisateur;
if ($choix_probleme == "none"||$choix_probleme=="")
{
		$sql="INSERT into $tableincidents VALUES ('', ".$idpla.", '".addslashes($_POST['probleme_autre'])."', 0)";
		mysqli_query($db,$sql) or die('Erreur SQL 2 !');
		$sql = "SELECT id FROM $tableincidents ORDER BY id DESC";
		//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
		mysqli_query($db,$sql) or die('Erreur SQL 3 !');
		$req = mysqli_query($db,$sql);
		$donnees = mysqli_fetch_array($req);
		$id_incidents = $donnees[0];
		$sql="INSERT INTO $tableincidusers VALUES ('', ".$id_incidents.", '".$choix_utilisateur."', 1, '".$_POST['date']."', '".addslashes($_POST['commentaire'])."', 1,NULL,'".$tech."','".$_POST['statut_session']."')";
		//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
		mysqli_query($db,$sql) or die('Erreur SQL 4 !');
		$sql="SELECT id FROM $tableincidusers ORDER BY id DESC";
		//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
		mysqli_query($db,$sql) or die('Erreur SQL 5!');
		$req=mysqli_query($db,$sql);
		$donnees=mysqli_fetch_array($req);
		$id=$donnees['id'];
		?>
		<script>
			alert('Le problème a bien été ajouté à la base de données.');
			mapopup('Depannage','admin_newdepannage.php?id=<?php echo $id; ?>');
                        //window.close();
			//window.location ="admin.php";
			window.location="<?php echo $_SESSION['racine']?>incidents/nouvel_incident_utilisateur";
		</script>
		<?php
		
}
else
{
	$sql="INSERT INTO $tableincidusers values ('', ".$choix_probleme.", '".$choix_utilisateur."', '".$_POST['etat']."', '".$_POST['date']."', '".addslashes($_POST['commentaire'])."', 1,NULL,'".$tech."','".$_POST['statut_session']."')";
	//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
	//echo $sql;
	mysqli_query($db,$sql) or die('Erreur SQL 6!'.mysqli_error($db));
        $idincid=mysqli_insert_id($db);
	$sql="SELECT id FROM $tableincidusers ORDER BY id DESC";
	//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
	mysqli_query($db,$sql) or die('Erreur SQL 7!');
	$req=mysqli_query($db,$sql);
	$donnees=mysqli_fetch_array($req);
	$id=$donnees['id'];
	?>
	<script>
		alert('Le problème a bien été ajouté à la base de données.');
		mapopup('Depannage','admin_newdepannage.php?id=<?php echo $id; ?>');
                mapopup('Solution','solution.php?id=<?php echo $idincid;?>');
		//window.close();
                //window.location ="admin.php";
                window.location="<?php echo $_SESSION['racine']?>incidents/nouvel_incident_utilisateur";
	</script>
	<?php
}
?>
        </body>
</html>
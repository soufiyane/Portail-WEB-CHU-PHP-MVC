<?php
require_once('includes/connexion.php');
require_once('includes/verification.php');
require_once('includes/alias_tables.php');
?>
<!DOCTYPE html>
<html>
	<head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title> Ajouter une solution </title>
		<script language=javascript>
			function redirige(adresse)
			{
				location.href = adresse;
			}
		</script>
	</head>
	<body>
		<?php
		//mysql_select_db($database_db,$db)   or die('Erreur de selection '.mysqli_error($db));

                $id_pb=securite_bdd($_POST['id_pb']);
		$sql="SELECT num_solu FROM $tablesoltoincid WHERE id_incid = ".$id_pb." ORDER BY num_solu DESC";
		//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
		mysqli_query($db,$sql) or die('Erreur SQL0 !');
		$req=mysqli_query($db,$sql);
		$donnees=mysqli_fetch_array($req);
		$num_solution = $donnees[0];
		if ($num_solution == '')
		{
			$num_solution = 1;
		}
		else
		{
			$num_solution = $num_solution + 1;
		}
		        if(isset($_POST['solution_txt']))
		        {
                $solu=securite_bdd($_POST['solution_txt']);
               // echo $solu;
                }
                if(isset($_POST['listesolu'])){
                $choixliste=securite_bdd($_POST['listesolu']);
                $sql="INSERT INTO $tablesoltoincid VALUES ('','".$id_pb."', '".$choixliste."','".$num_solution."')"; 
                //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
		mysqli_query($db,$sql) or die('Erreur SQL1 !');
                }else{
		$sql="INSERT INTO $tablesolu VALUES ('','', '".$solu."', '')";
                //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
		mysqli_query($db,$sql) or die('Erreur SQL2 !'.mysqli_error($db));
                $dernierid=mysqli_insert_id($db);
                $sql="INSERT INTO $tablesoltoincid VALUES ('','".$id_pb."', '".$dernierid."','".$num_solution."')"; 
                //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
		mysqli_query($db,$sql) or die('Erreur SQL3 !');
                }
		if (isset($_POST['rec']))
		{
		if ($_POST['rec'] == 'oui')
		{
			?>
			<script>
				alert('Solution ajoutée.');
				redirige('<?php echo $_SESSION['racine'] ?>incidents/gestion_incidents_recurrents');
			</script>
			<?php
		}
		else
		{
			?>
			<script>
				alert('Solution ajoutée.');
				redirige('<?php echo $_SESSION['racine'] ?>incidents/gestion_incidents_non_recurrents');
			</script>
			<?php
		}
	    }else{
	    ?>
			<script>
				alert('Solution ajoutée.');
				redirige('<?php echo $_SESSION['racine'] ?>incidents/gestion_incidents_non_recurrents.');
			</script>
			<?php	
	    }
		?>
	</body>
</html>
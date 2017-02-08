<?php
// On active les sessions :
require_once('includes/verification.php'); 
require_once('includes/connexion.php');
require_once('includes/alias_tables.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Update edition incident </title>
		<script src="html5shiv/dist/html5shiv.js">
		</script>
	</head>
	<body>
		<?php
		//mysql_select_db($database_db,$db)   or die('Erreur de selection '.mysqli_error($db)); 
		$sql="UPDATE $tableincidents SET probleme = '".addslashes($_POST['probleme'])."' WHERE id = '".$_POST['id']."'";
		mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
		$i = 1;
		while ($i <= $_POST['maxsolut'])
		{
			//echo $i;
			//$sql="UPDATE $tablesolu SET lib = '".$_POST[$i]."' WHERE id_incidents = ".$_POST['id']." AND num_solution = ".$i."";
                        $sql="UPDATE $tablesolu SET lib = '".addslashes($_POST[$i])."' WHERE id = '".$_POST['sol'.$i]."'";
                        //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sql) or die('Erreur SQL !'.mysqli_error($db));
                        $sql="UPDATE $tablesoltoincid SET num_solu = '".$i."' WHERE id_solu = '".$_POST['numsol'.$i]."'";
                        //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
			mysqli_query($db,$sql) or die('Erreur SQL !'.mysqli_error($db));
			$i++;			
		}
		?>
		<script>
			alert('Le problème a été mis à jour.');
			window.parent.opener.location.reload();
			self.close();
			
		</script>
	</body>
</html>

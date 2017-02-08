<?php	
	require_once('includes/connexion.php');
	require_once('includes/alias_tables.php');
	
        mysqli_query($db,"SET NAMES UTF8");
	
		//si queryString existe
		if(isset($_POST['queryString']))
		{
			$queryString=$_POST['queryString'];
			// si la longueur du contenu de la variable est supérieur à 0
			if(strlen($queryString) >0)
			{
				$result = mysqli_query($db,"SELECT distinct id_casq, id_user, type FROM $tablecasq, $tableagent WHERE  id_user LIKE '$queryString%' AND matricule NOT LIKE id_user ORDER BY id_user ASC");
				if($result)
				{
					// on parcourt les résultats
					while ($data = mysqli_fetch_assoc($result))
					{
						$type=$data['type'];
                                         $casque = ($type != '')? "&nbsp|&nbsp <font color=red> $type </font>" : "";
	                                 // on affiche les résultats dans un élément de liste en ajoutant la fonction fill sur l'événenement onClick
		          		echo '<li onClick="fill_pool(\''.$data['id_user'].' | '.$data['id_casq'].'\');">'.$data['id_user'].' | '.$data['id_casq'].'</li>';
                                }


                               
				}
				else
				{
					echo 'Il y a un problème avec la requête sql.';
				}
			}
			else
			{
	
			}
		}
		else
		{
			echo 'Erreur.';
		}
?>

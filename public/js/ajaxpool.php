<?php	
	require_once('includes/connexion.php');
	require_once('includes/alias_tables.php');
	
        mysqli_query($db,"SET NAMES UTF8");
	
		//si queryString existe
		if(isset($_POST['queryString']))
		{
			$queryString=$_POST['queryString'];
			// si la longueur du contenu de la variable est sup�rieur � 0
			if(strlen($queryString) >0)
			{
				$result = mysqli_query($db,"SELECT distinct id_casq, id_user, type FROM $tablecasq, $tableagent WHERE  id_user LIKE '$queryString%' AND matricule NOT LIKE id_user ORDER BY id_user ASC");
				if($result)
				{
					// on parcourt les r�sultats
					while ($data = mysqli_fetch_assoc($result))
					{
						$type=$data['type'];
                                         $casque = ($type != '')? "&nbsp|&nbsp <font color=red> $type </font>" : "";
	                                 // on affiche les r�sultats dans un �l�ment de liste en ajoutant la fonction fill sur l'�v�nenement onClick
		          		echo '<li onClick="fill_pool(\''.$data['id_user'].' | '.$data['id_casq'].'\');">'.$data['id_user'].' | '.$data['id_casq'].'</li>';
                                }


                               
				}
				else
				{
					echo 'Il y a un probl�me avec la requ�te sql.';
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

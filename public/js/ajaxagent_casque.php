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
				$result = mysqli_query($db,"SELECT nom, prenom, matricule, type_casq FROM $tableagent WHERE nom LIKE '$queryString%' OR prenom LIKE '$queryString%' OR matricule LIKE '$queryString%' ORDER BY nom ASC");
				if($result)
				{
					// on parcourt les r�sultats
					while ($data = mysqli_fetch_object($result))
					{
                                        $id=$data->matricule;
                                        $identi=$data->matricule;
                                        $nom=$data->nom;
                                        $prenom=$data->prenom;
                                        $identi1=preg_replace ( '`('.$queryString.')`i' , "<span style = background:#FFFA00>$1</span>" , $identi);
                                        $nom1=preg_replace ( '`('.$queryString.')`i' , "<span style = background:#FFFA00>$1</span>" , $nom);
                                        $prenom1=preg_replace ( '`('.$queryString.')`i' , "<span style = background:#FFFA00>$1</span>" , $prenom);
                                        $casque = ($data->type_casq != '' && isset($_POST['casq']))? "&nbsp|&nbsp<font color=red>$data->type_casq</font>" : "";
					
                                        // on affiche les r�sultats dans un �l�ment de liste en ajoutant la fonction fill sur l'�v�nenement onClick
		         		echo '<li onClick="fill_ag(\''.$id.' | '.$identi.' | '.$nom.' '.$prenom.'\');">'.$identi1.'&nbsp|&nbsp'.$nom1.'&nbsp'.$prenom1.$casque.'</li>';
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

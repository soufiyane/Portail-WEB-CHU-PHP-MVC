<?php	
	require_once('includes/connexion.php');
	require_once('includes/alias_tables.php');
	mysqli_query($db,"SET NAMES UTF8");
     
	
		//si queryString existe
		if(isset($_POST['queryString']))
		{
			$queryString=$_POST['queryString'];
                      //  $choixecole=$_POST['ecole'];
			// si la longueur du contenu de la variable est supérieur à 0
			if(strlen($queryString) >0)
			{
				$result = mysqli_query($db,"SELECT  nom, prenom, matricule, type_casq FROM $tableetud WHERE  nom LIKE '%$queryString%' OR prenom LIKE '%$queryString%' OR matricule LIKE '%$queryString%' ORDER BY nom ASC");
				if($result)
				{
					// on parcourt les résultats
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
						// on affiche les résultats dans un élément de liste en ajoutant la fonction fill sur l'événenement onClick
		         		echo '<li onClick="fill_ca(\''.$id.' | '.$identi.' | '.$nom.' '.$prenom.'\');">'.$identi1.'&nbsp|&nbsp'.$nom1.'&nbsp'.$prenom1.$casque.'</li>';
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
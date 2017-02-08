<?php	
    error_reporting(0);
    $database_db = "cfmhoptlsedb"; // nom de base de donn?es
    $hostname_db = "svm-prefms.chu-toulouse.fr"; // nom ou ip de serveur
    $username_db = "support"; // nom d'utilisateur 
    $password_db = "!su4RA15"; // mot de passe 
    $db = mysqli_connect($hostname_db, $username_db, $password_db,$database_db) or die('Erreur de selection '.mysqli_error($db));
    $enco=mysqli_query($db,"SET NAMES UTF8");
        mysqli_query($db,"SET NAMES UTF8");
	
		//si queryString existe
		if(isset($_POST['queryString']))
		{
			$queryString=$_POST['queryString'];
			// si la longueur du contenu de la variable est supérieur à 0
			if(strlen($queryString) >0)
			{
				$result1 = mysqli_query($db,"SELECT matricule,nom, prenom, matricule as identifiant FROM agents
 WHERE nom LIKE '%$queryString%' OR prenom LIKE '%$queryString%' OR matricule LIKE '%$queryString%' ORDER BY nom ASC");

				$result2 = mysqli_query($db,"SELECT matricule,nom, prenom, matricule as identifiant FROM etudiants
 WHERE nom LIKE '%$queryString%' OR prenom LIKE '%$queryString%' OR matricule LIKE '%$queryString%' ORDER BY nom ASC");
				if($result1||$result2)
				{
					// on parcourt les résultats
					while ($data = mysqli_fetch_object($result1))
					{
                                        $id=$data->matricule;
                                        $identi=$data->identifiant;
                                        $nom=$data->nom;
                                        $prenom=$data->prenom;
                                        $identi1=preg_replace ( '`('.$queryString.')`i' , "<span style = background:#FFFA00>$1</span>" , $identi);
                                        $nom1=preg_replace ( '`('.$queryString.')`i' , "<span style = background:#FFFA00>$1</span>" , $nom);
                                        $prenom1=preg_replace ( '`('.$queryString.')`i' , "<span style = background:#FFFA00>$1</span>" , $prenom);
                                       // $casque = ($data->type_casq != '' && isset($_POST['casq']))? "&nbsp|&nbsp<font color=red>$data->type_casq</font>" : "";
					
                                        // on affiche les résultats dans un élément de liste en ajoutant la fonction fill sur l'événenement onClick

                      
		         		echo '<li href="../public/js/historique_cfps.php?id='.$id.'"  target="popupModal2" title="This is title"
		         		onClick="fill(this,\''.$id.' | '.$identi.' | '.$nom.' '.$prenom.'\');">'.$identi1.'&nbsp|&nbsp'.$nom1.'&nbsp'.$prenom1.'</li>';
		         	
		         	
		         	

		         		//remplir la div suggestion
		         		//avec .$identi1.'&nbsp|&nbsp'.$nom1.'&nbsp'.$prenom1 deja colorisé et associer a l'even click la fonction fill  
	         		}
	         		while ($data = mysqli_fetch_object($result2))
					{
                                        $id=$data->matricule;
                                        $identi=$data->identifiant;
                                        $nom=$data->nom;
                                        $prenom=$data->prenom;
                                        $identi1=preg_replace ( '`('.$queryString.')`i' , "<span style = background:#FFFA00>$1</span>" , $identi);
                                        $nom1=preg_replace ( '`('.$queryString.')`i' , "<span style = background:#FFFA00>$1</span>" , $nom);
                                        $prenom1=preg_replace ( '`('.$queryString.')`i' , "<span style = background:#FFFA00>$1</span>" , $prenom);
                                       // $casque = ($data->type_casq != '' && isset($_POST['casq']))? "&nbsp|&nbsp<font color=red>$data->type_casq</font>" : "";
					
                                        // on affiche les résultats dans un élément de liste en ajoutant la fonction fill sur l'événenement onClick

                      
		         		echo '<li href="../public/js/historique_et.php?id='.$id.'"  target="popupModal2" title="This is title"
		         		onClick="fill(this,\''.$id.' | '.$identi.' | '.$nom.' '.$prenom.'\');">'.$identi1.'&nbsp|&nbsp'.$nom1.'&nbsp'.$prenom1.'</li>';
		         	

		         		//remplir la div suggestion
		         		//avec .$identi1.'&nbsp|&nbsp'.$nom1.'&nbsp'.$prenom1 deja colorisé et associer a l'even click la fonction fill  
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

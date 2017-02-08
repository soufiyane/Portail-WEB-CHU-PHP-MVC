<?php	
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
			//$rest = substr("abcdef", 2, -1);  // retourne "cde"
            //$rest = substr("abcdef", 4, -4);
			$pos = strpos($queryString, '0');
			$queryString1=substr($queryString, 0, $pos-1);
			$i=substr($queryString,$pos+1,strlen($queryString));
			echo '<script type="text/javascript">alert(" '.$queryString1.'"); </script>';

			echo '<script type="text/javascript">alert("' . $i . '"); </script>';
			if(strlen($queryString1) >0)
			{
				$result = mysqli_query($db,"SELECT id,lib FROM solutions WHERE lib LIKE '%$queryString1%'");
				if($result)
				{
					// on parcourt les résultats
					//$msg='qsdfqsdfqsfqfqf';
					//echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
					while ($data = mysqli_fetch_object($result))
					{
                                        $id=$data->id;
                                        $lib=$data->lib;
                                       // $id1=preg_replace ( '`('.$queryString.')`i' , "<span style = background:#FFFA00>$1</span>" , $id);
                                        //$lib1=preg_replace ( '`('.$queryString.')`i' , "<span style = background:#FFFA00>$1</span>" , $lib);
                                       // $casque = ($data->type_casq != '' && isset($_POST['casq']))? "&nbsp|&nbsp<font color=red>$data->type_casq</font>" : "";
					
                                        // on affiche les résultats dans un élément de liste en ajoutant la fonction fill sur l'événenement onClick

                        $max= "30"; // on d�termine combien de caract�res maxi doit avoir le texte.
						if (strlen($lib)>$max) // la longueur du texte est-elle sup�rieure � limite $max ?
						{
						$lib=strip_tags($lib);
						$lib = substr($lib, 0, $max); // on tronque le texte avec comme limite le maximum de caract�res autoris�s.
						$espace = strrpos($lib, " " ); // R�cup�ration du dernier espace pour ne pas couper un mot.
						$lib = substr($lib, 0, $espace); // la phrase est reformat�e pour s'arr�ter � l'�space .
						$lib = $lib."..."; // on ajoute des points de suspension
						}

                        $lib1=preg_replace ( '`('.$queryString1.')`i' , "<span style = background:#FFFA00>$1</span>" , $lib);
                        //echo '<li onClick="fill(\''.$lib.'\');">'.$lib1.'</li>';
		         		

                           


                        echo '<li onClick="fill(\''.$lib.'\',\''.$i.'\');"  id="'.$id.'" onMouseOver="voirdiv1(this)" onMouseOut="cacherdiv()">'.$lib1.  '</li>';

		         	
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

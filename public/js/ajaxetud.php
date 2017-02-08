<?php	
        // On active les sessions :
        session_start();
        error_reporting(0);
	require_once('includes/connexion.php');
	require_once('includes/alias_tables.php');
	mysqli_query($db,"SET NAMES UTF8");
        
	
		//si queryString existe
		if(isset($_POST['queryString']))
		{
			$queryString=$_POST['queryString'];
                        if(isset($_POST['ecole'])) $choixecole=$_POST['ecole'];
                        if($_SESSION['id_ecole']!=0){
                            $cond=" AND id_ecole=".$_SESSION['id_ecole']."";
                        }else{
                            $cond="";
                        }
			// si la longueur du contenu de la variable est sup�rieur � 0
			if(strlen($queryString) >0)
			{
				$result = mysqli_query($db,"SELECT et.matricule, et.nom, et.prenom, et.type_casq,et.carte FROM $tableetud et WHERE classe LIKE '%$choixecole' AND (nom LIKE '%$queryString%' OR prenom LIKE '%$queryString%' OR et.matricule LIKE '%$queryString%') ".$cond." ORDER BY nom ASC");
                                if($result)
				{
					if(mysqli_num_rows($result)==0){
						$result = mysqli_query($db,"SELECT et.matricule, et.nom, et.prenom, et.type_casq,et.carte FROM $tablearchives et WHERE et.carte!='' AND classe LIKE '%$choixecole' AND (nom LIKE '%$queryString%' OR prenom LIKE '%$queryString%' OR et.matricule LIKE '%$queryString%') ".$cond." ORDER BY nom ASC");
					}
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
											$carteat= $data->carte;
											if($carteat=="PRO"){
												$carte="<font color=red>Carte professionnelle attribuée</font>";
											}else if($carteat=="DEF"){
												$carte="<font color=red>Carte définitive attribuée</font>";
											}else{
                                            $resultcar = mysqli_query($db,"SELECT num_carte_gestion FROM $tablecartes WHERE identifiant = '$identi'");
                                            $carte="";
                                            if($resultcar)
                                            {
                                                    // on parcourt les r�sultats
                                                    while ($datacar = mysqli_fetch_object($resultcar))
                                                    {
													$num=$datacar->num_carte_gestion;
                                                    $carte = ($num != '' && isset($_POST['cart']))? "&nbsp|&nbsp<font color=red>Carte attribuée (".$num.")</font>" : "";
                                                    }
                                            }
											}
                                                    // on affiche les r�sultats dans un �l�ment de liste en ajoutant la fonction fill sur l'�v�nenement onClick
		         		echo '<li onClick="fill_et(\''.$id.' | '.$identi.' | '.$nom.' '.$prenom.'\');">'.$identi1.'&nbsp|&nbsp'.$nom1.'&nbsp'.$prenom1.$casque.$carte.'</li>';
	         		}
					}else{
					echo 'Il y a un problème avec la requête sql.'.mysqli_error($db);	
					}
				}
				else
				{
					echo 'Il y a un problème avec la requête sql.'.mysqli_error($db);
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
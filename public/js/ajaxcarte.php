<?php	
	require_once('includes/connexion.php');
	require_once('includes/alias_tables.php');
	mysqli_query($db,"SET NAMES UTF8");
error_reporting(0);
	
		//si queryString existe
		if(isset($_POST['queryString']))
		{
			$queryString=$_POST['queryString'];

            $hexdec = hexdec ($queryString);
			// si la longueur du contenu de la variable est sup�rieur � 0
			if(strlen($queryString) >0)
			{
				if(substr($queryString,0,1)=="X"){
				$queryString=substr($queryString,1);
				$queryString = str_pad(hexdec($queryString), 10, "0", STR_PAD_LEFT);
				$req ="SELECT * FROM $tablecartes WHERE num_puce = '$queryString'";
				}else{
				$req ="SELECT * FROM $tablecartes WHERE num_carte_gestion = '$queryString'";	
				}
				$result = mysqli_query($db,$req);
				if(mysqli_num_rows($result)>0)
				{
					// on parcourt les r�sultats
					while ($data = mysqli_fetch_object($result))
					{
                                            $identi=$data->identifiant;
                                            $def=$data->defaillant;
											$num=$data->num_carte;
											$puce=$data->num_puce;
											$concat=$num.'-'.$puce;
                                            if($identi=='')
                                            {
                                                if($def==1){
                                                echo "<img src='../img/images/nnok.png' id='imgval'/><span id='nnok'><font color=red> <b>Carte identifiée défaillante ($concat)</b></font>"; 
                                                }else if($def==2){
                                                echo "<img src='../img/images/nnok.png' id='imgval'/><span id='nnok'><font color=red> <b>Carte identifiée perdue ($concat)</b></font>";   
                                                }else{
                                                echo "<img src='../img/images/ok.png' id='imgval'/><span id='nnok'><font color=green> <b>Carte disponnible ($concat)</b></font>";      
                                                }
                                                //echo 'OK';
                                            }else{
												$reqdet ="SELECT nom,prenom,annee,libelle FROM $tableetud et,$tableecoles ec WHERE matricule='$identi' AND et.id_ecole=ec.id";	
												$resultdet = mysqli_query($db,$reqdet);
												while ($data2 = mysqli_fetch_object($resultdet))
												{
													$nom=$data2->nom;
													$prenom=$data2->prenom;
													$annee=$data2->annee;
													$ec=$data2->libelle;
												}
                                                //echo 'NNOK';
                                                echo "<img src='../img/images/nnok.png' id='imgval'/><span id='nnok'><font color=red> <b>Carte déjà attribuée à l'étudiant $prenom $nom ($identi) - $ec $annee</b><br />$concat</font>";
                                            }
                                    }
				}
				else
				{
					echo "<img src='../img/images/nnok.png' id='imgval'/><span id='nnok'><font color=red> <b>Cette carte n'existe pas.</font>";
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
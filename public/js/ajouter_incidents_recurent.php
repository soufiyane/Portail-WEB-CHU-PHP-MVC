<?php
// On active les sessions :
//session_start();
error_reporting(0);
// On inclus les donn�es de connexion :
require_once('includes/connexion.php');
require_once('includes/verification.php');
require_once('includes/alias_tables.php');
	
switch($_SESSION['statut']){ 
		//case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		//case 1: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 2: break;
                default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
	}
?>
<!DOCTYPE html>
<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title> Nouveau probl�me </title>
		<script src="html5shiv/dist/html5shiv.js">
		</script>
		<link rel="stylesheet" type="text/css" href="css/monCss.css" /> 
   <link rel="stylesheet" type="text/css" href="../css/bootstrap/dist/css/bootstrap.min.css">
	</head>
		<script>
		function closs()
			{
				parent.$("#popupModal").hide();
				//alert(window.top.location.href);
			}
			function visibilite(thingId)
			{
				var targetElement;
				targetElement = document.getElementById(thingId) ;
				if (targetElement.style.display == "none")
				{
					targetElement.style.display = "" ;
				}
				else
				{
					targetElement.style.display = "none" ;
				}
			}
		</script>
			<script>
			function cacher(thingId)
			{	
				document.getElementById(thingId).style.display = "none";
			}
		</script>
			<script>
			function redirige(adresse)
			{
				location.href = adresse;
			}
		</script>
	<body>
		<section>
	
			<br /><br />
			<div id="liste" align="center">	
				<form method="post" action="admin_newincident_insert.php">
					<table align="center" width="50%">
						<tr>
							<td colspan="2" align="center">
								<?php                           if(isset($_GET['id_autre'])){//***** A voir apres ****************
                                                                if($_GET['id_autre']!=""){

                                                                $id_pb=$_GET['id_autre'];
                                                              //  echo  $id_pb;echo  $id_pb;echo  $id_pb;echo  $id_pb;echo  $id_pb;
                                                                $sql="SELECT * FROM $tableincidents WHERE id='$id_pb'";
                                                                mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                                                                $req=mysqli_query($db,$sql);
                                                                while ($donnees=mysqli_fetch_array($req))
                                                                {
                                                                    $idpla=$donnees['id_plateforme'];
                                                                    $pb=$donnees['probleme'];
                                                                    $sql2="SELECT libelle FROM $tablepla WHERE id='$idpla'";
                                                                    mysqli_query($db,$sql) or die('Erreur SQL !'.$sql2.'<br />'.mysqli_error($db));
                                                                    $req2=mysqli_query($db,$sql2);
                                                                    while ($donnees2=mysqli_fetch_array($req2))
                                                                    {
                                                                        $libellepla=$donnees2['libelle'];
                                                                    }
                                                                }
								echo "<h1>".$libellepla."</h1>";
                                                                echo '<input type="hidden" name="plateforme" value="'.$idpla.'" />';
								echo '<input type="hidden" name="autre_to_rec" value="'.$id_pb.'" />';	
							//	echo $id_pb;echo $id_pb;echo $id_pb;echo $id_pb;
								}
							    }
							                                    if(isset($_GET['plateforme'])){
                                                                if($_GET['plateforme']!=""){
                                                                $id_pla=$_GET['plateforme'];
                                                                    $sql="SELECT libelle FROM $tablepla WHERE id='$id_pla'";
                                                                    mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                                                                    $req=mysqli_query($db,$sql);
                                                                    while ($donnees=mysqli_fetch_array($req))
                                                                    {
                                                                        $libellepla=$donnees['libelle'];
                                                                    }                                                               
								echo "<h1>".$libellepla."</h1>";
                                                                echo '<input type="hidden" name="plateforme" value="'.$id_pla.'" />';
								}
						    	}
								?>
							</td>
						</tr>
						<tr>
							<td>
								<h2 class="info">Probl�me:</h2>
							</td>
							<td align="center">
								<textarea class="form-control" rows="9" cols="42" name="probleme" onfocus="if (this.value=='D�crire le probl�me tel qu\'il sera propos� aux �tudiants.') this.value=''"><?php if(isset($_GET['id_autre'])){ if ($_GET['id_autre'] != '') { echo $pb; }} else { ?>D�crire le probl�me tel qu'il sera propos� aux �tudiants.<?php } ?></textarea>
							</td>
						</tr>
						<tr> 
							<td>
								<h2>Solution:</h2>
							</td>
							<td align="center">
								<textarea class="form-control" rows="9" cols="42" name="solution" onfocus="if (this.value=='Ne rien renseigner si pas de solution connue.') this.value=''">Ne rien renseigner si pas de solution connue.</textarea>
								<br />
								<a href="javascript:void(0)" style=text-decoration:none onclick="visibilite('solution2'); this.style.display"> <img src='img/bouton-plus.gif' />Nouvelle solution</a>
							</td>
						</tr>
						<tr id="solution2" style=display:none>
							<td> </td>
							<td align="center">
								<textarea class="form-control" rows="9" cols="42" name="solution2" onfocus="if (this.value=='Deuxi�me solution') this.value=''">Deuxi�me solution</textarea>
								<br />
								<a href="javascript:void(0)" style=text-decoration:none onclick="visibilite('solution3');"> <img src='img/bouton-plus.gif' />Nouvelle solution</a>
							</td>
						</tr>
						<tr id="solution3" style=display:none>
							<td> </td>
							<td align="center">
								<textarea class="form-control" rows="9" cols="42" name="solution3" onfocus="if (this.value=='Troisi�me solution') this.value=''">Troisi�me solution</textarea>								
							</td>
						</tr>
					</table>
					<br /><br />
			
					<input type="button" class="btn btn-default" value="Enregistrer" onClick="this.form.submit();closs();"/>
				</form>					
				<br/><br/>
			</div>				
					
		</section>
	</body>
</html>
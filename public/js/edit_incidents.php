<?php
// On inclus les données de connexion :
require_once('includes/connexion.php');
require_once('includes/verification.php');
require_once('includes/alias_tables.php');
error_reporting(0);
switch($_SESSION['statut']){ 
		case 2: break;
        default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
	}

$mess="";
if($_GET['id']!=""){
$numincident=securite_bdd($_GET['id']);
}
if(isset($_GET['sol'])){
$numsol=securite_bdd($_GET['sol']);
$sql="DELETE FROM $tablesoltoincid WHERE id_incid='$numincident' AND num_solu='$numsol'";
mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
$sql2="SELECT * 
FROM $tablesoltoincid
WHERE $tablesoltoincid.id_incid=".$numincident."";
$req2=mysqli_query($db,$sql2);
$maxsolut=mysqli_num_rows($req2);
for ($i=$numsol;$i<=$maxsolut;$i++){
    $numsup=$i+1;
    $sql="UPDATE $tablesoltoincid SET num_solu = '$i' WHERE id_incid = '$numincident' AND num_solu='$numsup'";
}
$req=mysqli_query($db,$sql);
if($req){
    $mess="<font color='green'><b>Solution supprimée avec succès.</b></font><br /><br />";
}
}
if(isset($_GET['idsol'])){
$numincident=securite_bdd($_GET['idsol']);
$numsol=securite_bdd($_GET['idsol']);
$sql0="SELECT document FROM $tablesolu WHERE id = '".$numsol."'";
mysqli_query($db,$sql0) or die('Erreur SQL !');
$req0=mysqli_query($db,$sql0);
while ($donnees0=mysqli_fetch_array($req0))
{
$nmfichier=$donnees0['document'];
}
$sql="UPDATE $tablesolu SET document = '' WHERE id = '".$numsol."'";
//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
mysqli_query($db,$sql) or die('Erreur SQL !');
$req=mysqli_query($db,$sql);
if (file_exists('Fichiers/'.$nmfichier.'.pdf')) {
unlink('Fichiers/'.$nmfichier.'.pdf');
}
if($req){
    $mess="<font color='green'><b>Document supprimé avec succès.</b></font><br /><br />";
}
}
$sql2="SELECT $tablesolu.*,num_solu 
FROM $tablesolu,$tablesoltoincid,$tableincidents
WHERE $tablesolu.id=$tablesoltoincid.id_solu
AND $tablesoltoincid.id_incid=$tableincidents.id
AND $tableincidents.id = ".$numincident."
ORDER BY num_solu ASC";
//echo $sql3;
mysqli_query($db,$sql2) or die('Erreur SQL !'.$sql3.'<br />'.mysqli_error($db));
mysqli_query($db,$sql2) or die('Erreur SQL !');
$req2=mysqli_query($db,$sql2);
$maxsolut=mysqli_num_rows($req2);
?>
<!DOCTYPE html>
<html>
	<head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title> Editer un incident </title>
		<script src="html5shiv/dist/html5shiv.js">
		</script>
		<link rel="stylesheet" type="text/css" href="css/monCss.css" /> 
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">
		<script>
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
		<script>
			function mapopup(page)
			{
				window.open(page,'mapopup','height=450,width=1000,top=50,left=50,resizable=no, scrollbars=yes');
			}
		</script>
		<script type="text/javascript">
			function mouseOver(thingId)
			{
				document.getElementById(thingId).style.backgroundImage = "url()";
			}
			function mouseOut(thingId)
			{
				document.getElementById(thingId).style.background = "url(img/fleche05.png)";
				document.getElementById(thingId).style.backgroundRepeat="no-repeat";
				document.getElementById(thingId).style.backgroundPosition="left center";
			}
                        function suppsolu(num1,num2){
                           window.location="edit_incidents.php?id="+num1+"&sol="+num2;
                        }
                        function supdoc(num){
                           window.location="edit_incidents.php?idsol="+num;
                        }
		</script>
                <script type="text/javascript" src="fckeditor/fckeditor.js"></script>
                <script type="text/javascript">
                    window.onload = function()
                    {
                        var oFCKeditor1 = new FCKeditor( 'probleme' ) ;
                        oFCKeditor1.ToolbarSet = 'Default' ;
                        oFCKeditor1.BasePath = "fckeditor/" ;
                        oFCKeditor1.ReplaceTextarea() ;
                        <?php
                        for ($i=1;$i<=$maxsolut;$i++){
                        echo "var oFCKeditor1 = new FCKeditor( '".$i."' ) ;";
                        echo "oFCKeditor1.ToolbarSet = 'Default' ;";
                        echo "oFCKeditor1.BasePath = 'fckeditor/' ;";
                        echo "oFCKeditor1.ReplaceTextarea() ;";
                        }
                        ?>
                    } 
                </script>
                <script type="text/javascript" language="javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.custom.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.datatables.min.js"></script>
	<script type="text/javascript" language="javascript">
	$(document).ready(function() {	
		
		var startPosition;
		var endPosition;
		$("#datatable-wrapper #example tbody").sortable({
    	cursor: "move",
	    start:function(event, ui){
	      startPosition = ui.item.prevAll().length + 1;
	    },
	    update: function(event, ui) {
	      endPosition = ui.item.prevAll().length + 1;
              var compteur = 1;
              $('#datatable-wrapper').find('.numsol').each(function(){
                                $(this).attr('name','numsol'+compteur+'');
                                compteur++;
			});
		});
	});
	</script>
	</head>
	<body>
		<section>


			<?php
	
            $sql="SELECT * FROM $tableincidents WHERE id = '".$numincident."'";
			mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
			$req=mysqli_query($db,$sql);
			$donnees=mysqli_fetch_array($req);
			?>
			<table align="center" width="80%" border="0">
				<tr>
					<td width ="100%">
						<form action="edit_incidents_update.php" method="post" target="_blank">
							<table align="center" border="0">
								<tr>
									<td  align="center" colspan="2">
										<input type="hidden" name="id" value="<?php echo $numincident; ?>" />
										<h1>Edition du problème n° <?php echo $numincident; ?></h1>
										<br /><br />
									</td>
								</tr>
								<tr>
									<td align="center" width ="150px">
										<h2>Problème:</h2>
									</td>
									<td align="center"  width ="400px">
										<textarea class="form-control" rows="9" cols="42" name="probleme"><?php echo $donnees['probleme']; ?> </textarea>
										<br />
									</td>								
								</tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                <div id="datatable-wrapper">
                                                                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
								<?php

                                                                $sql2="SELECT $tablesolu.*,num_solu 
                                                                FROM $tablesolu,$tablesoltoincid,$tableincidents
                                                                WHERE $tablesolu.id=$tablesoltoincid.id_solu
                                                                AND $tablesoltoincid.id_incid=$tableincidents.id
                                                                AND $tableincidents.id = ".$numincident."
                                                                ORDER BY num_solu ASC";
                                                                //echo $sql3;
                                                                mysqli_query($db,$sql2) or die('Erreur SQL !'.$sql3.'<br />'.mysqli_error($db));
                                                                mysqli_query($db,$sql2) or die('Erreur SQL !');
                                                                $req2=mysqli_query($db,$sql2);
                                                                $maxsolut=mysqli_num_rows($req2);
                                                                if($maxsolut=="0"){
                                                                echo "Il n'y a pas encore de solution pour ce problème. Vous serez informés lorsque ce sera le cas.";
                                                                }else{
								?>
								<input type="hidden" name="maxsolut" value="<?php echo $maxsolut; ?>" />
								<?php
								$i = 1;
								while ($donnees2=mysqli_fetch_array($req2))
									{
									?>
									<tr class='item'>
										<td align="center" width="20%">
											<h2>Solution <?php echo $i; ?> :</h2>
                                                                                        <input type="hidden" name="sol<?php echo $i; ?>" value="<?php echo $donnees2['id'];?>" />
                                                                                        <br /><img src="../img/images/supprimer.png" height="32px" width="32px" title="Supprimer la solution" onClick="suppsolu(<?php echo $numincident; ?>,<?php echo $donnees2['num_solu']; ?>);" onMouseOver="this.style.cursor='hand'"/>                                                                                        
										</td>
										<td align="center" width="50%">
                                                                                        <input type="hidden" class="numsol" name="numsol<?php echo $donnees2['num_solu'];?>" value="<?php echo $donnees2['id'];?>" />
											<textarea class="form-control" rows="9" cols="42" name="<?php echo $i; ?>"><?php echo $donnees2['lib']; ?></textarea>
										</td>
									</tr>
									<?php
									$donnees=mysqli_fetch_array($req);
									$i ++;
								}
                                                                }
								?>
                                                                </table>
                                                                </div>
                                                                    </td>
                                                                </tr>
								<tr>
									<td align="center" colspan="2">
										<br /><br />
                                                                                <?php echo $mess; ?>
										<input type="submit"  value="Valider"/>
										<br /><br />
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
				<tr>
					<td>
						<table  align="center">
							<tr>
								<?php

								$sql="SELECT $tablesolu.*, $tablesolu.id as num_solu
                                                                FROM $tablesolu,$tablesoltoincid,$tableincidents
                                                                WHERE $tablesolu.id=$tablesoltoincid.id_solu
                                                                AND $tablesoltoincid.id_incid=$tableincidents.id
                                                                AND $tableincidents.id = ".$numincident."
                                                                ORDER BY num_solu ASC";
                                                                mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
								$req=mysqli_query($db,$sql);
                                                                $i=1;
								while ($donnees=mysqli_fetch_array($req))
								{
									?>
									<td align="center"  style="border:1px solid black">
										<?php
										if($donnees['document'] != '')
										{
											?>
											<h3> 
												Document lié à la Solution <?php echo $i; ?>:
												<br />
												<a href="Fichiers/<?php echo $donnees['document'].'.pdf'; ?>" target="_blank">
													<?php
													echo $donnees['document']; ?>.pdf 
												</a>
											</h3>
											<a href="javascript:void(0)"  style=text-decoration:none onclick="visibilite('mod_pdf_<?php echo $donnees['num_solu']; ?>')">
												<h3>Modifier<img src='img/icone_document.png' height='40px'/></h3> 
											</a>
                                                                                        <a href="javascript:void(0)"  style=text-decoration:none onclick="supdoc(<?php echo $donnees['id']; ?>);">
                                                                                                <h3>Supprimer<img src='../img/images/supprimer.png' height='40px'/></h3>
                                                                                        </a>
											<div id="mod_pdf_<?php echo $donnees['num_solu']; ?>" style=display:none>
												<form enctype="multipart/form-data" action="upload_pdf.php" method="post" target="_blank">
													<input type="hidden" name="id_solution" value="<?php echo $numincident; ?>" />
													<input type="hidden" name="num_solution" value="<?php echo $donnees['num_solu']; ?>" />
													Choisir un fichier PDF: <input type="file" name="monfichier" />
													<input class= type="submit" />
												</form>
											</div> 
											<?php
										}
										else
										{
											?>
											<a href="javascript:void(0)"  style=text-decoration:none onclick="visibilite('add_pdf_<?php echo $donnees['num_solu']; ?>')">
												<h3> <img src='img/bouton-plus.gif' />Ajouter un document la Solution<?php echo $i; ?> <img src='img/upload.png' height='40px'/> </h3>
											</a>
											<div id="add_pdf_<?php echo $donnees['num_solu']; ?>" style=display:none>
												<form enctype="multipart/form-data" action="upload_pdf.php" method="post" target="_blank">
													<input type="hidden" name="id_solution" value="<?php echo $numincident; ?>" />
													<input type="hidden" name="num_solution" value="<?php echo $donnees['num_solu']; ?>" />
													Choisir un fichier PDF<input type="file" name="monfichier" />
													<input type="submit" />
												</form>
											</div> 
											<?php 
										}
										?>													
									</td>
									<?php
                                                                 $i++;
								}
								?>
							</tr>
							<tr>							
								<td  align="center" colspan="<?php echo $maxsolut; ?>">
									<input type="submit" data-dismiss="modal" value="Désactiver le problème" onclick="redirige('desactiverpb.php?id=<?php echo $_GET['id']; ?>');"/>
									<br />
									<font color="grey"> <i> ( Le problème reste récurrent mais ne sera plus proposé aux utilisateurs. Il pourra être réactivé par la suite. ) </i> </font>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<footer>
				<h3> 2016 Centre de Formation Multimedia - CHU Purpan - Toulouse </h3>
			</footer>
		</section>
	</body>
</html>
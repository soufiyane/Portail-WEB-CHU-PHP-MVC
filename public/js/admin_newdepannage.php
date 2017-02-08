<?php
// On active les sessions :
//session_start();
// On inclus les donn�es de connexion :
require_once('includes/connexion.php');
require_once('includes/verification.php');
require_once('includes/alias_tables.php');
	
switch($_SESSION['statut']){ 
		case 2: break;
        default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: ../index.php');  exit(); break;
	}
//$id_tech=36;
$id_tech=$_SESSION['id_tech'];
 ?>
<!DOCTYPE html>
<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Nouveau dépannage </title>
		<script src="html5shiv/dist/html5shiv.js">
		</script>
		 
		<link rel="stylesheet" type="text/css" href="../css//bootstrap//dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/monCss.css" />
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

		<link rel="stylesheet" type="text/css" href="../js/redactor/redactor/redactor.css" />
		<script src="../js/redactor/redactor/redactor.js"></script>
		<!--<script type="text/javascript">
        $(function()
		{
	    $('#textmes').redactor();
	    });

		</script>-->
		
		<script type="text/javascript">
    $(document).ready(function() {

      var mes1="Bonjour \n Si la(les) solution(s) proposée(s) ne vous ont pas aidée(s), l'idéal serait de venir nous voir avec votre ordinateur ou de nous appeler au 05.61.32.40.48 du Lundi au Vendredi entre 8h30 et 16h30 en étant devant votre ordinateur. Ceci dans le but que nous puissions prendre la main sur ce dernier. \nCordialement,\n Equipe technique,\nCentre de Formation Multimédia";

      var mes2="Bonjour,\n Afin de pouvoir résoudre votre problème au mieux, l'idéal serait de venir nous voir avec votre ordinateur ou de nous appeler au 05.61.32.40.48 du Lundi au Vendredi entre 8h30 et 16h30 en étant devant votre ordinateur. Ceci dans le but que nous puissions prendre la main sur ce dernier.\n Cordialement,\nEquipe technique,\nCentre de Formation Multimédia ";

      var mes3="Bonjour,\n Afin de résoudre votre problème, vous pouvez essayer de baisser le niveau de sécurité d'Internet Explorer via le menu outils->Options internet ->Onglet sécurité->Zone Internet->Baisser le curseur de niveau de sécurité au minimum et décocher la case \"activer le mode protégé\" si elle est cochée. Faire de même pour la zone sites de confiance. Un message d'avertissement peut apparaitre, il n'est pas à prendre en compte.Si cela ne fonctionne pas, l'idéal serait de nous appeler au 05.61.32.40.48 du Lundi au Vendredi entre 8h30 et 16h30 en étant devant votre ordinateur. Ceci dans le but que nous puissions prendre la main sur ce dernier.\n cordialement,\nEquipe technique,\nCentre de Formation Multimédia ";


         $('#bt1').click( function() {           
         $("#textmes").val(mes1);
         });
         $('#bt2').click( function() {
         $("#textmes").val(mes2);
         });
         $('#bt3').click( function() {
         $("#textmes").val(mes3);
         });

    });
    </script>
<script type="text/javascript">
    function valider_formulaire(){
                        /*var dure = document.getElementById( "mode" );
                        if (yourSelect.options[ yourSelect.selectedIndex ].value=="no"){
                        alert("Veuillez choisir un mode de dépannage.");
                        return false;
                        }*/
                        //alert('khra');
                        
                        if(document.getElementById("duree").selectedIndex==0){
                        alert("Veuillez choisir une durée.");
                        return false;
                        }                     
                        /*if(document.getElementById("detail").value==""){
                        alert("Veuillez renseigner le détail de l'intervention.");
                        return false;
                        }*/

                      /*  if (dure.options[ dure.selectedIndex ].value=="no"){
                        alert("Veuillez renseigner la durée de l'intervention.");
                        return false;
                        }*/
                       /* if(document.getElementById("mode").selectedIndex==3){
                        var oEditor = FCKeditorAPI.GetInstance("message").GetXHTML();
                        //alert(oEditor);
                            if(oEditor==""){
                            alert("Veuillez renseigner le message pour l'étudiant.");
                            return false;
                        }
                        }*/////   /**************************************** if(document.getElementById("mode").selectedIndex==3) a voir apres
                        }
</script>                        
	   <script type="text/javascript">

    function voir(){
        document.getElementById("detail").style.display = "none";
        document.getElementById("duree").style.display = "none";
        document.getElementById("mess").style.display = "none";
        document.getElementById("resolu").style.display = "none";
        document.getElementById("attente").style.display = "none";
        var yourSelect = document.getElementById( "mode" );
      if (yourSelect.options[ yourSelect.selectedIndex ].value!="no"){
        if (yourSelect.options[ yourSelect.selectedIndex ].value=="Par mail"){
        document.getElementById("detail").style.display = "";
        document.getElementById("duree").style.display = "";
        document.getElementById("mess").style.display = "";
        document.getElementById("resolu").style.display = "";
        }else {
            document.getElementById("detail").style.display = "";
            document.getElementById("duree").style.display = "";
            document.getElementById("resolu").style.display = "";
             if (yourSelect.options[ yourSelect.selectedIndex ].value!="En salle"){
            document.getElementById("attente").style.display = "";
            }
        }
    }
    }

                        
    </script>
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
		function redirige(adresse)
			{
				location.href = adresse;
			}
			function quitter()
			{
				var quitter = 'quit';
				return quitter;
			}
		</script>
		<script>
			function cacher(thingId)
			{	
				document.getElementById(thingId).style.display = "none";
			}
		</script>
		
		<!--<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
                <script type="text/javascript">
                    var oFCKeditor1;
                    window.onload = function()
                    {
                        oFCKeditor1 = new FCKeditor( 'message' ) ;
                        oFCKeditor1.ToolbarSet = 'Basic' ;
                        oFCKeditor1.BasePath = "fckeditor/" ;
                       // oFCKeditor1.Width = '350';
                        oFCKeditor1.Height = '150';
                        oFCKeditor1.ReplaceTextarea() ;
                    } 
			

                   
		</script>-->
	</head>
	<body>
		<section>
			<div id="contenu">
				<?php
				$sql="SELECT id, nom, prenom FROM $tabletech";
                mysqli_query($db,$sql) or die('Erreur SQL !');
				$req=mysqli_query($db,$sql);
				?>
				
				<?php 
				$sql="SELECT probleme FROM $tableincidents, $tableincidusers WHERE $tableincidusers.id_incidents = $tableincidents.id AND $tableincidusers.id = ".$_GET['id']."";
                mysqli_query($db,$sql) or die('Erreur SQL !');
				$req=mysqli_query($db,$sql);
				$donnees = mysqli_fetch_array($req);
				?>
			<!--	<h2 align="center">  <?php echo $donnees[0]; ?> </h2>-->


							    

									<form id=" fr" role="form" action="adddepannage.php" method="post" onSubmit="return valider_formulaire(this);">
										<div class="form-group">
										    <input type="hidden" name="id_incidents_to_users" value="<?php echo $_GET['id']; ?>"/>
                                            <input type="hidden" name="technicien" id="technicien" value="<?php echo $id_tech; ?>"/>
											<label for="sel1">Choisir un mode de dépannage:</label>
											<select class="form-control" id="mode" name="mode" onChange="voir()">
												<option value="no">Selectionner un mode</option>
												<option value="Par téléphone">Par téléphone</option>
												<option value="Par mail">Par mail</option>
												<option value="Au CFM">Au CFM</option>
												<option value="En salle">En salle</option>
												<option value="Sur site">Sur site</option>
											</select>
										</div>
										<div class="form-group" id="detail" style="display:none">
											<label name="detaillabel" id="detaillabel"for="sel1">Détail intervention:</label>
											<textarea class = "form-control" rows = "2" name="detail" id="detail" onfocus="if (this.value=='Détail intervention...') { this.value='' };" onKeypress="document.getElementById('bt_enregistrer').disabled=false;"></textarea>
										</div>


										<div class="form-group" id="mess"  style="display:none">										  
                                          
										   <label for="sel1" id="labelmes">Message à l'étudiant:</label>
										   <ul class="list-inline">
										    <li><label for="sel1" id="labelmes">Mail Types: </label></li>
										    <li><a href="javascript:void(0)" id="bt1" data-toggle="tooltip" data-placement="top" title="Demande de recontact direct aprés solution"> 1 </a></li>
										    <li><a href="javascript:void(0)" id="bt2" data-toggle="tooltip" data-placement="top" title="Demande de recontact direct"> 2 </a></li>
										    <li><a href="javascript:void(0)" id="bt3" data-toggle="tooltip" data-placement="top" title="Demande de baisse de niveau de sécurité d'IE"> 3 </a></li>
										   </ul>
											<textarea id="textmes" class = "form-control" rows = "8" name="message" id="message" onKeypress="document.getElementById('bt_enregistrer').disabled=false;"></textarea>
										</div>
										<div class="form-group" id="duree"  style="display:none">
											<label for="sel1">Choisir la durée du dépannage:</label>
											<select name="duree" class="form-control" id="duree">
											    <option value="no">Selectionner une durée</option>
												<option value="0-15 min">0-15 min</option>
												<option value="15-30 min">15-30 min</option>
												<option value="30min - 1h">30min - 1h</option>
												<option value="Plus d'1h">Plus d'1h</option>
											</select>
										</div>
										<!--<td id="attente" style="display:none;" align="center"><input type="checkbox" name="attente" value="attente"><br />En attente de l'étudiant</td><td align="center"><input type="checkbox" name="resolve" value="resolve"><br />Problème résolu</td>-->
										<div class="checkbox">
											<label id="attente"  name="attente" style="display:none">
												<input  type="checkbox" name="attente" value="attente"/> En attente de l'étudiant
											</label>
											<label id="resolu"  name="resolve style="display:none">
												<input type="checkbox" name="resolve" value="resolve"/> Problème résolu
											</label>
										</div>
										<button type="submit" id="bt_enregistrer" class="btn btn-default" disabled="disabled" onclick="valider_formulaire()">Enregistrer</button>
									</form>
								

			</div>
			
		</section>
	</body>
</html>
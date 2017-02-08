<?php
// On active les sessions :
session_start();
// On inclus les donn�es de connexion :
require_once('includes/connexion.php');
require_once('includes/alias_tables.php');
	
switch($_SESSION['statut']){ 
		//case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		//case 1: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 2: break;
                default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: ../index.php');  exit(); break;
	}
		
?>
<!DOCTYPE html>
<html>
	<head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title> Administration - Problèmes résolus </title>
		<script src="html5shiv/dist/html5shiv.js">
		</script>
		<link rel="stylesheet" type="text/css" href="css/monCss.css" /> 
		<script type="text/javascript">
			function mapopup(page)
			{
                                //alert(page);
				window.open(page,'_blank','height=450,width=1000,top=50,left=50,resizable=no,scrollbars=yes');
			}
		</script>
                <link rel="stylesheet" type="text/css" href="css/datatables.css" /> 
                <script type="text/javascript" language="javascript" src="js/jquery-1.4.2.min.js"></script>
                <script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.custom.min.js"></script>
                <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
                <script type="text/javascript" charset="ISO-8859-1">
			$(document).ready(function() {
				var myTable=$('#resolus').dataTable( {
					"bProcessing": true,
                                        "bServerSide": true,
                                        //"bFilter": false,
					"sAjaxSource": "requete_admin_resolus.php",
                                        "fnServerParams": function ( aoData ) {
                                                aoData.push({"name":"critere","value":$("select[name='choix'] option:selected").val()});
                                        },
                                        "sPaginationType": "full_numbers",
                                        "aaSorting": [[ 0, "desc" ]],
                                        "aoColumns": [
                                        null,
                                        null,
                                        null,
                                        null,
                                        {"bSortable": false },
                                        null,
                                        {"bSortable": false }
                                        ],
                                        "fnDrawCallback": function() {
                                                $('#resolus tbody tr td').each(function(){
                                                        $(this).css('border','1px solid black');
                                                        $(this).css('text-align','center');
                                                        }),
                                                $("#resolus tbody tr").hover(
                                                        function () {
                                                                $(this).css("background-color","#F7951E");
                                                                $(this).css('cursor','pointer');
                                                        },
                                                        function () {
                                                                $(this).css("background-color","white");
                                                                $(this).css('cursor','auto');
                                                        }
                                                );
                                                $("#resolus tbody tr").click(function () {
                                                    mapopup("admin_detail.php?id="+$(this).find('td:first').text()+"&solution=1");
                                                } );
                                            },
                                        "fnInitComplete":function() {
                                                $(".dataTables_filter").wrap("<div id='rechercher'></div>");
                                                $('<div style="float:left;padding-top:7px;background-color: #F7951E;"><b>Rechercher dans:</b><select id="choix" name="choix" style="margin-left:10px;margin-right:10px;"><option name="choix" value="id">Num Incident</option><option name="choix" value="date">Date</option><option name="choix" value="nom">Nom - Prénom</option><option name="choix" value="identifiant">Identifiant</option><option name="choix" value="pb">Problème</option></select></div>').insertBefore(".dataTables_filter");
                                                $('<div class="clear"></div>').insertAfter("#rechercher");  
                                                $('<input type="button" class="rech" value="OK" />').insertAfter(".dataTables_filter :text");
                                                $('.rech').click(function(){
                                                myTable.fnFilter($('.dataTables_filter :text').val());    
                                                });
                                                $('.dataTables_filter :text')
                                                    .unbind('keypress keyup')
                                                    .bind('keypress', function(e){
                                                    if (e.keyCode != 13) return;
                                                    myTable.fnFilter($(this).val());
                                                    });
                                                },
                                                "oLanguage": { 
                                                "sProcessing":   "Traitement en cours...",
                                                "sLengthMenu":   "Nombre de lignes par page: _MENU_",
                                                //"sLengthMenu":   "",
                                                "sZeroRecords":  "Aucun élément à afficher",
                                                //"sInfo": "Affichage de l'�lement _START_ � _END_ sur _TOTAL_ �l�ments",
                                                "sInfo": "",
                                                //"sInfo": "",
                                                //"sInfoEmpty": "Affichage de l'�lement 0 � 0 sur 0 �l�ments",
                                                "sInfoEmpty": "",
                                                //"sInfoFiltered": "(filtr� de _MAX_ �l�ments au total)",
                                                "sInfoFiltered": "",
                                                "sInfoPostFix":  "",
                                                "sSearch":       "",
                                                "sUrl":          "",
                                                "oPaginate": {
                                                        "sFirst":    "<<",
                                                        "sPrevious": "< Précédent",
                                                        "sNext":     "Suivant >",
                                                        "sLast":     ">>"
                                                    }
                                                        }
				} );
			} );
		</script>
	</head>
	<body>
		<section>
			<header>
				<img src="img/bandeau - support.jpg" width="100%"/>
			</header>			
			<!-- Menu de Navigation -->
                        <?php include('includes/menunav.php'); ?>
			<!--<nav>
				<ul>
					<li> <a href="admin.php?ordre=$tableincidusers.new&sens=DESC" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');"> Incidents en cours</a> </li>
					<li> <a href="admin_resolus.php?ordre=$tableincidusers.id&sens=DESC&minligne=0&maxligne=14&ligneparpage=15" class = "current" id="current"> Incidents r�solus</a> </li>
					<li> <a href="admin_newincidentstousers.php" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');"> Cr�er un nouvel incident utilisateur</a> </li>
					<li> <a href="gestion_incidents_recurrents.php" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');">Gestion des probl�mes</a></li>
					<li> <a href="statistiques.php?ofc=test.json" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');"> Statistiques</a> </li>	
					<!--<li> <a href="liste_etudiant.php" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');">Liste �tudiants</a> </li>-->
					<!--<li> <a href="deconnexion.php" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');"> Deconnexion</a> </li>
				</ul>
			</nav>-->
			<!-- FIN Menu de Navigation -->
<!--			<div id="recherche">
				<table align="center">
					<form  method="get" action="adminrecherche.php" target="_blank">
						<tr>
							<td>
								<b>Rechercher dans:</b>
								<select name="choix">
									<option name="choix" value="id">Num Incident</option>
									<option name="choix" value="nom">Nom</option>
									<option name="choix" value="prenom">Pr�nom</option>
									<option name="choix" value="mail">Mail</option>
									<option name="choix" value="identifiant">Identifiant</option>					
									<option name="choix" value="v_off">Version office</option>
									<option name="choix" value="$tableincidents.id">Id Description probl�me</option>
								</select>
								<input type="texte" name="texte"/>
								<input type="hidden" name="ordre" value="id" />
								<input type="hidden" name="sens" value="ASC" />
								<input type="hidden" name="clos" value="3" />
								<input type="submit" value="Chercher"/>
							</td>
						</tr>
					</form>
				</table>
			</div>-->				
			<!-- Contenu de la page (milieu)-->
			<article class = "droite">
				<h1> Incidents résolus </h1>
                                <div id="compteur">
				<table align="center" style="border:3px solid black">
					<tr>						
						<?php
						//mysql_select_db($database_db,$db)   or die('Erreur de selection '.mysqli_error($db));  
						$sql="SELECT count(id) FROM $tableincidusers WHERE id_etat = 3";
						mysqli_query($db,$sql) or die ('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
						$req=mysqli_query($db,$sql);
						$donnees=mysqli_fetch_array($req);
						$total=$donnees[0];
						?>
						<td style="border:1px solid black">
							<font face="Arial" color="#000000">Total (<font color="#E22E3A"><b><?php echo $total; ?></b></font>)</font>
						</td>
					</tr>
				</table>
                                </div>
                                <div class="clear"></div>
				<TABLE width="100%" id="resolus">
                                    <thead>
					<TR style="border:1px" bgcolor="#87CEFA" height="30px">
                                                <TH style="border:1px solid black" ><font face="Arial" color="#000000">Num incident</font></TH>
                                                <TH style="border:1px solid black" ><font face="Arial" color="#000000">Date création</font></TH>
                                                <TH style="border:1px solid black" ><font face="Arial" color="#000000">Nom Prénom</font></TH>
                                                <TH style="border:1px solid black" ><font face="Arial" color="#000000">Identifiants</font></TH>
                                                <TH style="border:1px solid black" ><font face="Arial" color="#000000">Télephone</font></TH>
                                                <TH style="border:1px solid black" ><font face="Arial" color="#000000">Description problème</font></TH>
						<TH style="border:1px solid black" ><font face="Arial" color="#000000">Dernier dépannage</font></TH>
					</TR>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                    <td colspan="7" class="dataTables_empty">Chargement des données...</td>
                                            </tr>
                                    </tbody>
				</TABLE>	
			</article>
			<!-- FIN Contenu de la page (milieu) -->				
			<footer>
				<h3> 2015 Centre de Formation Multimedia - CHU Purpan - Toulouse </h3>
			</footer>			
		</section>
	</body>
</html>
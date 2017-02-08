<?php
require_once('includes/verification.php');
	
switch($_SESSION['statut']){ 
		//case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 1: break;
		case 0: break;
                default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: ../index.php');  exit(); break;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Aide en ligne - Contact </title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />		
		<link rel="stylesheet" type="text/css" href="../css/bootstrap/dist/css/bootstrap.min.css">
		</script>
		<script type="text/javascript">
		$(document).ready(function(){
		$('#addincid').submit(function() {
			alert('yes');
   	//window.close();
});
		});
</script>
<script type="text/javascript">	
function closs()
			{
				parent.$("#popupModal").hide();
				//alert(window.top.location.href);
			}
</script>
		
	</head>
	<body>
			<p align ="center">
				<img src="img/warning.jpg" width="25px"/> <b> Avant d'appeler ou d'envoyer un mail, vérifier que la solution à votre problème ne soit pas proposée sur le site. </b>
			</p>
			<br><br><br>
			<h1 align="center">Contact</h1>
			<table border="0" align="center" style="width:770px;">
				<form method="post" action="insertincidentstousers.php">
				<tr>
					<td align="center">
						
							<p class="form">
								Message:
								<span style="font-weight: bolder; color: red;"> * </span>
								<br>
								<textarea style="width:500px" class="form-control" rows="9" cols="42" name="autretexte"></textarea>
								<input type="hidden" name="pla" value="<?php echo $_GET['plateforme']; ?>"/>
							</p>
							<br>
							<font size="1px"> <i> (Ce mail sera transmis au technicien pour qu'il étudie <br> votre problème et vous indique la marche à suivre.) </i> </font>							
						
					</td>
				</tr>
				<tr>
					<td>						
						<center>
							<input style="width:170px" id="addincid" class="formsubmit form-control" type="submit" value="Envoyer le message" onClick="this.form.submit();closs();"/>
								<p class="formklein">
									Tous les champs marqués par
									<span style="font-weight: bolder; color: red;"> * </span>
									sont obligatoires.
								</p>
						</center>						
					</td>
				</tr>
				</form>		
			</table>
                        
	</body>
</html>
<?php

class CasquesController extends Controller {

	function requette() {

$this->Casque->query("INSERT INTO casques (date_entree, type, id_formation, commentaires) VALUES ('2016-08-12', 'Casque simple', '2', 'com')");
	                    }

    function gestion_stock() {

    	  require_once('../public/js/includes/verification.php'); 

	
       switch($_SESSION['statut']){ 
		case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 1: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 3: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		//case 2: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
	}

     
 $this->set('title','Gestion du stock des casques');

$string="";
	
$this->set('reqi',$this->Casque->query("SELECT COUNT(*)NBR FROM casques WHERE date_attribution IS NULL AND date_retour IS NULL AND defaillant='0'"));
$this->set('reqo',$this->Casque->query("SELECT COUNT(*)NBR FROM casques WHERE date_attribution<>'0000-00-00' AND date_retour<>'0000-00-00' AND defaillant='0'"));
$this->set('reqdef',$this->Casque->query("SELECT COUNT(*)NBR FROM casques WHERE defaillant='1'"));

$rowi = mysqli_fetch_object($this->_template->get('reqi'));
$rowo = mysqli_fetch_object($this->_template->get('reqo'));
$rowdef = mysqli_fetch_object($this->_template->get('reqdef'));

$row = $rowi->NBR + $rowo->NBR;$this->set('row',$row);
$def = $rowdef->NBR;$this->set('def',$def);



$this->set('sqlSi',$this->Casque->query("SELECT COUNT(*)NBR FROM casques WHERE type='Casque simple' AND date_attribution IS NULL AND date_retour IS NULL AND defaillant='0'"));
$this->set('sqlSo',$this->Casque->query("SELECT COUNT(*)NBR FROM casques WHERE type='Casque simple' AND date_attribution<>'0000-00-00' AND date_retour<>'0000-00-00' AND defaillant='0'"));
$this->set('totdefS',$this->Casque->query("SELECT COUNT(*) NBR FROM casques WHERE defaillant='1' AND type='Casque simple'"));

$rowSi = mysqli_fetch_object($this->_template->get('sqlSi'));
$rowSo = mysqli_fetch_object($this->_template->get('sqlSo'));
$rowdefS = mysqli_fetch_object($this->_template->get('totdefS'));		

$rowS = $rowSi->NBR + $rowSo->NBR;$this->set('rowS',$rowS);
$defS = $rowdefS->NBR;$this->set('defS',$defS);



$this->set('reqMi',$this->Casque->query("SELECT COUNT(*)NBR FROM casques WHERE type='Casque-micro' AND date_attribution IS NULL AND date_retour IS NULL AND defaillant='0'"));
$this->set('reqMo',$this->Casque->query("SELECT COUNT(*)NBR FROM casques WHERE type='Casque-micro' AND date_attribution<>'0000-00-00' AND date_retour<>'0000-00-00' AND defaillant='0'"));
$this->set('reqdefM',$this->Casque->query("SELECT COUNT(*)NBR FROM casques WHERE defaillant='1' AND type='Casque-micro'"));

$rowMi = mysqli_fetch_object($this->_template->get('reqMi'));
$rowMo = mysqli_fetch_object($this->_template->get('reqMo'));
$rowdefM = mysqli_fetch_object($this->_template->get('reqdefM'));

$rowM = $rowMi->NBR + $rowMo->NBR;$this->set('rowM',$rowM);
$defM = $rowdefM->NBR;$this->set('defM',$defM);



	
        if (isset($_POST['valider'])) {
			$entreeStockSimple = $_POST['entreestocksimple'];
			//echo $entreeStockSimple;
			$entreeStockMicro = $_POST['entreestockmicro'];
			//echo $entreeStockMicro;
			$casqDate = $_POST['date'];
			$dateajout=$_POST['date'];
			list($jour, $mois, $annee) = explode("/",$dateajout);
			$casqDate = $annee."-".$mois."-".$jour;
			$casqComm = $_POST['commentaire'];

			for($i=0; $i<$entreeStockSimple; $i++)
			{
			$this->Casque->query("INSERT INTO casques (date_entree, type, id_formation, commentaires) VALUES ('$casqDate', 'Casque simple', '2', '$casqComm')");
			}

			for($i=0;$i<$entreeStockMicro;$i++)
			{
		    $this->Casque->query("INSERT INTO casques (date_entree, type, id_formation, commentaires) VALUES ('$casqDate', 'Casque-micro', '1', '$casqComm')");
			}

	$string="Stock mis à jour.<br>";
        //echo '<a href="histo.php">Actualiser la page.</a>';
	}

        
$this->set('string',$string);







}


    function attribution_etudiant() {

       require_once('../public/js/includes/verification.php'); 

	
       switch($_SESSION['statut']){ 
		case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 1: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 3: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		//case 2: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
        

    	}


$this->set('title','attribution d\'un casque à un étudiant');

$message="";

if(isset($_POST['attribuer_etudiant'])){
    
//$formation = $_POST['formation'];

if(isset($_POST['commentaire'])) $commentaire = $_POST['commentaire']; else $commentaire = "";
       
$etudiant = $_POST['choix_utilisateur'];

$this->set('execverif',$this->Casque->query("SELECT id_user FROM casques WHERE id_user='$etudiant'"));

$datav = mysqli_fetch_assoc($this->_template->get('execverif'));
	
//$this->set('execsql_type',$this->Casque->query("SELECT type_casque FROM cask_formations WHERE id_formation='$formation'"));

//$datatype = mysqli_fetch_assoc($this->_template->get('execsql_type'));

$type = 'Casque-micro';
      
$this->set('exeCompS',$this->Casque->query("SELECT COUNT(*)NBRS FROM casques WHERE id_user='' AND type = '$type'"));

$rowCompS = mysqli_fetch_object($this->_template->get('exeCompS'));     
        
$row = $rowCompS->NBRS;
	
            if($row == 0)	{$message = "<font color=red>Il n'y a plus de casques en stock.</font>";	}
            else
            {
                if($datav['id_user'] == $etudiant)	{ $message = "<font color=red>Cet utilisateur a déjà un casque.</font>";}
                else
                {

                    //attribution d'un casque à l'étudiant, et mise à jour de la table casques
                    $this->Casque->query("UPDATE etudiants SET type_casq='$type' WHERE matricule='$etudiant'");

         $this->set('reqt',$this->Casque->query("SELECT min(id_casq) as RES FROM casques WHERE type='$type' AND id_user='' AND defaillant=0"));

         $data = mysqli_fetch_assoc($this->_template->get('reqt'));  

         $inter = $data['RES'];	

         $this->Casque->query("UPDATE casques SET id_user='$etudiant', date_attribution=CURDATE(), date_retour='',  commentaires=CONCAT(commentaires, '; $commentaire') WHERE type='$type' AND id_casq='$inter'");

      $message = "<font color=green>Attribution réussie.</font>";
                                                          
                }
            }
    }
                        
			
$this->set('message',$message);
}






function attrib_liste_etudiants(){   

 require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }

$this->set('result',$this->Casque->query('SELECT id, libelle FROM ecoles'));
$this->set('resultt',$this->Casque->query('SELECT id, libelle FROM ecoles'));
$this->set('resulttt',$this->Casque->query('SELECT id, libelle FROM ecoles'));

$this->set('req',$this->Casque->query("SELECT id_formation,titre FROM cask_formations"));  

$string="";

  
            if(isset($_POST['id_ecole'])&&$_POST['id_ecole']!='-1'){
             $id_ecole=$_POST['id_ecole']; 
            $this->set('ecole_selected',$id_ecole);
          
    if (isset($_POST['annee'.$id_ecole])){
        $annee = $_POST['annee'.$id_ecole];$this->set('annee_selected',$annee); 
        $ann="annee".$id_ecole;  $this->set('ann',$ann);
    
    if (isset($_POST['groupe'.$id_ecole. $annee])){
        $groupe = $_POST['groupe'.$id_ecole.$annee]; $this->set('groupe_selected',$groupe);
        $group="groupe".$id_ecole.$annee;$this->set('group',$group); 
       }
    }
        
        if ($id_ecole == "-1") {
       // $ecole = "TOUS";//
      //  $annee = "TOUS";//
        $condition ="";//
        } else {
             $condec = "id_ecole = '" . $id_ecole . "'";//
          if (isset($_POST['annee'.$id_ecole])){
            if ($annee == "-1") {
           // $annee = "TOUS";//
            $condition = $condec;//
            } else {
                $condition = "annee = '" . $annee . "' AND $condec";//
            }
           if (isset($_POST['groupe'.$id_ecole. $annee])){
            if ($groupe == "-1") {
           // $annee = "TOUS";//
            } else {
                $condition = "groupe = '" . $groupe . "' AND annee = '" . $annee . "' AND $condec";//
            }
           }
          }
        }  

   $requete_user = "SELECT  matricule, nom, prenom, type_casq FROM etudiants WHERE $condition ORDER BY matricule ASC";
   //$string.=$requete_user;
   $this->set('result1',$this->Casque->query($requete_user));
   
    $array = array();
    while($row = mysqli_fetch_array($this->_template->get('result1'))){
        $matricule=$row['matricule'];
        $nom=$row['nom'];
        $prenom=$row['prenom'];
        $type_casq=$row['type_casq'];
        

 $col_casque = ($row['type_casq'] != "" ) ? '<font color = red> | '.$row["type_casq"].' </font>' : '';

 if($type_casq== "")  { $string.=  $matricule. " | ".$nom." ".$prenom."<br>";
$array[] = $row;
} else {

 $string.= "$matricule"." | "."$nom"." "."$prenom".""."$col_casque"."<br />";
}


}
  $string.='<br><button class="btn btn-default" onClick="window.print()">Imprimer cette page</button><br>';
  $this->set('string',$string);
  $this->set('array',$array);



 // print_r($array);

}






 if(isset($_POST['attribuer'])){
                         
                      
                        $commentaire = $_POST['commentaire'];                   
                        $compt=$_POST['nbet'];


                     //   $this->set('execsql_type',$this->Casque->query("SELECT type_casque FROM cask_formations WHERE id_formation='$id_formation'"));

                      //  $datatype = mysqli_fetch_assoc($this->_template->get('execsql_type')); 
                        
                        $type = 'Casque-micro';

                       $this->set('exeCompS',$this->Casque->query("SELECT COUNT(*)NBRS FROM casques WHERE id_user='' AND type = '$type'"));

                        $rowCompS = mysqli_fetch_object($this->_template->get('exeCompS')); 
   
                        $row = $rowCompS->NBRS;

                        foreach ($array as $row) {

                        $etudiant= $row['matricule'];


                            if($row == 0)	{$string.= "<font color=red>Il n'y a plus de casques en stock.</font>";	}
                            else
                            {
                                  
                                    //attribution d'un casque à l'étudiant, et mise à jour de la table casques
                        $this->Casque->query("UPDATE etudiants SET type_casq='$type' WHERE matricule='$etudiant'");
                        $this->set('execsql_type',$this->Casque->query("SELECT min(id_casq) as RES FROM casques WHERE type='$type' AND id_user='' AND defaillant=0"));

                        $data = mysqli_fetch_assoc($this->_template->get('execsql_type')); 
   
                       $inter = $data['RES'];	
                       $this->Casque->query("UPDATE casques SET id_user='$etudiant', date_attribution=CURDATE(), date_retour='', commentaires=CONCAT(commentaires, '; $commentaire') WHERE type='$type' AND id_casq='$inter'");


                                                    
                                 $string.= "<font color=green> l'attribution du casque numéro ".$inter." pour l'étudiant ".$row['matricule']." | ".$prenom=$row['nom']." ".$prenom=$row['prenom']." a été réussie.</font><br />";

                               }
                             }
                       

                        $this->set('string',$string);
}



}

function retour_casque_etudiant(){
 require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }

$message="";
        
if(isset($_POST['bouton']))
{
    if(isset($_POST['defaillant']))    $defaillant = $_POST['defaillant'];

	if(isset ($defaillant))
	{
		$defaillant = 1;
	}
	else
	{
		$defaillant = 0;
	}
	
	//mysqli_query($db,"SET NAMES UTF8");
	
	$etudiant = $_POST['etudiant'];

	$first = explode (' ', $etudiant);//récupération de l'id de l'étudiant
	$etudiant = $first[0];


    $this->set('execsql_type',$this->Casque->query("SELECT type_casq FROM etudiants WHERE matricule='$etudiant'"));

    $data = mysqli_fetch_assoc($this->_template->get('execsql_type')); 

	
	if ($data['type_casq'] <> '')//si l'utilisateur choisi possède déjàun casque
	{
		//retour du casque de l'étudiant, et mise à jour de la table casques
		 $this->Casque->query("UPDATE etudiants SET type_casq='' WHERE matricule='$etudiant'");
		 $this->Casque->query("UPDATE casques SET id_user='', date_retour=CURDATE(), defaillant=$defaillant,  id_formation = '0',  commentaires=CONCAT(commentaires, '; $etudiant') WHERE id_user='$etudiant'");
		$message = "<font color=green>Retour réussi.</font>";
	}
	else//s'il ne possède pas de casque
	{
		$message = "<font color=red>Erreur : cet utilisateur n'a pas de casque.</font>";
	}

}
$this->set('message',$message);

}

    function attribution_agent() {
       require_once('../public/js/includes/verification.php'); 

	
       switch($_SESSION['statut']){ 
		case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 1: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 3: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		//case 2: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
        

    	}


$this->set('title','attribution d\'un casque à un agent');

$message="";

if(isset($_POST['attribuer_agent'])){
    
$formation = $_POST['formation'];

if(isset($_POST['commentaire'])) $commentaire = $_POST['commentaire']; else $commentaire = "";
       
$agent = $_POST['choix_utilisateur'];

$this->set('execverif',$this->Casque->query("SELECT id_user FROM casques WHERE id_user='$agent'"));

$datav = mysqli_fetch_assoc($this->_template->get('execverif'));
	
$this->set('execsql_type',$this->Casque->query("SELECT type_casque FROM cask_formations WHERE id_formation='$formation'"));

$datatype = mysqli_fetch_assoc($this->_template->get('execsql_type'));

$type = $datatype['type_casque'];
      
$this->set('exeCompS',$this->Casque->query("SELECT COUNT(*)NBRS FROM casques WHERE id_user='' AND type = '$type'"));

$rowCompS = mysqli_fetch_object($this->_template->get('exeCompS'));     
        
$row = $rowCompS->NBRS;
	
            if($row == 0)	{$message = "<font color=red>Il n'y a plus de casques en stock.</font>";	}
            else
            {
                if($datav['id_user'] == $agent)	{ $message = "<font color=red>Cet utilisateur a déjà un casque.</font>";}
                else
                {
                  /*  $message="klhhhhhhhhhhhhhhhhhhhhhhhhh<br>";
                    $message.="klhhhhhhhhhhhhhhhhhhhhhhhhh<br>";
                	$message.='data:'.$datav['id_user'].'<br>';
                	$message.='agent'.$agent.'<br>';*/

                    //attribution d'un casque à l'étudiant, et mise à jour de la table casques
                    $this->Casque->query("UPDATE agents SET type_casq='$type' WHERE matricule='$agent'");

         $this->set('reqt',$this->Casque->query("SELECT min(id_casq) as RES FROM casques WHERE type='$type' AND id_user='' AND defaillant=0"));

         $data = mysqli_fetch_assoc($this->_template->get('reqt'));  

         $inter = $data['RES'];	

         $this->Casque->query("UPDATE casques SET id_user='$agent', date_attribution=CURDATE(), date_retour='', id_formation='$formation', commentaires=CONCAT(commentaires, '; $commentaire') WHERE type='$type' AND id_casq='$inter'");

      $message.= "<font color=green>Attribution réussie.</font>";
                                                          
                }
            }
    }
           
            $this->set('req',$this->Casque->query("SELECT id_formation,titre FROM cask_formations"));             
			
$this->set('message',$message);
}

function attrib_cfps_fonda() {
	$_SESSION['statut']=4;
		header('Content-Type: text/html; charset=UTF-8');
		header ("Access-Control-Allow-Origin:*", true);
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Access-Control-Max-Age: 1000');
		header('Access-Control-Allow-Headers: Content-Type');
	   
$this->set('title','attribution d\'un casque à un agent');

$message="";
$lastuser="";
for ($i = 0, $c = count($_POST['cask']); $i < $c; $i++) {
        $commentaire = "";
        $formation = "1";
	$agent = '01'.$_POST['cask'][$i];
        if($agent!=$lastuser){
	$this->set('execverif',$this->Casque->query("SELECT nom, prenom FROM agents WHERE matricule='$agent'"));
	
$datav = mysqli_fetch_assoc($this->_template->get('execverif'));

	$message.= $datav['nom'].' '.$datav['prenom'].' -> ';
	
	$this->set('execverif',$this->Casque->query("SELECT id_user FROM casques WHERE id_user='$agent'"));
	
$datav = mysqli_fetch_assoc($this->_template->get('execverif'));

	
$this->set('execsql_type',$this->Casque->query("SELECT type_casque FROM cask_formations WHERE id_formation='$formation'"));

$datatype = mysqli_fetch_assoc($this->_template->get('execsql_type'));

$type = $datatype['type_casque'];
      
$this->set('exeCompS',$this->Casque->query("SELECT COUNT(*)NBRS FROM casques WHERE id_user='' AND type = '$type'"));

$rowCompS = mysqli_fetch_object($this->_template->get('exeCompS'));     
        
$row = $rowCompS->NBRS;
	
            if($row == 0)	{$message .= "<font color=red>Il n'y a plus de casques en stock.</font><br />";	}
            else
            {
                if($datav['id_user'] == $agent)	{ $message .= "<font color=red>Cet utilisateur a déjà un casque.</font><br />";}
                else
                {
                  /*  $message="klhhhhhhhhhhhhhhhhhhhhhhhhh<br>";
                    $message.="klhhhhhhhhhhhhhhhhhhhhhhhhh<br>";
                	$message.='data:'.$datav['id_user'].'<br>';
                	$message.='agent'.$agent.'<br>';*/

                    //attribution d'un casque à l'étudiant, et mise à jour de la table casques
                    $this->Casque->query("UPDATE agents SET type_casq='$type' WHERE matricule='$agent'");

         $this->set('reqt',$this->Casque->query("SELECT min(id_casq) as RES FROM casques WHERE type='$type' AND id_user='' AND defaillant=0"));

         $data = mysqli_fetch_assoc($this->_template->get('reqt'));  

         $inter = $data['RES'];	

         $this->Casque->query("UPDATE casques SET id_user='$agent', date_attribution=CURDATE(), date_retour='', id_formation='$formation', commentaires=CONCAT(commentaires, '; $commentaire') WHERE type='$type' AND id_casq='$inter'");

      $message.= "<font color=green>Attribution réussie.</font><br />";
                                                          
                }
            }
        }
}
           
            $this->set('req',$this->Casque->query("SELECT id_formation,titre FROM cask_formations"));             
			
$this->set('message',$message);
}


    function attrib_liste_agents() {
    	error_reporting(0);

       require_once('../public/js/includes/verification.php'); 

	
       switch($_SESSION['statut']){ 
		case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 1: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 3: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		//case 2: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
        

    	}

$string="";

if (isset($_GET['fichier'])) $fichier = $_GET['fichier'];
if (isset($_GET['id_formation'])) $id_formation = $_GET['id_formation'];
    else $id_formation = $_POST['id_formation'];

                        if (!isset($_GET['validation']))
                        {
                            
                            
                            if (!isset($_FILES['file'])) // si pas encore de fichier
                            {
                            $string= '<br><br><br><form id="my_form" action="attrib_liste_agents" method="post" enctype="multipart/form-data" name="form_upload">';
                             
                                // REQUETE POUR AFFICHAGE FORMATION
                             $this->set('reqt',$this->Casque->query("SELECT id_formation,titre FROM cask_formations"));
   
                           $string.= "Formation : ";
                            if(mysqli_num_rows($this->_template->get('reqt')))
                            {
                             $string.= "<select style=\"width:300px\" class=\"form-control\" name=id_formation id=formation onchange=this.form.submit();";
                            $string.= "<option value='-1'>- - - Formation concernée : - - -</option>";

                            while($row_formation = mysqli_fetch_assoc($this->_template->get('reqt'))){

                            $formation = $row_formation['titre'];
                            $id_formation = $row_formation['id_formation'];
                                if (isset($_POST['id_formation']) && ($id_formation == ($_POST['id_formation']))) 
                                $string.= "<option value=".$id_formation." selected=selected>".$formation."</option>";
                                else
                                $string.= "<option value=".$id_formation.">".$formation."</option>";			
                            }
                            $string.= "</select><br /><br />";
                            }

                             $string.= "<h5>Veuillez selectionner le fichier csv de la liste que vous souhaitez importer...</h5> 
                        	<div style='position:relative;'>                                              
		                    <a class='btn btn-primary' href='javascript:;'>
			                Choisisez un fichier			                
			                 <input id='fileInput' type='file' name='file' style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:\"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)\";opacity:0;background-color:transparent;color:transparent;'  size='40' 
			                  >
		                         </a>		
		                     <span class='label label-info' id='upload-file-info'></span>
		                     </div> </br>

		                     <a href='javascript:{}'' onclick='document.getElementById(\"my_form\").submit();' name='Envoi' class='btn btn-default'>Importer</a>
                              </form><br><br><br>";
       
                            }
                            else
                            {
                            $dossier = '../public/js/upload/';
                            $fichier = basename($_FILES['file']['name']);
                            $taille_maxi = 300000;
                            $taille = filesize($_FILES['file']['tmp_name']);
                            $extensions = array('.csv');
                            $extension = strrchr($_FILES['file']['name'], '.'); 
                            $destination=$dossier.$fichier;

                        //D�but des v�rifications de s�curit�...
                                if(!in_array($extension, $extensions))  $erreur = '<br><br><br>Vous devez uploader un fichier de type csv...';
                                if($taille>$taille_maxi) $erreur = '<br><br><br>Le fichier est trop gros...';

                                if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
                                {
                                     //On formate le nom du fichier ici...
                                     $fichier = strtr($fichier, 
                                          '����������������������������������������������������', 
                                          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                                     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);


                                if(is_uploaded_file($_FILES['file']['tmp_name'])) //Si la fonction renvoie TRUE, c'est que �a a fonctionn�...
                                {
                                    if(!@move_uploaded_file($_FILES['file']['tmp_name'], $destination)){
                                    $string= '<br><br><br>Echec de l\'upload !';
                                    }else{
                                    $string= '<br><br><br>Upload effectué avec succés !';
                                    $string.= "<br><br><br>ATTENTION !!! vous vous apprétez à attribuer des casques à la liste contenue dans le fichier <b>$fichier</b>, Validez vous cette action ?<br>";
                                    $string.= "<a href = attrib_liste_agents?validation&fichier=$fichier&id_formation=$id_formation>oui</a>  -  ";
                                    $string.= "<a href = 'attrib_liste_agents'>non</a><br><br><br><br><br><br><br><br>";


                                    }
                                }
                                else
                                {
                                $string= '<br><br><br>Echec de l\'upload !';
                                }


                                
                                }
                                else
                                {
                                $string.= '<br><br><br>';
                                $string.= $erreur;
                                $string.= "<a href = 'attrib_liste_agents'>Retour</a><br><br><br><br><br><br><br><br>"; 
                                }

                            }

                        }
                        else
                        {    
                     // ouverture du fichier en lecture                           
                        if (file_exists('../public/js/upload/'.$fichier))
                        $fp = fopen('../public/js/upload/'.$fichier, "r");
                        else{ // fichier inconnu
                        $string= "Fichier introuvable !<br>Importation stoppée.<a href = 'attrib_liste_agents'>Retour</a>";
                           $this->set('string', $string); 
                        exit();
                        }
                        
                        
                        // importation
                        while (!feof($fp)){ 
                        $ligne = fgets($fp,4096);
                        $liste = explode(";",$ligne); // on cree un tableau des elements separe par point virgule

                        $matricule = $liste[0];//****************************  $username = 'cfps.01'.$liste[0]
                        $date_attrib = $liste[3];
                        
                       
                        $commentaire = $liste[4];    

                          $this->set('execsql_type',$this->Casque->query("SELECT id_user FROM casques WHERE id_user='$matricule'"));

                        $datatv = mysqli_fetch_assoc($this->_template->get('execsql_type')); 
                        
                       $this->set('execsql_type',$this->Casque->query("SELECT type_casque FROM cask_formations WHERE id_formation='$id_formation'"));

                        $datatype = mysqli_fetch_assoc($this->_template->get('execsql_type')); 
                        
                        $type = $datatype['type_casque'];

                       $this->set('exeCompS',$this->Casque->query("SELECT COUNT(*)NBRS FROM casques WHERE id_user='' AND type = '$type'"));

                        $rowCompS = mysqli_fetch_object($this->_template->get('exeCompS')); 
   
                        $row = $rowCompS->NBRS;                                     


                            if($row == 0)	{$string.= "<font color=red>Il n'y a plus de casques en stock.</font>";	}
                            else
                            {
                            if($datav['id_user'] == $matricule)	{ $message = "<font color=red>Cet utilisateur : ".$datav['id_user']." a déjà un casque.</font>";}
                            else {
                                  
                                    //attribution d'un casque à l'étudiant, et mise à jour de la table casques
                        $this->Casque->query("UPDATE agents SET type_casq='$type' WHERE matricule='$matricule'");
                        $this->set('execsql_type',$this->Casque->query("SELECT min(id_casq) as RES FROM casques WHERE type='$type' AND id_user='' AND defaillant=0"));

                        $data = mysqli_fetch_assoc($this->_template->get('execsql_type')); 
   
                       $inter = $data['RES'];	
                       $this->Casque->query("UPDATE casques SET id_user='$matricule', date_attribution=CURDATE(), date_retour='', id_formation='$id_formation', commentaires=CONCAT(commentaires, '; $commentaire') WHERE type='$type' AND id_casq='$inter'");


                                                    
                                 $string.= "<font color=green> l'attribution du casque numéro ".$inter." pour l'agent ".$matricule." a été réussie.</font><br />";

                               }
                             }                                                 

                          
                        }
                         fclose($fp);
                         $string.= "<br>Attribution terminée avec succes<br>$message<br>";
                        }
 $this->set('string', $string); 

    }


function attrib_pool_agents() {

error_reporting(0);

       require_once('../public/js/includes/verification.php'); 

	
       switch($_SESSION['statut']){ 
		case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 1: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 3: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		//case 2: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
        

    	}

$this->set('req',$this->Casque->query("SELECT id_formation,titre FROM cask_formations")); 

$string="";
if(isset($_POST['attribuer_agent']))
    {
             
        $compt=$_POST['qty'];
        
        if (isset($_GET['commentaire'])) $commentaire = $_POST['commentaire']; else $commentaire="";
        $id_formation = $_POST['formation'];
	$agent = $_POST['agent'];
       
                    $this->set('execsql_type',$this->Casque->query("SELECT type_casque FROM cask_formations WHERE id_formation='$id_formation'"));

                        $datatype = mysqli_fetch_assoc($this->_template->get('execsql_type')); 
                        
                        $type = $datatype['type_casque'];
      
        
         $this->set('exeCompS',$this->Casque->query("SELECT COUNT(*)NBRS FROM casques WHERE id_user='' AND type = '$type'"));

                        $rowCompS = mysqli_fetch_object($this->_template->get('exeCompS')); 
   
                        $row = $rowCompS->NBRS;  

		if($row == 0)
			{$string.= "<font color=red>Il n'y a plus de casques en stock.</font>";
			}
			else
			{
                            for ($i = 0; $i < $compt; $i++)
                            {
					
					     $this->set('reqt',$this->Casque->query("SELECT min(id_casq) as RES FROM casques WHERE type='$type' AND id_user='' AND defaillant=0"));

                        $data = mysqli_fetch_assoc($this->_template->get('reqt'));  

                          $inter = $data['RES'];

                           $this->Casque->query("UPDATE casques SET id_user='$agent', date_attribution=CURDATE(), date_retour='', id_formation='$id_formation', commentaires=CONCAT(commentaires, '; $commentaire') WHERE type='$type' AND id_casq='$inter'");
		
								$string.= "<font color=green>Attribution réussie pour l'agent".$i."</font><br>";
                            }	
				
			}
	

 $this->set('string', $string); 

}
}

function retour_casque_agent(){
 require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }

$message="";
        
if(isset($_POST['bouton']))
{
    if(isset($_POST['defaillant']))    {

		$defaillant = 1;
	}
	else
	{
		$defaillant = 0;
	}
	
	//mysqli_query($db,"SET NAMES UTF8");
	
	$agent = $_POST['agent'];

	$first = explode (' ', $agent);//récupération de l'id de l'étudiant
	$agent = $first[0];


    $this->set('execsql_type',$this->Casque->query("SELECT type_casq FROM agents WHERE matricule='$agent'"));

    $data = mysqli_fetch_assoc($this->_template->get('execsql_type')); 

	
	if ($data['type_casq'] <> '')//si l'utilisateur choisi possède déjàun casque
	{
		//retour du casque de l'étudiant, et mise à jour de la table casques
		 $this->Casque->query("UPDATE agents SET type_casq='' WHERE matricule='$agent'");
		 $this->Casque->query("UPDATE casques SET id_user='', date_retour=CURDATE(), defaillant=$defaillant,  id_formation = '0',  commentaires=CONCAT(commentaires, '; $agent') WHERE id_user='$agent'");
		$message = "<font color=green>Retour réussi.</font>";
	}
	else//s'il ne possède pas de casque
	{
		$message = "<font color=red>Erreur : cet utilisateur n'a pas de casque.</font>";
	}

}
$this->set('message',$message);

}

function retour_pool_agents(){
 require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }

$message="";

if(isset($_POST['bouton']))
{
   if(isset($_POST['defaillant'])) 
	{
		$defaillant = 1;
	}
	else
	{
		$defaillant = 0;
	}
	if(isset($_POST['choix_utilisateur']))  $choix=$_POST['choix_utilisateur'];
	
	$agent = $_POST['agent'];
	//echo $choix." ".$agent.
	
	$this->set('result',$this->Casque->query("SELECT * FROM casques WHERE id_casq = '$choix' "));

    $data = mysqli_fetch_assoc($this->_template->get('result')); 

     
            if ($data)
            {    
            //retour du casque de l'agent, et mise à jour de la table casques
            	$this->Casque->query("UPDATE casques SET id_user='', date_retour=CURDATE(), defaillant=$defaillant, id_formation = '0', commentaires=CONCAT('attribuer avant', '; $agent') WHERE id_casq = '$choix'");

            $message.= "<font color=green>Retour du casque ".$choix. " réussi.</font>";                                        
            }
            else
            {
              $message.= "<font color=red>Retour non traité. Pas d'attribution pour ce nom.</font>";
            }
     

$this->set('message',$message);        
}

}







}
?>
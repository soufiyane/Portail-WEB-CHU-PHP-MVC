<?php

class EtudiantsController extends Controller {

 
	
	function test(){
		$destination = "CM_GESTION_CFM.csv";
		$path=realpath('../public/');
    //echo $path;
  $path= $path.'\\'.$destination;
  $path = str_replace('\\', '/', $path);
  //$path = str_replace('-', '_', $path);
  echo '</br>';
  //echo $path;


//$fichier=$_GET['fichier'];
//$source=$_GET['source'];
echo $path;
//$path=$_SERVER['DOCUMENT_ROOT']."gestion_cfm/public/CM.csv";
//$path="E:/Apache/Apache24/htdocs/gestion-cfm/public/CM-GESTION-CFM.csv";

	 $fp = fopen($path, "r");
     if (!$fp) echo 'nooo';
		
	}

    function liste_etudiants() {
    
    require_once('../public/js/includes/verification.php'); 
        include ('../public/js/includes/fonctions.php');

	
       switch($_SESSION['statut']){ 
		case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 1: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		//case 2: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
	}

     
 $this->set('title','Listes des Etudiants');


    }


function test_ftp_photo() {

//$ftp_server = "svm-erpers-tst";        
$ftp_server = "ftps://svm-aurion";
$ftp_user = "DSIO";
$ftp_password = "!D\$ioRA15"; 
//$conn_id = ftp_connect($ftp_server,990);
//IDENTIFICATION FTP
/*$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

//VERIFICATION DE LA CONNEXION
if ((!$conn_id) || (!$login_result)) {
        $string.= "La connexion FTP a échoué !<br>";
        $string.= "Tentative de connexion au serveur $ftp_server pour l'utilisateur $ftp_user_name"."<br>";
        exit;
    } else {
        $string.= "Connexion au serveur $ftp_server, pour l'utilisateur $ftp_user_name"."<br>";
    }
  */
     $matricule='01849253';
     $source_photos =  "Exports/photos/";  
     //$name=substr($matricule, 1);   
     $source_photo_jpg=$source_photos.$matricule.'.jpg';
     //echo $source_photo_jpg;
     $destination_photos=realpath('../public/js/photos/');
     $destination_photo_jpg= $destination_photos.'\\'.$matricule.'.jpg';
     $destination_photo_jpg = str_replace('\\', '/', $destination_photo_jpg);

//download_image($source_photo_jpg, $destination_photo_jpg);
   //}
// ...e.g./var/www/certs/ssl-certificate.pub.crt    


$file = fopen($destination_photo_jpg, 'w');


set_time_limit(0);
$curl = curl_init();
$file = fopen($destination_photo_jpg, 'w');
curl_setopt($curl, CURLOPT_URL, "ftps://svm-aurion/Exports/photos/0149253.jpg"); #input
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FILE, $file); #output
curl_setopt($curl, CURLOPT_USERPWD, "$ftp_user :$ftp_password");
curl_exec($curl);
curl_close($curl);
fclose($file);


 /*$ch = curl_init ($source_photo_jpg);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    $raw=curl_exec($ch);
    curl_close ($ch);
    if(file_exists($destination_photo_jpg)){
        unlink($destination_photo_jpg);
    }
    $fp = fopen($destination_photo_jpg,'x');
    fwrite($fp, $raw);
    fclose($fp);

*/



   
}

  function test_ftp() {

//$ftp_server = "svm-erpers-tst";        
$ftp_server = "ftps://svm-aurion";
$ftp_user = "DSIO";
$ftp_password = "!D\$ioRA15"; 
//$conn_id = ftp_connect($ftp_server,990);
//IDENTIFICATION FTP
/*$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

//VERIFICATION DE LA CONNEXION
if ((!$conn_id) || (!$login_result)) {
        $string.= "La connexion FTP a échoué !<br>";
        $string.= "Tentative de connexion au serveur $ftp_server pour l'utilisateur $ftp_user_name"."<br>";
        exit;
    } else {
        $string.= "Connexion au serveur $ftp_server, pour l'utilisateur $ftp_user_name"."<br>";
    }
	*/

// ...e.g./var/www/certs/ssl-certificate.pub.crt    
$source_file = '/Exports/photos/01849066.jpg';
$destination_file = '01849066.jpg';

$file = fopen($destination_file, 'w');

$ch = curl_init();

curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
curl_setopt($ch, CURLOPT_URL, $ftp_server . $source_file);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $ftp_user . ':' . $ftp_password);
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 400);
curl_setopt($ch, CURLOPT_FILE, $file);
curl_setopt($ch, CURLOPT_PORT, "990");

//SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_ALL);
curl_setopt($ch, CURLOPT_FTPSSLAUTH, CURLFTPAUTH_SSL);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


curl_exec($ch);
$error_no = curl_errno($ch);
$error_msg = curl_error($ch);
curl_close ($ch);
if ($error_no == 0) {
    $msg = 'File downloaded succesfully.';
} else {
    $msg = 'File download error:' . $error_msg . ' | ' . $error_no;
}
fclose($file);
echo $msg;
$this->set('string',$string);
   
}

    function requette() {
      $string="";
      $matricule='01960842';

 $source_photos =  "/Exports/photos/";  
     //$name=substr($matricule, 1);   
     $source_photo_jpg=$source_photos.$matricule.'.jpg';
     //echo $source_photo_jpg;
     $destination_photos=realpath('../public/js/photos/');
     $destination_photo_jpg= $destination_photos.'\\'.$matricule.'.jpg';
     $destination_photo_jpg = str_replace('\\', '/', $destination_photo_jpg);

$ftp_server = "ftps://svm-aurion";
$ftp_user = "DSIO";
$ftp_password = "!D\$ioRA15"; 

$source_file = $source_photo_jpg;
$destination_file = $destination_photo_jpg;

$file = fopen($destination_file, 'w');

$ch = curl_init();

curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
curl_setopt($ch, CURLOPT_URL, $ftp_server . $source_file);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $ftp_user . ':' . $ftp_password);
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 400);
curl_setopt($ch, CURLOPT_FILE, $file);
curl_setopt($ch, CURLOPT_PORT, "990");

//SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_ALL);
curl_setopt($ch, CURLOPT_FTPSSLAUTH, CURLFTPAUTH_SSL);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


curl_exec($ch);

curl_close ($ch);
fclose($file);

    if (filesize($destination_file)==0) {
      chmod($destination_file,0755);
      unlink($destination_file);
      } else {
        $photo='photos/'.$matricule.'.jpg';
        $this->Etudiant->query("UPDATE etudiants SET photo = '$photo'  where matricule = ".$matricule."");
        $message.= "L'image pour l'étudiant" .$nom." ".$prenom." a été copié avec succée..."."<br>";        
      }

      

    /*  set_time_limit(500);

       require_once('../public/js/includes/verification.php'); 
        include ('../public/js/includes/fonctions.php');
        include ('../public/js/includes/fonctions_texte.php');


$this->set('req',$this->Etudiant->query("SELECT matricule, nom, prenom, libelle, annee FROM etudiants, ecoles where ecoles.id=etudiants.id_ecole and carte='DEF' and (photo='' or photo is null) ORDER BY etudiants.matricule ASC "));

//while ($donnees=mysqli_fetch_array($this->_template->get('req'))){

  $rows_count = mysqli_num_rows($this->_template->get('req'));
$string='<table style="border-spacing: 10px;border-collapse: separate;">';
for($i=0; $i<$rows_count; $i++)
{
    $string.= '<tr>';
    $row = mysqli_fetch_row($this->_template->get('req'));
    for($r=0;$r<count($row);$r++)
    {
        $string.= '<td>';
        $string.= $row[$r];
        $string.= '</td>'; 
        $string.='    ';  
    }
    $string.= '</tr><br>';
}
$string.= '</table>';
$this->set('string',$string);*/


  //}

    }

    function importation_etudiants() {
      set_time_limit(500);
	  error_reporting(0);

    	 require_once('../public/js/includes/verification.php'); 
        include ('../public/js/includes/fonctions.php');
        include ('../public/js/includes/fonctions_texte.php');

//error_reporting(0);
	
       switch($_SESSION['statut']){ 
		case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 1: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		//case 2: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
	}

  $string=""; 
 $this->set('title','importation des Etudiants');

if (!isset($_GET['validation']))
{

    if (!isset($_GET['local'])&&!isset($_GET['ftp'])) // si pas encore de fichier
    {
    $string= "<br><br><br><form id='my_form' action='importation_etudiants?ftp' method='post' enctype='multipart/form-data' name='form_upload'  onSubmit='getPath();'>
    <h5>Veuillez cliquer sur importer pour importer le fichier depuis le serveur ftp (si vous voulez importer un fichier local cliquer <a href = importation_etudiants?local>ici</a>)...</h5> 
  

                         <a href='javascript:{}'' onclick='document.getElementById(\"my_form\").submit();' name='Envoi' class='btn btn-default'>Importer</a>
                              </form>";
    } else if (isset($_FILES['file'])&&isset($_GET['local']))
    {
    $dossier = '../public/';
    $fichier = basename($_FILES['file']['name']);
    $taille_maxi = 300000;
    $taille = filesize($_FILES['file']['tmp_name']);
    $extensions = array('.csv');
    $extension = strrchr($_FILES['file']['name'], '.'); 
    $destination=$dossier.$fichier;
    
//Début des vérifications de sécurité...
        if(!in_array($extension, $extensions))  $erreur = '<br><br><br>Vous devez uploader un fichier de type csv...';
        if($taille>$taille_maxi) $erreur = '<br><br><br>Le fichier est trop gros...';

        if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
             //On formate le nom du fichier ici...
             $fichier = strtr($fichier, 
                  'éééééééééééééééééééééééééééééééééééééééééééééééééééé', 
                  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
             $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);


        if(is_uploaded_file($_FILES['file']['tmp_name'])) //Si la fonction renvoie TRUE, c'est que éa a fonctionné...
        {
            if(!@move_uploaded_file($_FILES['file']['tmp_name'], $destination)){
            $string='<br><br><br>Echec de l\'upload !';
            }else{
            $string='<br><br><br>Upload effectué avec succès !';
            }
        }
        else
        {
        $string='<br><br><br>Echec de l\'upload !';
        }

        $string="<br><br><br>ATTENTION !!! vous vous apprêtez à importer le fichier <b>$fichier</b>, Validez vous cette action ?<br>
        <a href = importation_etudiants?validation&fichier=$fichier>oui</a>  -  
        <a href = 'importation_etudiants'>non</a><br><br><br><br><br><br><br><br>";     
        }
        else
        {
        $string='<br><br><br>'.$erreur."<a href = 'importation_etudiants'>Retour à l'import</a><br><br><br><br><br><br><br><br>"; 
        }
 
 $this->set('string',$string);
    }
    else if (!isset($_FILES['ftp'])&&isset($_GET['local'])) {
     $string= "<br><br><br><form id='my_form' action='importation_etudiants?local' method='post' enctype='multipart/form-data' name='form_upload'  onSubmit='getPath();'>
    <h5>Veuillez selectionner le fichier csv local que vous souhaitez importer...</h5> 
        <div style='position:relative;'>                                              
                        <a class='btn btn-primary inner' href='javascript:;'>
                      Choisisez un fichier                      
                       <input id='fileInput' type='file' name='file' style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:\"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)\";opacity:0;background-color:transparent;color:transparent;'  size='40' 
                        >
                             </a>   
                        
                         </div> </br>

                         <a href='javascript:{}'' onclick='document.getElementById(\"my_form\").submit();' name='Envoi' class='btn btn-default'>Importer</a>
                              </form>"; 

    }
     else if (isset($_GET['ftp'])) {

//DOWNLOAD D'UN FICHIER

//$destination = "liste_etudiants.csv";
$destination_photos = "../public/js/photos/";



$ftp_server = "ftps://svm-aurion";
$ftp_user = "DSIO";
$ftp_password = "!D\$ioRA15"; 
 
$source_file = '/Exports/CM_GESTION_CFM.csv';
$destination_file = 'CM_GESTION_CFM.csv';

$file = fopen($destination_file, 'w');

$ch = curl_init();

curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
curl_setopt($ch, CURLOPT_URL, $ftp_server . $source_file);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $ftp_user . ':' . $ftp_password);
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 400);
curl_setopt($ch, CURLOPT_FILE, $file);
curl_setopt($ch, CURLOPT_PORT, "990");

//SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_ALL);
curl_setopt($ch, CURLOPT_FTPSSLAUTH, CURLFTPAUTH_SSL);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


curl_exec($ch);
$error_no = curl_errno($ch);
$error_msg = curl_error($ch);
curl_close ($ch);
if ($error_no == 0) {
	$string.="Fichier distant enregistré avec succès dans $destination_file :)"."<br>";
   $string.="<br><br><br>ATTENTION !!! vous vous apprêtez à importer le fichier dans la base de données <b>depuis le serveur ftp</b>, Validez vous cette action ?<br>
        <a href = importation_etudiants?validation&ftp>oui</a>  -  
        <a href = 'importation_etudiants'>non</a><br><br><br><br><br><br><br><br>";
} else {
    $sting = 'Il y a eu un problème avec la copie du fichier depuis le serveur ftp:' . $error_msg . ' | ' . $error_no;
}
fclose($file);
$this->set('string',$string);
}
    
}
else
{  



$source =  "export/CM_GESTION_CFM.csv";
//$source =  "export/liste_etudiants.csv";
$source_photos =  "export/photos/";
//$destination = "liste_etudiants.csv";
$destination = "CM_GESTION_CFM.csv";
$destination_photos = "../public/js/photos/";

if (isset($_GET['ftp'])) {
$ftp_server = "svm-erpers-tst";
//$ftp_server = "svm-aurion";
$ftp_user_name = "DSIO";
$ftp_user_pass = "!D\$ioRA15";
$conn_id = ftp_connect($ftp_server);
//IDENTIFICATION FTP
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

}

//if (ftp_get($conn_id, $destination, $source, FTP_BINARY)) { }///***********************************************

  $path=realpath('../public/');
    //echo $path;
  $path= $path.'\\'.$destination;
  $path = str_replace('\\', '/', $path);
  echo '</br>';
  //echo $path;


//$fichier=$_GET['fichier'];
//$source=$_GET['source'];
//echo $path;
if (file_exists($path))
{$fp = fopen($path, "r");
//echo 'lu';
}
else{
//echo 'no';	// fichier inconnu
$string.= "Fichier copié introuvable !<br>Importation stoppée."."<br>";
exit();
}


$message='';
// importation
$array = array();
$flag = true;
while (($liste = fgetcsv($fp, 1024, ";") ) !== FALSE) {
if($flag) { $flag = false; continue; }
//while (!feof($fp)){ 
//$ligne = fgets($fp);
//$liste = explode(";",$ligne); // on cree un tableau des elements separe par point virgule

$matricule =  $liste[0];

//if (strlen($matricule)==6) $matricule='01'.$matricule;
//else if (strlen($matricule)==7) $matricule='0'.$matricule;

$array[] = $liste[0];
//$message.='matricule_actuel:'.$matricule.'<br>';
//echo $matricule;
//echo '</br>';
$nom = nettoyer($liste[1]);
$nom = suppr_accents($nom);
$nom = trimUltime($nom);
$nom = mysqlclean($nom);

//echo $nom;
//echo '</br>';

$prenom = nettoyer($liste[2]);
$prenom = suppr_accents($prenom);
$prenom = trimUltime($prenom);
$prenom = mysqlclean($prenom);

//echo $prenom;
//echo '</br>';

$mail = $liste[3];

$telephone =  $liste[4];

$nom_ecole = $liste[5];

$this->set('req_ecole',$this->Etudiant->query("SELECT id FROM ecoles where libelle = '".$nom_ecole."'"));

if (mysqli_num_rows($this->_template->get('req_ecole'))!= 0 ) // si l'etudiant n'existe pas ds la table
{
         $ligne_ecole = mysqli_fetch_array($this->_template->get('req_ecole'));
         $id_ecole = $ligne_ecole['id'];      
}


//$groupe = $liste[6];

$anne = $liste[7];

$classe  = $liste[7];//*////////////////////// IL FAUT VOIR ////////////////////////////////

$date_naissance = $liste[8];
$date_naissance = substr($date_naissance, 0, 2) . substr($date_naissance, 3, 2) .substr($date_naissance, 6, 4);

$pp=$liste[9];




////////////////////////////////////////////////////////////////

$curYear = date('Y');//ERASS_1619
$curYear = substr($curYear, 2);
$annee=substr(substr($anne, -4),0,-2);

switch ($annee) {
    case $curYear+0:
        $annee="A1";
        break;
    case $curYear-1:
        $annee="A2";
        break;
    case $curYear-2:
        $annee="A3";
        break;
    case $curYear-3:
        $annee="A4";
        break;
    case $curYear-4:
        $annee="A5";
        break;
}

//*************************************************************************************************

$this->set('req_etudiant',$this->Etudiant->query("SELECT * FROM etudiants WHERE matricule = '".$matricule."'"));

$this->set('req_archives',$this->Etudiant->query("SELECT * FROM etudiants_archive WHERE matricule = '".$matricule."'"));

//MAJ de l'étudiant
if(mysqli_num_rows($this->_template->get('req_etudiant') )!= 0){ // si l'etudiant existe ds la table et_users
  
    $message.= "L'étudiant : '".$matricule."' existe déjà dans la table etudiants<br>";   
    
   


    //	$this->Etudiant->query("INSERT INTO etudiants_archive SELECT * FROM etudiants WHERE matricule = '".$matricule."'");
    
    //    $this->Etudiant->query("DELETE FROM etudiants  WHERE matricule = '".$matricule."'");

     //   $message.= "L'étudiant : '".$matricule."' est archivé<br>";  
    

    //**************************************************************************************

    	  $this->Etudiant->query("UPDATE etudiants SET nom='$nom', prenom='$prenom', id_ecole='$id_ecole', annee='$annee', classe = '$classe',  mail = '$mail',  tel = '$telephone',  pp = '$pp',  date_maj = curdate() where matricule = ".$matricule."");

         $this->set('req_pp',$this->Etudiant->query("SELECT * FROM status_professionnel WHERE code = '".$pp."'"));
        $donnees_pp = mysqli_fetch_array($this->_template->get('req_pp'));
        $carte = $donnees_pp['carte'];
        if($carte=='PRO'){$this->Etudiant->query("UPDATE etudiants SET carte='PRO' where matricule = ".$matricule."");}
        if ($pp=='0'){
		$this->set('req_carte',$this->Etudiant->query("SELECT * FROM etudiants WHERE matricule = '".$matricule."'"));
        $donnees_carte = mysqli_fetch_array($this->_template->get('req_carte'));
        $cart = $donnees_carte['carte'];
		if ($cart=='PRO'|| $cart=='TEMP') {
			$this->Etudiant->query("UPDATE etudiants SET carte='' where matricule = ".$matricule."");
		}
	 }
       
     $message.= "L'étudiant : '".$matricule."' a été modifié<br>"; 	  
 
// 
$donnees = mysqli_fetch_array($this->_template->get('req_etudiant'));
$photo = $donnees['photo'];
if($photo==""||is_null($photo)){ 

   $source_photos =  "/Exports/photos/";  
     //$name=substr($matricule, 1);   
     $source_photo_jpg=$source_photos.$matricule.'.jpg';
     //echo $source_photo_jpg;
     $destination_photos=realpath('../public/js/photos/');
     $destination_photo_jpg= $destination_photos.'\\'.$matricule.'.jpg';
     $destination_photo_jpg = str_replace('\\', '/', $destination_photo_jpg);

$ftp_server = "ftps://svm-aurion";
$ftp_user = "DSIO";
$ftp_password = "!D\$ioRA15"; 

$source_file = $source_photo_jpg;
$destination_file = $destination_photo_jpg;

$file = fopen($destination_file, 'w');

$ch = curl_init();

curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
curl_setopt($ch, CURLOPT_URL, $ftp_server . $source_file);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $ftp_user . ':' . $ftp_password);
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 400);
curl_setopt($ch, CURLOPT_FILE, $file);
curl_setopt($ch, CURLOPT_PORT, "990");

//SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_ALL);
curl_setopt($ch, CURLOPT_FTPSSLAUTH, CURLFTPAUTH_SSL);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


curl_exec($ch);

curl_close ($ch);
fclose($file);

    if (filesize($destination_file)==0) {
      chmod($destination_file,0755);
      unlink($destination_file);
      } else {
        $photo='photos/'.$matricule.'.jpg';
        $this->Etudiant->query("UPDATE etudiants SET photo = '$photo'  where matricule = ".$matricule."");
        $message.= "L'image pour l'étudiant" .$nom." ".$prenom." a été copié avec succée..."."<br>";        
      }               
}
    	
} else if(mysqli_num_rows($this->_template->get('req_archives')) != 0) {  // si l'etudiant existe dans les archives !!!
    
   $message.= "L'étudiant : '".$matricule."' existe déjà dans la table archive<br>"; 

    
    /*
    $req_insert_archive = "INSERT INTO et_users_archive (matricule, identifiant, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, cloud, type_casq, scolarite, date_maj)
                                               VALUES  ('$matricule', '$identifiant', '$identifiant_cfm', '$id_ecole', '$annee','$classe','$nom','$prenom', '$date_naissance', '$tel', '$mail', '$carte', '$photo', '$version_office', '$cloud', '$type_casq', '$archive', curdate())";
    */

      //*******************************************************************************************

    	$this->Etudiant->query("INSERT INTO etudiants (matricule, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, cloud, type_casq, commentaire, groupe) SELECT matricule, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, cloud, type_casq, commentaire, groupe FROM etudiants_archive WHERE matricule = '".$matricule."'");
    
        $this->Etudiant->query("DELETE FROM etudiants_archive  WHERE matricule = '".$matricule."'");

        $this->Etudiant->query("UPDATE etudiants  SET nom='$nom', prenom='$prenom',id_ecole='$id_ecole', annee='$annee',classe = '$classe',  mail = '$mail',  tel = '$telephone',  pp = '$pp',  date_maj = curdate() where matricule = ".$matricule."");
          
        $this->set('req_pp',$this->Etudiant->query("SELECT * FROM status_professionnel WHERE code = '".$pp."'"));
        $donnees_pp = mysqli_fetch_array($this->_template->get('req_pp'));
        $carte = $donnees_pp['carte'];
        if($carte=='PRO'){$this->Etudiant->query("UPDATE etudiants SET carte='PRO' where matricule = ".$matricule."");}
        if ($pp=='0'){
		$this->set('req_carte',$this->Etudiant->query("SELECT * FROM etudiants WHERE matricule = '".$matricule."'"));
        $donnees_carte = mysqli_fetch_array($this->_template->get('req_carte'));
        $cart = $donnees_carte['carte'];
		if ($cart=='PRO'|| $cart=='TEMP') {
			$this->Etudiant->query("UPDATE etudiants SET carte='' where matricule = ".$matricule."");
		}
	 }
// 
$donnees = mysqli_fetch_array($this->_template->get('req_etudiant'));
$photo = $donnees['photo'];
if($photo==""||is_null($photo)){

  $source_photos =  "/Exports/photos/";  
     //$name=substr($matricule, 1);   
     $source_photo_jpg=$source_photos.$matricule.'.jpg';
     //echo $source_photo_jpg;
     $destination_photos=realpath('../public/js/photos/');
     $destination_photo_jpg= $destination_photos.'\\'.$matricule.'.jpg';
     $destination_photo_jpg = str_replace('\\', '/', $destination_photo_jpg);

$ftp_server = "ftps://svm-aurion";
$ftp_user = "DSIO";
$ftp_password = "!D\$ioRA15"; 

$source_file = $source_photo_jpg;
$destination_file = $destination_photo_jpg;

$file = fopen($destination_file, 'w');

$ch = curl_init();

curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
curl_setopt($ch, CURLOPT_URL, $ftp_server . $source_file);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $ftp_user . ':' . $ftp_password);
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 400);
curl_setopt($ch, CURLOPT_FILE, $file);
curl_setopt($ch, CURLOPT_PORT, "990");

//SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_ALL);
curl_setopt($ch, CURLOPT_FTPSSLAUTH, CURLFTPAUTH_SSL);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


curl_exec($ch);

curl_close ($ch);
fclose($file);

    if (filesize($destination_file)==0) {
      chmod($destination_file,0755);
      unlink($destination_file);
      } else {
        $photo='photos/'.$matricule.'.jpg';
        $this->Etudiant->query("UPDATE etudiants SET photo = '$photo'  where matricule = ".$matricule."");
        $message.= "L'image pour l'étudiant" .$nom." ".$prenom." a été copié avec succée..."."<br>";        
      }

}

        $message.= "L'étudiant : '".$matricule."' est désarchivé<br>";  
    
        
}  else {
//********************************************************************************************
$query="INSERT INTO etudiants (`matricule`, `nom`, `prenom` ,`annee` ,  `mail`, `tel`, `id_ecole`, `classe`, `date_naissance` , `pp`, `date_maj`)
    VALUES ('$matricule', '$nom','$prenom', '$annee', '$mail', '$telephone','$id_ecole', '$classe' , '$date_naissance' ,  '$pp', curdate())
";
        $this->set('req_pp',$this->Etudiant->query("SELECT * FROM status_professionnel WHERE code = '".$pp."'"));
        $donnees_pp = mysqli_fetch_array($this->_template->get('req_pp'));
        $carte = $donnees_pp['carte'];
        if($carte=='PRO'){$this->Etudiant->query("UPDATE etudiants SET carte='PRO' where matricule = ".$matricule."");}
		if ($pp=='0'){
		$this->set('req_carte',$this->Etudiant->query("SELECT * FROM etudiants WHERE matricule = '".$matricule."'"));
        $donnees_carte = mysqli_fetch_array($this->_template->get('req_carte'));
        $cart = $donnees_carte['carte'];
		if ($cart=='PRO'|| $cart=='TEMP') {
			$this->Etudiant->query("UPDATE etudiants SET carte='' where matricule = ".$matricule."");
		}
	 }
//echo $query;
 $this->Etudiant->query($query);


/*
                $path1='../public/js/photos/'.$matricule.'.jpg';
                $path1=realpath($path1);
                //echo $path;
                $path1 = str_replace('\\', '/', $path1);
                $path2='../public/js/photos/'.$matricule.'.jpeg';
                $path2=realpath($path2);
                //echo $path;
                $path2 = str_replace('\\', '/', $path2);

               

                if (file_exists($path1)){
                  $photo='photos/'.$matricule.'.jpg';
                   $message.= "L'image pour l'étudiant" .$nom." ".$prenom." a été copié avec succée..."."<br>";

                  $this->Etudiant->query("UPDATE etudiants SET photo = '$photo'  where matricule = ".$matricule."");
                        
                }else
                if (file_exists($path2)){
                  $photo='photos/'.$matricule.'.jpeg';
                   $message.= "L'image pour l'étudiant" .$nom." ".$prenom." a été copié avec succée..."."<br>";
                  $this->Etudiant->query("UPDATE etudiants SET photo = '$photo'  where matricule = ".$matricule."");
                        
                }else  $message.= "La copie de l'image pour l'étudiant " .$nom." ".$prenom."  a échoué..."."<br>";
*/




    $source_photos =  "/Exports/photos/";  
     //$name=substr($matricule, 1);   
     $source_photo_jpg=$source_photos.$matricule.'.jpg';
     //echo $source_photo_jpg;
     $destination_photos=realpath('../public/js/photos/');
     $destination_photo_jpg= $destination_photos.'\\'.$matricule.'.jpg';
     $destination_photo_jpg = str_replace('\\', '/', $destination_photo_jpg);

$ftp_server = "ftps://svm-aurion";
$ftp_user = "DSIO";
$ftp_password = "!D\$ioRA15"; 

$source_file = $source_photo_jpg;
$destination_file = $destination_photo_jpg;

$file = fopen($destination_file, 'w');

$ch = curl_init();

curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
curl_setopt($ch, CURLOPT_URL, $ftp_server . $source_file);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $ftp_user . ':' . $ftp_password);
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 400);
curl_setopt($ch, CURLOPT_FILE, $file);
curl_setopt($ch, CURLOPT_PORT, "990");

//SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_ALL);
curl_setopt($ch, CURLOPT_FTPSSLAUTH, CURLFTPAUTH_SSL);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


curl_exec($ch);

curl_close ($ch);
fclose($file);

    if (filesize($destination_file)==0) {
      chmod($destination_file,0755);
      unlink($destination_file);
      } else {
        $photo='photos/'.$matricule.'.jpg';
        $this->Etudiant->query("UPDATE etudiants SET photo = '$photo'  where matricule = ".$matricule."");
        $message.= "L'image pour l'étudiant" .$nom." ".$prenom." a été copié avec succée..."."<br>";        
      }

            
 $message.= "L'étudiant : '".$nom." ".$prenom."' a été importé avec succes<br>";   


}
 
 //print_r($array);
	        
      
}
//***********************************************************************
$this->set('liste_actuelle',$this->Etudiant->query("SELECT * FROM etudiants"));
while($rowetud = mysqli_fetch_array($this->_template->get('liste_actuelle')))
{
$matricule = $rowetud['matricule'];
//$message.=$matricule.'<br>';
if (!(in_array($matricule, $array))&& $matricule!='01010101'){

//***********************************************************************************
       $this->Etudiant->query("INSERT INTO etudiants_archive (matricule, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, cloud, type_casq, commentaire, groupe, date_maj) SELECT matricule, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, cloud, type_casq, commentaire, groupe, date_maj FROM etudiants WHERE matricule = '".$matricule."'");


   	    // $this->Etudiant->query("INSERT INTO etudiants_archives SELECT * FROM etudiantss WHERE matricule = '".$matricule."'");
//*******************************************************************************************    
         $this->Etudiant->query("DELETE FROM etudiants  WHERE matricule = '".$matricule."'");

         $message.= "L'étudiant : '".$matricule."' n'existe pas dans le fichier importé, il est maintenant archivé<br>"; 

         } 
  
}
$string.=$message."<br>"; 
$string.= "<br>Importation BASE MYSQL terminée avec succes<br><br>";





   
////FERMETURE DE LA CONNEXION
if (isset($_GET['ftp'])) {
ftp_close($conn_id);
}
}
$this->set('string',$string);

}

 function importation_auto() {
    set_time_limit(500);
    error_reporting(0);

$_SESSION['statut']=2;
        include ('../public/js/includes/fonctions.php');
        include ('../public/js/includes/fonctions_texte.php');



$string=""; 

$ftp_server = "ftps://svm-aurion";
$ftp_user = "DSIO";
$ftp_password = "!D\$ioRA15"; 
 
$source_file = '/Exports/CM_GESTION_CFM.csv';
$destination_file = 'CM_GESTION_CFM.csv';

$file = fopen($destination_file, 'w');

$ch = curl_init();

curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
curl_setopt($ch, CURLOPT_URL, $ftp_server . $source_file);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $ftp_user . ':' . $ftp_password);
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 400);
curl_setopt($ch, CURLOPT_FILE, $file);
curl_setopt($ch, CURLOPT_PORT, "990");

//SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_ALL);
curl_setopt($ch, CURLOPT_FTPSSLAUTH, CURLFTPAUTH_SSL);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


curl_exec($ch);
$error_no = curl_errno($ch);
$error_msg = curl_error($ch);
curl_close ($ch);
if ($error_no == 0) {
  //echo "Fichier distant enregistré avec succès dans $destination_file :)"."<br>";
  $string.="Fichier distant enregistré avec succès dans $destination_file :)"."<br>";
  } else {
  $sting.= 'Il y a eu un problème avec la copie du fichier depuis le serveur ftp:' . $error_msg . ' | ' . $error_no;
}
fclose($file);

$destination = "CM_GESTION_CFM.csv";


  $path=realpath('../public/');
    //echo $path;
  $path= $path.'\\'.$destination;
  $path = str_replace('\\', '/', $path);
  echo '</br>';
  //echo $path;

if (file_exists($path)){
$fp = fopen($path, "r");
//echo 'lu';
}
else{
//echo 'no';  // fichier inconnu
$string.= "Fichier copié introuvable !<br>Importation stoppée."."<br>";
exit();
}


$message='';
// importation
$array = array();
$flag = true;
while (($liste = fgetcsv($fp, 1024, ";") ) !== FALSE) {
if($flag) { $flag = false; continue; }
//while (!feof($fp)){ 
//$ligne = fgets($fp);
//$liste = explode(";",$ligne); // on cree un tableau des elements separe par point virgule

$matricule =  $liste[0];

//if (strlen($matricule)==6) $matricule='01'.$matricule;
//else if (strlen($matricule)==7) $matricule='0'.$matricule;

$array[] = $liste[0];
//$message.='matricule_actuel:'.$matricule.'<br>';
//echo $matricule;
//echo '</br>';
$nom = nettoyer($liste[1]);
$nom = suppr_accents($nom);
$nom = trimUltime($nom);
$nom = mysqlclean($nom);

//echo $nom;
//echo '</br>';

$prenom = nettoyer($liste[2]);
$prenom = suppr_accents($prenom);
$prenom = trimUltime($prenom);
$prenom = mysqlclean($prenom);

//echo $prenom;
//echo '</br>';

$mail = $liste[3];

$telephone =  $liste[4];

$nom_ecole = $liste[5];

$this->set('req_ecole',$this->Etudiant->query("SELECT id FROM ecoles where libelle = '".$nom_ecole."'"));

if (mysqli_num_rows($this->_template->get('req_ecole'))!= 0 ) // si l'etudiant n'existe pas ds la table
{
         $ligne_ecole = mysqli_fetch_array($this->_template->get('req_ecole'));
         $id_ecole = $ligne_ecole['id'];      
}


//$groupe = $liste[6];

$anne = $liste[7];

$classe  = $liste[7];//*////////////////////// IL FAUT VOIR ////////////////////////////////

$date_naissance = $liste[8];
$date_naissance = substr($date_naissance, 0, 2) . substr($date_naissance, 3, 2) .substr($date_naissance, 6, 4);

$pp=$liste[9];




////////////////////////////////////////////////////////////////

$curYear = date('Y');//ERASS_1619
$curYear = substr($curYear, 2);
$annee=substr(substr($anne, -4),0,-2);

switch ($annee) {
    case $curYear+0:
        $annee="A1";
        break;
    case $curYear-1:
        $annee="A2";
        break;
    case $curYear-2:
        $annee="A3";
        break;
    case $curYear-3:
        $annee="A4";
        break;
    case $curYear-4:
        $annee="A5";
        break;
}

//*************************************************************************************************

$this->set('req_etudiant',$this->Etudiant->query("SELECT * FROM etudiants WHERE matricule = '".$matricule."'"));

$this->set('req_archives',$this->Etudiant->query("SELECT * FROM etudiants_archive WHERE matricule = '".$matricule."'"));

//MAJ de l'étudiant
if(mysqli_num_rows($this->_template->get('req_etudiant') )!= 0){ // si l'etudiant existe ds la table et_users
  
    $message.= "L'étudiant : '".$matricule."' existe déjà dans la table etudiants<br>";   
    
   


    //  $this->Etudiant->query("INSERT INTO etudiants_archive SELECT * FROM etudiants WHERE matricule = '".$matricule."'");
    
    //    $this->Etudiant->query("DELETE FROM etudiants  WHERE matricule = '".$matricule."'");

     //   $message.= "L'étudiant : '".$matricule."' est archivé<br>";  
    

    //**************************************************************************************

        $this->Etudiant->query("UPDATE etudiants SET nom='$nom', prenom='$prenom', id_ecole='$id_ecole', annee='$annee', classe = '$classe',  mail = '$mail',  tel = '$telephone',  pp = '$pp',  date_maj = curdate() where matricule = ".$matricule."");

        $this->set('req_pp',$this->Etudiant->query("SELECT * FROM status_professionnel WHERE code = '".$pp."'"));
        $donnees_pp = mysqli_fetch_array($this->_template->get('req_pp'));
        $carte = $donnees_pp['carte'];
        if($carte=='PRO'){$this->Etudiant->query("UPDATE etudiants SET carte='PRO' where matricule = ".$matricule."");}
       
	   
	 if ($pp=='0'){
		$this->set('req_carte',$this->Etudiant->query("SELECT * FROM etudiants WHERE matricule = '".$matricule."'"));
        $donnees_carte = mysqli_fetch_array($this->_template->get('req_carte'));
        $cart = $donnees_carte['carte'];
		if ($cart=='PRO'|| $cart=='TEMP') {
			$this->Etudiant->query("UPDATE etudiants SET carte='' where matricule = ".$matricule."");
		}
	 }  
     $message.= "L'étudiant : '".$matricule."' a été modifié<br>";    
  
// 
$donnees = mysqli_fetch_array($this->_template->get('req_etudiant'));
$photo = $donnees['photo'];
if($photo==""||is_null($photo)){

   $source_photos =  "/Exports/photos/";  
     //$name=substr($matricule, 1);   
     $source_photo_jpg=$source_photos.$matricule.'.jpg';
     //echo $source_photo_jpg;
     $destination_photos=realpath('../public/js/photos/');
     $destination_photo_jpg= $destination_photos.'\\'.$matricule.'.jpg';
     $destination_photo_jpg = str_replace('\\', '/', $destination_photo_jpg);

$ftp_server = "ftps://svm-aurion";
$ftp_user = "DSIO";
$ftp_password = "!D\$ioRA15"; 

$source_file = $source_photo_jpg;
$destination_file = $destination_photo_jpg;

$file = fopen($destination_file, 'w');

$ch = curl_init();

curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
curl_setopt($ch, CURLOPT_URL, $ftp_server . $source_file);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $ftp_user . ':' . $ftp_password);
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 400);
curl_setopt($ch, CURLOPT_FILE, $file);
curl_setopt($ch, CURLOPT_PORT, "990");

//SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_ALL);
curl_setopt($ch, CURLOPT_FTPSSLAUTH, CURLFTPAUTH_SSL);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


curl_exec($ch);

curl_close ($ch);
fclose($file);

    if (filesize($destination_file)==0) {
      chmod($destination_file,0755);
      unlink($destination_file);
      } else {
        $photo='photos/'.$matricule.'.jpg';
        $this->Etudiant->query("UPDATE etudiants SET photo = '$photo'  where matricule = ".$matricule."");
        $message.= "L'image pour l'étudiant" .$nom." ".$prenom." a été copié avec succée..."."<br>";        
      }               
}
//
      
} else if(mysqli_num_rows($this->_template->get('req_archives')) != 0) {  // si l'etudiant existe dans les archives !!!
    
   $message.= "L'étudiant : '".$matricule."' existe déjà dans la table archive<br>"; 

    
    /*
    $req_insert_archive = "INSERT INTO et_users_archive (matricule, identifiant, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, cloud, type_casq, scolarite, date_maj)
                                               VALUES  ('$matricule', '$identifiant', '$identifiant_cfm', '$id_ecole', '$annee','$classe','$nom','$prenom', '$date_naissance', '$tel', '$mail', '$carte', '$photo', '$version_office', '$cloud', '$type_casq', '$archive', curdate())";
    */

      //*******************************************************************************************

      $this->Etudiant->query("INSERT INTO etudiants (matricule, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, cloud, type_casq, commentaire, groupe) SELECT matricule, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, cloud, type_casq, commentaire, groupe FROM etudiants_archive WHERE matricule = '".$matricule."'");
    
        $this->Etudiant->query("DELETE FROM etudiants_archive  WHERE matricule = '".$matricule."'");

        $this->Etudiant->query("UPDATE etudiants SET nom='$nom', prenom='$prenom', id_ecole='$id_ecole', annee='$annee',classe = '$classe',  mail = '$mail',  tel = '$telephone',  pp = '$pp',  date_maj = curdate() where matricule = ".$matricule."");
         
        $this->set('req_pp',$this->Etudiant->query("SELECT * FROM status_professionnel WHERE code = '".$pp."'"));
        $donnees_pp = mysqli_fetch_array($this->_template->get('req_pp'));
        $carte = $donnees_pp['carte'];
        if($carte=='PRO'){$this->Etudiant->query("UPDATE etudiants SET carte='PRO' where matricule = ".$matricule."");}
		
		if ($pp=='0'){
		$this->set('req_carte',$this->Etudiant->query("SELECT * FROM etudiants WHERE matricule = '".$matricule."'"));
        $donnees_carte = mysqli_fetch_array($this->_template->get('req_carte'));
        $cart = $donnees_carte['carte'];
		if ($cart=='PRO'|| $cart=='TEMP') {
			$this->Etudiant->query("UPDATE etudiants SET carte='' where matricule = ".$matricule."");
		}
	 }


// 
$donnees = mysqli_fetch_array($this->_template->get('req_etudiant'));
$photo = $donnees['photo'];
if($photo==""||is_null($photo)){

  $source_photos =  "/Exports/photos/";  
     //$name=substr($matricule, 1);   
     $source_photo_jpg=$source_photos.$matricule.'.jpg';
     //echo $source_photo_jpg;
     $destination_photos=realpath('../public/js/photos/');
     $destination_photo_jpg= $destination_photos.'\\'.$matricule.'.jpg';
     $destination_photo_jpg = str_replace('\\', '/', $destination_photo_jpg);

$ftp_server = "ftps://svm-aurion";
$ftp_user = "DSIO";
$ftp_password = "!D\$ioRA15"; 

$source_file = $source_photo_jpg;
$destination_file = $destination_photo_jpg;

$file = fopen($destination_file, 'w');

$ch = curl_init();

curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
curl_setopt($ch, CURLOPT_URL, $ftp_server . $source_file);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $ftp_user . ':' . $ftp_password);
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 400);
curl_setopt($ch, CURLOPT_FILE, $file);
curl_setopt($ch, CURLOPT_PORT, "990");

//SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_ALL);
curl_setopt($ch, CURLOPT_FTPSSLAUTH, CURLFTPAUTH_SSL);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


curl_exec($ch);

curl_close ($ch);
fclose($file);

    if (filesize($destination_file)==0) {
      chmod($destination_file,0755);
      unlink($destination_file);
      } else {
        $photo='photos/'.$matricule.'.jpg';
        $this->Etudiant->query("UPDATE etudiants SET photo = '$photo'  where matricule = ".$matricule."");
        $message.= "L'image pour l'étudiant" .$nom." ".$prenom." a été copié avec succée..."."<br>";        
      }
}


        $message.= "L'étudiant : '".$matricule."' est désarchivé<br>";  
    
        
}  else {
//********************************************************************************************
$query="INSERT INTO etudiants (`matricule`, `nom`, `prenom` ,`annee` ,  `mail`, `tel`, `id_ecole`, `classe`, `date_naissance` , `pp`, `date_maj`)
    VALUES ('$matricule', '$nom','$prenom', '$annee', '$mail', '$telephone','$id_ecole', '$classe' , '$date_naissance' ,  '$pp', curdate())
";
 
        $this->set('req_pp',$this->Etudiant->query("SELECT * FROM status_professionnel WHERE code = '".$pp."'"));
        $donnees_pp = mysqli_fetch_array($this->_template->get('req_pp'));
        $carte = $donnees_pp['carte'];
        if($carte=='PRO'){$this->Etudiant->query("UPDATE etudiants SET carte='PRO' where matricule = ".$matricule."");}
		if ($pp=='0'){
		$this->set('req_carte',$this->Etudiant->query("SELECT * FROM etudiants WHERE matricule = '".$matricule."'"));
        $donnees_carte = mysqli_fetch_array($this->_template->get('req_carte'));
        $cart = $donnees_carte['carte'];
		if ($cart=='PRO'|| $cart=='TEMP') {
			$this->Etudiant->query("UPDATE etudiants SET carte='' where matricule = ".$matricule."");
		}
	 }
		
//echo $query;
 $this->Etudiant->query($query);


/*
                $path1='../public/js/photos/'.$matricule.'.jpg';
                $path1=realpath($path1);
                //echo $path;
                $path1 = str_replace('\\', '/', $path1);
                $path2='../public/js/photos/'.$matricule.'.jpeg';
                $path2=realpath($path2);
                //echo $path;
                $path2 = str_replace('\\', '/', $path2);

               

                if (file_exists($path1)){
                  $photo='photos/'.$matricule.'.jpg';
                   $message.= "L'image pour l'étudiant" .$nom." ".$prenom." a été copié avec succée..."."<br>";

                  $this->Etudiant->query("UPDATE etudiants SET photo = '$photo'  where matricule = ".$matricule."");
                        
                }else
                if (file_exists($path2)){
                  $photo='photos/'.$matricule.'.jpeg';
                   $message.= "L'image pour l'étudiant" .$nom." ".$prenom." a été copié avec succée..."."<br>";
                  $this->Etudiant->query("UPDATE etudiants SET photo = '$photo'  where matricule = ".$matricule."");
                        
                }else  $message.= "La copie de l'image pour l'étudiant " .$nom." ".$prenom."  a échoué..."."<br>";
*/




    $source_photos =  "/Exports/photos/";  
     //$name=substr($matricule, 1);   
     $source_photo_jpg=$source_photos.$matricule.'.jpg';
     //echo $source_photo_jpg;
     $destination_photos=realpath('../public/js/photos/');
     $destination_photo_jpg= $destination_photos.'\\'.$matricule.'.jpg';
     $destination_photo_jpg = str_replace('\\', '/', $destination_photo_jpg);

$ftp_server = "ftps://svm-aurion";
$ftp_user = "DSIO";
$ftp_password = "!D\$ioRA15"; 

$source_file = $source_photo_jpg;
$destination_file = $destination_photo_jpg;

$file = fopen($destination_file, 'w');

$ch = curl_init();

curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
curl_setopt($ch, CURLOPT_URL, $ftp_server . $source_file);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $ftp_user . ':' . $ftp_password);
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 400);
curl_setopt($ch, CURLOPT_FILE, $file);
curl_setopt($ch, CURLOPT_PORT, "990");

//SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_ALL);
curl_setopt($ch, CURLOPT_FTPSSLAUTH, CURLFTPAUTH_SSL);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


curl_exec($ch);

curl_close ($ch);
fclose($file);

    if (filesize($destination_file)==0) {
      chmod($destination_file,0755);
      unlink($destination_file);
      } else {
        $photo='photos/'.$matricule.'.jpg';
        $this->Etudiant->query("UPDATE etudiants SET photo = '$photo'  where matricule = ".$matricule."");
        $message.= "L'image pour l'étudiant" .$nom." ".$prenom." a été copié avec succée..."."<br>";        
      }

            
 $message.= "L'étudiant : '".$nom." ".$prenom."' a été importé avec succes<br>";   


}
 
 //print_r($array);
          
      
}
//***********************************************************************
$this->set('liste_actuelle',$this->Etudiant->query("SELECT * FROM etudiants"));
while($rowetud = mysqli_fetch_array($this->_template->get('liste_actuelle')))
{
$matricule = $rowetud['matricule'];
//$message.=$matricule.'<br>';
if (!(in_array($matricule, $array))&& $matricule!='01010101'){

//***********************************************************************************
       $this->Etudiant->query("INSERT INTO etudiants_archive (matricule, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, cloud, type_casq, commentaire, groupe, date_maj) SELECT matricule, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, cloud, type_casq, commentaire, groupe, date_maj FROM etudiants WHERE matricule = '".$matricule."'");


        // $this->Etudiant->query("INSERT INTO etudiants_archives SELECT * FROM etudiantss WHERE matricule = '".$matricule."'");
//*******************************************************************************************    
         $this->Etudiant->query("DELETE FROM etudiants  WHERE matricule = '".$matricule."'");

         $message.= "L'étudiant : '".$matricule."' n'existe pas dans le fichier importé, il est maintenant archivé<br>"; 

         } 
  
}
$string.=$message."<br>"; 
$string.= "<br>Importation BASE MYSQL terminée avec succes<br><br>";






$this->set('string',$string);












    }














}

?>

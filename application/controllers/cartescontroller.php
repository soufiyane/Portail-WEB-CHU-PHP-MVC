<?php

class CartesController extends Controller {

    function information_cartes() {

    require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    case 3: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }

                        $sqltot = "SELECT COUNT(*)NBR FROM cartes WHERE identifiant='' AND defaillant='0'";
                        $this->set('req', $this->Carte->query($sqltot));
                        $totdef = "SELECT COUNT(*) NBR FROM cartes WHERE defaillant='1'";
                        $this->set('reqdef', $this->Carte->query($totdef));
                        $totperd = "SELECT COUNT(*) NBR FROM cartes WHERE defaillant='2'";
                        $this->set('reqperd', $this->Carte->query($totperd));



  }

    
    function importation_cartes() {

       require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }
    $string='';
    CartesController::information_cartes();

                        if (!isset($_FILES['file'])) { // si pas encore de fichier
                            $string="
                            <form id='my_form' action='importation_cartes' method='post' enctype='multipart/form-data' name='form_upload'>
                            <h5>Veuillez selectionner le fichier csv des cartes que vous souhaitez importer...</h5> 
                            <div style='position:relative;'>                                              
                            <a class='btn btn-primary inner    ' href='javascript:;'>
                            Choisisez un fichier                            
                             <input id='fileInput' type='file' name='file' style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:\"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)\";opacity:0;background-color:transparent;color:transparent;'  size='40' 
                              >
                                 </a>       
                             
                             </div> </br>

                             <a href='javascript:{}'' onclick='document.getElementById(\"my_form\").submit();' name='Envoi' class='btn btn-default'>Importer</a>
                              </form>
                             "

                             
                            
                             ;

                         /*   $string='<br><br><br><form action="importation_cartes" method="post" enctype="multipart/form-data" name="form_upload">
                                   <label class="btn btn-default btn-file">Veuillez selectionner le fichier csv des cartes que vous souhaitez importer<br><br /><input type="file" name="file" />
                                    <input type="submit" name="Envoi" value="Envoi"></label>
                                    </form><br><br><br>';*/
                        } else {

                            $dossier = '../public/js/upload/';
                            $fichier = basename($_FILES['file']['name']);
                          $string='$fichier=';
                          //echo $fichier;
                            $taille_maxi = 300000;
                            $taille = filesize($_FILES['file']['tmp_name']);
                       //     echo $taille;
                            $extensions = array('.csv');
                            $extension = strrchr($_FILES['file']['name'], '.');
                            $destination = $dossier . $fichier;
                      
                     
                     //Début des vérifications de sécurité...
                            if (!in_array($extension, $extensions))
                                $erreur = '<br><br><br><h5>Vous devez uploader un fichier de type csv...</h5>';
                            if ($taille > $taille_maxi)
                                $erreur = '<br><br><br><h5>Le fichier est trop gros...</h5>';

                            if (!isset($erreur)) { //S'il n'y a pas d'erreur, on upload
                                //On formate le nom du fichier ici...
                                $fichier = strtr($fichier, 'éééééééééééééééééééééééééééééééééééééééééééééééééééé', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

                               
                                if (is_uploaded_file($_FILES['file']['tmp_name'])) { //Si la fonction renvoie TRUE, c'est que éa a fonctionné...
                                    if (!@move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
                                        $string='<br><br><br>Echec de l\'upload ! <a href = "importation_cartes">Retour à l\'import</a>';
                                    } else {

                                        $string='<br><br><br>Upload effectué avec succès !<br /><br />';
                                        // ouverture du fichier en lecture

                                       if (file_exists('../public/js/upload/'.$fichier))
                                              {
                                                // echo 'here';
                                            $fp = fopen('../public/js/upload/'.$fichier, "r");
                                        }else { // fichier inconnu
                                             echo 'here';
                                            $string.="<h5>Fichier introuvable !<br>Importation stoppée.</h5>";
                                             $this->set('string', $string); 
                                            exit();
                                        }
                                        $ligne = 0;
                                       // $string+='mas';
                                        // importation
                                        while (($liste = fgetcsv($fp, 1024, ";") ) !== FALSE) {
                                        //  echo 'je suis la';
                                            if ($ligne > 0) {
                                              //  echo 'je suis la';
                                                //while (!feof($fp)){ 
                                                //$ligne = fgets($fp);
                                                //$liste = explode(";",$ligne); // on cree un tableau des elements separe par point virgule
 
                                                $num_carte_fab = $liste[0];
                                                $num_puce = $liste[1];
                                                $num_carte_gestion = intval(substr($num_carte_fab, 5, 3));

                                                ////////////////////////////////////////////////////////////////

                                               // echo 'je suis la';
                                                $req_carte = "SELECT * FROM cartes WHERE num_carte = '" . $num_carte_fab . "'";
                                                $this->set('req_carte',$this->Carte->query($req_carte));
                                                //MAJ de l'étudiant
                                                if (($this->Carte->getNumRows($req_carte) ) != 0) { // si la carte existe
                                                    //echo 'carte existe';
                                                    $message = "La carte n° " . $num_carte_fab . " existe déjà dans la table des cartes";
                                                }else{
                                                $query = "INSERT INTO cartes (`num_carte`, `num_puce`, `date_entree`,`num_carte_gestion`)
                                                VALUES ('$num_carte_fab','$num_puce',curdate(),'$num_carte_gestion')
                                                ";
                                                //echo $query;
                                                $this->Carte->query($query);
                                                $message = "La carte n° " . $num_carte_fab . " a été créée avec succès<br>";
                                                }
                                               
                                                    $string=$string. $message . "<br>";
                                                
                                            }
                                            $ligne++;
                                        }
                                        $string=$string."<br>Importation BASE MYSQL terminée avec succès<br><br>";
                                    }
                                } else {
                                    $string='<br><br><br>Echec de l\'upload !';
                                }
                            } else {
                                $string="<br><br><br>'".$erreur."'<a href = 'importation_cartes'>Retour à l'import</a><br><br><br><br><br><br><br><br>";
                            }
                        }
              $this->set('string', $string);                


  }


function liste_requette() {


      require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }


include ('../public/js/includes/fonctions.php');
include '../public/js/Classes/PHPExcel.php';
include '../public/js/Classes/PHPExcel/Writer/Excel5.php';
        

$this->set('result',$this->Carte->query("SELECT id, libelle FROM ecoles where id not in ('3','4','11','12','13','16')"));
$this->set('resultt',$this->Carte->query("SELECT id, libelle FROM ecoles where id not in ('3','4','11','12','13','16')"));

$fichierModele = "../public/js/modele.xls";
    
    // Si envoi du formulaire
    if(isset($_POST['Exporter'])&&isset($_POST['id_ecole'])){
    $id_ecole=$_POST['id_ecole'];
        
    if (isset($_POST['annee'.$id_ecole]))
        $annee = $_POST['annee'.$id_ecole];   
        
        if ($id_ecole == "-1") {
       // $ecole = "TOUS";//
      //  $annee = "TOUS";//
        $condition ="";//
        } else {
            $this->set('result_ecole',$this->Carte->query("SELECT libelle FROM ecoles where id = '".$id_ecole."'"));
            $ligne = mysqli_fetch_assoc($this->_template->get('result_ecole'));
            $ecole = $ligne["libelle"]; //
            $condec = "id_ecole = '" . $id_ecole . "'";//
            if ($annee == "-1") {
           // $annee = "TOUS";//
            $condition = $condec." AND ";//
            } else {
                $condition = "annee = '" . $annee . "' AND $condec AND ";//
            }
        }


    $reader = new PHPExcel_Reader_Excel5();
        
    //chargement du fichier modele
    $fichierModele = $reader->load($fichierModele);

    //recuperation du sheet modele
    $sheet_ImportUsers = $fichierModele->getSheet(0);
        $sheet_ImportUsers->setCellValue('A1',"MATRICULE");
        $sheet_ImportUsers->setCellValue('B1',"NOM");
        $sheet_ImportUsers->setCellValue('C1',"PRENOM");
        $sheet_ImportUsers->setCellValue('C1',"ANNEE");
        $sheet_ImportUsers->setCellValue('D1',"DATE DE NAISSANCE");
    $sheet_ImportUsers->setCellValue('E1',"ECOLE");
        $sheet_ImportUsers->setCellValue('F1',"TEL_ECOLE");
        
    //creation du fichier de sortie
    $writer = new PHPExcel();
        //PROVISOIRE
    /*"SELECT DISTINCT matricule,nom,prenom,date_naissance,libelle, libelle_long, tel_ecole FROM etudiants, ecoles WHERE $condition ecoles.id=etudiants.id_ecole AND etudiants.pp=0 AND photo!='' AND information_ok = '1' AND matricule!='010101' AND (carte='' or carte='TEMP') AND matricule NOT IN (select identifiant from et_exports_cartes where type='SCOPUS')  ORDER BY etudiants.matricule ASC";*/
        $requete_user = "SELECT DISTINCT matricule,nom,prenom,annee,date_naissance,libelle, libelle_long, tel_ecole FROM etudiants, ecoles WHERE $condition ecoles.id=etudiants.id_ecole AND etudiants.pp=0 AND (photo='' or photo IS NULL) AND matricule!='010101' AND (carte IS NULL or carte='' or carte='TEMP') AND matricule NOT IN (select identifiant from et_exports_cartes where type='SCOPUS')  ORDER BY etudiants.matricule ASC";
         
    // Requet 
        $this->set('result_user',$this->Carte->query($requete_user));
        
        $nbRes=mysqli_num_rows($this->_template->get('result_user'));
   
        if ($nbRes > 0 ){
    $NumLigne = 2;
                     
        // TRAITEMENT DES UTILISATEURS
    $NumLigne_user = 2;
        $sheet_ImportUsers->getColumnDimension('A')->setWidth(15); //en pouces
        $sheet_ImportUsers->getColumnDimension('B')->setWidth(30); //en pouces
        $sheet_ImportUsers->getColumnDimension('C')->setWidth(30); //en pouces
        $sheet_ImportUsers->getColumnDimension('D')->setWidth(70); //en pouces
        $files=array();
    while ($row = mysqli_fetch_assoc($this->_template->get('result_user'))) {




                $ecole=$row['libelle'];
                $mat=$row['matricule'];
                $date_naissance = ($row['date_naissance']);
                $date_naissance = substr($date_naissance, 0, 2) . '/' . substr($date_naissance, 2, 2). '/'.substr($date_naissance, 4, 4);
                
        //Import Users 
                $sheet_ImportUsers->setCellValueExplicit('A'.$NumLigne_user,$mat,PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet_ImportUsers->setCellValue('B'.$NumLigne_user,$row['nom']);
                $sheet_ImportUsers->setCellValue('C'.$NumLigne_user,$row['prenom']);
                $sheet_ImportUsers->setCellValue('D'.$NumLigne_user,$row['annee']);
                $sheet_ImportUsers->setCellValueExplicit('E'.$NumLigne_user,$date_naissance,PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet_ImportUsers->setCellValue('F'.$NumLigne_user,$row['libelle_long']);
                $sheet_ImportUsers->setCellValue('G'.$NumLigne_user,$row['tel_ecole']);
                
                           
                $NumLigne_user++;
                
    }
        
    //ajout des feuilles sheet modele modifié au fichier de sortie
    $writer->addSheet($sheet_ImportUsers);
   // $date=date("d-m-Y");date("Y-m-d H:i:s");
    $date=date("d-m-Y-H-i-s");  
    $date2=date("d_m_Y");
    $dossier = "../public/js/Exports/".$date;
    if(!is_dir($dossier)){
       mkdir($dossier);
    }
    $fichierSortie =  $date2 .'-' . $ecole . '-' . $annee . '-Etudiants_SCOPUS.xls';
   
        
        
    //ecriture du fichier de sortiie
    $fichierSortie=str_replace(' ','',$fichierSortie);
    $writer->removeSheetByIndex(0);
    $sortie = new PHPExcel_Writer_Excel5($writer);
       
        //header('Content-type: application/vnd.ms-excel');
        //header("Content-Disposition: inline;filename=".$fichierSortie );
        header('Pragma: no-cache');
        header('Expires: 0');    
        $sortie->save($dossier."/".$fichierSortie);
        //$sortie->save('php://output');
        
        //GENERATION DU FICHIER ZIP AVEC LES PHOTOS
   
        $mess= "<font color=green> <b>Le fichier Excel a été exporté avec succès, il est disponnible <a href='".$dossier."/".$fichierSortie."'>ici</a></b></font><br/>";

    }else{
                $mess= "<font color=red><b>Aucun étudiant à exporter</b></font>";
        }
        $this->set('mess',$mess);
        }

 
$this->Carte->query("INSERT INTO etudiants (matricule, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, cloud, type_casq, commentaire, groupe) SELECT matricule, identifiant_cfm, id_ecole, annee, classe, nom, prenom, date_naissance, tel, mail, carte, photo, version_office, cloud, type_casq, commentaire, groupe FROM etudiants_archive WHERE matricule = '".$matricule."'");


}


function exportation_scopus() {

error_reporting(0);
      require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }


include ('../public/js/includes/fonctions.php');
include '../public/js/Classes/PHPExcel.php';
include '../public/js/Classes/PHPExcel/Writer/Excel5.php';
        

$this->set('result',$this->Carte->query("SELECT id, libelle FROM ecoles where id not in ('3','4','11','12','13','16')"));
$this->set('resultt',$this->Carte->query("SELECT id, libelle FROM ecoles where id not in ('3','4','11','12','13','16')"));

$fichierModele = "../public/js/modele.xls";
    
    // Si envoi du formulaire
    if(isset($_POST['Exporter'])&&isset($_POST['id_ecole'])){
    $id_ecole=$_POST['id_ecole'];
        
    if (isset($_POST['annee'.$id_ecole]))
        $annee = $_POST['annee'.$id_ecole];   
        
        if ($id_ecole == "-1") {
       // $ecole = "TOUS";//
      //  $annee = "TOUS";//
        $condition ="";//
        } else {
            $this->set('result_ecole',$this->Carte->query("SELECT libelle FROM ecoles where id = '".$id_ecole."'"));
            $ligne = mysqli_fetch_assoc($this->_template->get('result_ecole'));
            $ecole = $ligne["libelle"]; //
            $condec = "id_ecole = '" . $id_ecole . "'";//
            if ($annee == "-1") {
           // $annee = "TOUS";//
            $condition = $condec." AND ";//
            } else {
                $condition = "annee = '" . $annee . "' AND $condec AND ";//
            }
        }


    $reader = new PHPExcel_Reader_Excel5();
        
    //chargement du fichier modele
    $fichierModele = $reader->load($fichierModele);

    //recuperation du sheet modele
    $sheet_ImportUsers = $fichierModele->getSheet(0);
        $sheet_ImportUsers->setCellValue('A1',"MATRICULE");
        $sheet_ImportUsers->setCellValue('B1',"NOM");
        $sheet_ImportUsers->setCellValue('C1',"PRENOM");
        $sheet_ImportUsers->setCellValue('D1',"DATE DE NAISSANCE");
    $sheet_ImportUsers->setCellValue('E1',"ECOLE");
        $sheet_ImportUsers->setCellValue('F1',"TEL_ECOLE");
        
    //creation du fichier de sortie
    $writer = new PHPExcel();
        //PROVISOIRE
    /*"SELECT DISTINCT matricule,nom,prenom,date_naissance,libelle, libelle_long, tel_ecole FROM etudiants, ecoles WHERE $condition ecoles.id=etudiants.id_ecole AND etudiants.pp=0 AND photo!='' AND information_ok = '1' AND matricule!='010101' AND (carte='' or carte='TEMP') AND matricule NOT IN (select identifiant from et_exports_cartes where type='SCOPUS')  ORDER BY etudiants.matricule ASC";*/
        $requete_user = "SELECT DISTINCT matricule,nom,prenom,date_naissance,libelle, libelle_long, tel_ecole FROM etudiants, ecoles WHERE $condition ecoles.id=etudiants.id_ecole AND etudiants.pp=0 AND photo!='' AND matricule!='010101' AND (carte IS NULL or carte='' or carte='TEMP') AND matricule NOT IN (select identifiant from et_exports_cartes where type='SCOPUS')  ORDER BY etudiants.matricule ASC";
         
    // Requet 
        $this->set('result_user',$this->Carte->query($requete_user));
        
        $nbRes=mysqli_num_rows($this->_template->get('result_user'));
   
        if ($nbRes > 0 ){
    $NumLigne = 2;
                     
        // TRAITEMENT DES UTILISATEURS
    $NumLigne_user = 2;
        $sheet_ImportUsers->getColumnDimension('A')->setWidth(15); //en pouces
        $sheet_ImportUsers->getColumnDimension('B')->setWidth(30); //en pouces
        $sheet_ImportUsers->getColumnDimension('C')->setWidth(30); //en pouces
        $sheet_ImportUsers->getColumnDimension('D')->setWidth(70); //en pouces
        $files=array();
    while ($row = mysqli_fetch_assoc($this->_template->get('result_user'))) {

                $matricule=$row['matricule'];
                $path1='../public/js/photos/'.$matricule.'.jpg';
                $path1=realpath($path1);
                //echo $path;
                $path1 = str_replace('\\', '/', $path1);
                $path2='../public/js/photos/'.$matricule.'.jpeg';
                $path2=realpath($path2);
                //echo $path;
                $path2 = str_replace('\\', '/', $path2);

               

                if (file_exists($path1) || file_exists($path2)){



                $ecole=$row['libelle'];
                $mat=$row['matricule'];
                $date_naissance = ($row['date_naissance']);
                $date_naissance = substr($date_naissance, 0, 2) . '/' . substr($date_naissance, 2, 2). '/'.substr($date_naissance, 4, 4);
                $files[]="../public/js/photos/$mat.jpg";
                $files[]="../public/js/photos/$mat.jpeg";
                //echo dirname(__FILE__)."../public/js/photos/$mat.jpeg";
                
        //Import Users 
                $sheet_ImportUsers->setCellValueExplicit('A'.$NumLigne_user,$mat,PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet_ImportUsers->setCellValue('B'.$NumLigne_user,$row['nom']);
                $sheet_ImportUsers->setCellValue('C'.$NumLigne_user,$row['prenom']);
                $sheet_ImportUsers->setCellValueExplicit('D'.$NumLigne_user,$date_naissance,PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet_ImportUsers->setCellValue('E'.$NumLigne_user,$row['libelle_long']);
                $sheet_ImportUsers->setCellValue('F'.$NumLigne_user,$row['tel_ecole']);
                
                $reqinsert="INSERT INTO et_exports_cartes (identifiant, type, date) VALUES ('$mat','SCOPUS', CURDATE())";
                 $this->Carte->query($reqinsert);
                
                $NumLigne_user++;
                }
    }
        
    //ajout des feuilles sheet modele modifié au fichier de sortie
    $writer->addSheet($sheet_ImportUsers);
   // $date=date("d-m-Y");date("Y-m-d H:i:s");
    $date=date("d-m-Y-H-i-s");  
    $date2=date("d_m_Y");
    $dossier = "../public/js/Exports/".$date;
    if(!is_dir($dossier)){
       mkdir($dossier);
    }
    $fichierSortie =  $date2 .'-' . $ecole . '-' . $annee . '-Etudiants_SCOPUS.xls';
   
        
        
    //ecriture du fichier de sortiie
    $fichierSortie=str_replace(' ','',$fichierSortie);
    $writer->removeSheetByIndex(0);
    $sortie = new PHPExcel_Writer_Excel5($writer);
       
        //header('Content-type: application/vnd.ms-excel');
        //header("Content-Disposition: inline;filename=".$fichierSortie );
        header('Pragma: no-cache');
        header('Expires: 0');    
        $sortie->save($dossier."/".$fichierSortie);
        //$sortie->save('php://output');
        
        //GENERATION DU FICHIER ZIP AVEC LES PHOTOS
        $zip = create_zip($files,$dossier."/".$date2 ."-" . $ecole . "-" . $annee . "-Photos_SCOPUS.zip");
        $mess= "<font color=green> <b>Le fichier Excel a été exporté avec succès, il est disponnible <a href='".$dossier."/".$fichierSortie."'>ici</a></b></font><br/>";
        $mess.= "<font color=green> <b>Le fichier zip a été créé avec succès, il est disponnible <a href='".$dossier."/".$date2 ."-" . $ecole . "-" . $annee . "-Photos_SCOPUS.zip'>ici</a></b></font><br/>";
    }else{
                $mess= "<font color=red><b>Aucun étudiant à exporter</b></font>";
        }
        $this->set('mess',$mess);
        }

 




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

$this->set('result',$this->Carte->query("SELECT id, libelle FROM ecoles where id not in ('3','4','11','12','13','16')"));
$this->set('resultt',$this->Carte->query("SELECT id, libelle FROM ecoles  where id not in ('3','4','11','12','13','16')"));
$this->set('resulttt',$this->Carte->query("SELECT id, libelle FROM ecoles  where id not in ('3','4','11','12','13','16')"));

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

   $requete_user = "SELECT  matricule, nom, prenom, carte FROM etudiants WHERE $condition and (pp=0 or pp=3) and matricule!='01010101' ORDER BY matricule ASC";
   //$string.=$requete_user;
   $this->set('result1',$this->Carte->query($requete_user));
   
    $array = array();
$nb= mysqli_num_rows($this->_template->get('result1'));

    while($row = mysqli_fetch_array($this->_template->get('result1'))){
        $matricule=$row['matricule'];
        $nom=$row['nom'];
        $prenom=$row['prenom'];
        $carte=$row['carte'];



if($carte== "")  { $string.=  $matricule. " | ".$nom." ".$prenom."<br>";
$array[] = $row;
} else {
$requete_num = "SELECT  num_carte_gestion FROM cartes WHERE identifiant='$matricule'";
$this->set('rr',$this->Carte->query($requete_num));
$data = mysqli_fetch_assoc($this->_template->get('rr'));
$num_carte = $data['num_carte_gestion'];
if($carte == "PRO")  { $string.=  $matricule. " | ".$nom." ".$prenom."<font color=red> -> a déjà une carte professionnelle n°".$num_carte.".</font><br />";}
else if($carte == "DEF")   { $string.=  $matricule. " | ".$nom." ".$prenom."<font color=red> -> a déjà une carte définitive n°".$num_carte.".</font><br />";}
else if($carte== "TEMP")  { $string.=  $matricule. " | ".$nom." ".$prenom."<font color=red> -> a déjà une carte temporaire n°".$num_carte.".</font><br />";

}
}

}
$string.= '<br>il ya '.$nb.' étudiants<br>';
  $string.='<br><button class="btn btn-default" onClick="window.print()">Imprimer cette page</button><br>';
  $this->set('string',$string);
  $this->set('array',$array);


 // print_r($array);

}


if (isset($_POST['attribuer'])){
//$string.='hkggjkgjkg<br>';

$nb=count($array);
//print_r($array);
$string.= "vous allez attribuer des cartes temporaires a ".$nb." étudiants<br>";

foreach ($array as $row) {

    $matricule= $row['matricule'];

                            $this->set('req',$this->Carte->query("SELECT min(num_carte) AS RES FROM cartes WHERE identifiant='' AND defaillant=0"));
                            $data = mysqli_fetch_assoc($this->_template->get('req'));
                            $inter = $data['RES'];
                            
                            $reqUPD = "UPDATE cartes SET identifiant='$matricule', date_attribution=CURDATE(), date_retour='' WHERE num_carte='$inter'";
                            $this->Carte->query($reqUPD);
                            
                            $reqUPD = "UPDATE etudiants SET carte='TEMP' WHERE matricule='$matricule'";
                            $this->Carte->query($reqUPD);
                            
                            if($_SESSION['statut']==2){
                                $type_att="Attribution CFM";
                            }else{
                                $type_att="Attribution Ecole";
                            }
                            $datejour = date("Y-m-d H:i:s");
                            $op=$_SESSION['identifiant'];

                            $reqIN="INSERT into cartes_actions (num_carte, action, date, operateur, matricule) VALUES ('$inter','$type_att','$datejour','$op','$matricule')";
                            $this->Carte->query($reqIN);
                            
$string.= "<font color=green> l'attribution de la carte numéro ".$inter." pour l'étudiant ".$row['matricule']." | ".$prenom=$row['nom']." ".$prenom=$row['prenom']." a été réussie.</font><br />";



}

$this->set('string',$string);
}

}




function exportation_Agirh() {

 require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }


include ('../public/js/includes/fonctions.php');
include '../public/js/Classes/PHPExcel.php';
include '../public/js/Classes/PHPExcel/Writer/Excel5.php';
        

$this->set('result',$this->Carte->query("SELECT id, libelle FROM ecoles  where id not in ('3','4','11','12','13','16')"));
$this->set('resultt',$this->Carte->query("SELECT id, libelle FROM ecoles  where id not in ('3','4','11','12','13','16')"));


$fichierModele = "../public/js/modele.xls";
$montxt='';

  // Si envoi du formulaire
    if(isset($_POST['Exporter'])){
    $id_ecole=$_POST['id_ecole'];
        
    if (isset($_POST['annee'.$id_ecole]))
        $annee = $_POST['annee'.$id_ecole];   
        
        if ($id_ecole == "-1") {
       // $ecole = "TOUS";//
      //  $annee = "TOUS";//
        $condition ="";//
        } else {
            $this->set('result_ecole',$this->Carte->query("SELECT libelle FROM ecoles where id = '".$id_ecole."'"));
            $ligne = mysqli_fetch_assoc($this->_template->get('result_ecole'));
            $ecole = $ligne["libelle"]; //
            $condec = "id_ecole = '" . $id_ecole . "'";//
            if ($annee == "-1") {
           // $annee = "TOUS";//
            $condition = $condec." AND ";//
            } else {
                $condition = "annee = '" . $annee . "' AND $condec AND ";//
            }
        }


    /* echo "SELECT DISTINCT matricule,nom,prenom,date_naissance,libelle, libelle_long, tel_ecole FROM etudiants, ecoles WHERE $condition ecoles.id=etudiants.id_ecole AND etudiants.pp=0 AND photo!='' AND information_ok = '1' AND matricule!='010101' AND (carte='' or carte='TEMP') AND matricule NOT IN (select identifiant from et_exports_cartes where type='SCOPUS')  ORDER BY etudiants.identifiant ASC";*/

   /* echo "SELECT DISTINCT matricule, num_carte, num_puce FROM etudiants, cartes WHERE $condition etudiants.matricule=cartes.identifiant AND cartes.defaillant=0 AND matricule NOT IN (select identifiant from et_exports_cartes where type='AGIRH') ORDER BY etudiants.matricule ASC";*/

    $requete_user = "SELECT DISTINCT matricule, num_carte, num_puce FROM etudiants, cartes WHERE $condition etudiants.matricule=cartes.identifiant AND cartes.defaillant=0 AND matricule NOT IN (select identifiant from et_exports_cartes where type='AGIRH') ORDER BY etudiants.matricule ASC";

    $this->set('result_user',$this->Carte->query($requete_user));
        
    $nbRes=mysqli_num_rows($this->_template->get('result_user'));

        if ($nbRes > 0 ){
    $NumLigne = 2;

    // TRAITEMENT DES UTILISATEURS
    while ($row = mysqli_fetch_assoc($this->_template->get('result_user'))) {

        //Export Users 
        $montxt.= $row['matricule'] . "\t" . $row['num_carte'] . "\t" . $row['num_puce'] . "\r\n";
        $reqinsert="INSERT INTO et_exports_cartes (identifiant, type, date) VALUES ('".$row['matricule']."','AGIRH', CURDATE())";
        $this->Carte->query($reqinsert);
    }
    $date=date("d-m-Y");
    $date2=date("d_m_Y");
    $dossier = "../public/js/Exports/".$date;
    if(!is_dir($dossier)){
       mkdir($dossier);
    }
    $fichierSortie =  $date2 . '-' . $ecole . '-' . $annee . '-Import_cartes_AGIRH.txt';



    //ecriture du fichier de sortiie
    $fichierSortie = str_replace(' ', '', $fichierSortie);

    @unlink($fichierSortie);
    $fp = fopen($fichierSortie, "a+");
    file_put_contents($dossier . "/". $fichierSortie, $montxt);
    $mess = "Le fichier a bien été créé, il est accessible à l'adresse suivante: <a href='../public/js/Exports/$fichierSortie'>$fichierSortie</a>";
    }else{
    $mess= "<font color=red><b>Aucun étudiant à exporter</b></font>";
    }
     $this->set('mess',$mess);
}



}


function attrib_def(){

 require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }

$carteconc='';

if(isset($_GET['et'])){
    $id_et=$_GET['et'];
    $this->set('id_et',$id_et);
 
    $this->set('result',$this->Carte->query("SELECT et.matricule, et.nom, et.prenom, et.type_casq,et.carte FROM etudiants et WHERE matricule='$id_et'"));       
    while ($data = mysqli_fetch_object($this->_template->get('result')))
        {
            $nom=$data->nom;
            $prenom=$data->prenom;
            $et= $id_et." | ".$nom." ".$prenom;
            $this->set('et',$et);
        }
}


if(isset($_POST['attribuer_etudiant'])){
        
    $etudiant = $_POST['choix_utilisateur'];
     

    $reqUPD = "UPDATE etudiants SET carte='DEF' WHERE matricule='$etudiant'";
    $this->Carte->query($reqUPD);


}

}

function attrib_tempo_etudiant(){

 require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }


         $reqCart = "SELECT min(num_carte) AS num ,num_puce,num_carte_gestion FROM cartes WHERE identifiant='' AND defaillant=0";
    $this->set('exeCart',$this->Carte->query($reqCart));
    $rowCompS = mysqli_fetch_array($this->_template->get('exeCart'));
    $row = mysqli_num_rows($this->_template->get('exeCart'));
            if(($row == 0) || ($row == 1 && $rowCompS['num'] == NULL))  {$message = "<font color=red>Il n'y a plus de cartes en stock.</font>"; }
            else
            {
             $gestion1=$rowCompS['num_carte_gestion'];
             $info="première carte disponible: ".$gestion1."<br>";
             $reqCart = "SELECT min(num_carte) AS num ,num_puce,num_carte_gestion FROM cartes WHERE identifiant='' AND defaillant=0 AND num_carte_gestion!=$gestion1";
             $this->set('exeCart',$this->Carte->query($reqCart));
             $rowCompS = mysqli_fetch_array($this->_template->get('exeCart'));
             $row = mysqli_num_rows($this->_template->get('exeCart'));
            if(($row == 0) || ($row == 1 && $rowCompS['num'] == NULL))  {$message = "<font color=red>Il n'y a plus de cartes en stock.</font>"; }
            else
            {
             $gestion2=$rowCompS['num_carte_gestion'];
             $info.="deuxième carte disponible: ".$gestion2."<br>";
             $reqCart = "SELECT min(num_carte) AS num ,num_puce,num_carte_gestion FROM cartes WHERE identifiant='' AND defaillant=0 AND num_carte_gestion!=$gestion2 AND num_carte_gestion!=$gestion1";
             $this->set('exeCart',$this->Carte->query($reqCart));
             $rowCompS = mysqli_fetch_array($this->_template->get('exeCart'));
             $row = mysqli_num_rows($this->_template->get('exeCart'));
            if(($row == 0) || ($row == 1 && $rowCompS['num'] == NULL))  {$message = "<font color=red>Il n'y a plus de cartes en stock.</font>"; }
            else
            {
             $gestion=$rowCompS['num_carte_gestion'];
             $info.="troisieme carte disponible: ".$gestion."<br>";
            }
            }
            $this->set('info',$info);
            $this->set('gestion1',$gestion1);
            }

$carteconc='';

if(isset($_GET['et'])){
    $id_et=$_GET['et'];
    $this->set('id_et',$id_et);
 
    $this->set('result',$this->Carte->query("SELECT et.matricule, et.nom, et.prenom, et.type_casq,et.carte FROM etudiants et WHERE matricule='$id_et'"));       
    while ($data = mysqli_fetch_object($this->_template->get('result')))
        {
            $nom=$data->nom;
            $prenom=$data->prenom;
            $et= $id_et." | ".$nom." ".$prenom;
            $this->set('et',$et);
        }

}

$info="";
if(isset($_POST['attribuer_etudiant'])){
        
    $etudiant = $_POST['choix_utilisateur'];
    $this->set('execverif',$this->Carte->query("SELECT carte FROM etudiants WHERE matricule='$etudiant'"));
    $datav = mysqli_fetch_assoc($this->_template->get('execverif'));

   
        
        $hexdec = hexdec ($_POST['num_carte']);
        $reqCart = "SELECT num_carte AS num ,num_puce,num_carte_gestion FROM cartes WHERE (num_puce='".$hexdec."' or num_carte_gestion = '".$_POST['num_carte']."') AND identifiant='' AND defaillant=0";
     
        //echo $reqCart;
    $this->set('exeCart',$this->Carte->query($reqCart));
    $rowCompS = mysqli_fetch_array($this->_template->get('exeCart'));
    $row = mysqli_num_rows($this->_template->get('exeCart'));
            if(($row == 0) || ($row == 1 && $rowCompS['num'] == NULL))  {$message = "<font color=red>Il n'y a plus de cartes en stock.</font>"; }
            else
            {
                if($datav['carte'] == "PRO")    { $message = "<font color=red>Cet utilisateur a déjà une carte professionnelle.</font>";}
                else if($datav['carte'] == "DEF")   { $message = "<font color=red>Cet utilisateur a déjà une carte définitive.</font>";}
                else if($datav['carte'] == "TEMP")  { $message = "<font color=red>Cet utilisateur a déjà une carte temporaire.</font>";}
                else
                {
                    $carte = $rowCompS['num'];
                    $puce   =   $rowCompS['num_puce'];
                    $carteconc=$carte."-".$puce;
                    $gestion=$rowCompS['num_carte_gestion'];
                    //attribution d'une carte à l'étudiant, et mise à jour de la table cartes ];
                    
                    $reqUPD="UPDATE cartes SET identifiant='$etudiant', date_attribution=CURDATE(), date_retour='0000-00-00' WHERE num_carte='$carte'";
                    $this->Carte->query($reqUPD);
                    
                    $reqUPD = "UPDATE etudiants SET carte='TEMP' WHERE matricule='$etudiant'";
                    $this->Carte->query($reqUPD);
                    
                    if($_SESSION['statut']==2){
                        $type_att="Attribution CFM";
                    }else{
                        $type_att="Attribution Ecole";
                    }
                    $datejour = date("Y-m-d H:i:s");
                    $op=$_SESSION['identifiant'];
                    
                    $reqIN="INSERT into cartes_actions (num_carte, action, date, operateur, matricule) VALUES ('$carte','$type_att','$datejour','$op','$etudiant')";
                    $this->Carte->query($reqIN);
                    

                //    if(){                        
                        $reqinsert="INSERT INTO et_exports_cartes (identifiant, type, date) VALUES ('$etudiant','AGIRH', CURDATE())  ON DUPLICATE KEY UPDATE date=CURDATE()";
                        $this->Carte->query($reqinsert);
                  //  }
                    
                    if (preg_match('/MSIE/', $_SERVER["HTTP_USER_AGENT"])) {
                    $message = "<font color=green>Attribution réussie, le numéro de carte a été copié dans le presse papier, merci de le coller dans AGIRH.<br />Si la copie ne fonctionne pas, veuillez sélectionner le numéro de carte puis réaliser la condinaison des touches ctrl + c.</font>";
                    }else{
                    $message = "<font color=green>Attribution réussie,merci de copier le numéro de carte ci-dessous (sélectionner le texte puis réaliser la condinaison des touches ctrl + c ou clic droit -> Copier) et de le coller dans AGIRH.</font>";    
                    }
                     $message.="<br /><br /><br> matricule étudiant: ".$etudiant; 
                     $message.="<br /><br>".$carteconc."</b><br />(Numéro de gestion: ".$gestion.")"; 
                                             
                }
                 $this->set('message',$message);
                 $this->set('carteconc',$carteconc); 
            }



}


}

function perte_carte_definitive(){
error_reporting(0);
 require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }
$message="";
if (isset($_POST['bouton'])) {
  
    //mysqli_query($db,"SET NAMES UTF8");

    $etudiant = $_POST['choix_utilisateur'];
    
    //$first = explode(' ', $etudiant); //récupération de l'id de l'étudiant
    //$etudiant = $first[0];
    if ($etudiant != "") {

 
        $reqverif = "SELECT carte FROM etudiants WHERE matricule='$etudiant'";
        $this->set('execverif',$this->Carte->query($reqverif));
        $data = mysqli_fetch_array($this->_template->get('execverif'));
        $carte = $data['carte'];
        if ($carte == 'DEF') {//si l'utilisateur choisi possède déjà une carte

                //SELECTION DE LA DATE D'ANCIEN EXPORT SCOPUS POUR TRACABILITE
                $sqlt = "SELECT * FROM et_exports_cartes where identifiant='$etudiant' and type='SCOPUS'";
                $this->set('reqt',$this->Carte->query($sqlt));
                
                while ($donneest = mysqli_fetch_array($this->_template->get('reqt'))) {
                    $dateexport=$donneest['date'];
                }
                $dateexport = date_format(date_create($dateexport), 'd/m/Y');
                $reqINS = "INSERT INTO cartes_pertes (id_user,type_carte,date,commentaire) VALUES('$etudiant','DEF',CURDATE(),'Anciennement commandée le ".$dateexport."')";
                $this->Carte->query($reqINS);
                
                //ON SUPPRIME LA LIGNE DE LA TABLE DES CARTES EXPORTEES POUR SCOPUS AFIN QUE LA CARTE SOIR REEXPORTEE LORS DE LA PROCHAINE COMMANDE
                $sql="DELETE FROM et_exports_cartes where identifiant='$etudiant' and type='SCOPUS'";
                $this->Carte->query($sql);
                
                
                $reqUPD = "UPDATE etudiants SET carte=DEFAULT WHERE matricule='$etudiant'";
                $this->Carte->query($reqUPD);
                
                $reqUPD = "UPDATE etudiants_archive SET carte=DEFAULT WHERE matricule='$etudiant'";
                $this->Carte->query($reqUPD);
                
                
            $message = "<font color=green>La perte de la carte définitive pour cet étudiant(e) a bien été prise en compte.</font><br /><a href='attrib_tempo_etudiant?et=".$etudiant."'>-->Attribuer une carte temporaire à cet étudiant<--</a>";
        } else {//s'il ne possède pas de carte
            $message = "<font color=red>Erreur : cet utilisateur n'a pas de carte définitive.</font>";
        }
    } else {
        $message = "<font color=red>Erreur : Vous n'avez pas choisi d'étudiant.</font>";
    }
 $this->set('message',$message);   
}



}


function retour_cartes_tempo(){

error_reporting(0);
 require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    case 3: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }

    if(isset($_GET['finsco'])){
    $finsco=$_GET['finsco'];
    }

if ($_SESSION['statut'] != 2 && $finsco!=1) {$check='checked=checked';}

$this->set('finsco',$finsco); 
$this->set('check',$check); 

if (isset($_POST['bouton'])) {
    $defaillant = $_POST['defaillant'];
    $perdu = $_POST['perdu1'];



    $cartedef = $_POST['cartedef'];
    if (isset($defaillant)) {
        $defaillant = 1;
    } else if (isset($perdu)) {
        $defaillant = 2;
    } else {
        $defaillant = 0;
    }
    
    //mysqli_query($db,"SET NAMES UTF8");

    $etudiant = $_POST['choix_utilisateur'];
    
    //$first = explode(' ', $etudiant); //récupération de l'id de l'étudiant
    //$etudiant = $first[0];




    if ($etudiant != "") {
        $reqverif = "SELECT id_ecole FROM etudiants WHERE matricule='$etudiant'";
        $this->set('execverifa',$this->Carte->query($reqverif));
        $data_ecole = mysqli_fetch_assoc($this->_template->get('execverifa'));
        $id_ecole = $data_ecole['id_ecole'];
        $reqverif = "SELECT libelle FROM ecoles WHERE id='$id_ecole'";
        $this->set('execverifaa',$this->Carte->query($reqverif));
        $data_ecole = mysqli_fetch_assoc($this->_template->get('execverifaa'));
        $nom_ecole = $data_ecole['libelle'];
        $reqverif = "SELECT num_carte,num_carte_gestion FROM cartes WHERE identifiant='$etudiant'";
        $this->set('execverif',$this->Carte->query($reqverif));
        $data = mysqli_fetch_assoc($this->_template->get('execverif'));
        $carte = $data['num_carte'];
        $carte_gestion = $data['num_carte_gestion'];
        if ($carte <> '') {//si l'utilisateur choisi possède déjà une carte
            if ($_SESSION['statut'] == 2) {
                $type_att = "Retour CFM";
                //retour de la carte de l'étudiant, et mise à jour de la table cartes
                $reqUPD = "UPDATE cartes SET identifiant='', date_retour=CURDATE(), defaillant=$defaillant WHERE identifiant='$etudiant'";
                $this->Carte->query($reqUPD);
                
                if(isset($perdu)){
                $motif_perte = $_POST['perdu_options1'];    
                $reqINS = "INSERT INTO cartes_pertes (id_user,type_carte,date,commentaire,motif) VALUES('$etudiant','$carte_gestion',CURDATE(),'','$motif_perte')";
                $this->Carte->query($reqINS);
                }
                
                $reqUPD = "UPDATE etudiants SET carte=DEFAULT WHERE matricule='$etudiant'";
                $this->Carte->query($reqUPD);
                
                $reqUPD = "UPDATE etudiants_archive SET carte=DEFAULT WHERE matricule='$etudiant'";
                $this->Carte->query($reqUPD);
                
            } else {
                 $reqUPD = "UPDATE cartes SET identifiant='$nom_ecole', date_retour=CURDATE() WHERE num_carte_gestion=' $carte_gestion'";
                $this->Carte->query($reqUPD);
                $type_att = "Retour Ecole";
            }
            $datejour = date("Y-m-d H:i:s");
            $op = $_SESSION['identifiant'];

            $reqIN = "INSERT into cartes_actions (num_carte, action, date, operateur, matricule) VALUES ('$carte','$type_att','$datejour','$op','$etudiant')";
            $this->Carte->query($reqIN);

            if(isset($cartedef)){
            $requpdt="UPDATE etudiants set carte='DEF' WHERE matricule = '$etudiant'";
            $this->Carte->query($requpdt);
            }
                
            $message = "<font color=green>Retour carte $carte_gestion réussi.</font>";
        } else {//s'il ne possède pas de carte
            $message = "<font color=red>Erreur : cet utilisateur n'a pas de carte provisoire.</font>";
        }
    } else {
        $message = "<font color=red>Erreur : Vous n'avez pas choisi d'étudiant.</font>";
    }
$this->set('message',$message);    
}



if (isset($_POST['bouton2'])) {
    $defaillant = $_POST['defaillant'];
    $perdu = $_POST['perdu2'];



    $cartedef = $_POST['cartedef'];
    if (isset($defaillant)) {
        $defaillant = 1;
    } else if (isset($perdu)) {
        $defaillant = 2;
    } else {
        $defaillant = 0;
    }

    //mysqli_query($db,"SET NAMES UTF8");



    /*
 $this->set('reqt',$this->Carte->query($sqlt));
                
                while ($donneest = mysqli_fetch_array($this->_template->get('reqt')))
*/

    $carte = $_POST['num_carte'];
    if ($carte != "") {
        if(substr($carte,0,1)=="X"){
            $carte=substr($carte,1);
            $hexdec = str_pad(hexdec($carte), 10, "0", STR_PAD_LEFT);
            $reqverif = "SELECT num_carte,num_carte_gestion FROM cartes WHERE num_puce = '$hexdec'";
        }else{
            $reqverif = "SELECT num_carte,num_carte_gestion FROM cartes WHERE num_carte_gestion = '$carte'";
        }
        //echo $carte." ";
        
        //echo $hexdec;
        //echo $reqverif ; 
        $this->set('execverif',$this->Carte->query($reqverif));
        $data = mysqli_fetch_assoc($this->_template->get('execverif'));
        $numcarte = $data['num_carte'];
        $carte_gestion = $data['num_carte_gestion'];
        if ($numcarte <> '') {//si la carte existe
            $reqverif2 = "SELECT identifiant FROM cartes WHERE num_carte = '$numcarte'";
            $this->set('req',$this->Carte->query($reqverif2));
            $data2 = mysqli_fetch_assoc($this->_template->get('req'));
            $etudiant = $data2['identifiant'];
        $reqverif = "SELECT id_ecole FROM etudiants WHERE matricule='$etudiant'";
        $this->set('execverifa',$this->Carte->query($reqverif));
        $data_ecole = mysqli_fetch_assoc($this->_template->get('execverifa'));
        $id_ecole = $data_ecole['id_ecole'];
        $reqverif = "SELECT libelle FROM ecoles WHERE id='$id_ecole'";
        $this->set('execverifaa',$this->Carte->query($reqverif));
        $data_ecole = mysqli_fetch_assoc($this->_template->get('execverifaa'));
        $nom_ecole = $data_ecole['libelle'];
            if ($etudiant <> ''&& $nom_ecole!='') {//si la carte est déjà attribuée
                if ($_SESSION['statut'] == 2) {
                    $type_att = "Retour CFM";
                    //retour de la carte de l'étudiant, et mise à jour de la table cartes
                    $reqUPD = "UPDATE cartes SET identifiant='', date_retour=CURDATE(), defaillant=$defaillant WHERE num_carte='$numcarte'";
                    $this->Carte->query($reqUPD);
                    
                    $reqUPD = "UPDATE etudiants SET carte=DEFAULT WHERE matricule='$etudiant'";
                    $this->Carte->query($reqUPD);
                    
                    if(isset($perdu)){
                    $motif_perte = $_POST['perdu_options2']; 
                    $reqINS = "INSERT INTO cartes_pertes (id_user,type_carte,date,commentaire,motif) VALUES('$etudiant','$carte_gestion',CURDATE(),'','$motif_perte')";
                    $this->Carte->query($reqINS);
                    }
                    
                    $reqUPD = "UPDATE etudiants_archive SET carte=DEFAULT WHERE matricule='$etudiant'";
                    $this->Carte->query($reqUPD);
                    
                } else {
                     $reqUPD = "UPDATE cartes SET identifiant='$nom_ecole', date_retour=CURDATE() WHERE num_carte_gestion=' $carte_gestion'";
                $this->Carte->query($reqUPD);
                    $type_att = "Retour Ecole";
                }
                $datejour = date("Y-m-d H:i:s");
                $op = $_SESSION['identifiant'];

                $reqIN = "INSERT into cartes_actions (num_carte, action, date, operateur, matricule) VALUES ('$numcarte','$type_att','$datejour','$op','$etudiant')";
                $this->Carte->query($reqIN);

                if(isset($cartedef)){
                $requpdt="UPDATE etudiants set carte='DEF' WHERE matricule = '$etudiant'";
                $this->Carte->query($requpdt);
                }
                
                $message2 = "<font color=green>Retour carte $carte_gestion réussi.</font>";
            } else { //Si la carte n'est pas attribuée
                $message2 = "<font color=red>Erreur retour: la carte $carte_gestion n'est pas attribuée.</font>";
            }
        } else {//si la carte n'existe pas
            $message2 = "<font color=red>Erreur retour: la carte $carte_gestion n'existe pas.</font>";
        }
    } else {
        $message2 = "<font color=red>Erreur retour: Vous n'avez pas renseigné le numéro de carte à retourner.</font>";
    }
$this->set('message2',$message2);     
}



}


function retour_carte_definitive(){

 require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    case 3: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }



if (isset($_POST['bouton'])) {
   
    
    //mysqli_query($db,"SET NAMES UTF8");

    $etudiant = $_POST['choix_utilisateur'];


    
    //$first = explode(' ', $etudiant); //récupération de l'id de l'étudiant
    //$etudiant = $first[0];
    if ($etudiant != "") {
        $reqverif = "SELECT * FROM etudiants WHERE matricule='$etudiant' AND carte='DEF'";
         $this->set('reqt',$this->Carte->query($reqverif));
         $execverif = mysqli_fetch_assoc($this->_template->get('reqt'));
        $nb = mysqli_num_rows($this->_template->get('reqt'));
        if ($nb !=0) {//si l'utilisateur choisi possède bien une carte définitive
            if ($_SESSION['statut'] == 2) {
                $type_att = "Retour CFM";
                //retour de la carte de l'étudiant, et mise à jour de la table cartes
                
                $reqUPD = "UPDATE etudiants SET carte=DEFAULT WHERE matricule='$etudiant'";
                $this->Carte->query($reqUPD);
                
                $reqUPD = "UPDATE etudiants_archive SET carte=DEFAULT WHERE matricule='$etudiant'";
                $this->Carte->query($reqUPD);
                
            } else {
                $type_att = "Retour Ecole";
            }
            $datejour = date("Y-m-d H:i:s");
            $op = $_SESSION['identifiant'];

            $reqIN = "INSERT into cartes_actions (num_carte, action, date, operateur, matricule) VALUES ('DEF','$type_att','$datejour','$op','$etudiant')";
            $this->Carte->query($reqIN);
                
            $message = "<font color=green>Retour carte définitive réussi.</font>";
        } else {//s'il ne possède pas de carte définitive
            $message = "<font color=red>Erreur : cet utilisateur n'a pas de carte définitive attribuée.</font>";
        }
    } else {
        $message = "<font color=red>Erreur : Vous n'avez pas choisi d'étudiant.</font>";
    }
    $this->set('message',$message); 
}
}
function historiques(){
    
    error_reporting(0);
 require_once('../public/js/includes/verification.php');
    switch ($_SESSION['statut']) {
    case 2: break;
    case 3: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
    }

   


if (isset($_POST['bouton'])) {
  
    
    //mysqli_query($db,"SET NAMES UTF8");

    $etudiant = $_POST['choix_utilisateur'];
    
    //$first = explode(' ', $etudiant); //récupération de l'id de l'étudiant
    //$etudiant = $first[0];

    if ($etudiant != "") {
        $req = "SELECT * FROM cartes_actions WHERE matricule='$etudiant'";
        $this->set('req',$this->Carte->query($req));
        $nb = mysqli_num_rows($this->_template->get('req'));
        if ($nb !=0) {  
        while($data = mysqli_fetch_assoc($this->_template->get('req'))){
       
        //si l'utilisateur choisi possède déjà une carte
         $num_carte = $data['num_carte'];
        $action = $data['action'];
        $date = $data['date'];
        $operateur = $data['operateur'];
        $matricule = $data['matricule']; 
        $reqverifc = "SELECT num_carte_gestion FROM cartes WHERE num_carte='$num_carte'";
        $this->set('reqc',$this->Carte->query($reqverifc));
        $data3 = mysqli_fetch_assoc($this->_template->get('reqc'));
        $num_carte_gestion = $data3['num_carte_gestion'];
        $message.= "<font color=green>(".$etudiant.")La carte ".$num_carte_gestion.":".$action." ".$date." par ".$operateur.".</font><br>";
           // $message = "<font color=green>La carte ".$num_carte_gestion.".""..</font>";
        }
        } else {//s'il ne possède pas de carte
            $message = "<font color=red>Erreur : cet utilisateur n'a pas d'historique.</font>";
      
       } 
    }      
    else {
        $message = "<font color=red>Erreur : Vous n'avez pas choisi d'étudiant.</font>";
    }
$this->set('message',$message);    


}

if (isset($_POST['bouton2'])) {


    //mysqli_query($db,"SET NAMES UTF8");



    /*
 $this->set('reqt',$this->Carte->query($sqlt));
                
                while ($donneest = mysqli_fetch_array($this->_template->get('reqt')))
*/

    $carte = $_POST['num_carte'];
    if ($carte != "") {
        if(substr($carte,0,1)=="X"){
            $carte=substr($carte,1);
            $hexdec = str_pad(hexdec($carte), 10, "0", STR_PAD_LEFT);
            $reqverif = "SELECT num_carte,num_carte_gestion FROM cartes WHERE num_puce = '$hexdec'";
        }else{
            $reqverif = "SELECT num_carte,num_carte_gestion FROM cartes WHERE num_carte_gestion = '$carte'";
        }
        //echo $carte." ";
        
        //echo $hexdec;
        //echo $reqverif ; 
        $this->set('execverif',$this->Carte->query($reqverif));
        $data = mysqli_fetch_assoc($this->_template->get('execverif'));
        $num_carte = $data['num_carte'];
        $carte_gestion = $data['num_carte_gestion'];
    if ($num_carte != "") {
        $req = "SELECT * FROM cartes_actions WHERE num_carte='$num_carte'";
        $this->set('req',$this->Carte->query($req));
        $nb = mysqli_num_rows($this->_template->get('req'));
        if ($nb !=0) {  
        while($data = mysqli_fetch_assoc($this->_template->get('req'))){
       
        //si l'utilisateur choisi possède déjà une carte
         $num_carte = $data['num_carte'];
        $action = $data['action'];
        $date = $data['date'];
        $operateur = $data['operateur'];
        $matricule = $data['matricule']; 
        $reqverifc = "SELECT num_carte_gestion FROM cartes WHERE num_carte='$num_carte'";
        $this->set('reqc',$this->Carte->query($reqverifc));
        $data3 = mysqli_fetch_assoc($this->_template->get('reqc'));
        $num_carte_gestion = $data3['num_carte_gestion'];
        $message2.= "<font color=green>La carte ".$num_carte_gestion.":".$action." ".$date." par ".$operateur." pour l'étudiant ".$matricule."</font><br>";
           // $message = "<font color=green>La carte ".$num_carte_gestion.".""..</font>";
        }
        } else {//s'il ne possède pas de carte
            $message2 = "<font color=red>Erreur : cet utilisateur n'a pas d'historique.</font>";
      
       } 
    } else {//si la carte n'existe pas
            $message2 = "<font color=red>Erreur retour: la carte $carte_gestion n'existe pas.</font>";
        }
    } else {
        $message2 = "<font color=red>Erreur retour: Vous n'avez pas renseigné le numéro de carte à retourner.</font>";
    }
$this->set('message2',$message2);     
}



    


}











}

?>
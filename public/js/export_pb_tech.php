<?php
require_once('includes/connexion.php');
require_once('includes/alias_tables.php');
error_reporting(0);
	include 'Classes/PHPExcel.php';
	include 'Classes/PHPExcel/Writer/Excel5.php';

	// Fichier model depuis lequel on recupere les entetes des colonnes et les feuilles dont on a besoin.
	$fichierModele = 'modele.xls';
        
        //STYLES
        //pour des styles de police, les bordures,etc..., je les d�clare en d�but de document sous forme de tableau pour les r�utiliser par la suite :)
        //array de configuration des bordures
        
$sharedStyle1 = new PHPExcel_Style();
$centrer = new PHPExcel_Style();
$centrergras = new PHPExcel_Style();

$sharedStyle1->applyFromArray(
	array('fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
								'color'		=> array('argb' => 'FFCCFFCC')
							),
		  'borders' => array(
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                                                'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'left'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
							)
		 ));

$centrer->applyFromArray(array('alignment'=>array(
       'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true)));

$centrergras->applyFromArray(
        array('alignment'=>array(
                                                                'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                                'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true),
       'font' => array(
        'bold' => true
        )
            ));

//$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "A1:T100");
//$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, "C5:R95");
        
//$bordersarray = new PHPExcel_Style();
//        $gras = new PHPExcel_Style();
//        $center = new PHPExcel_Style();
//        $left = new PHPExcel_Style();
//        $souligner = new PHPExcel_Style();
//        $bordersarray->applyFromArray(array(
//        'borders'=>array(
//        'top'=>array(
//        'style'=>PHPExcel_Style_Border::BORDER_THIN),
//        'left'=>array(
//        'style'=>PHPExcel_Style_Border::BORDER_THIN),
//        'right'=>array(
//        'style'=>PHPExcel_Style_Border::BORDER_THIN),
//        'bottom'=>array(
//        'style'=>PHPExcel_Style_Border::BORDER_THIN))));
//        //array de configuration des polices
//        //pour mettre en gras
//        $gras->applyFromArray(array('font' => array(
//        'bold' => true
//        )));
//        //on centre verticalement et horizontalement
//        $center->applyFromArray(array('alignment'=>array(
//        'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
//        'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER)));
//        //pour aligner � gauche
//        $left->applyFromArray(array('alignment'=>array(
//        'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT)));
//        //pour souligner
//        $souligner->applyFromArray(array('font' => array(
//        'underline' => PHPExcel_Style_Font::UNDERLINE_DOUBLE
//        )));
//        $sheet->getStyle('A')->applyFromArray($gras);
//$sheet->getStyle('A')->applyFromArray($center);
//$sheet->getStyle('B1:G8')->applyFromArray($left);
	
	$reader = new PHPExcel_Reader_Excel5();
	//chargement du fichier modele
	$fichierModele = $reader->load($fichierModele);

	//recuperation du sheet modele
	$sheet = $fichierModele->getSheetByName('Feuil1');
	//$sheet_Aruba = $fichierModele->getSheetByName('Aruba');
	
	//creation du fichier de sortie
	$writer = new PHPExcel();
            $NumLigne = 1;
            //echo $moins;
            $sheet->getColumnDimension('A')->setWidth(15); //en pouces
            $sheet->getColumnDimension('B')->setWidth(90); //en pouces
            $sheet->getColumnDimension('C')->setWidth(15); //en pouces
            $sheet->setCellValue('A'.$NumLigne,iconv("ISO-8859-1//TRANSLIT","UTF-8","PLATEFORME"));
            $sheet->setCellValue('B'.$NumLigne,iconv("ISO-8859-1//TRANSLIT","UTF-8","PROBLEME"));
            $sheet->setCellValue('C'.$NumLigne,iconv("ISO-8859-1//TRANSLIT","UTF-8","ETAT (0:rien ; 1:récurent ; 2:ancien récurent)"));
            $sheet->setSharedStyle($centrer, "A$NumLigne:I$NumLigne");
            $sheet->getRowDimension($NumLigne)->setRowHeight(-1);
            $NumLigne++;
            
$id_ecole=$_GET['id_ecole'];
$annee=$_GET['annee'];
$cfps=$_GET['cfps'];


$et="";
$condet="";
if($cfps==0){
$user="étudiants";
$sql = "SELECT matricule AS id FROM etudiants
";
    $req = mysqli_query($db,$sql);
    while ($donnees = mysqli_fetch_array($req)) {
        $taball_et[] = $donnees['id'];
    }
if($id_ecole!=""&&$id_ecole!="0"){$et=", etudiants
 et"; $condet.=" AND itu.id_users = et.matricule";$and_ec=" AND id_ecole = $id_ecole";}
if($annee!=""&&$annee!="A0"){$et=", etudiants
 et";$condet.=" AND itu.id_users = et.matricule";$and_an=" AND annee = '$annee'";}
$like = " IN('" . implode("','", $taball_et) . "')";
}else{
$user="agents";
  $sql = "SELECT matricule AS id FROM agents
";
    $req = mysqli_query($db,$sql);
    while ($donnees = mysqli_fetch_array($req)) {
        $taball_ag[] = $donnees['id'];
    } 
$infos=" ,ag.nom as usernom,ag.prenom as userprenom,ag.uf,ag.pole,d.detail,d.mode,t.prenom as techprenom";
$et=", $tableagent ag,$tabledepa d,$tabletech t";
$condet=" AND itu.id_users=ag.matricule AND itu.id=d.id_incidents_to_users AND d.id_tech=t.id";
if($id_ecole!=""&&$id_ecole!="0"){$et=", agents
 ag"; $condet.=" AND itu.id_users = ag.matricule";$and_ec=" AND pole = '$pole'";}
if($annee!=""&&$annee!="A0"){$et=", agents
 ag";$condet.=" AND itu.id_users = ag.matricule";$and_an=" AND uf = '$uf'";} 
$like = " IN('" . implode("','", $taball_ag) . "')";
}
    $sql="SELECT itu.id,incidents.probleme,incidents.statut,$tablepla.libelle".$infos."
    FROM $tableincidusers itu, $tableincidents, $tablepla".$et."
    WHERE `id_users` ".$like."
    AND `id_etat` ='3'
    AND itu.id_incidents=incidents.id 
    AND itu.commentaire NOT LIKE '%par utilisateur%'
    AND itu.commentaire NOT LIKE '%relance infructueuse%'
    AND incidents.id_plateforme=plateforme.id
    ".$condet.$and_ec.$and_an."
    ORDER BY statut ASC, libelle ASC";
    $req = mysqli_query($db,$sql)or die(mysqli_error($db));
    while ($donnees=mysqli_fetch_array($req))
    {
        $tabid[]=$donnees['id'];
        $pb=html_entity_decode($donnees['probleme']);
        $statut=$donnees['statut'];
        $pla=strtoupper($donnees['libelle']);
        $sheet->setCellValue('A'.$NumLigne,iconv("ISO-8859-1//TRANSLIT","UTF-8",$pla));
        $sheet->setCellValue('B'.$NumLigne,iconv("ISO-8859-1//TRANSLIT","UTF-8",$pb));
        $sheet->setCellValue('C'.$NumLigne,iconv("ISO-8859-1//TRANSLIT","UTF-8",$statut));
        if($cfps==1){
        $nom=$donnees['usernom'];
        $prenom=$donnees['userprenom'];
        $pole=$donnees['pole'];
        $uf=$donnees['uf'];
        $nmtech=$donnees['techprenom'];
        $detail=$donnees['detail'];
        $mode=$donnees['mode'];
        $sheet->setCellValue('D1',iconv("ISO-8859-1//TRANSLIT","UTF-8","Détail"));
        $sheet->setCellValue('E1',iconv("ISO-8859-1//TRANSLIT","UTF-8","Mode"));
        $sheet->setCellValue('F1',iconv("ISO-8859-1//TRANSLIT","UTF-8","Tech"));
        $sheet->setCellValue('G1',iconv("ISO-8859-1//TRANSLIT","UTF-8","Nom Prénom"));
        $sheet->setCellValue('H1',iconv("ISO-8859-1//TRANSLIT","UTF-8","Pôle"));
        $sheet->setCellValue('I1',iconv("ISO-8859-1//TRANSLIT","UTF-8","UF"));
        $sheet->setCellValue('D'.$NumLigne,iconv("ISO-8859-1//TRANSLIT","UTF-8",$detail));
        $sheet->setCellValue('E'.$NumLigne,iconv("ISO-8859-1//TRANSLIT","UTF-8",$mode));
        $sheet->setCellValue('F'.$NumLigne,iconv("ISO-8859-1//TRANSLIT","UTF-8",$nmtech));
        $sheet->setCellValue('G'.$NumLigne,iconv("ISO-8859-1//TRANSLIT","UTF-8",$nom." ".$prenom));
        $sheet->setCellValue('H'.$NumLigne,iconv("ISO-8859-1//TRANSLIT","UTF-8",$pole));
        $sheet->setCellValue('I'.$NumLigne,iconv("ISO-8859-1//TRANSLIT","UTF-8",$uf));
        $sheet->getColumnDimension('D')->setWidth(35); //en pouces
        $sheet->getColumnDimension('E')->setWidth(10); //en pouces
        $sheet->getColumnDimension('F')->setWidth(10); //en pouces
        $sheet->getColumnDimension('G')->setWidth(25); //en pouces
        $sheet->getColumnDimension('H')->setWidth(15); //en pouces
        $sheet->getColumnDimension('I')->setWidth(15); //en pouces
        $sheet->setSharedStyle($centrergras, "A$NumLigne:I$NumLigne");
        $sheet->getRowDimension($NumLigne)->setRowHeight(-1);
        }
        $NumLigne++;
    }
            
        //ajout des feuilles sheet modele modifi� au fichier de sortie
        $writer->addSheet($sheet);
        //OBLIGATOIRE POUR QUE LES STYLES DES AUTRES FEUILLES S'APPLIQUENT
        $writer->getSheet(0)->setSharedStyle($centrergras, "A1:F1");
        $writer->getSheet(0)->setSharedStyle($centrer, "A1:F1");
	//ecriture du fichier de sortie
       	$fichierSortie="Detail_problemes.xls";
//        $chemin="upload/gesform/suivi/";
	$writer->removeSheetByIndex(0);
	$sortie = new PHPExcel_Writer_Excel5($writer);
//	$sortie->save($chemin.$fichierSortie.".xls"); 
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: inline;filename=".$fichierSortie );
        header('Pragma: no-cache');
        header('Expires: 0');
        
        $sortie->save('php://output');
        ?>

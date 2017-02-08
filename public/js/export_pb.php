<?php
require_once('includes/verification.php'); 
require_once('includes/connexion.php');
require_once('includes/alias_tables.php');
error_reporting(0);
include 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel5.php';

// Fichier model depuis lequel on recupere les entetes des colonnes et les feuilles dont on a besoin.
$fichierModele = 'modele.xls';

//STYLES
//pour des styles de police, les bordures,etc..., je les déclare en début de document sous forme de tableau pour les réutiliser par la suite :)
//array de configuration des bordures

$sharedStyle1 = new PHPExcel_Style();
$centrer = new PHPExcel_Style();
$centrergras = new PHPExcel_Style();

$sharedStyle1->applyFromArray(
        array('fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('argb' => 'FFCCFFCC')
            ),
            'borders' => array(
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
            )
));

$centrer->applyFromArray(array('alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true)));

$centrergras->applyFromArray(
        array('alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true),
            'font' => array(
                'bold' => true
            )
));

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
$sheet->setCellValue('E' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", "PLATEFORME"));
$sheet->setCellValue('F' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", "PROBLEME"));
$sheet->setSharedStyle($centrer, "A$NumLigne:I$NumLigne");
$sheet->getRowDimension($NumLigne)->setRowHeight(-1);
$NumLigne++;

$id_ecole = $_GET['id_ecole'];
$annee = $_GET['annee'];
$cfps = $_GET['cfps'];
$dtdebut = $_GET['dtdeb'];
$dtfin = $_GET['dtfin'];

$et = "";
$condet = "";
if ($cfps == 0) {
    $user = "étudiants";
    $sql = "SELECT matricule AS id FROM etudiants
";
    $req = mysqli_query($db,$sql);
    while ($donnees = mysqli_fetch_array($req)) {
        $taball_et[] = $donnees['id'];
    }
    $et = ", $tableetud et,$tabledepa d,$tabletech t";
    $condet.=" AND itu.id_users = et.matricule AND itu.id=d.id_incidents_to_users AND d.id_tech=t.id";
    if ($id_ecole != "" && $id_ecole != "0") {
        $and_ec = " AND id_ecole = $id_ecole";
    }
    if ($annee != "" && $annee != "A0") {
        $and_an = " AND annee = '$annee'";
    }
    $like = " IN('" . implode("','", $taball_et) . "')";
    $infos = " ,et.nom as usernom,et.prenom as userprenom,et.annee as userannee,d.detail,d.mode,t.prenom as techprenom";
} else {
    $user = "agents";
    $sql = "SELECT matricule AS id FROM agents
";
    $req = mysqli_query($db,$sql);
    while ($donnees = mysqli_fetch_array($req)) {
        $taball_ag[] = $donnees['id'];
    } 
    $infos = " ,ag.nom as usernom,ag.prenom as userprenom,ag.uf,ag.pole,d.detail,d.mode,t.prenom as techprenom";
    $et = ", $tableagent ag,$tabledepa d,$tabletech t";
    $condet = " AND itu.id_users=ag.matricule AND itu.id=d.id_incidents_to_users AND d.id_tech=t.id";
    if ($id_ecole != "" && $id_ecole != "0") {
        $et = ", agents
 ag";
        $condet.=" AND itu.id_users = ag.matricule";
        $and_ec = " AND pole = '$pole'";
    }
    if ($annee != "" && $annee != "A0") {
        $et = ", agents
 ag";
        $condet.=" AND itu.id_users = ag.matricule";
        $and_an = " AND uf = '$uf'";
    }
   $like = " IN('" . implode("','", $taball_ag) . "')";
}
if ($dtdebut != "") {
    $dtdeb = " AND itu.date > '$dtdebut'";
}
if ($dtfin != "") {
    $dtf = " AND itu.date < '$dtfin'";
}
$sql = "SELECT itu.id,incidents.probleme,incidents.statut,$tablepla.libelle" . $infos . "
    FROM $tableincidusers itu, $tableincidents, $tablepla" . $et . "
    WHERE `id_users` " . $like . "
    AND `id_etat` ='3'
    AND itu.id_incidents=incidents.id
    AND incidents.id_plateforme=plateforme.id
    " . $condet . $and_ec . $and_an . $dtdeb . $dtf ."
    ORDER BY statut ASC, libelle ASC";
//echo $sql;
$req = mysqli_query($db,$sql) or die(mysqli_error($db));
$sheet->setCellValue('A1', iconv("ISO-8859-1//TRANSLIT", "UTF-8", "ID problème"));
if ($cfps == 0) {
    $sheet->setCellValue('B1', iconv("ISO-8859-1//TRANSLIT", "UTF-8", "Nom"));
    $sheet->setCellValue('C1', iconv("ISO-8859-1//TRANSLIT", "UTF-8", "Prénom"));
    $sheet->setCellValue('D1', iconv("ISO-8859-1//TRANSLIT", "UTF-8", "Année"));
} else {
    $sheet->setCellValue('B1', iconv("ISO-8859-1//TRANSLIT", "UTF-8", "Nom Prénom"));
    $sheet->setCellValue('C1', iconv("ISO-8859-1//TRANSLIT", "UTF-8", "Pôle"));
    $sheet->setCellValue('D1', iconv("ISO-8859-1//TRANSLIT", "UTF-8", "UF"));
}
$sheet->setCellValue('E1', iconv("ISO-8859-1//TRANSLIT", "UTF-8", "Plateforme"));
$sheet->setCellValue('F1', iconv("ISO-8859-1//TRANSLIT", "UTF-8", "Problème"));
$sheet->setCellValue('G1', iconv("ISO-8859-1//TRANSLIT", "UTF-8", "Détail"));
$sheet->setCellValue('H1', iconv("ISO-8859-1//TRANSLIT", "UTF-8", "Mode"));
$sheet->setCellValue('I1', iconv("ISO-8859-1//TRANSLIT", "UTF-8", "Tech"));
while ($donnees = mysqli_fetch_array($req)) {
    $idpb = $donnees['id'];
    $pb = html_entity_decode($donnees['probleme']);
    $pla = strtoupper($donnees['libelle']);
    $sheet->setCellValue('A' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", $idpb));
    $nom = $donnees['usernom'];
    $prenom = $donnees['userprenom'];
    $nmtech = $donnees['techprenom'];
    $detail = $donnees['detail'];
    $mode = $donnees['mode'];
    if ($cfps == 0) {
        $annee = $donnees['userannee'];
        $sheet->setCellValue('B' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", $nom));
        $sheet->setCellValue('C' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", $prenom));
        $sheet->setCellValue('D' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", $annee));
    } else {
        $pole = $donnees['pole'];
        $uf = $donnees['uf'];
        $sheet->setCellValue('B' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", $nom . " " . $prenom));
        $sheet->setCellValue('C' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", $pole));
        $sheet->setCellValue('D' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", $uf));
    }
    $sheet->setCellValue('E' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", $pla));
    $sheet->setCellValue('F' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", $pb));
    $sheet->setCellValue('G' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", $detail));
    $sheet->setCellValue('H' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", $mode));
    $sheet->setCellValue('I' . $NumLigne, iconv("ISO-8859-1//TRANSLIT", "UTF-8", $nmtech));
    $sheet->getColumnDimension('F')->setWidth(60); //en pouces
    $sheet->getColumnDimension('G')->setWidth(25); //en pouces
    $sheet->setSharedStyle($centrergras, "A$NumLigne:I$NumLigne");
    $sheet->getRowDimension($NumLigne)->setRowHeight(-1);
    $NumLigne++;
}
$sheet->getColumnDimension('A')->setWidth(12); //en pouces
$sheet->getColumnDimension('B')->setWidth(20); //en pouces
$sheet->getColumnDimension('C')->setWidth(20); //en pouces
$sheet->getColumnDimension('D')->setWidth(10); //en pouces
$sheet->getColumnDimension('E')->setWidth(12); //en pouces
//ajout des feuilles sheet modele modifié au fichier de sortie
$writer->addSheet($sheet);
//OBLIGATOIRE POUR QUE LES STYLES DES AUTRES FEUILLES S'APPLIQUENT
$writer->getSheet(0)->setSharedStyle($centrergras, "A1:F1");
$writer->getSheet(0)->setSharedStyle($centrer, "A1:F1");
//ecriture du fichier de sortie
$fichierSortie = "Detail_problemes.xls";
//        $chemin="upload/gesform/suivi/";
$writer->removeSheetByIndex(0);
$sortie = new PHPExcel_Writer_Excel5($writer);
//	$sortie->save($chemin.$fichierSortie.".xls"); 
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: inline;filename=" . $fichierSortie);
header('Pragma: no-cache');
header('Expires: 0');

$sortie->save('php://output');
?>

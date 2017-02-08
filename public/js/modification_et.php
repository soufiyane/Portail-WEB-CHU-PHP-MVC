<?php
// PAGE AUTHORISEE QUE TECH/ADMIN STATUT 2 et GROUPE ETUDIANT

require_once('includes/connexion.php');

include ('includes/fonctions.php');
include ('includes/fonctions_texte.php');

require_once('includes/alias_tables.php');

include('page_iso.php');

//switch ($_SESSION['statut']) {
//case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
//case 1: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
//case 2: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
//}

include ('includes/variables_annee.php');
$date1 = $cette_annee;


// date à tester :
$aujourdhui = date('Y-m-d');
$date_atelier = "2015-08-10";

// test
$aujourdhui = new DateTime($aujourdhui);
$aujourdhui = $aujourdhui->format('Ymd');
$date_atelier = new DateTime($date_atelier);
$date_atelier = $date_atelier->format('Ymd');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script src="support/html5shiv/dist/html5shiv.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="support/css/monCss.css" />
<title>INSCRIPTION MODIFICATION ETUDIANT</title>

<script src="includes/jquery.js"></script>
<script type="text/javascript">
var numb = '0123456789';
var lwr = 'abcdefghijklmnopqrstuvwxyz';
var upr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
var sp = ' ';
function cacher(uneclasse)
{
var choix=document.getElementsByClassName(uneclasse);
for (i=0;i<choix.length;i++)
   {
   choix[i].style.display="none";
   }
}
function placeholderIsSupported() {
    var test = document.createElement('input');
    return ('placeholder' in test);
}
function testholder(){
    if(placeholderIsSupported()){
        cacher('legende');
    }
}
function isValid(parm, val) {
if (parm == "")
return false;
for (i = 0; i < parm.length; i++) {
if (val.indexOf(parm.charAt(i), 0) == -1)
return false;
}
return true;
}

function isNum(parm) {
return isValid(parm, numb);
}
function isLower(parm) {
return isValid(parm, lwr);
}
function isUpper(parm) {
return isValid(parm, upr);
}
function isAlpha(parm) {
return isValid(parm, lwr + upr + sp);
}
function isAlphanum(parm) {
return isValid(parm, lwr + upr + numb);
}

function verif_formulaire()
{
if (document.form_envoyer.nom.value == "")
{
alert("Veuillez entrer votre nom !");
return false;
}

if (document.form_envoyer.prenom.value == "")
{
alert("Veuillez entrer votre prénom !");
return false;
}

//vérification de saisie de date de naissance
if (document.form_envoyer.date_naissance.value == "")
{
alert("Veuillez entrer votre date de naissance !");
return false;
}
if (document.form_envoyer.date_naissance.value != "")
{
var reg_datenaiss = /^[0-9]{8}$/
if (!(reg_datenaiss.exec(document.form_envoyer.date_naissance.value) != null))
{
alert("La date de naissance saisie n'est pas au format valide (JJMMAAAA) !");
return(false);
}

<?php

if (($_SESSION['statut']) != 2) {
?>
        
if (document.form_envoyer.type_voie.value == "-1")
{
alert("Veuillez renseigner le type de voie de l'adresse !");
return false;
}

if ((document.form_envoyer.type_complement.value != "-1") && (document.form_envoyer.lib_comp.value == ""))
{
alert("Veuillez renseigner le libellé de la résidence ou du lotissement !");
return false;
}
if ((document.form_envoyer.type_complement.value == "-1") && (document.form_envoyer.lib_comp.value != ""))
{
alert("Veuillez indiquer si le complément d'adresse est une résidence ou un lotissement !");
return false;
}

if ((document.form_envoyer.type_voie.value != "-1") && (document.form_envoyer.lib_voie.value == ""))
{
alert("Veuillez renseigner le libellé de la voie !");
return false;
}

if (document.form_envoyer.code_postal.value == "")
{
alert("Veuillez entrer votre code postal !");
return false;
}

if (document.form_envoyer.ville.value == "")
{
alert("Veuillez entrer votre ville !");
return false;
}

if (document.form_envoyer.lieu_naissance.value == "")
{
alert("Veuillez entrer votre lieu de naissance !");
return false;
}

if (!isAlpha(document.form_envoyer.lieu_naissance.value))
{
alert("Veuillez vérifier votre lieu de naissance, et supprimer les caractères spéciaux ou numériques");
return false;
}

if (document.form_envoyer.secu1.value == "")
{
alert("Veuillez entrer votre numéro de sécurité sociale !");
return false;
}

if (document.form_envoyer.secu2.value == "")
{
alert("Veuillez entrer votre numéro de sécurité sociale !");
return false;
}

if (document.form_envoyer.secu3.value == "")
{
alert("Veuillez entrer votre numéro de sécurité sociale !");
return false;
}

if (document.form_envoyer.secu4.value == "")
{
alert("Veuillez entrer votre numéro de sécurité sociale !");
return false;
}

if (document.form_envoyer.secu5.value == "")
{
alert("Veuillez entrer votre numéro de sécurité sociale !");
return false;
}

if (document.form_envoyer.secu6.value == "")
{
alert("Veuillez entrer votre numéro de sécurité sociale !");
return false;
}

if (document.form_envoyer.secu7.value == "")
{
alert("Veuillez entrer votre numéro de sécurité sociale !");
return false;
}
var numsecu=String(document.form_envoyer.secu1.value)+String(document.form_envoyer.secu2.value)+String(document.form_envoyer.secu3.value)+String(document.form_envoyer.secu4.value)+String(document.form_envoyer.secu5.value)+String
(document.form_envoyer.secu6.value)+String(document.form_envoyer.secu7.value);
alert(numsecu);
if(checkInsee(numsecu)==false){
	alert("Veuillez vérifier votre numéro de sécurité sociale !");
return false;
}
function checkInsee(inseeString)
{
     var isValid = true;
     var expressionInsee = new RegExp("^[12]\\d{14}$");
     if (inseeString.match(expressionInsee))
     {
         var partialInsee = inseeString.substring(0,13);
         var clef = 97-(parseFloat(partialInsee) % 97);
         if(clef!=parseInt(inseeString.substring(13,15)))
             isValid = false;
     } else isValid = false;
     return isValid;
}

if (document.form_envoyer.tel.value == "")
{
alert("Veuillez entrer votre téléphone !");
return false;
}
}
<?php
}
?>

//vérification de saisie d'email au bon format
if (document.form_envoyer.mail.value == "")
{
alert("Veuillez entrer votre adresse mail !");
return false;
}

else
{
if ((document.form_envoyer.mail.value.indexOf("@") == -1) || (document.form_envoyer.mail.value.indexOf(".") == -1))
{
alert("L'adresse mail saisie n'est pas au format valide !");
return false
}
}

if (document.form_envoyer.version_office.selectedIndex == false)
{
alert("Veuillez sélectionnez votre version d'Office!");
return false;
}

}

function mouseOver(thingId)
{
document.getElementById(thingId).style.backgroundImage = "url()";
}

function mouseOut(thingId)
{
document.getElementById(thingId).style.background = "url(img/fleche05.png)";
document.getElementById(thingId).style.backgroundRepeat = "no-repeat";
document.getElementById(thingId).style.backgroundPosition = "left center";
}
function suivant(enCours, suivant, limite)
{
if (enCours.value.length == limite)
document.form_envoyer[suivant].focus();
}
</SCRIPT>
</head>
<body onLoad="testholder();">
<section>
<header>

<CENTER>	
<img src="images/bandeau_gestion_etudiants.jpg" width="100%"/>			
</CENTER>
</header>


<!-- Menu de Navigation -->
<nav>
<ul>



<?php
if (($_SESSION['statut']) == 2) {
?>
<li> <a href="menu_gestion_et.php" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');"> Accueil </a> </li> 
<li> <a href="menu_inscription_et.php" class = "current" id="current"> Inscriptions/Modification </a> </li>
<li> <a href="menu_archive_et.php" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');"> Report & Fin de scolarité </a> </li>
<li> <a href="recherche_et.php" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');"> Recherche & Historique </a></li>
<li> <a href="import_et.php" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');"> Import étudiants </a> </li>
<li> <a href="menu_export_et.php" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');"> Export étudiants </a> </li>   
<?php
} else {
?>
<li> <a href="modification_et.php" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');"> Retour </a> </li> 
<?php
}
?>    

</ul>
</nav>
<!-- FIN Menu de Navigation -->

<?php
// SI on envoie les modifications -> UPDATE SUPPORT ET USERS       
if (isset($_POST['envoyer'])) {
//DECALARTION VARIABLES
// On commence par récupérer les champs 	
//if(isset($_POST['sexe']))      $sexe=$_POST['sexe'];
// if(isset($_POST['situation']))      $situation=$_POST['situation'];
//$situation = suppr_accents ($situation) ;

if (isset($_POST['nom']))
$nom = $_POST['nom'];
$nom = suppr_accents($nom);

// if(isset($_POST['nom2']))      $nom2=$_POST['nom2'];
// $nom2 = suppr_accents ($nom2) ;


if (isset($_POST['prenom']))
$prenom = $_POST['prenom'];
$prenom = suppr_accents($prenom);

if (isset($_POST['num_voie']))
$num_voie = nettoyer($_POST['num_voie']);

if (isset($_POST['type_voie']))
$type_voie = $_POST['type_voie'];

if (isset($_POST['lib_voie']))
$lib_voie = nettoyer($_POST['lib_voie']);

$adresse = $num_voie . ' ' . $type_voie . ' ' . $lib_voie;

if (isset($_POST['num_apt']) && (($_POST['num_apt']) != "")) {
$num_apt = nettoyer($_POST['num_apt']);
$apt = "APPARTEMENT " . $num_apt;
} else {
$apt = "";
}

if (isset($_POST['num_bat']) && (($_POST['num_bat']) != "")) {
$num_bat = nettoyer($_POST['num_bat']);
$bat = "BATIMENT " . $num_bat . " ";
} else {
$bat = "";
}
$adresse_ligne2 = $bat . $apt;

if (isset($_POST['type_complement']) && ($_POST['type_complement'] != "-1")) {
$type_comp = $_POST['type_complement'];
$lib_comp = nettoyer($_POST['lib_comp']);
$adresse_ligne3 = $type_comp . ' ' . $lib_comp;
}

if (isset($_POST['ville']))
$ville = $_POST['ville'];
$ville = suppr_accents($ville);

if (isset($_POST['code_postal']))
$code_postal = $_POST['code_postal'];


if (isset($_POST['annee']))
$annee = $_POST['annee'];
//if (($_SESSION['statut']) == 2) {     
if (isset($_POST['identifiant']))
$identifiant = $_POST['identifiant'];
/* }else{
$identifiant=$_SESSION['identifiant'];
} */

if (isset($_POST['secu1']))
$secu1 = $_POST['secu1'];

if (isset($_POST['secu2']))
$secu2 = $_POST['secu2'];

if (isset($_POST['secu3']))
$secu3 = $_POST['secu3'];

if (isset($_POST['secu4']))
$secu4 = $_POST['secu4'];

if (isset($_POST['secu5']))
$secu5 = $_POST['secu5'];

if (isset($_POST['secu6']))
$secu6 = $_POST['secu6'];

if (isset($_POST['secu7']))
$secu7 = $_POST['secu7'];

if (isset($_POST['date_naissance']))
$date_naissance = $_POST['date_naissance'];

if (isset($_POST['lieu_naissance']))
$lieu_naissance = $_POST['lieu_naissance'];
$lieu_naissance = suppr_accents($lieu_naissance);

// if(isset($_POST['pays_naissance']))      $pays_naissance=$_POST['pays_naissance'];
// $pays_naissance = suppr_accents ($pays_naissance) ;
// if(isset($_POST['nationnalite']))      $nationnalite=$_POST['nationnalite'];
//$nationnalite = suppr_accents ($nationnalite) ;

if (isset($_POST['tel']))
$tel = $_POST['tel'];

if (isset($_POST['num_etudiant']))
$num_etudiant = $_POST['num_etudiant'];

    if(isset($_POST['commentaire']))      $commentaire=addslashes($_POST['commentaire']);

if (isset($_POST['mail']))
$mail = htmlentities($_POST['mail']);

if (isset($_FILES['photo'])) {

$sql4 = "SELECT * FROM $tableetud, $tableecole WHERE identifiant = '" . $identifiant . "' AND id_ecole=id GROUP BY identifiant";
//mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
mysqli_query($db, $sql4) or die("Impossible :" . mysqli_error($db));
$resultat4 = mysqli_query($db, $sql4);
$ligne_ecole = mysqli_fetch_assoc($resultat4);
$ecole = $ligne_ecole['libelle'];

$dossier = 'upload/photos/' . $ecole . '/';
$fichier = basename($_FILES['photo']['name']);
$taille_maxi = 3000000;
$taille = filesize($_FILES['photo']['tmp_name']);
$extensions = array('.jpg', '.jpeg','.JPG','.JPEG');
$extension = strrchr($_FILES['photo']['name'], '.');


//Début des vérifications de sécurité...
if (!in_array($extension, $extensions))
$erreur = '<br><br><br>Vous devez uploader un fichier de type jpg ou jpeg...';
if ($taille > $taille_maxi)
$erreur = '<br><br><br>Le fichier est trop gros...';

if (!isset($erreur)) { //S'il n'y a pas d'erreur, on upload
//On formate le nom du fichier ici...
$fichier_ori = $identifiant . "_ori" . $extension;
$fichier = $identifiant . $extension;
$doss_ori= $dossier . "originaux/";
$destination_ori = $doss_ori . $fichier_ori;
$destination = $dossier . $fichier;


if (is_uploaded_file($_FILES['photo']['tmp_name'])) { //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
if (!file_exists($doss_ori))
        {
                mkdir ($doss_ori,0700);
        }
if (!@move_uploaded_file($_FILES['photo']['tmp_name'], $destination_ori)) {
echo '<br><br><br>Echec de l\'upload !';
} else {
if (!copy($destination_ori, $destination)) {
    echo "La copie du fichier a échoué...\n";
}
redimensionner_image($destination, 90, 120);
$photo_etudiant = $destination;
}
} else {
echo '<br><br><br>Echec de l\'upload !';
}
} else {
echo '<br><br><br>';
echo $erreur;
}
} else {
$photo_etudiant = $ligne_ecole['photo'];
}


if (isset($_POST['groupe_buro']) && ($_POST['groupe_buro']) != '-1') {
$id_buro = $_POST['groupe_buro'];
$sql = "SELECT libelle FROM groupes WHERE id = '" . $id_buro . "'";
$req = mysqli_query($db, $sql);
while ($donnees = mysqli_fetch_array($req)) {
$groupe_buro = $donnees["libelle"];
}
} else {
$groupe_buro = '';
$id_buro = 'NULL';
}

if (isset($_POST['groupe_anglais']) && ($_POST['groupe_anglais']) != '-1') {
$id_ang = $_POST['groupe_anglais'];
$sql = "SELECT libelle FROM groupes WHERE id = '" . $id_ang . "'";
$req = mysqli_query($db, $sql);
while ($donnees = mysqli_fetch_array($req)) {
$groupe_anglais = $donnees["libelle"];
}
} else {
$groupe_anglais = '';
$id_ang = 'NULL';
}

if (isset($_POST['groupe_ecole']) && ($_POST['groupe_ecole']) != '-1') {
$id_ec = $_POST['groupe_ecole'];
$sql = "SELECT libelle FROM groupes WHERE id = '" . $id_ec . "'";
$req = mysqli_query($db, $sql);
while ($donnees = mysqli_fetch_array($req)) {
$groupe_ecole = $donnees["libelle"];
}
} else {
$groupe_ecole = '';
$id_ec = 'NULL';
}


$sql = "SELECT * FROM $tableetud, $tableecole WHERE identifiant = '" . $_POST['identifiant'] . "' AND id_ecole=id GROUP BY identifiant";
//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br>'.mysqli_error($db)); 
mysqli_query($db, $sql) or die("Impossible :" . mysqli_error($db));
$resultat = mysqli_query($db, $sql);
$ligne_user = mysqli_fetch_assoc($resultat);
$old_v_off = $ligne_user['version_office'];

$nom = strtoupper($nom);
$nom = to7bit($nom);

$prenom = ucfirst($prenom);
$prenom = to7bit($prenom);

$date_naissance = preg_replace("[^0-9]", "", $date_naissance);
$tel = wordwrap($tel, 2, '-', true);

//MAJ VERSION OFFICE
if (isset($_POST['maj'])) {
$cloud = 1;
$version_office = '2010';
} else {
$cloud = $ligne_user['cloud'];
$version_office = $old_v_off;
}

//création de la classe avec concatenation des variables
switch ($annee) {
case 'A2';
case $A2_ESF; //A2 
case $A2_IFMK; //k2    
case $A2_IBODE; //A2       
$date1 = $date1 - 1;
break;

case 'A3';
case $A3_ESF; //A3 
case $A3_IFMK; //K3    
$date1 = $date1 - 2;
break;

case $A4_ESF; //A4 
$date1 = $date1 - 3;
break;

default :
$date1 = $date1;
}
//$dateFin = $date1 + ($ligne_user['cursus'] - 1);
$dateFin = $date1 + ($ligne_user['cursus']);
$classe = '[' . $date1 . '-' . $dateFin . ']-' . $ligne_user['libelle'];



if (($version_office != '') AND ( $groupe_buro != '') AND ( $cloud == 0))
$groupe_buro = $groupe_buro . ' - ' . $version_office;
if ($cloud == 1)
if (($ligne_user['id_ecole'] == '8') AND ($annee == 'A3'))
{    
$groupe_buro = $groupe_buro . ' - ' . $version_office . ' Cloud';
}

$ecole = $ligne_user['libelle'];


$sql10 = "SELECT * FROM $tabless WHERE matricule = '" . $identifiant . "'";
//mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
mysqli_query($db, $sql10) or die("Impossible :" . mysqli_error($db));
$resultat10 = mysqli_query($db, $sql10);
$ligne_ss = mysqli_fetch_assoc($resultat10);

$sqladr = "INSERT INTO $tableadr (`matricule`, `numero_voie`, `type_voie`, `libelle_voie`, `apt_numero`,`apt_batiment`,`type_complement`,`libelle_complement`) VALUES ('$identifiant','$num_voie','$type_voie','$lib_voie','$num_apt','$num_bat','$type_comp','$lib_comp') ON DUPLICATE KEY UPDATE  numero_voie = '$num_voie', type_voie = '$type_voie', libelle_voie = '$lib_voie', apt_numero = '$num_apt', apt_batiment = '$num_bat', type_complement = '$type_comp', libelle_complement = '$lib_comp'";
mysqli_query($db, $sqladr) or die("Impossible de modifier l'adresse :" . mysqli_error($db));

$sql2 = "UPDATE $tableetud SET annee = '$annee', classe='$classe', nom = '$nom', prenom = '$prenom', adresse = '$adresse', adresse_ligne2 = '$adresse_ligne2', adresse_ligne3 = '$adresse_ligne3', code_postal = '$code_postal', ville = '$ville',  date_naissance = '$date_naissance',tel = '$tel', mail = '$mail', lieu_naissance = '$lieu_naissance', photo = '$photo_etudiant', groupe_anglais = '$groupe_anglais', id_ang = $id_ang, groupe_buro = '$groupe_buro', id_buro = $id_buro, groupe_ecole = '$groupe_ecole', id_ec = $id_ec, commentaire = '$commentaire' WHERE identifiant = '$identifiant'";
mysqli_query($db, $sql2) or die("Impossible de modifier l'enregistrement1 :" . mysqli_error($db));


$sql7 = "INSERT INTO $tabless (`matricule`, `ss1`, `ss2`, `ss3`, `ss4`, `ss5`, `ss6`, `ss7`) VALUES ('$identifiant','$secu1','$secu2','$secu3','$secu4','$secu5','$secu6','$secu7') ON DUPLICATE KEY UPDATE  ss1 = '$secu1', ss2 = '$secu2', ss3 = '$secu3', ss4 = '$secu4', ss5 = '$secu5', ss6 = '$secu6', ss7 = '$secu7'";
mysqli_query($db, $sql7) or die("Impossible de créer l'enregistrement2 :" . mysqli_error($db));
//echo $sql7;

if (($old_v_off != "" && $old_v_off != $version_office) || isset($_POST['maj'])) {
//On insère un incident si c'est un changement de version d'office.
$my_t = getdate(date("U"));
if ($my_t[mday] < 10) {
$my_t[mday] = "0" . $my_t[mday];
}
if ($my_t[mon] < 10) {
$my_t[mon] = "0" . $my_t[mon];
}
$datecom = $my_t[mday] . '/' . $my_t[mon] . '/' . $my_t[year];
$date = $my_t[year] . '-' . $my_t[mon] . '-' . $my_t[mday] . ' ' . $my_t[hours] . ':' . $my_t[minutes] . ':' . $my_t[seconds];
$req = mysqli_query($db, "SELECT id_etudiant FROM " . $tableetud . " WHERE identifiant = '" . $identifiant . "'");
while ($donnees = mysqli_fetch_array($req)) {
$idetud = $donnees['id_etudiant'];
}
if (isset($_POST['maj'])) {
$pb = "'Changement de Version d\'Office Cloud'";
$txtcloud = " Cloud";
} else {
$pb = "'Changement de Version d\'Office'";
$txtcloud = "";
}
$req = mysqli_query($db, "SELECT id FROM " . $tableincidents . " WHERE probleme = $pb");
while ($donnees = mysqli_fetch_array($req)) {
$idpb = $donnees['id'];
}

$sql = "SELECT id,nom,prenom FROM $tabletech WHERE identifiant='" . $identifiant . "'";
mysqli_query($db, $sql) or die("Impossible :" . mysqli_error($db));

$req = mysqli_query($db, $sql);
$donnees = mysqli_fetch_array($req);
$idtech = $donnees[0];
$technicien_nom = $donnees[1];
$technicien_prenom = $donnees[2];
$sql = "INSERT INTO $tableincidusers (id_incidents,id_users,id_etat,date,new,createur)values (" . $idpb . ", '" . $idetud . "', '1', '" . $date . "', 1,'" . $technicien_prenom . " " . $technicien_nom . "')";
//mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br>'.mysqli_error($db)); 
mysqli_query($db, $sql) or die("Impossible de créer l'incident :" . mysqli_error($db));
$idincid = mysqli_insert_id($db);
//On insère un dépannage pour cet incident.
$sql = "INSERT INTO $tabledepa (id_tech,id_incidents_to_users,date,detail,mode)VALUE(" . $idtech . ", " . $idincid . ", '" . $date . "', 'Passage de " . $old_v_off . " en " . $version_office . $txtcloud . "','A distance')";
mysqli_query($db, $sql) or die('Erreur SQL!' . $sql . '<br />' . mysqli_error($db));
//mysqli_query($db,$sql) or die ('Erreur SQL!');
//On marque l'incident comme résolut.
$sql = "UPDATE $tableincidusers SET id_etat=3,commentaire='Résolu le " . $datecom . " par " . $technicien_prenom . " " . $technicien_nom . "' WHERE id=" . $idincid . "";
mysqli_query($db, $sql) or die('Erreur SQL!' . $sql . '<br />' . mysqli_error($db));
//mysqli_query($db,$sql) or die ('Erreur SQL!');
}

// on affiche le résultat pour le visiteur 
echo "<br><br><font size='3' align='center'>Les informations ont été correctement modifiées.</font><br><br>";
echo "<br><img src='images/add.png'><font size='3' align='center'><a href='index.php'>Déconnexion</a></font>";
} else {
if (isset($_POST['modifier']) || isset($_GET['id']) || $_SESSION['statut'] == 0) {
?>
<form name="form_envoyer" id="form1" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return verif_formulaire()"> 


<?php
if (isset($_POST['identifiant']))
$identifiant = $_POST['identifiant'];
if (isset($_GET['id']))
$identifiant = $_GET['id'];
if ($_SESSION['statut'] == 0)
$identifiant = $_SESSION['identifiant'];

$req_user = "SELECT * , $tableecole.libelle as nom_ecole
FROM $tableecole, $tableetud
WHERE identifiant = '" . $identifiant . "' AND id_ecole = $tableecole.id";

mysqli_query($db, $req_user) or die('Erreur SQL !' . $req_user . '<br>' . mysqli_error($db));
$res_req_user = mysqli_query($db, $req_user);
//echo $req_user;

if (mysqli_num_rows($res_req_user) == 0)
echo '<script type="text/javascript"> alert("L\'identifiant saisi : ' . $identifiant . '  n\'existe pas, veuillez le resaisir.");location = "modification_et.php"; </script>';

if (isset($_POST['dtnaiss']) && $_POST['dtnaiss'] == "") {
echo '<script type="text/javascript"> alert("Veuillez saisir votre date de naissance");location = "modification_et.php"; </script>';
} else {
if (isset($_POST['dtnaiss'])) {
$dtnaiss = $_POST['dtnaiss'];
$condet = " AND date_naissance='$dtnaiss'";
}
$req_user = "SELECT * , $tableecole.libelle as nom_ecole
FROM $tableecole, $tableetud
WHERE identifiant = '" . $identifiant . "' AND id_ecole = $tableecole.id
$condet";

mysqli_query($db, $req_user) or die('Erreur SQL !' . $req_user . '<br>' . mysqli_error($db));
$res_req_user = mysqli_query($db, $req_user);
//echo $req_user;

if (mysqli_num_rows($res_req_user) == 0)
echo '<script type="text/javascript"> alert("la date de naissance saisie ne correspond pas avec l\'identifiant renseigné, merci de les re saisir");location = "modification_et.php"; </script>';
}

$ligne_user = mysqli_fetch_assoc($res_req_user);
$casque = $ligne_user['type_casq'];

$sql10 = "SELECT * FROM $tabless WHERE matricule = '" . $identifiant . "'";
//mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
mysqli_query($db, $sql10) or die("Impossible :" . mysqli_error($db));
$resultat10 = mysqli_query($db, $sql10);
$ligne_ss = mysqli_fetch_assoc($resultat10);


// AFFICHAGE ECOLE
?>
<fieldset>           
<legend>INFORMATIONS ECOLE : <?php echo $ligne_user['classe'] ?></legend>

<?php
         
//AFFICHAGE ANNEE
echo "Année : ";
// Choix annee si adm ou technicien
if (($_SESSION['statut']) == 2) {
$cursus = $ligne_user["cursus"];

echo "<select name=annee id=annee>";
echo "<option value='" . $ligne_user['annee'] . "' selected=selected>" . $ligne_user['annee'] . "</option>";
switch ($ligne_user['id_ecole']) {
case "9"://ibode
if ($ligne_user['annee'] != $A1_IBODE)
echo "<option value=" . $A1_IBODE . ">" . $A1_IBODE . "</option>";
if ($ligne_user['annee'] != $A2_IBODE)
echo "<option value=" . $A2_IBODE . ">" . $A2_IBODE . "</option>";
Break;

case "4"://ifmk
if ($ligne_user['annee'] != $A1_IFMK)
echo "<option value=" . $A1_IFMK . ">" . $A1_IFMK . "</option>";
if ($ligne_user['annee'] != $A2_IFMK)
echo "<option value=" . $A2_IFMK . ">" . $A2_IFMK . "</option>";
if ($ligne_user['annee'] != $A3_IFMK)
echo "<option value=" . $A3_IFMK . ">" . $A3_IFMK . "</option>";
Break;

case "5"://esf
if ($ligne_user['annee'] != $A1_ESF)
echo "<option value=" . $A1_ESF . ">" . $A1_ESF . " = A1</option>";
if ($ligne_user['annee'] != $A2_ESF)
echo "<option value=" . $A2_ESF . ">" . $A2_ESF . " = A2</option>";
if ($ligne_user['annee'] != $A3_ESF)
echo "<option value=" . $A3_ESF . ">" . $A3_ESF . " = A3</option>";
if ($ligne_user['annee'] != $A4_ESF)
echo "<option value=" . $A4_ESF . ">" . $A4_ESF . " = A4</option>";
Break;

default:
for ($i = 1; $i <= $cursus; $i++) {
if ($ligne_user['annee'] != "A" . $i)
echo "<option value=A" . $i . ">A" . $i . "</option>";
}
}
echo"</select>";
}
else { // Pas de choix pour l'etudiant A1 Forcé
$annee = $ligne_user['annee'];
echo "<b><font color=red>" . $annee . "</font></b><input type=hidden value=$annee name=annee></input>";
}

if (($_SESSION['statut']) == 2 or $aujourdhui >= $date_atelier) {
// AFFICHAGE DES GROUPES
// REQUETE POUR AFFICHAGE DES GROUPES BUREAUTIQUE
$req_gr_buro = "SELECT id_groupe, libelle, type FROM et_groupes_to_ecoles, groupes WHERE id_groupe = groupes.id AND id_ecole = '" . $ligne_user['id_ecole'] . "' and type='buro'";
$result_gr_buro = mysqli_query($db, $req_gr_buro);
if (mysqli_num_rows($result_gr_buro)) {
echo "<select name=groupe_buro id=groupe_buro>";
echo "<option value='-1'>- - - Aucun groupe bureautique - - -</option>";
if ($ligne_user['id_buro'] != NULL) { // Un groupe a été rattaché à cet étudiant
$req_libelle_groupe = "SELECT libelle, id FROM $tablegroupes WHERE id = '" . $ligne_user["id_buro"] . "'";
// echo $req_libelle_groupe;
$result_libelle_buro = mysqli_query($db, $req_libelle_groupe);
$ligne_libelle_groupe = mysqli_fetch_assoc($result_libelle_buro);
if (mysqli_num_rows($result_libelle_buro)) {
echo "<option value=" . $ligne_user["id_buro"] . " selected=selected>" . $ligne_libelle_groupe['libelle'] . "</option>";
} else // le groupe est inconnu de la table groupe.
echo "<option value=" . $ligne_user["id_buro"] . " selected=selected>" . $ligne_user['groupe_buro'] . "</option>";
}
while ($ligne_groupe = mysqli_fetch_assoc($result_gr_buro)) {
if ($ligne_groupe["id_groupe"] != $ligne_user["id_buro"])
echo "<option value=" . $ligne_groupe["id_groupe"] . ">" . $ligne_groupe["libelle"] . "</option>";
}
echo"</select>";
}

// AFFICHAGE DES GROUPES
// REQUETE POUR AFFICHAGE DES GROUPES ANGLAIS
$req_gr_ang = "SELECT id_groupe, libelle, type FROM et_groupes_to_ecoles, groupes WHERE id_groupe = groupes.id AND id_ecole = '" . $ligne_user['id_ecole'] . "' and type='ang'";
$result_gr_ang = mysqli_query($db, $req_gr_ang);
if (mysqli_num_rows($result_gr_ang)) {
echo "<select name=groupe_anglais id=groupe_anglais>";
echo "<option value='-1'>- - - Aucun groupe anglais - - -</option>";
if ($ligne_user['id_ang'] != NULL) { // Un groupe a été rattaché à cet étudiant
$req_libelle_groupe = "SELECT libelle, id FROM $tablegroupes WHERE id = '" . $ligne_user["id_ang"] . "'";
//echo $req_libelle_groupe;
$result_libelle_ang = mysqli_query($db, $req_libelle_groupe);
$ligne_libelle_groupe = mysqli_fetch_assoc($result_libelle_ang);
if (mysqli_num_rows($result_libelle_ang)) {
echo "<option value=" . $ligne_user["id_ang"] . " selected=selected>" . $ligne_libelle_groupe['libelle'] . "</option>";
} else // le groupe est inconnu de la table groupe.
echo "<option value=" . $ligne_user["id_ang"] . " selected=selected>" . $ligne_user['groupe_anglais'] . "</option>";
}
while ($ligne_groupe = mysqli_fetch_assoc($result_gr_ang)) {
if ($ligne_groupe["id_groupe"] != $ligne_user["id_ang"])
echo "<option value=" . $ligne_groupe["id_groupe"] . ">" . $ligne_groupe["libelle"] . "</option>";
}

echo"</select>";
}


// AFFICHAGE DES GROUPES
// REQUETE POUR AFFICHAGE DES GROUPES ECOLE
$req_gr_ec = "SELECT id_groupe, libelle, type FROM et_groupes_to_ecoles, groupes WHERE id_groupe = groupes.id AND id_ecole = '" . $ligne_user['id_ecole'] . "' and type='ecole'";
$result_gr_ec = mysqli_query($db, $req_gr_ec);
if (mysqli_num_rows($result_gr_ec)) {
echo "<select name=groupe_ecole id=groupe_ecole>";
echo "<option value='-1'>- - - Aucun groupe école - - -</option>";
if ($ligne_user['id_ec'] != NULL) { // Un groupe a été rattaché à cet étudiant
$req_libelle_groupe = "SELECT libelle, id FROM $tablegroupes WHERE id = '" . $ligne_user["id_ec"] . "'";
//echo $req_libelle_groupe;
$result_libelle_ec = mysqli_query($db, $req_libelle_groupe);
$ligne_libelle_groupe = mysqli_fetch_assoc($result_libelle_ec);
if (mysqli_num_rows($result_libelle_ec)) {
echo "<option value=" . $ligne_user["id_ec"] . " selected=selected>" . $ligne_libelle_groupe['libelle'] . "</option>";
} else // le groupe est inconnu de la table groupe.
echo "<option value=" . $ligne_user["id_ec"] . " selected=selected>" . $ligne_user['groupe_ecole'] . "</option>";
}
while ($ligne_groupe = mysqli_fetch_assoc($result_gr_ec)) {
if ($ligne_groupe["id_groupe"] != $ligne_user["id_ec"])
echo "<option value=" . $ligne_groupe["id_groupe"] . ">" . $ligne_groupe["libelle"] . "</option>";
}

echo"</select>";
}
}
if (($_SESSION['statut']) == 2) {
?>

<br><hr>
<table width="100%">
<tr>
<td valign="top"><label for="adresse">COMMENTAIRE : </label></td>
<td><label><textarea name="commentaire" cols="90"><?php echo $ligne_user["commentaire"]; ?></textarea></label></td>
</tr>
</table>            
<br>
<?php
}
echo "</fieldset>";

?>
<br>
<fieldset>


<legend>INFORMATIONS ETUDIANTS : <?php echo $identifiant; ?> <font color="red"></font></legend>

<table border="0" width="100%">
<!--<tr>
<td ><label for="sexe">Sexe </label></td>
<td><label><select name="sexe" size="1"><option>F</option><option >M</option></select></label></td> 
<td ><label for="situation">Situation Familiale </label></td>
<td ><label><select name="situation" size="1"><option>Célibataire</option><option>Marié</option><option>Divorcé</option></select></label></td>
</tr> -->
<tr height="40px">
<td><label for="nom">Nom Usuel </label></td>
<td><label><input type="text" name="nom" size="30" value="<?php echo $ligne_user['nom']; ?>"  <?php if (($_SESSION['statut']) != 2) echo "readonly=on"; ?>></label></td>
<td><label for="prenom">Prénom </label></td>
<td><label><input type="text" name="prenom" size="25" value="<?php echo $ligne_user['prenom']; ?>"  <?php if (($_SESSION['statut']) != 2) echo "readonly=on"; ?>></label></td>
</tr>
<?php
$reqadr_user = "SELECT * FROM $tableadr WHERE matricule=$identifiant";
@$res_reqadr_user = mysqli_query($db, $reqadr_user);
@$ligne_adruser = mysqli_fetch_assoc($res_reqadr_user);
$num_voie = $ligne_adruser['numero_voie'];
$type_voie = $ligne_adruser['type_voie'];
$lib_voie = $ligne_adruser['libelle_voie'];
$num_apt = $ligne_adruser['apt_numero'];
$num_bat = $ligne_adruser['apt_batiment']; 
$type_comp = $ligne_adruser['type_complement'];
$lib_comp = $ligne_adruser['libelle_complement'];
$statut_photo1 = $ligne_user['photo'];
?>
<tr height="180px">
<td>ADRESSE</td>
<td>
    <table>
        <tr class="legende">
            <td>N° de voie</td>
            <td>Type de voie</td>
            <td>Libellé de voie</td>
        </tr>
        <tr>
            <td>
<input type="text" name="num_voie" size="10" maxlength="5" value="<?php echo $num_voie ?>" placeholder="N° de voie" >
            </td>
            <td>
<?php
$table_name = $tableadr;
$column_name = "type_voie";

echo "<select name=\"$column_name\" style='margin:0px;'>";
$result = mysqli_query($db, "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = '$table_name' AND COLUMN_NAME = '$column_name'")
or die(mysqli_error($db));

$row = mysqli_fetch_array($result);
$enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE']) - 6))));
echo "<option value='-1'>Type de voie</option>";
foreach ($enumList as $value) {
if ($type_voie == $value) {
$selected = "SELECTED";
} else {
$selected = "";
}
echo "<option value=\"$value\" $selected>$value</option>";
}

echo "</select>";
?>
            </td>
            <td>
<input type="text" name="lib_voie" size="25" maxlength="22" value="<?php echo $lib_voie; ?>"  placeholder="Libellé de voie" ><br />
            </td>
        </tr>
    </table><br />
<label for="num_apt" style="float:left;">Appt. / Chambre <input type="text" name="num_apt" id="num_apt" size="5" maxlength="4" value="<?php echo $num_apt; ?>" placeholder="N°" ></label>
<label for="num_bat" style="float:left;">Bât. / Immeuble <input type="text" name="num_bat" id="num_bat" size="9" maxlength="15" value="<?php echo $num_bat; ?>" placeholder="N°" ></label>
<div style='clear:both;'></div>
<table>
    <tr class="legende">
        <td>Complément</td>
        <td>Libellé</td>
    </tr>
    <tr>
        <td>
<?php
$column_name = "type_complement";

echo "<select name=\"$column_name\" style='margin:0px;'>";
$result = mysqli_query($db, "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = '$table_name' AND COLUMN_NAME = '$column_name'")
or die(mysqli_error($db));

$row = mysqli_fetch_array($result);
$enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE']) - 6))));
echo "<option value='-1'>Complément</option>";
foreach ($enumList as $value) {
if ($type_comp == $value) {
$selected = "SELECTED";
} else {
$selected = "";
}
echo "<option value=\"$value\" $selected>$value</option>";
}
?>
        </td>
        <td>
        <input type="text" name="lib_comp" size="30" maxlength="28" value="<?php echo $lib_comp; ?>" placeholder="Libellé" >
        </td>
    </tr>
</table><br /><br />
&nbsp;<input type="text" name="code_postal" size="15" maxlength="5" value="<?php echo $ligne_user['code_postal']; ?>" placeholder="Code postal">
<input type="text" name="ville" size="40" maxlength="50" value="<?php echo $ligne_user['ville']; ?>" placeholder="Ville">
</td>
<td>
    <?php
    // AFFICHAGE Casque si casque + PHOTO SI PHOTO
    switch ($casque)
    {
    case "Casque simple":
    echo "<img src='images/casque_simple.png' width=120px height=120px>";  
    break;
    case "Casque-micro":
    echo "<img src='images/casque_micro.png'  width=120px height=120px>";    
    break;
    default;
    break;                                                       
    }  
    ?>
</td>
<td align="center"><img src="<?php echo $statut_photo1;?>" height="120" width="90" alt="image" /></td>
</tr>

<tr>
<td><label for="secu1">N° Sécurité Sociale </label></td>
<td><label><input type="text" name="secu1" size="1" maxlength="1"  value="<?php echo $ligne_ss['ss1']; ?>" <?php if (($_SESSION['statut']) != 2 &&($ligne_user['agirh']) == 1) echo "readonly=on"; ?> onKeyUp="suivant(this, 'secu2', 1)"> 
<input type="text" name="secu2" size="1" maxlength="2"  value="<?php echo $ligne_ss['ss2']; ?>" <?php if (($_SESSION['statut']) != 2 &&($ligne_user['agirh']) == 1) echo "readonly=on"; ?> onKeyUp="suivant(this, 'secu3', 2)">
<input type="text" name="secu3" size="1" maxlength="2"  value="<?php echo $ligne_ss['ss3']; ?>" <?php if (($_SESSION['statut']) != 2 &&($ligne_user['agirh']) == 1) echo "readonly=on"; ?> onKeyUp="suivant(this, 'secu4', 2)">
<input type="text" name="secu4" size="1" maxlength="2"  value="<?php echo $ligne_ss['ss4']; ?>" <?php if (($_SESSION['statut']) != 2 &&($ligne_user['agirh']) == 1) echo "readonly=on"; ?>  onKeyUp="suivant(this, 'secu5', 2)">
<input type="text" name="secu5" size="1" maxlength="3"  value="<?php echo $ligne_ss['ss5']; ?>" <?php if (($_SESSION['statut']) != 2 &&($ligne_user['agirh']) == 1) echo "readonly=on"; ?> onKeyUp="suivant(this, 'secu6', 3)">
<input type="text" name="secu6" size="1" maxlength="3"  value="<?php echo $ligne_ss['ss6']; ?>" <?php if (($_SESSION['statut']) != 2 &&($ligne_user['agirh']) == 1) echo "readonly=on"; ?> onKeyUp="suivant(this, 'secu7', 3)">
<input type="text" name="secu7" size="1" maxlength="2"  value="<?php echo $ligne_ss['ss7']; ?>" <?php if (($_SESSION['statut']) != 2 &&($ligne_user['agirh']) == 1) echo "readonly=on"; ?> ></label>
</td>
<td><label for="date de naissance">Date de Naissance </label></td>
<td><label><input type="text" name="date_naissance" size="20" maxlength="8" value="<?php echo $ligne_user['date_naissance']; ?>" <?php if (($_SESSION['statut']) != 2) echo "readonly=on"; ?> placeholder="(jjmmaaaa)"></label></td>
</tr>

<tr>
<td><label for="lieu_naissance">Lieu de Naissance </label></td>
<td><label><input type="text" name="lieu_naissance" size="15" maxlength="50"  value="<?php echo $ligne_user['lieu_naissance']; ?>" ></label></td>    
<!--<td><label for="pays_naissance">Pays de naissance </label></td>
<td><label><input type="text" name="pays_naissance" size="15" maxlength="10"  value="<?php echo $ligne_user['pays_naissance']; ?>"></label></td>  
<td><label for="nationnalite">Nationnalité </label></td>
<td><label><input type="text" name="nationnalite" size="15" maxlength="10"  value="<?php echo $ligne_user['nationnalite']; ?>"></label></td>-->
<td></td><td></td>
</tr>  

<tr>
<td><label for="mail">Adresse Mail </label></td>
<td><label><input type="text" name="mail" size="40" value="<?php echo $ligne_user['mail']; ?>" <?php if (($_SESSION['statut']) != 2) echo "readonly=on"; ?>></label></td>
<td><label for="tel">Téléphone </label></td>
<td><label><input type="text" name="tel" size="15" maxlength="10"  value="<?php echo $ligne_user['tel']; ?>"></label></td>  
</tr>

<!--<tr>
<td><label for="num_etudiant">N° Etudiant </label></td>
<td><label><input type="text" name="num_etudiant" size="15" value="<?php echo $ligne_user['num_etudiant']; ?>"></label></td>  
</tr>  -->

<?php
if ($statut_photo1 == '') {
?>

<tr>
<td><label for="photo">Télécharger votre photo (format jpg ou jpeg) </label></td>
<td><label><input type="file" name="photo" ></label></td> 
</tr>

<?php
} 
?>

</table>

<input type="hidden" value="<?php echo $ligne_user['identifiant']; ?>" name="identifiant"></input>
</fieldset>

<?php
if (($_SESSION['statut']) == 2) {
?>
<fieldset>
<legend>INFORMATIONS BUREAUTIQUE : <font color="red"><b>(ATTENTION A CHANGER SUR LEARNEOS !)</b></font></legend>
<table width="100%">

    <tr valign="middle">

        <TD width="30%" align="center" valign="midle">     
            <?php
            if ($ligne_user['version_office'] != '') {
                if ($ligne_user['cloud'] == 1) {
                    echo "<img src='images/cloud.png' width=90px height=60px><br>";
                    echo "Office " . $ligne_user['version_office'] . " Cloud";
                } else
                    echo "Office " . $ligne_user['version_office'];
            } else
                echo "Vous n'avez pas encore renseigné votre version d'Office"
                ?>
        </TD>
        <TD width="70%" align="center" valign="midle">
            <?php
            if ($ligne_user['cloud'] != 1) {
                Echo "<input type='checkbox' name='maj';>Je souhaite mettre à jour ma version d'Office pour : <br>";
                echo "<img src='images/cloud.png' width=90px height=60px><br>";
                echo "Office 2010 Cloud";
            }
            ?>
<!--                <select name=version_office id=version_office>
        <option value='-1'>- - Choisissez votre version du pack Office - -</option>
        <option value='2003' <?php // if ($ligne_user['version_office'] =='2003') echo 'selected=selected'   ?>>Office 2003</option>
        <option value='2007' <?php // if ($ligne_user['version_office'] =='2007') echo 'selected=selected'  ?>>Office 2007</option>
        <option value='2010' <?php // if ($ligne_user['version_office'] =='2010') echo 'selected=selected'  ?>>Office 2010</option>
        <option value='' <?php // if ($ligne_user['version_office'] =='') echo 'selected=selected'   ?>>Non déterminé</option>     
        </select>   -->

        </td>
    </TR>

</TABLE>
</fieldset>
<?php
}
?>

<br>
<label><input type="submit" name="envoyer" id="envoyer" value="Envoyer"></label>
</form> 
<?php
// mysqli_close($db);  // on ferme la connexion
}
if ((!isset($_POST['modifier'])) && (!isset($_POST['envoyer'])) && (!isset($_GET['id'])) && ($_SESSION['statut'] != 0)) {
?>

<form method="post" name="form_modif" id="formulairetotal" action="#" ENCTYPE="multipart/form-data" style="margin-left:0px;width:100%;">
<?php
echo "<fieldset><legend>INFORMATIONS ECOLES : </legend>";

// REQUETE POUR AFFICHAGE LISTE ECOLE      
if (!empty($_SESSION['id_ecole'])) { // Si connexion compte étudiant
    $id_ecole = $_SESSION['id_ecole'];
    $req_ecole = "SELECT libelle FROM " . $tableecole . " where id = " . $id_ecole . "";
    $result = mysqli_query($db, $req_ecole);
    $ligne = mysqli_fetch_assoc($result);
    $ecole = $ligne["libelle"];
    echo "Ecole : <b>" . $ecole . "";
} else { // si connexion compte admininstrateur
    $req_ecole = "SELECT id, libelle FROM " . $tableecole . "";
    $result_ecole = mysqli_query($db, $req_ecole);
    if (mysqli_num_rows($result_ecole)) {
        echo "<select name=id_ecole id=ecole onchange=this.form.submit();>";
        echo "<option value='Toutes'>- - - Choisissez l'école - - -</option>";
        while ($ligne = mysqli_fetch_assoc($result_ecole)) {
            $ecole = $ligne["libelle"];
            $id_ecole = $ligne["id"];
            if (isset($_POST['id_ecole']) && ($id_ecole == ($_POST['id_ecole'])))
                echo "<option value=" . $id_ecole . " selected=selected>" . $ecole . "</option>";
            else
                echo "<option value=" . $id_ecole . ">" . $ecole . "</option>";
        }
        echo"</select>";
    }
    $id_ecole = $_POST['id_ecole'];
}

echo"</fieldset><br><br>";



################################################ NOM ET PRENOM############################################  

echo"<fieldset><legend>INFORMATIONS ETUDIANT : </legend>";

if (($_SESSION['statut']) != 2) {
    ?>
    <div>
        <label for="identifiant">Identifiant Learneos actuel : </label><label><input type=text name="identifiant" size=14 value="<?php echo $ecole; ?>-20XX-XXX" onClick="if ((this).value == '<?php echo $ecole; ?>-20XX-XXX') {
                                (this).value = '';
                            }"></label><br />
        <label for="dtnaiss">Date de naissance(jjmmaaaa) : </label><label><input type=text name="dtnaiss" size=8></label><br />
    </div>
    <?php
} else {

    if ($id_ecole != '') {
        // REQUETE POUR AFFICHAGE Liste des étudiants de l'école selctionnée
        $req_nom_prenom = "SELECT prenom, nom, identifiant FROM " . $tableetud . " where id_ecole = " . $id_ecole . " ORDER BY nom ASC";
        $result_etudiant = mysqli_query($db, $req_nom_prenom);
        if (mysqli_num_rows($result_etudiant)) {
            echo "<select name=identifiant id=nom_prenom>";
            echo "<option value=''>- - - Choisissez l'étudiant - - -</option>";
            while ($ligne = mysqli_fetch_assoc($result_etudiant)) {
                $nom = $ligne["nom"];
                $prenom = $ligne["prenom"];
                $identifiant = $ligne["identifiant"];
                if (isset($_POST['identifiant']) && ($identifiant == ($_POST['identifiant'])))
                    echo "<option value=" . $identifiant . " selected=selected>" . $nom . ' ' . $prenom . ' [' . $identifiant . ']' . "</option>";
                else
                    echo "<option value='" . $identifiant . "'>" . $nom . ' ' . $prenom . ' [' . $identifiant . ']' . "</option>";
            }
            echo"</select>";
        }
    }
}
echo '</fieldset>';
?>

<br><br>


        <input type="submit" name="modifier" value="Modifier"/> 

        <br><br>

                </form>
                <?php
            }
            mysqli_close($db);  // on ferme la connexion
        }
        ?>


        <footer>
            <h3> 2015-2016 Centre de Formation Multimedia - CHU Purpan - Toulouse </h3>
        </footer>
        </section>
        </body>
        </html>

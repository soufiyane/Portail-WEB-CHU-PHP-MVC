<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
error_reporting(0);
//require_once('public/js/includes/connexion.php');
require_once (ROOT . DS . 'config' . DS . 'statuts.php');
require_once (ROOT . DS . 'config' . DS . 'config.php');
require_once('public/js/includes/alias_tables.php');
$_SESSION['racine'] = "https://ecoles-instituts.chu-toulouse.fr/gestion-cfm/"; 
//$errorMessage3="<font color='red'>Maintenance en cours, veuillez réessayer dans quelques instants...</font>";
// On teste si le visiteur a saisis ses id :
if ((isset($_POST['identifiant'])) && (isset($_POST['mot_de_passe']))) {
    if ($_POST['identifiant'] == "" || $_POST['mot_de_passe'] == "") {
        $errorMessage = "<font color='red';>Veuillez saisir votre nom d'utilisateur ET votre mot de passe.</font>";
    } else {
        $login = $_POST['identifiant'];
        $pwd = $_POST['mot_de_passe'];
        if (@$errorMessage3 != "") {
            $login = "";
        }

    $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('Erreur de selection '.mysqli_error($db));
    $enco=mysqli_query($db,"SET NAMES UTF8");

        // Sélection de l'utilisateur concerné
        //SI CONNEXION TECHNICIENS
        $req = mysqli_query($db,"SELECT id, identifiant, password, statut, id_ecole FROM " . $tabletech . " WHERE identifiant = '" . $login . "'");//************************************
        if (mysqli_num_rows($req) == 0)
                $errorMessage2 = "<font color='red';>Le nom d'utilisateur '<b>" . $login . "</b>' n'existe pas</font>";
            else {
        if (mysqli_error($db))
            $errorMessage = "<font color='red';>Une erreur est survenue lors de la tentative de connexion</font>";
        else {
            // Si aucun utilisateur n'a été trouvé
            
                while ($donnees = mysqli_fetch_array($req)) {
                    $id = $donnees["id"];
                    $log = $donnees["identifiant"];
                    $pwd = $donnees["password"];
                    $id_tech = $donnees["id"];
                    $statut = $donnees["statut"];
                    $id_ec = $donnees["id_ecole"];
                    $_SESSION['id_ecole']= $id_ec;
                    $_SESSION['statut'] = $statut;  
                }
                // Definition des constantes et variables
                define('LOGIN', $log);
                define('PASSWORD', $pwd);
                // Sont-ils les mémes que les constantes ?
                if (md5($_POST['mot_de_passe']) != PASSWORD)
                    $errorMessage = "<font color='red';>Mot de passe invalide !</font>";
                else {
                    // On enregistre le login en session
                    $_SESSION['identifiant'] = LOGIN;
                    $_SESSION['id_tech'] = $id_tech;
                    $my_t = getdate(date("U"));
                    $date = $my_t['year'] . '-' . $my_t['mon'] . '-' . $my_t['mday'] . ' ' . $my_t['hours'] . ':' . $my_t['minutes'] . ':' . $my_t['seconds'];
                    $sql = "INSERT INTO connexions VALUES ('" . $_SESSION['identifiant'] . "', '" . $date . "')";
                    //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                    mysqli_query($db,$sql) or die('Erreur SQL !');
                    if ($_SESSION['url'] != "") {
                        header('Location: ' . $_SESSION['url']);//*************** a voir ***************************************************
                        exit();
                    } else {
                        // On redirige vers le fichier admin.php
                        if($statut==2){
                        header('Location: incidents/incidents_attente_cfm');
                        }else{
                        header('Location: cartes/retour_cartes_tempo');    
                        }
                        exit();
                    }
                }
            }
        }
        if ($errorMessage2 != "") {
            $errorMessage2 = "";
            //SI CONNEXION ETUDIANT POUR INSCRIPTION
            $req2 = mysqli_query($db,"SELECT id_ecole,login,password FROM " . $tableecolelog . " WHERE login = '" . $login . "'");//************************************
            //if(!$req2)
            if (mysqli_num_rows($req2) == 0)
                    $errorMessage2 = "<font color='red';>Le nom d'utilisateur '<b>" . $login . "</b>' n'existe pas</font>";
                else {
            if (mysqli_error($db))
                $errorMessage = "<font color='red';>Une erreur est survenue lors de la tentative de connexion</font>";
            else {

                // Si aucun utilisateur n'a été trouvé
                
                    while ($donnees2 = mysqli_fetch_array($req2)) {
                        $log2 = $donnees2["login"];
                        $pwd2 = $donnees2["password"];
                        $id_ecole = $donnees2["id_ecole"];
                        $_SESSION['statut'] = $statut_et_insc;
                    }
                    // Definition des constantes et variables
                    define('LOGIN2', $log2);
                    define('PASSWORD2', $pwd2);
                    // Sont-ils les mémes que les constantes ?
                    if (md5($_POST['mot_de_passe']) != PASSWORD2)
                        $errorMessage = "<font color='red';>Mot de passe invalide !</font>";
                    else {
                        // On enregistre le login en session
                        $_SESSION['identifiant'] = LOGIN2;
                        $_SESSION['id_ecole'] = $id_ecole;
                        $my_t = getdate(date("U"));
                        $date = $my_t['year'] . '-' . $my_t['mon'] . '-' . $my_t['mday'] . ' ' . $my_t['hours'] . ':' . $my_t['minutes'] . ':' . $my_t['seconds'];
                        $sql = "INSERT INTO connexions VALUES ('" . $_SESSION['identifiant'] . "', '" . $date . "')";
                        //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sql) or die('Erreur SQL !');
                        if ($_SESSION['url'] != "") {
                            header('Location: ' . $_SESSION['url']);
                            exit();
                        } else {
                            // On redirige vers le fichier admin.php
                            header('Location: menu_inscription_et.php');
                            exit();
                        }
                    }
                }
            }
        }
        if ($errorMessage2 != "") {
            $errorMessage2 = "";
            //SI CONNEXION ETUDIANT POUR SUPPORT
            $req3 = mysqli_query($db,"SELECT matricule,tel,date_naissance FROM " . $tableetud . " WHERE matricule = '" . $_POST['identifiant'] . "'");//********************** 
            //if(!$req2)
            if (mysqli_num_rows($req3) == 0)
                    $errorMessage2 = "<font color='red';>Le nom d'utilisateur '<b>" . $login . "</b>' n'existe pas</font>";
                else {
            if (mysqli_error($db))
                $errorMessage = mysqli_error($db)."<font color='red';>Une erreur est survenue lors de la tentative de connexion</font>";
            else {

                // Si aucun utilisateur n'a été trouvé
                
                    while ($donnees3 = mysqli_fetch_array($req3)) {
                        $idetud = $donnees3['matricule'];
                        $log3 = $donnees3["matricule"];
                        $pwd3 = $donnees3["date_naissance"];
                        $_SESSION['tel'] = $donnees3['tel'];
                        $_SESSION['statut'] = $statut_etudiant;
                    }
                    // Definition des constantes et variables
                    define('LOGIN3', $log3);
                    define('PASSWORD3', $pwd3);
                    // Sont-ils les mémes que les constantes ?
                    if ($_POST['mot_de_passe'] != PASSWORD3)
                        $errorMessage = "<font color='red';>Mot de passe invalide !</font>";
                    else {
                        // On enregistre le login en session
                        $_SESSION['identifiant'] = LOGIN3;
                        $_SESSION['mot_de_passe'] = ($_POST['mot_de_passe']);
                        $my_t = getdate(date("U"));
                        $date = $my_t['year'] . '-' . $my_t['mon'] . '-' . $my_t['mday'] . ' ' . $my_t['hours'] . ':' . $my_t['minutes'] . ':' . $my_t['seconds'];
                        $sql = "INSERT INTO connexions VALUES ('" . $_SESSION['identifiant'] . "', '" . $date . "')";
                        //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sql) or die('Erreur SQL !');
                        if ($_SESSION['url'] != "") {
                            header('Location: ' . $_SESSION['url']);
                            exit();
                        } else {
                            // On redirige vers le fichier admin.php
                            $sql = "SELECT $tableincidusers.id, $tableincidusers.date, $tableincidents.probleme, $tableincidusers.id_etat, $tableincidusers.id_incidents, $tableincidents.statut, $tableincidusers.commentaire FROM $tableincidusers, $tableincidents WHERE $tableincidusers.id_incidents = $tableincidents.id AND id_users = '" . $idetud . "' AND id_etat <> 3";
                            //mysqli_query($db,$sql) or die ('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                            mysqli_query($db,$sql) or die('Erreur SQL !');
                            //echo $sql;
                            $req = mysqli_query($db,$sql);
                            //$donnees=mysqli_fetch_array($req);
                            $nbresult = mysqli_num_rows($req);
                            //echo $nbresult;
                            if ($nbresult > 0) {
                                header('Location: incidents/mes_problemes');// ************ a modifier --> mes probleme
                            } else {
                                header('Location: incidents/rediger_incident');
                            }
                            exit();
                        }
                    }
                }
            }
        }
        if ($errorMessage2 != "") {
            $errorMessage2 = "";
        //  if (preg_match("/^cfps.*$/", $_POST['identifiant'])) $log=$_POST['identifiant']; else $log="cfps.".$_POST['identifiant'];
            //SI CONNEXION CFPS POUR SUPPORT
            $req4 = mysqli_query($db,"SELECT date_naissance FROM $tableagent WHERE matricule = ".$_POST['identifiant']."");//********************************************
            //if(!$req2)
             if (mysqli_num_rows($req4) == 0) {
                    $errorMessage2 = "<font color='red';>Le nom d'utilisateur '<b>" . $login . "</b>' n'existe pas</font>";
                } else {  
            if (mysqli_error($db)) {
                $errorMessage = "<font color='red';>Une erreur est survenue lors de la tentative de connexion</font>";
            } else {

                // Si aucun utilisateur n'a été trouvé
                                 
                    while ($donnees4 = mysqli_fetch_array($req4)) {
                        $log4 = $_POST['identifiant'];
                        $pwd4 = $donnees4["date_naissance"];
                        $_SESSION['statut'] = $statut_agent;
                    }
                    // Definition des constantes et variables
                    define('LOGIN4', $log4);
                    define('PASSWORD4', $pwd4);
                    // Sont-ils les mémes que les constantes ?
                    if ($_POST['mot_de_passe'] != PASSWORD4) {
                        $errorMessage = "<font color='red';>Mot de passe invalide !</font>";
                    } else {
                        // On ouvre la session
                        session_start();
                        // On enregistre le login en session
                        $_SESSION['identifiant'] = LOGIN4;
                        $_SESSION['public']="cfps";
                        $_SESSION['mot_de_passe'] = ($_POST['mot_de_passe']);
                        $my_t = getdate(date("U"));
                        $date = $my_t['year'] . '-' . $my_t['mon'] . '-' . $my_t['mday'] . ' ' . $my_t['hours'] . ':' . $my_t['minutes'] . ':' . $my_t['seconds'];
                        $sql = "INSERT INTO connexions VALUES ('" . $_SESSION['identifiant'] . "', '" . $date . "')";
                        //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sql) or die('Erreur SQL !');
                        if ($_SESSION['url'] != "") {
                            header('Location: ' . $_SESSION['url']);
                            exit();
                        } else {
                            // On redirige vers le fichier admin.php
                            header('Location: incidents/rediger_incident');
                            exit();
                        }
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Plateforme de Support - Identifiez-vous</title>

 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
  <link rel="stylesheet" type="text/css" href="public/css/bootstrap/dist/css/bootstrap.min.css">   
        <link rel="stylesheet" type="text/css" href="public/css/monCss.css" />

         <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">       
        <link rel="stylesheet" href="public/assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="public/assets/css/form-elements.css">
        <link rel="stylesheet" href="public/assets/css/style.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="public/assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="public/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="public/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="public/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="public/assets/ico/apple-touch-icon-57-precomposed.png">



        <script src="public/css/bootstrap/dist/js/bootstrap.min.js"></script>

   
        <!--[if lt IE 9]>
 <script src="public/IE/html5shiv.js" type="text/javascript"></script>
 <script src="public/IE/respond.js" type="text/javascript"></script>
<![endif]-->
    </head>
<body   onload="close_all_modal();" style="padding-top:20px;">
<!--[if IE 8]><center><![endif]-->

        
           
     
     
  

  <div class="top-content">
            
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Plateforme de Support</strong></h1>
                            <div class="description">
                                <p>
                                    Ce site est une plateforme de support de dépannage, il vous permet de créer des incidents,
                                    consulter les solutions de vos incidents ainsi que contacter nos techniciens.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Identifiez-vous</h3>
                                    <p>Entrez votre identifiant et votre mot de passe pour se connecter:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>

                            <div class="form-bottom">
                             <p style="margin-left:auto;margin-right:auto;width:600px;text-align:center;display:none;">Publié le 27/12/2013:<br />Attention!!! La plateforme Learneos a déménagé le 26 décembre 2013.<br />
                             Pensez é modifier vos favoris ainsi que vos sites de confiance pour : http://lms.learneos.fr</p>
                                <form role="form" action="#" method="post" class="login-form" autocomplete="on">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Identifiant</label>
                                        <input autocomplete="on" type="text" name="identifiant" placeholder="Identifiant..." class="form-username form-control" id="form-identifiant">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Mot de passe</label>
                                        <input autocomplete="on" type="password" name="mot_de_passe" placeholder="Mot de passe..." class="form-password form-control" id="form-password">
                                    </div>
                                    <button type="submit" class="btn">Connexion!</button>
                                    <p style="margin-left:auto;margin-right:auto;width:180px;text-align:center;"><font size="1">Identifiants oubliés ? <a href="#">Cliquez ici</a></font></p>
                                </form>
                                <p style="margin-left:auto;margin-right:auto;width:600px;text-align:center;">
                        <?php                        
                        if (@$errorMessage3 == "") {
                            if ($errorMessage2 != "") {
                                echo "<p align='center'>".$errorMessage2."</p>";
                            } else if ($errorMessage != "") {
                                echo "<p align='center'>".$errorMessage."</p>";
                            }
                        }else{
                          echo "<p align='center' >".$errorMessage3."</p>";  
                        }
                        ?>
                        </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


           <footer>
           <h3 style="color: Snow";">2016-2017 Centre de Formation Multimedia - PREFMS - Toulouse</h3>
           </footer>

        
        <!-- Javascript -->
        <script src="public/assets/js/jquery-1.11.1.min.js"></script>
        <script src="public/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="public/assets/js/jquery.backstretch.min.js"></script>
        <script src="public/assets/js/scripts.js"></script>

    </body>
</html>
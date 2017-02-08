<?php
session_start();
// On inclus les données de connexion :
require_once('includes/connexion.php');
require_once('includes/statuts.php');
require_once('includes/alias_tables.php');

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
        // Sélection de l'utilisateur concerné
        //SI CONNEXION TECHNICIENS
        $req = mysqli_query($db,"SELECT id, identifiant, password, statut, id_ecole FROM " . $tabletech . " WHERE identifiant = '" . $login . "'");
        if (mysqli_error($db))
            $errorMessage = "<font color='red';>Une erreur est survenue lors de la tentative de connexion</font>";
        else {
            // Si aucun utilisateur n'a été trouvé
            if (mysqli_num_rows($req) == 0)
                $errorMessage2 = "<font color='red';>Le nom d'utilisateur '<b>" . $login . "</b>' n'existe pas</font>";
            else {
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
                    $date = $my_t[year] . '-' . $my_t[mon] . '-' . $my_t[mday] . ' ' . $my_t[hours] . ':' . $my_t[minutes] . ':' . $my_t[seconds];
                    $sql = "INSERT INTO connexions VALUES ('" . $_SESSION['identifiant'] . "', '" . $date . "')";
                    //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                    mysqli_query($db,$sql) or die('Erreur SQL !');
                    if ($_SESSION['url'] != "") {
                        header('Location: ' . $_SESSION['url']);
                        exit();
                    } else {
                        // On redirige vers le fichier admin.php
                        if($statut==2){
                        header('Location: menu.php');
                        }else{
                        header('Location: cartes/index.php');    
                        }
                        exit();
                    }
                }
            }
        }
        if ($errorMessage2 != "") {
            $errorMessage2 = "";
            //SI CONNEXION ETUDIANT POUR INSCRIPTION
            $req2 = mysqli_query($db,"SELECT id_ecole,login,password FROM " . $tableecolelog . " WHERE login = '" . $login . "'");
            //if(!$req2)
            if (mysqli_error($db))
                $errorMessage = "<font color='red';>Une erreur est survenue lors de la tentative de connexion</font>";
            else {

                // Si aucun utilisateur n'a été trouvé
                if (mysqli_num_rows($req2) == 0)
                    $errorMessage2 = "<font color='red';>Le nom d'utilisateur '<b>" . $login . "</b>' n'existe pas</font>";
                else {
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
                        $date = $my_t[year] . '-' . $my_t[mon] . '-' . $my_t[mday] . ' ' . $my_t[hours] . ':' . $my_t[minutes] . ':' . $my_t[seconds];
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
            $req3 = mysqli_query($db,"SELECT identifiant,tel,date_naissance FROM " . $tableetud . " WHERE identifiant = '" . $_POST['identifiant'] . "'");
            //if(!$req2)
            if (mysqli_error($db))
                $errorMessage = mysqli_error($db)."<font color='red';>Une erreur est survenue lors de la tentative de connexion</font>";
            else {

                // Si aucun utilisateur n'a été trouvé
                if (mysqli_num_rows($req3) == 0)
                    $errorMessage2 = "<font color='red';>Le nom d'utilisateur '<b>" . $login . "</b>' n'existe pas</font>";
                else {
                    while ($donnees3 = mysqli_fetch_array($req3)) {
                        $idetud = $donnees3['identifiant'];
                        $log3 = $donnees3["identifiant"];
                        $pwd3 = $donnees3["date_naissance"];
                        $_SESSION['tel'] = $donnees3['tel'];
                        $_SESSION['statut'] = $statut_et_supp;
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
                        $date = $my_t[year] . '-' . $my_t[mon] . '-' . $my_t[mday] . ' ' . $my_t[hours] . ':' . $my_t[minutes] . ':' . $my_t[seconds];
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
                                header('Location: support/mes_problemes.php');
                            } else {
                                header('Location: support/liste_plateforme.php');
                            }
                            exit();
                        }
                    }
                }
            }
        }
        if ($errorMessage2 != "") {
            $errorMessage2 = "";
			if (preg_match("/^cfps.*$/", $_POST['identifiant'])) $log=$_POST['identifiant']; else $log="cfps.".$_POST['identifiant'];
            //SI CONNEXION CFPS POUR SUPPORT
            $req4 = mysqli_query($db,"SELECT date_naissance FROM $tableagent WHERE username = '" . $log . "'");
            //if(!$req2)
            if (mysqli_error($db)) {
                $errorMessage = "<font color='red';>Une erreur est survenue lors de la tentative de connexion</font>";
            } else {

                // Si aucun utilisateur n'a été trouvé
                if (mysqli_num_rows($req4) == 0) {
                    $errorMessage2 = "<font color='red';>Le nom d'utilisateur '<b>" . $login . "</b>' n'existe pas</font>";
                } else {
                    while ($donnees4 = mysqli_fetch_array($req4)) {
                        $log4 = $log;
                        $pwd4 = $donnees4["date_naissance"];
                        $_SESSION['statut'] = $statut_et_supp;
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
                        $date = $my_t[year] . '-' . $my_t[mon] . '-' . $my_t[mday] . ' ' . $my_t[hours] . ':' . $my_t[minutes] . ':' . $my_t[seconds];
                        $sql = "INSERT INTO connexions VALUES ('" . $_SESSION['identifiant'] . "', '" . $date . "')";
                        //mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
                        mysqli_query($db,$sql) or die('Erreur SQL !');
                        if ($_SESSION['url'] != "") {
                            header('Location: ' . $_SESSION['url']);
                            exit();
                        } else {
                            // On redirige vers le fichier admin.php
                            header('Location: support/liste_plateforme.php');
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="CFM">

        <title>Plateforme de Support - Identifiez-vous</title>

        <!-- Bootstrap core CSS -->

<link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">       
        <link rel="stylesheet" type="text/css" href="support/css/monCss.css" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="bootstrap/assets/js/html5shiv.js"></script>
          <script src="bootstrap/assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <section>
            <header>
                <CENTER>	
                    <img src="support/img/bandeau - support.jpg" width="100%" />			
                </CENTER>
            </header>
            <nav>
                <ul style="padding-left:0px;">
                    <li> <font color="#ffffff" ><b> Identifiez-vous </b> </font> </li>					
                </ul>
            </nav>
            <br><br><br><br>
            <!-- formulaire d'identifiaction é deux champs (id et mdp) -->
            <div class="container">
                <p style="margin-left:auto;margin-right:auto;width:600px;text-align:center;display:none;">Publié le 27/12/2013:<br />Attention!!! La plateforme Learneos a déménagé le 26 décembre 2013.<br />
                    Pensez é modifier vos favoris ainsi que vos sites de confiance pour : http://lms.learneos.fr</p>
                <form class="form-signin" method="post" action="#">
                    <h2 class="form-signin-heading">Identifiez-vous</h2>
                    <input type="text" class="form-control" placeholder="Identifiant" name="identifiant" autofocus>
                    <input type="password" class="form-control" placeholder="Mot de passe" name="mot_de_passe">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
                    <p style="margin-left:auto;margin-right:auto;width:180px;text-align:center;"><font size="1">Identifiants oubliés ? <a href="oubli.php">Cliquez ici</a></font></p>
                </form>
                <p style="margin-left:auto;margin-right:auto;width:600px;text-align:center;">
                        <?php                        
                        if (@$errorMessage3 == "") {
                            if ($errorMessage2 != "") {
                                echo "<b>".$errorMessage2."</b>";
                            } else if ($errorMessage != "") {
                                echo "<b>".$errorMessage."</b>";
                            }
                        }else{
                          echo "<b>".$errorMessage3."</b>";  
                        }
                        ?>
                        </p>
            </div>
            <br><br><br><br><br><br>
            <?php
            include ("includes/footer.php");
            ?>
        </section>
    </body>
</html>
<?php
// On active les sessions :
//session_start();
// On inclus les donn�es de connexion :
require_once('includes/connexion.php');
require_once('includes/verification.php');
require_once('includes/alias_tables.php');
error_reporting(0);
switch ($_SESSION['statut']) {
    case 2: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
}
?>
<!DOCTYPE html>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Ajouter un dépannage</title>
        <script src="html5shiv/dist/html5shiv.js">
        </script>
        <script language=javascript>
            function redirige(adresse)
            {
                location.href = adresse;
            }
        </script> 
    </head>
    <body>
        <?php
        $my_t = getdate(date("U"));
        //mysql_select_db($database_db,$db)   or die('Erreur de selection '.mysqli_error($db));  
        // On r�cup�re les infos utilisateur
        if ($_POST['technicien'] == 'none') {
            ?>
            <script>
                alert('Veuillez choisir un technicien');
                history.back();//The back() method loads the previous URL in the history list
            </script>
            <?php
            exit;
        }
        if ($_POST['mode'] == 'none') {
            ?>
            <script>
                alert('Veuillez choisir le mode de dépannage.');
                history.back();
            </script>
            <?php
            exit;
        }
        if (($_POST['detail'] == '') OR ($_POST['detail'] == 'Detail intervention...')) {
            ?>
            <script>
                alert('Veuillez renseigner le détail de l\'intervention.');
                history.back();
            </script>
            <?php
            exit;
        }
        if ($my_t[mday] < 10) {
            $my_t[mday] = "0" . $my_t[mday];
        }
        if ($my_t[mon] < 10) {
            $my_t[mon] = "0" . $my_t[mon];
        }
        $datecom = $my_t[mday] . '/' . $my_t[mon] . '/' . $my_t[year];
        $date = $my_t[year] . '-' . $my_t[mon] . '-' . $my_t[mday] . ' ' . $my_t[hours] . ':' . $my_t[minutes] . ':' . $my_t[seconds];
        $mess = $_POST['message'];
        $mode = $_POST['mode'];
        //echo $_POST['mode'];
        if ($mode == "Par mail") {
            $sql = "UPDATE $tableincidusers SET id_etat='4' WHERE id=" . $_POST['id_incidents_to_users'] . "";
            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
            mysqli_query($db,$sql) or die('Erreur SQL1!');
            $sql = "INSERT INTO $tabledepa (id_tech,id_incidents_to_users,date,detail,mess_tech,mode,duree)VALUE('" . $_POST['technicien'] . "', '" . $_POST['id_incidents_to_users'] . "', '" . $date . "', '" . addslashes($_POST['detail']) . "', '" . addslashes($mess) . "','" . $_POST['mode'] . "','" . $_POST['duree'] . "')";
            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
            mysqli_query($db,$sql) or die('Erreur SQL2!');
            $sql = "SELECT probleme FROM $tableincidents
                LEFT JOIN $tableincidusers
                ON $tableincidusers.id_incidents=$tableincidents.id
                WHERE $tableincidusers.id= '" . $_POST['id_incidents_to_users'] . "'";
            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
            mysqli_query($db,$sql) or die('Erreur SQL3!');
            $req = mysqli_query($db,$sql);
            $donnees = mysqli_fetch_array($req);
            $probleme = $donnees[0];
            mysqli_query($db,$sql) or die('Erreur SQL4!');
            $sql = "SELECT mail FROM $tableetud
                LEFT JOIN $tableincidusers
                ON $tableincidusers.id_users=$tableetud.matricule
                WHERE $tableincidusers.id= '" . $_POST['id_incidents_to_users'] . "'";
            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
            mysqli_query($db,$sql) or die('Erreur SQL5!');
            $req = mysqli_query($db,$sql);
            $donnees = mysqli_fetch_array($req);
            $mailetud = $donnees[0];
            //echo"<script>alert('".$mailetud."');</script>";
            // class DE PHPMailler qui marche avec le class class.smtp.php
            require("class.phpmailer.php");
            $mail = new PHPMailer();
            $titre = 'Suivi incident technique - ' . $plateforme;
            include('includes/configmail.php');
            // On �crit un mail dans lequel on rappelle la plateforme sur laquelle l'incident est apparu, puis le nom de l�l�ve, sa classe, le probl�me qu'il a eu, le n� de l'incident avec un lien vers la page admin.php pour retrouver la ligne correspondante � l'incident puis en fin de mail l'adresse de contact de l'�tudiant pour pouvoir lui envoyer une r�ponse directement.
            $messcont = "<p>Bonjour,<br /><br />Un technicien vous a répondu concernant votre problème (<i>\"$probleme\"</i>).</p><p>Pour consulter la réponse, veuillez vous connecter au <a href='$racine'>site de support</a>.</p><p><b><u>N.B.:</u></b> Ceci est un message automatique, merci de ne pas y répondre.</p><p>Equipe technique,<br />Centre de Formation Multimédia.</p>";
            //$mess = "Bonjour,<br /><br />Un technicien vous a r�pondu concernant votre probl�me (<i>\"$probleme\"</i>).<br />Pour consulter la r�ponse, veuillez vous connecter au <a href='$racine'>site de support</a>.<br /><br /><b><u>N.B.:</u></b> Ceci est un message automatique, merci de ne pas y r�pondre.<br /><br />Equipe technique,<br />Centre de Formation Multim�dia.";
            // L'adresse exp�diteur
            $mail->From = "noreply".$domaine;
            // L'objet du mail
            $mail->FromName = "Support CFM";
            // Le sujet du mail
            $mail->Subject = "Réponse incident n° " . $_POST['id_incidents_to_users'] . "";
            //FIndes param�trages pour l'envois de mail et envois de ce dernier si le cota n'est pas atteint
            $mail->WordWrap = 50;
            // L'adresse destinataire
            $mail->AddAddress($mailetud); // Mail de l'�tudiant
            // On ajoute le message � l'objet mail
            $mess = $headmess . $messcont . $footmess;
            $mail->MsgHTML($mess);
            // Si le mail est envoy�
            if ($mail->Send()) {
                echo"<script>alert('Mail correctement envoyé !');</script>";
            } else {
                echo"<script>alert('Erreur lors de l'envois !');</script>";
            }
        } else {
            $sql = "INSERT INTO $tabledepa (id_tech,id_incidents_to_users,date,detail,mode,duree)VALUE('" . $_POST['technicien'] . "', '" . $_POST['id_incidents_to_users'] . "', '" . $date . "', '" . addslashes($_POST['detail']) . "','" . $_POST['mode'] . "','" . $_POST['duree'] . "')";
            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
            mysqli_query($db,$sql) or die('Erreur SQL6!');
        }
        $sql = "SELECT COUNT(id) FROM $tabledepa WHERE id_incidents_to_users=" . $_POST['id_incidents_to_users'] . "";
        //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
        mysqli_query($db,$sql) or die('Erreur SQL7!');
        $req = mysqli_query($db,$sql);
        $donnees = mysqli_fetch_array($req);
        $nombre = $donnees[0];
        $sql = "UPDATE $tableincidusers SET commentaire='En cours, nombre d\'intervention: " . $nombre . ".' WHERE id=" . $_POST['id_incidents_to_users'] . "";
        //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
        mysqli_query($db,$sql) or die('Erreur SQL8!');
        if ($_POST['attente'] == 'attente') {
            $sql = "UPDATE $tableincidusers SET id_etat='4' WHERE id=" . $_POST['id_incidents_to_users'] . "";
            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
            mysqli_query($db,$sql) or die('Erreur SQL9!');
        }
        if ($_POST['resolve'] == 'resolve') {
            $sql = "SELECT prenom FROM $tabletech WHERE id=" . $_POST['technicien'] . "";
            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
            mysqli_query($db,$sql) or die('Erreur SQL10!');
            $req = mysqli_query($db,$sql);
            $donnees = mysqli_fetch_array($req);
            $technicien_prenom = $donnees[0];
            $sql = "UPDATE $tableincidusers SET commentaire='Résolu le " . $datecom . " par " . $technicien_prenom . "' WHERE id=" . $_POST['id_incidents_to_users'] . "";
            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
            mysqli_query($db,$sql) or die('Erreur SQL11!');
            $sql = "UPDATE $tableincidusers SET id_etat=3 WHERE id=" . $_POST['id_incidents_to_users'] . "";
            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
            mysqli_query($db,$sql) or die('Erreur SQL12!');
            $sql = "SELECT id_incidents FROM $tableincidusers WHERE $tableincidusers.id=" . $_POST['id_incidents_to_users'] . "";
            //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
            mysqli_query($db,$sql) or die('Erreur SQL13!');
            $req = mysqli_query($db,$sql);
            $donnees = mysqli_fetch_array($req);
            $id_incidents = $donnees[0];
            $sql = "SELECT statut FROM $tableincidents WHERE $tableincidents.id = " . $id_incidents . "";
            mysqli_query($db,$sql) or die ('Erreur SQL14!'.$sql.'<br />'.mysqli_error($db));
            //mysqli_query($db,$sql) or die('Erreur SQL14!');
            $req = mysqli_query($db,$sql);
            $donnees = mysqli_fetch_array($req);
            $recurrent = $donnees[0];
            if ($recurrent == 0) {
                //$sql="INSERT INTO $tablesolu VALUE (".$id_incidents.", 1, '".$_POST['detail']."')";
                $sql = "INSERT INTO $tablesolu VALUE ('','','" . $_POST['detail'] . "')";
                $idsol = mysqli_insert_id($db);
                $sql = "INSERT INTO $tablesoltoincid VALUE (''," . $id_incidents . "," . $idsol . ", '" . $_POST['detail'] . "')";
                //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
                mysqli_query($db,$sql) or die('Erreur SQL15!');
                ?>
                <script>
                    alert('Le problème est résolu, il va être archivé. Le détail du dépannage est enregistré comme solution.');
                    opener.location.reload();/////*********
                    window.close();/////////************ a voir
                </script>
        <?php
    } else {
        ?>
                <script>
                    alert('Le problème est résolu, il va être archivé.');
                    opener.location.reload();
                    window.close();
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert('Le dépannage a été correctement ajouté.');
                redirige("admin_detail.php?id=<?php echo $_POST['id_incidents_to_users']; ?>&solution=1");
            </script> 
            <?php
        }
        exit();
        ?>
    </body>
</html>
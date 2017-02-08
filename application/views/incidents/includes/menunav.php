<script src="../support/js/liste.js"></script>
<link rel="stylesheet" href="../support/css/liste.css" type="text/css" />
<?php
$monUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$statut = $_SESSION['statut'];
if ($statut == 1) {
    ?>
    <nav>
        <ul>
            <li> <a href="liste_plateforme.php" <?php
    $masque = "#liste_plateforme.php#i";
    if (preg_match($masque, $monUrl)) {
        echo 'class = "current" id="current"';
    }
    ?>>Régler un incident</a></li>
            <li> <a href="mes_problemes.php" <?php
                $masque = "#mes_problemes.php#i";
                if (preg_match($masque, $monUrl)) {
                    echo 'class = "current" id="current"';
                }
    ?>>Problèmes en cours</a></li>
            <li> <a href="resolus.php" <?php
                $masque = "#resolus.php#i";
                if (preg_match($masque, $monUrl)) {
                    echo 'class = "current" id="current"';
                }
    ?>>Problèmes résolus</a></li>					
            <li> <a href="mesinfos.php" <?php
                $masque = "#mesinfos.php#i";
                if (preg_match($masque, $monUrl)) {
                    echo 'class = "current" id="current"';
                }
    ?>>Mes Informations</a></li>
            <li> <a href="outils.php" <?php
                $masque = "#outils.php#i";
                if (preg_match($masque, $monUrl)) {
                    echo 'class = "current" id="current"';
                }
    ?>>Boite à outils</a></li>
            <li> <a href="deconnexion.php" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');"> Deconnexion </a> </li>
        </ul>
    </nav>
    <?php
}
if ($statut == 2) {
    ?>
    <nav id="menu">
        <ul class="level1">
            <li class="level1-li"> <a class="level1-a" href="admin.php" <?php
    $masque = "#admin.php|admin_attente_etu.php#i";
    if (preg_match($masque, $monUrl)) {
        echo 'class = "current" id="current"';
    }
    ?>>Incidents en cours</a></li>
            <li class="level1-li"> <a class="level1-a" href="admin_resolus.php" <?php
                                  $masque = "#admin_resolus.php#i";
                                  if (preg_match($masque, $monUrl)) {
                                      echo 'class = "current" id="current"';
                                  }
    ?>>Incidents résolus </a></li>
	<li class="level1-li"> <a class="level1-a drop" href="#url" <?php
                                  $masque = "#admin_newincidentsto#i";
								  $masque2 = "#new_incid_salle#i";
                                  if (preg_match($masque, $monUrl)) {
                                      echo 'class = "current" id="current"';
                                  }else if (preg_match($masque2, $monUrl)) {
                                      echo 'class = "current" id="current"';
                                  }
    ?>>Nouvel incident<!--[if gte IE 7]><!--></a><!--<![endif]-->
            <!--[if lte IE 6]><table><tr><td><![endif]-->
                <ul class="level2">
                    <li><a href="admin_newincidentstousers.php">Utilisateur</a></li>
                    <li><a href="new_incid_salle.php">Salle</a></li>
                </ul>
                <!--[if lte IE 6]></td></tr></table></a><![endif]-->
            </li>
            <li class="level1-li"> <a class="level1-a" href="gestion_incidents_recurrents.php" <?php
                                  $masque = "#gestion_incidents_recurrents.php|gestion_incidents_non_recurrents.php|edit_incidents.php|admin_newincidents.php#i";
                                  if (preg_match($masque, $monUrl)) {
                                      echo 'class = "current" id="current"';
                                  }
    ?>>Gestion des problèmes</a></li>
            <li class="level1-li"> <a class="level1-a" href="stats.php" <?php
                                  $masque = "#stats.php#i";
                                  if (preg_match($masque, $monUrl)) {
                                      echo 'class = "current" id="current"';
                                  } else {
                                      echo "onmouseover=mouseOver('current'); onmouseout=mouseOut('current');";
                                  }
    ?>>Stats</a></li>
            <li class="level1-li"> <a class="level1-a drop" href="#url">Recherche<!--[if gte IE 7]><!--></a><!--<![endif]-->
            <!--[if lte IE 6]><table><tr><td><![endif]-->
                <ul class="level2">
                    <li><a href="../recherche_et.php">Etudiants</a></li>
                    <li><a href="../recherche_cfps.php">CFPS</a></li>
                </ul>
                <!--[if lte IE 6]></td></tr></table></a><![endif]-->
            </li>
            <!--<li> <a href="liste_etudiant.php" onmouseover="mouseOver('current');" onmouseout="mouseOut('current');">Liste �tudiants </a> </li>-->
            <li class="level1-li"> <a class="level1-a" href="../menu.php">Retour Menu</a> </li>
        </ul>
    </nav>
    <?php
}
?>
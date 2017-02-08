   <?php
$monUrl1 = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//$statut = $_SESSION['statut'];
//if ($statut == 1) {
    ?>
    <!-- Navbar -->
    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Support secrétaire</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Gestion des cartes</a>
        </div>
        <div class="navbar-collapse collapse">

            <!-- Left nav -->
            <ul class="nav navbar-nav cc">
                <li><a href="<?php echo $_SESSION['racine']?>cartes/information_cartes"
                <?php
                $masque = "#information_cartes#i";
                if (preg_match($masque, $monUrl1)) {
                    echo 'class = "current" id="current"';
                }
                ?>
                >Etat des cartes</a></li>
                <li><a href="<?php echo $_SESSION['racine']?>cartes/retour_cartes_tempo"
                <?php
                $masque = "#retour_carte#i";
                if (preg_match($masque, $monUrl1)) {
                    echo 'class = "current" id="current"';
                }
                ?>
                >Retour carte provisoire pour échange avec définitive</a></li>
                <li><a href="<?php echo $_SESSION['racine']?>cartes/retour_cartes_tempo?finsco=1"
                <?php
                $masque = "#retour_cartes?finsco=1#i";
                if (preg_match($masque, $monUrl1)) {
                    echo 'class = "current" id="current"';
                }
                ?>
                >  Retour carte provisoire en fin de scolarité</span></a></li>  
                </ul>
                <ul class="nav navbar-nav navbar-right">                      
                <li><a href="<?php echo $_SESSION['racine']?>public/deconnexion.php"
                <?php
                $masque = "#deconnexion.php#i";
                if (preg_match($masque, $monUrl1)) {
                    echo 'class = "current" id="current"';
                }
                ?>
                >Deconnexion</a></li>
            </ul>

        </div><!--/.nav-collapse -->
    </div>
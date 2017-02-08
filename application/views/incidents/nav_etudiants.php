   <?php
$monUrl1 = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//$statut = $_SESSION['statut'];
//if ($statut == 1) {
    ?>
    <!-- Navbar -->
    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Plateforme de support</a>
        </div>
        <div class="navbar-collapse collapse">

            <!-- Left nav -->
            <ul class="nav navbar-nav cc">
                <li><a href="http:\\localhost\framework\incidents\rediger_incident"
                <?php
                $masque = "#rediger_incident#i";
                if (preg_match($masque, $monUrl1)) {
                    echo 'class = "current" id="current"';
                }
                ?>
                >Régler un incident</a></li>
                <li><a href="http:\\localhost\framework\incidents\mes_problemes"
                <?php
                $masque = "#mes_problemes#i";
                if (preg_match($masque, $monUrl1)) {
                    echo 'class = "current" id="current"';
                }
                ?>
                >Problèmes en cours</span></a></li>
                <li><a href="http:\\localhost\framework\incidents\problemes_resolus"
                <?php
                $masque = "#problemes_resolus#i";
                if (preg_match($masque, $monUrl1)) {
                    echo 'class = "current" id="current"';
                }
                ?>
                >Problèmes résolus</span></a></li>
                <li><a href="http:\\localhost\framework\incidents\mes_infos"
                <?php
                $masque = "#mes_infos#i";
                if (preg_match($masque, $monUrl1)) {
                    echo 'class = "current" id="current"';
                }
                ?>
                >Mes Informations</span></a></li>   
                <li><a href="http:\\localhost\framework\incidents\mes_outils"
                <?php
                $masque = "#mes_outils#i";
                if (preg_match($masque, $monUrl1)) {
                    echo 'class = "current" id="current"';
                }
                ?>
                >Boite à outils</a></li>             
                <li><a href="http:\\localhost\framework\public\deconnexion.php"
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
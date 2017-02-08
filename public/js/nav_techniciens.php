    <!-- Navbar -->
    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div class="navbar-collapse collapse">

            <!-- Left nav -->
            <ul class="nav navbar-nav">
                <li><a href="#">Recherche<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Etudiants</a></li>
                        <li><a href="#">Agents</a></li>
                    </ul>
                </li>
                <li><a href="#">Nouvel Incident<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="http:\\localhost\framework\incidents\nouvel_incident_utilisateur">Utilisateur</a></li>
                        <li><a href="http:\\localhost\framework\incidents\nouvel_incident_salle">Salle</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right nav -->
            <ul class="nav navbar-nav navbar-right">

                <li><a href="#">Etudiants<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Inscription & modification</a></li>
                        <li><a href="#">Recherche & Historique</a></li>
                        <li><a href="#">Report & Fin de scolarité</a></li>
                        <li><a href="#">Import & Mise à jour</a></li>
                        <li><a href="#">Export</a></li>
                        <li><a href="#">Transcoder un Identifiant</a></li>
                    </ul>
                </li>

                <li><a href="#">Agents<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://localhost/framework/agents/modification_agent">Modification</a></li>
                        <li><a href="http://localhost/framework/agents/liste_agents">Recherche & Historique</a></li>
                    </ul>
                </li>

                <li><a href="#">Support<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Incidents en Cours <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="http:\\localhost\framework\incidents\incidents_attente_CFM">En attente du CFM</a></li>
                                <li><a href="http:\\localhost\framework\incidents\incidents_attente_etudiant">En attente de l'étudiant</a></li>
                            </ul>
                        </li>
                        <li><a href="http:\\localhost\framework\incidents\incidents_resolus">Incidents Résolus</a></li>
                        <li><a href="#">Nouvel Incident<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="http:\\localhost\framework\incidents\nouvel_incident_utilisateur"">Utilisateur</a></li>
                                <li><a href="http:\\localhost\framework\incidents\nouvel_incident_salle">Salle</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Gestion des Problèmes<span class="caret"></span></a>
                           <ul class="dropdown-menu">
                               <li><a href="http:\\localhost\framework\incidents\gestion_incidents_recurrents">gestion incidents recurrents</a></li>
                               <li><a href="http:\\localhost\framework\incidents\gestion_incidents_non_recurrents">gestion incidents non recurrents</a></li>
                           </ul>
                        </li>
                        <li><a href="http:\\localhost\framework\incidents\statistiques">Statistiques</a></li>                        
                    </ul>
                </li>

                <li><a href="#">Casques<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Etudiants <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Attribution a un Etudiant</a></li>
                                <li><a href="#">Attribution a une liste d'étudiants</a></li>
                                <li><a href="#">Retour casque</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Agents <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Attribution a un Agent</a></li>
                                <li><a href="#">Attribution a une liste d'agents</a></li>
                                <li><a href="#">Attribution a un pool</a></li>
                                <li><a href="#">Retour casque</a></li>
                                <li><a href="#">Retour casque pool</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li><a href="#">Cartes<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Importation</a></li>
                        <li><a href="#">Exportation<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">vers SCOPUS</a></li>
                                <li><a href="#">vers AGIRH</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Attribution<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Un Etudiant</a></li>
                                <li><a href="#">Un groupe d'Etudiant</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Déclarer une perte de carte définitive</a></li>
                        <li><a href="#">Retourner une carte provisoire</a></li>
                    </ul>
                </li>
                <li><a href="http:\\localhost\framework\public\deconnexion.php">Deconnexion</a></li>

            </ul>

        </div><!--/.nav-collapse -->
    </div>
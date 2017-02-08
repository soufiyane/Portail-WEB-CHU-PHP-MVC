    <!-- Navbar -->
    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Support Agent</a>
        </div>
        <div class="navbar-collapse collapse">

            <!-- Left nav -->
         
            <ul id="side" class="nav navbar-nav">
                <li id="a_rech"><a  href="<?php echo $_SESSION['racine']?>etudiants/liste_etudiants">Recherche<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="rech"><a href="<?php echo $_SESSION['racine']?>etudiants/liste_etudiants">Etudiants</a></li>
                        <li class="rech"><a href="<?php echo $_SESSION['racine']?>agents/liste_agents">Agents</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo $_SESSION['racine']?>incidents/nouvel_incident_utilisateur">Nouvel Incident<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $_SESSION['racine']?>incidents/nouvel_incident_utilisateur">Utilisateur</a></li>
                        <li><a href="<?php echo $_SESSION['racine']?>incidents/nouvel_incident_salle">Salle</a></li>
                    </ul>
                </li>
            </ul>
            

            <!-- Right nav -->
            <ul class="nav navbar-nav navbar-right">

                <li><a href="<?php echo $_SESSION['racine']?>etudiants/liste_etudiants">Etudiants<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Inscription & modification</a></li>
                        <li><a href="<?php echo $_SESSION['racine']?>etudiants/liste_etudiants">Recherche & Historique</a></li>
                        <li><a href="<?php echo $_SESSION['racine']?>etudiants/importation_etudiants">importation etudiants</a></li>
                    </ul>
                </li>

                <li><a href="<?php echo $_SESSION['racine']?>agents/liste_agents">Agents<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $_SESSION['racine']?>agents/modification_agent">Modification</a></li>
                        <li><a href="<?php echo $_SESSION['racine']?>agents/liste_agents">Recherche & Historique</a></li>
                    </ul>
                </li>

                <li><a href="<?php echo $_SESSION['racine']?>incidents/incidents_attente_CFM">Support<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $_SESSION['racine']?>incidents/incidents_attente_CFM">Incidents en Cours <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $_SESSION['racine']?>incidents/incidents_attente_CFM">En attente du CFM</a></li>
                                <li><a href="<?php echo $_SESSION['racine']?>incidents/incidents_attente_etudiant">En attente de l'étudiant</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo $_SESSION['racine']?>incidents/incidents_resolus">Incidents Résolus</a></li>
                        <li><a href="#">Nouvel Incident<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $_SESSION['racine']?>incidents/nouvel_incident_utilisateur"">Utilisateur</a></li>
                                <li><a href="<?php echo $_SESSION['racine']?>incidents\nouvel_incident_salle">Salle</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Gestion des Problèmes<span class="caret"></span></a>
                           <ul class="dropdown-menu">
                               <li><a href="<?php echo $_SESSION['racine']?>incidents/gestion_incidents_recurrents">gestion incidents recurrents</a></li>
                               <li><a href="<?php echo $_SESSION['racine']?>incidents/gestion_incidents_non_recurrents">gestion incidents non recurrents</a></li>
                           </ul>
                        </li>
                        <li><a href="<?php echo $_SESSION['racine']?>incidents\statistiques">Statistiques</a></li>                        
                    </ul>
                </li>

                <li><a href="<?php echo $_SESSION['racine']?>casques/gestion_stock">Casques<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $_SESSION['racine']?>casques/gestion_stock">Gestion du stock</a></li>
                        <li><a href="#">Etudiants <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $_SESSION['racine']?>casques/attribution_etudiant">Attribution a un Etudiant</a></li>
                                <li><a href="<?php echo $_SESSION['racine']?>casques/attrib_liste_etudiants">Attribution a une liste d'étudiants</a></li>
                                <li><a href="<?php echo $_SESSION['racine']?>casques/retour_casque_etudiant">Retour casque</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Agents <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $_SESSION['racine']?>casques/attribution_agent">Attribution a un Agent</a></li>
                                <li><a href="<?php echo $_SESSION['racine']?>casques/attrib_liste_agents">Attribution a une liste d'agents</a></li>
                                <li><a href="<?php echo $_SESSION['racine']?>casques/attrib_pool_agents">Attribution a un pool</a></li>
                                <li><a href="<?php echo $_SESSION['racine']?>casques/retour_casque_agent">Retour casque</a></li>
                                <li><a href="<?php echo $_SESSION['racine']?>casques/retour_pool_agents">Retour casque pool</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li><a href="<?php echo $_SESSION['racine']?>cartes/retour_cartes_tempo">Cartes<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $_SESSION['racine']?>cartes/importation_cartes">Importation</a></li>
                        <li><a href="#">Exportation<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $_SESSION['racine']?>cartes/exportation_scopus">vers SCOPUS</a></li>
                                <li><a href="<?php echo $_SESSION['racine']?>cartes/exportation_Agirh">vers AGIRH</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Attribution<span class="caret"></span></a>
                            <ul class="dropdown-menu">
							    <li><a href="<?php echo $_SESSION['racine']?>cartes/attrib_def">Carte définitive</a></li>
                                <li><a href="<?php echo $_SESSION['racine']?>cartes/attrib_tempo_etudiant">Carte temporaire Un Etudiant</a></li>
                                <li><a href="<?php echo $_SESSION['racine']?>cartes/attrib_liste_etudiants">Carte temporaire Un groupe</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo $_SESSION['racine']?>cartes/perte_carte_definitive">Déclaration perte de carte définitive</a></li>
                        <li><a href="<?php echo $_SESSION['racine']?>cartes/retour_cartes_tempo">Retour carte provisoire</a></li>
                        <li><a href="<?php echo $_SESSION['racine']?>cartes/retour_carte_definitive">Retour carte définitive</a></li>
						 <li><a href="<?php echo $_SESSION['racine']?>cartes/historiques">Historiques</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo $_SESSION['racine']?>public/deconnexion.php">Deconnexion</a></li>

            </ul>

        </div><!--/.nav-collapse -->
    </div>
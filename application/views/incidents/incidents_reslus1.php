



            <div class="fw-body">
    <div class="content">
        <h1 class="page_title">Incidents en cours - en attente du CFM</h1>

   

        <div class="row">
        <div class="col-lg-1 col-sm-1 col-xs-1"> <!-- class="col-lg-4 col-sm-3 col-xs-4 xs = extra small screens (mobile phones) sm = small screens (tablets) md = medium screens (some desktops) lg = large screens (remaining desktops) -->
        <table class="table">
            <thead>
            <tr>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <?php                       
                        $donnees=mysqli_fetch_array($resolus);
                        $total=$donnees[0];
                        ?>
                <td  class="active"><?php echo $total; ?></td>
            </tr>
            </tbody>
        </table>
        </div>
        </div>  
                   
                <div class="clear"></div>
                <TABLE id="resolus" class="table text-center" cellspacing="0" width="100%">
                                    <thead>
                                       <TR>
                                                <TH>Num incident</TH>
                                                <TH>Date création</TH>
                                                <TH>Nom Prénom</TH>
                                                <TH>Identifiants</TH>
                                                <TH>Télephone</TH>
                                                <TH>Description problème</TH>
                                                <TH>Dernier dépannage</TH>
                                      </TR>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                    <td colspan="7" class="dataTables_empty">Chargement des données...</td>
                                            </tr>
                                    </tbody>
                </TABLE>




    </div>
</div>
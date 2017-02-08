
<?php include('nav_techniciens.php');?>


            <div class="fw-body">
    <div class="content">
        <h1 class="page_title">Incidents résolus :</h1>

        
 <div class="modal modal-wide" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog" style="width: 920px;height:650"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-modal-edit" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="titremodal"></h4>
      </div>
      <div class="modal-body">
         <iframe id="iframe" src="" style="zoom:0.95" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close-modal-edit">Close</button>
        <!--<button type="button" class="btn btn-primary">Sign now!</button>-->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
   

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
                   
              <!--  <div class="clear"></div>
                <div id='rechercher'></div>
                <div style="float:left;padding-top:7px;background-color: #F7951E;"><b>Rechercher dans:</b><select id="choix" name="choix" style="margin-left:10px;margin-right:10px;"><option name="choix" value="id">Num Incident</option><option name="choix" value="date">Date</option><option name="choix" value="nom">Nom - Prénom</option><option name="choix" value="identifiant">Identifiant</option><option name="choix" value="pb">Problème</option></select></div>
                <div class="clear"></div>  
                <input type="button" class="rech" value="OK" />-->
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